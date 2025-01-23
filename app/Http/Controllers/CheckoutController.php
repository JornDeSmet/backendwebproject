<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Exception;

class CheckoutController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->firstOrFail();

        $lineItems = [];
        foreach ($cart->items as $item) {
            if ($item->product->stock < $item->quantity) {
                return redirect()->back()->withErrors("Insufficient stock for product: {$item->product->name}");
            }
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->product->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $checkoutSession = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success'),
                'cancel_url' => route('checkout.cancel'),
            ]);

            return redirect($checkoutSession->url);
        } catch (Exception $e) {
            session()->flash('error', 'Something went wrong with the payment server. Please try again later.');
            return redirect()->back();

        }
    }

    public function success()
    {
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->firstOrFail();

        $total = $cart->items->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'stripe_payment_id' => request('payment_intent'),
        ]);

        foreach ($cart->items as $cartItem) {
            $product = $cartItem->product;
            if ($product->stock < $cartItem->quantity) {
                throw new \Exception("Insufficient stock for product: {$product->name}");
            }
            $product->stock -= $cartItem->quantity;
            $product->save();

            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $cartItem->quantity,
                'price' => $product->price,
            ]);
        }

        $cart->items()->delete();
        $cart->delete();

        return view('checkout.success', compact('order'));
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}
