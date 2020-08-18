<?php

namespace App\Http\Controllers;

use App\Product;

class HomeController extends Controller
{

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    public function index()
    {
        $products = $this->product->where('active', 'OK')->orderby('id', 'DESC')->paginate(9);


        return view('welcome', compact('products'));
    }

    public function single($slug)
    {
        $product = $this->product->whereSlug($slug)->first();

        return view('single', compact('product'));
    }
}
