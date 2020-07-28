<?php

namespace App\Http\Controllers;

use App\OrderUser;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $order;

    public function __construct(OrderUser $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders = auth()->user()->orders()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }
}
