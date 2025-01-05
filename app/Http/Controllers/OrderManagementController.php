<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderManagementController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items.product')->latest()->get();

        return view('admin-orders.index', compact('orders'));
    }
}
