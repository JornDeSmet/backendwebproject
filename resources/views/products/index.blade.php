<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>
    </head>
    <body class="bg-gray-100">

        <div class="container mx-auto p-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">All Products</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white shadow-md rounded-lg p-4">

                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="rounded-lg w-full h-40 object-cover mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
                        <p class="text-gray-600 text-sm mt-2">{{ Str::limit($product->description, 50) }}</p>
                        <p class="text-green-500 font-bold mt-2">${{ number_format($product->price, 2) }}</p>

                        <a href="{{ route('products.show', $product->id) }}" class="block mt-4 text-center bg-blue-500 text-white py-2 rounded-lg shadow hover:bg-blue-600">
                            View Details
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </body>
    </html>


</x-app-layout>
