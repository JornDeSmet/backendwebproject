<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user'); // Load related user data for orders

        // Filtering by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filtering by user name
        if ($request->has('user_name') && $request->user_name !== '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user_name . '%');
            });
        }

        $orders = $query->latest()->paginate(10);

        return view('admin-orders.index', compact('orders'));
    }
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);

        return view('admin-orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.show', $order->id)->with('status', 'Order status updated successfully!');
    }


}
