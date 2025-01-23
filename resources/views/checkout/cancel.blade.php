<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout Cancelled') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <h1 class="text-4xl font-bold text-red-500 mb-4">Checkout Cancelled</h1>
            <p class="text-gray-700 text-lg mb-6">
                Oops! Your payment was not completed. You can return to your cart and try again.
            </p>

            <div class="flex justify-center">
                <a href="{{ url('/cart') }}"
                   class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-600 transition duration-200">
                    Return to Cart
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
