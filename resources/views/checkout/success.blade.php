<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Successful') }}
        </h2>
    </x-slot>

    <div class="container mx-auto max-w-4xl p-6">
        <!-- Order Success Header -->
        <div class="bg-white shadow-md rounded-lg p-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Thank You for Your Order!</h1>
            <p class="text-gray-600">Your order has been successfully placed.</p>
            <p class="text-gray-700 mt-4">
                <strong>Order ID:</strong> <span class="text-blue-500">{{ $order->id }}</span>
            </p>
            <p class="text-gray-700">
                <strong>Total:</strong> <span class="text-green-500">${{ number_format($order->total, 2) }}</span>
            </p>
        </div>

        <!-- Order Items -->
        <div class="bg-white shadow-md rounded-lg mt-6 p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Order Items</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold">Product</th>
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold">Quantity</th>
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold">Price</th>
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="border-b">
                            <td class="py-3 px-4 text-gray-600">{{ $item->product->name }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $item->quantity }}</td>
                            <td class="py-3 px-4 text-gray-600">${{ number_format($item->price, 2) }}</td>
                            <td class="py-3 px-4 text-gray-600">${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-8">
            <a href="{{ route('shop.index') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                Continue Shopping
            </a>
            <a href="{{ route('profile.orders') }}" class="ml-4 bg-gray-500 text-white px-6 py-3 rounded-lg shadow hover:bg-gray-600">
                View Your Orders
            </a>
        </div>
    </div>
</x-app-layout>
