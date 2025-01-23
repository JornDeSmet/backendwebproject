<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin - Orders') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Order Details</h1>
        <a href="{{ route('admin.orders.index') }}" class="text-blue-500 hover:text-blue-700 font-semibold mb-4 inline-block">
            &larr; Back to Orders
        </a>
        <!-- Order Info -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Order #{{ $order->id }}</h2>
            <p><strong>User:</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
            <p><strong>Address:</strong> {{ $order->user->address_line }}, {{ $order->user->city }}, {{ $order->user->state }}, {{ $order->user->postal_code }}, {{ $order->user->country }}</p>
            <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
        </div>

        <!-- Order Items -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-6">
            <h2 class="text-xl font-bold mb-4">Items</h2>
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Product</th>
                        <th class="border px-4 py-2">Quantity</th>
                        <th class="border px-4 py-2">Price</th>
                        <th class="border px-4 py-2">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->product->name }}</td>
                            <td class="border px-4 py-2">{{ $item->quantity }}</td>
                            <td class="border px-4 py-2">${{ number_format($item->product->price, 2) }}</td>
                            <td class="border px-4 py-2">${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Actions -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-6">
            <h2 class="text-xl font-bold mb-4">Actions</h2>

            <!-- Update Status -->
            <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="mb-4">
                @csrf
                @method('PATCH')
                <label for="status" class="block text-sm font-medium text-gray-700">Update Status</label>
                <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded hover:bg-blue-600">
                    Update Status
                </button>
            </form>

            <!-- Cancel Order -->
            @if ($order->status !== 'cancelled')
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Cancel Order
                    </button>
                </form>
            @endif
        </div>
    </div>

</x-app-layout>


