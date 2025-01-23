<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin - Orders') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Manage Orders</h1>

        <!-- Filters Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Filter Orders</h2>

            <form method="GET" action="{{ route('admin.orders.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <!-- Filter by Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status" name="status" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="all">All</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <!-- Filter by User -->
                    <div>
                        <label for="user_name" class="block text-sm font-medium text-gray-700 mb-2">User</label>
                        <input
                            id="user_name"
                            type="text"
                            name="user_name"
                            value="{{ request('user_name') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Search by user name"
                        />
                    </div>

                    <!-- Filter Button -->
                    <div class="flex items-end">
                        <button
                            type="submit"
                            class="w-full bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Orders</h2>

            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-600">Order ID</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-600">User</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-600">Total Price</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-600">Order Date</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2 text-sm text-gray-800">{{ $order->id }}</td>
                            <td class="border px-4 py-2 text-sm text-gray-800">{{ $order->user->name }}</td>
                            <td class="border px-4 py-2 text-sm text-green-500 font-bold">${{ number_format($order->total_price, 2) }}</td>
                            <td class="border px-4 py-2 text-sm text-gray-800">{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="border px-4 py-2 text-sm text-gray-800">
                                <span
                                    class="px-2 py-1 rounded-md {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="border px-4 py-2 text-sm text-gray-800">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-500 hover:underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border px-4 py-2 text-center text-gray-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $orders->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
