<?php

namespace App\Http\Controllers\Admin;

use App\OrderUser;
use App\Http\Controllers\Controller;
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
