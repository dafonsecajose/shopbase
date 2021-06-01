<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        //session()->forget('cart');
        $cart = session()->has('cart') ? session()->get('cart') : [];
        $newCart = $this->verifyAmountProduct($cart);


        if (multi_array_key_exists('erro', $newCart)) {
            flash('Opss! Alguns produtos estão em falta no estoque vefique o carrinho')->warning();
        }
        $cart = session()->get('cart');
        $shippingConfig = session()->get('shipping');


        return view('cart', compact(['cart', 'shippingConfig']));
    }

    public function add(Request $request)
    {
        $productData = $request->get('product');

        $product = Product::whereSlug($productData['slug']);

        if (!$product->count() || $productData['amount'] <= 0) {
            return redirect()->route('home');
        }


        $product = $product->first(['id', 'name', 'price'])->toArray();
        $product = array_merge($productData, $product);


        if (session()->has('cart')) {
            $products = session()->get('cart');
            $productsSlugs = array_column($products, 'slug');
            if (in_array($product['slug'], $productsSlugs)) {
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                session()->put('cart', $products);
                $this->configShipping();
            } else {
                session()->push('cart', $product);
                $this->configShipping();
            }
        } else {
            $products[] = $product;
            session()->put('cart', $products);
            $this->configShipping();
        }
        flash('Product adicionado no carrinho!')->success();
        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }

    public function remove($slug)
    {
        if (!session()->has('cart')) {
            return redirect()->route('cart.index');
        }

        $products = session()->get('cart');
        $products = array_filter($products, function ($line) use ($slug) {
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);
        $this->configShipping();
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        session()->forget('cart');
        session()->forget('shipping');
        flash('Desistência da compra realizada com sucesso!')->success();
        return redirect()->route('cart.index');
    }

    private function productIncrement($slug, $amount, $products)
    {
        $products = array_map(function ($line) use ($slug, $amount) {
            if ($slug == $line['slug']) {
                $line['amount'] += $amount;
            }
            return $line;
        }, $products);

        return $products;
    }

    private function verifyAmountProduct($cart)
    {
        if (!multi_array_key_exists('erro', $cart)) {
            $newCartItens = array_map(function ($line) {
                $product = Product::find($line['id']);
                if ($product->amount == 0) {
                    $line['amount'] = 0;
                    $line['price'] = 0.00;
                    $line['erro'] = 'Oopps! O estoque do produto acima acabou';
                } elseif ($line['amount'] > $product->amount) {
                    $line['amount'] = $product->amount;
                    $line['erro'] = 'Ooops! Alteramos a quantidade do produto acima, pois, o estoque foi reduzido.';
                }
                return $line;
            }, $cart);
            session()->put('cart', $newCartItens);
        } else {
            $newCartItens = array_map(function ($line) {
                if ($line['amount'] == 0) {
                    unset($line);
                } else {
                    unset($line['erro']);
                    return $line;
                }
            }, $cart);
//

            $newCartItens = array_filter($newCartItens);

            session()->put('cart', $newCartItens);
        }
        return $newCartItens;
    }

    private function configShipping()
    {
        $cart = session()->get('cart');
        $shipping['height'] = 0;
        $shipping['width'] = 0;
        $shipping['depth'] = 0;
        $shipping['weight'] = 0;
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            $shipping['weight'] += ($product->weight * $item['amount']);
            $shipping['height'] = ($shipping['height'] >= $product->height) ? $shipping['height'] : $product->height;
            $shipping['width'] = ($shipping['width'] >= $product->width) ? $shipping['width'] : $product->width;
            $shipping['depth'] = ($shipping['depth'] >= $product->depth) ? $shipping['depth'] : $product->depth;
        }
        session()->put('shipping', $shipping);
    }
}
