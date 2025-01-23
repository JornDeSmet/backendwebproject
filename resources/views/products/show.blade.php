<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <x-go-back/>

        <!-- Product Details -->
        <div class="bg-white shadow-md rounded-lg p-6 flex flex-wrap">
            <!-- Product Image -->
            <div class="w-full md:w-1/2">
                <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" alt="{{ $product->name }}" class="rounded-lg shadow-md w-full">
            </div>

            <!-- Product Info -->
            <div class="w-full md:w-1/2 md:pl-8 mt-6 md:mt-0">
                <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
                <p class="mt-4 text-gray-600">{{ $product->description }}</p>
                <p class="mt-4 text-2xl font-semibold text-green-500">${{ number_format($product->price, 2) }}</p>
                <p class="mt-2 text-sm text-gray-500">Stock: {{ $product->stock }}</p>

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add') }}" method="POST" class="mt-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <!-- Quantity Selector -->
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity:</label>
                    <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        min="1"
                        max="{{ $product->stock }}"
                        value="1"
                        class="mt-1 block w-20 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        oninput="if(this.value > {{ $product->stock }}) this.value = {{ $product->stock }}">

                    <!-- Submit Button -->
                    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
