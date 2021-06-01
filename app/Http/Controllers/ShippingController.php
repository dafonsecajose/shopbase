<?php

namespace App\Http\Controllers;

use App\Shipping\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function shipping(Request $request)
    {
        $data = $request->all(['nVlAltura', 'nVlComprimento', 'nVlLargura', 'nVlPeso', 'sCepDestino']);

        $shipping = new Shipping(
            $data['sCepDestino'],
            $data['nVlLargura'],
            $data['nVlComprimento'],
            $data['nVlLargura'],
            $data['nVlPeso']
        );

        $shipping = response()->json($shipping->calculateShipping());
        return $shipping;
    }
}
