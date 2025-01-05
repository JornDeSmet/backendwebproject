<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout Cancelled') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Checkout Cancelled</h1>
        <p class="mb-4">Your payment was not completed.</p>
        <a href="{{ url('/cart') }}" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
            Return to Cart
        </a>
    </div>
</x-app-layout>
