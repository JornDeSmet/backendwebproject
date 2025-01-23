<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Your Cart') }}
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

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Your Cart</h1>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Error:</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if ($cart && $cart->items->count() > 0)
            <div class="bg-white shadow-md rounded-lg p-6">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left py-2">Product</th>
                            <th class="text-left py-2">Quantity</th>
                            <th class="text-left py-2">Price</th>
                            <th class="text-left py-2">Total</th>
                            <th class="text-left py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->items as $item)
                            <tr>
                                <td class="py-2">{{ $item->product->name }}</td>
                                <td class="py-2">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input
                                            type="number"
                                            name="quantity"
                                            value="{{ $item->quantity }}"
                                            min="1"
                                            max="{{ $item->product->stock }}"
                                            class="w-16 border border-gray-300 rounded-md px-2 py-1"
                                            oninput="if(this.value > {{ $item->product->stock }}) this.value = {{ $item->product->stock }};">
                                        <button type="submit" class="text-blue-500 hover:text-blue-700 ml-2">Update</button>
                                    </form>
                                </td>
                                <td class="py-2">${{ number_format($item->product->price, 2) }}</td>
                                <td class="py-2">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                <td class="py-2">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ url('/shop') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                    Continue Shopping
                </a>
            </div>
            <div class="mt-6">
                <a href="{{ route('checkout') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">
                    Proceed to Checkout
                </a>
            </div>
        @else
            <div class="text-center bg-gray-100 p-12 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Your Cart is Empty</h2>
                <p class="text-gray-500 mb-6">Looks like you haven't added anything to your cart yet. Start exploring our shop!</p>
                <a href="{{ url('/shop') }}"
                   class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                    Shop Now
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
