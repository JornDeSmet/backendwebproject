<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="container mx-auto max-w-3xl p-6 bg-white rounded-lg shadow-md mt-6">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Edit Product</h1>

        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="block text-lg font-semibold mb-2">Product Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                    value="{{ old('name', $product->name) }}"
                    required
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-lg font-semibold mb-2">Description</label>
                <textarea
                    name="description"
                    id="description"
                    rows="4"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                    required
                >{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div class="mb-6">
                <label for="price" class="block text-lg font-semibold mb-2">Price</label>
                <input
                    type="number"
                    name="price"
                    id="price"
                    step="0.01"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                    value="{{ old('price', $product->price) }}"
                    required
                >
                @error('price')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stock -->
            <div class="mb-6">
                <label for="stock" class="block text-lg font-semibold mb-2">Stock</label>
                <input
                    type="number"
                    name="stock"
                    id="stock"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                    value="{{ old('stock', $product->stock) }}"
                    required
                >
                @error('stock')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div class="mb-6">
                <label for="image" class="block text-lg font-semibold mb-2">Product Image</label>
                <input
                    type="file"
                    name="image"
                    id="image"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                >
                @if ($product->image)
                    <div class="mt-4">
                        <p class="text-sm text-gray-500 mb-2">Current Image:</p>
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="Product Image"
                             class="w-40 h-auto rounded-lg border">
                    </div>
                @endif
                @error('image')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                        class="bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
