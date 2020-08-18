<?php

namespace App\Http\Controllers;

use App\Jobs\OrderEmail;
use App\Jobs\OrderShopMail;
use App\OrderUser;
use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;
use App\Product;
use App\Shipping\Shipping;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CheckoutController extends Controller
{

    public function index()
    {
        //session()->forget('pagseguro_session_code');
        try {
            if (!auth()->check()) {
                return redirect()->route('login');
            }

            if (!session()->has('cart')) return redirect()->route('home');

            $this->makePagSeguroSession();


            $total = 0;

            $cardItens = array_map(function ($line) {
                return $line['amount'] * $line['price'];
            }, session()->get('cart'));

            $cardItens = array_sum($cardItens);
            $address = auth()->user()->adresses()->where('address_type', 'ADDRESS_DELIVERY')->first();
            $shipping = session()->get('shipping');

            $optionsShipping = new Shipping($address->zip_code, $shipping['height'], $shipping['depth'], $shipping['width'], $shipping['weight']);
            $optionsShipping = $optionsShipping->calculateShipping();

            return view('checkout', compact(['cardItens', 'address', 'optionsShipping']));
        } catch (\Exception $e) {
            session()->forget('pagseguro_session_code');
            redirect()->route('checkout.index');
        }
    }

    public function proccess(Request $request)
    {
//        try {
            $dataPost = $request->except('shipChoice');
            $shipChoice = $request->get('shipChoice');
            $user = auth()->user();
            $cartItems = session()->get('cart');
            $reference = Uuid::uuid4();

            $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference, $shipChoice);

            $result = $creditCardPayment->doPayment();

            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
            ];

            $userOrder = $user->orders()->create($userOrder);

            $tags = array_map(function ($tag) {
                $newTags = $tag;
                $newTags['product_id'] = $newTags['id'];
                unset($newTags['id']);
                return $newTags;
            }, $cartItems);

            $userOrder->itens()->createMany($tags);
            $this->removeItemStock($cartItems);


            //Notificar loja de novo pedido

            $user = (new User())->notifyUserOwners();

            $op = [
                'subject'   => 'Pedido registrado com sucesso',
                'option'    => '1'
            ];


            \App\Jobs\OrderEmail::dispatch(auth()->user(), $op)->delay(now()->addSecond(15));

            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado com sucesso!',
                    'order' => $reference,
                    'shipRes' => $shipChoice,
                ]
            ]);

//        } catch (\Exception $e) {
//
//            $message = env('APP_DEBUG') ? simplexml_load_string($e->getMessage()) : 'Erro ao processar o pedido!';
//            return response()->json([
//                'data' => [
//                    'status' => false,
//                    'message' => $message,
//                ]
//            ], 401);
//        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function notification()
    {
        try {
            $notification = new Notification();
            $notification = $notification->getTransaction();
            //Atualizar o pedido do usuario
            $reference = base64_decode($notification->getReference());

            $orderUser = OrderUser::whereReference($reference);

            $orderUser->update([
                'pagseguro_status' => $notification->getStatus()
            ]);

            if ($notification->getStatus() == 3) {
                //Pago Liberar para separação
                //Notificar o usuario que pedido foi pago
                $option = [
                    'subject' => 'Confirmação de Pagamento',
                    'option'  => 3
                ];
                OrderEmail::dispatch($orderUser->user(), $option);
                //Notificar a loja para a confirmação do pedido
                $owner = User::where('role', 'ROLE_OWNER');

                $optionOwner = [
                    'subject' => `O pedido {{$orderUser->reference}} foi pago!.`,
                    'option' => 3
                ];
                OrderShopMail::dispatch($owner, $optionOwner, $orderUser);

            }

        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : '';
            return response()->json(['error' => $message], 500);
        }

    }

    private function makePagSeguroSession()
    {
        if (!session()->has('pagseguro_session_code')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());

        }
    }

    private function removeItemStock($items)
    {
        foreach ($items as $item){
            $product = Product::find($item['id']);
                $product->amount -= $item['amount'];
                $product->update();
        }
    }


}
