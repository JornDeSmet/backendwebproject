<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin - Products') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Manage Products</h1>

        <!-- Add Product Button -->
        <div class="flex justify-end mb-6">
            <a href="{{ route('products.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Add Product
            </a>
        </div>

        <!-- Products Table -->
        <div class="bg-white rounded-lg shadow p-6">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2 bg-gray-100 text-left">ID</th>
                        <th class="border px-4 py-2 bg-gray-100 text-left">Name</th>
                        <th class="border px-4 py-2 bg-gray-100 text-left">Price</th>
                        <th class="border px-4 py-2 bg-gray-100 text-left">Stock</th>
                        <th class="border px-4 py-2 bg-gray-100 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="border px-4 py-2">{{ $product->id }}</td>
                            <td class="border px-4 py-2">{{ $product->name }}</td>
                            <td class="border px-4 py-2 text-green-600 font-bold">${{ number_format($product->price, 2) }}</td>
                            <td class="border px-4 py-2">
                                @if ($product->stock > 10)
                                    <span class="text-green-600 font-medium">{{ $product->stock }}</span>
                                @elseif($product->stock > 0)
                                    <span class="text-yellow-600 font-medium">{{ $product->stock }}</span>
                                @else
                                    <span class="text-red-600 font-medium">Out of Stock</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <!-- Edit Button -->
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="text-yellow-500 hover:underline mr-4">
                                    Edit
                                </a>

                                <!-- Delete Form -->
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500 hover:underline"
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border px-4 py-2 text-center text-gray-500">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
