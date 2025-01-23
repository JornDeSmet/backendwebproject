<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Your Orders') }}
            </h2>
            <nav class="flex space-x-4">
                <a href="{{ route('profile.edit') }}"
                   class="text-gray-600 hover:text-gray-800 border-b-2 border-transparent hover:border-gray-800">
                    {{ __('Profile') }}
                </a>
                <a href="{{ route('cart.index') }}"
                   class="text-gray-600 hover:text-gray-800 border-b-2 border-transparent hover:border-gray-800">
                    {{ __('Cart') }}
                </a>
                <a href="{{ route('profile.orders') }}"
                   class="text-gray-600 hover:text-gray-800 border-b-2 border-transparent hover:border-gray-800">
                    {{ __('Orders') }}
                </a>
            </nav>
        </div>
    </x-slot>

    <div class="container mx-auto max-w-4xl p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Your Orders</h1>

        @if ($orders->count() > 0)
            @foreach ($orders as $order)
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <!-- Order Header -->
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Order #{{ $order->id }}</h2>
                            <p class="text-sm text-gray-500">Placed on: {{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <span class="text-sm px-3 py-1 rounded-full
                                @if($order->status === 'completed') bg-green-100 text-green-600
                                @elseif($order->status === 'pending') bg-yellow-100 text-yellow-600
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-600
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Order Details -->
                    <div class="border-t pt-4">
                        <p class="text-gray-600"><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
                        <h3 class="text-lg font-semibold mt-4 text-gray-800">Items:</h3>
                        <ul class="mt-2">
                            @foreach ($order->items as $item)
                                <li class="flex justify-between text-gray-600 border-b py-2">
                                    <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                    <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center bg-gray-100 p-6 rounded-lg">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">No Orders Yet</h2>
                <p class="text-gray-500">You haven’t placed any orders yet. Start shopping now!</p>
                <a href="{{ route('shop.index') }}"
                   class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-600">
                    Shop Now
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
