<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Successful') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Thank You for Your Order!</h1>
        <p>Your order has been successfully placed.</p>
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>

        <h2 class="text-2xl font-bold mt-6">Order Items</h2>
        <table class="w-full mt-4">
            <thead>
                <tr>
                    <th class="text-left py-2">Product</th>
                    <th class="text-left py-2">Quantity</th>
                    <th class="text-left py-2">Price</th>
                    <th class="text-left py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td class="py-2">{{ $item->product->name }}</td>
                        <td class="py-2">{{ $item->quantity }}</td>
                        <td class="py-2">${{ number_format($item->price, 2) }}</td>
                        <td class="py-2">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
