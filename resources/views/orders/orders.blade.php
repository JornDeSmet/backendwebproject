<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Orders') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Your Orders</h1>

        @if ($orders->count() > 0)
            @foreach ($orders as $order)
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold">Order #{{ $order->id }}</h2>
                    <p class="text-gray-600">Placed on: {{ $order->created_at->format('d M Y, H:i') }}</p>
                    <p class="text-gray-600">Status: {{ ucfirst($order->status) }}</p>
                    <p class="text-gray-600">Total: ${{ number_format($order->total_price, 2) }}</p>

                    <h3 class="text-lg font-semibold mt-4">Items:</h3>
                    <ul class="list-disc list-inside">
                        @foreach ($order->items as $item)
                            <li>
                                {{ $item->product->name }} (x{{ $item->quantity }}) -
                                ${{ number_format($item->price * $item->quantity, 2) }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        @else
            <p>You have not placed any orders yet.</p>
        @endif
    </div>
</x-app-layout>
