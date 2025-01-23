<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="container mx-auto p-6">
                    <!-- Success or Status Messages -->
                    @if(session('status'))
                        <div x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 class="text-2xl font-bold mb-6">Users List</h1>
                    <div bg-white p-6 rounded-lg shadow-lg>


                    <!-- Add New User Button (Admin Only) -->
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <div class="mb-4">
                                <button id="openModalButton" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Add New User
                                </button>
                            </div>
                        @endif
                    @endauth

                    <!-- User Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($users as $user)
                            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                                <!-- User Name -->
                                <h2 class="text-xl font-semibold">
                                    <a href="{{ route('users.show', $user->id) }}" class="text-blue-500 hover:underline">
                                        {{ $user->name }}
                                    </a>
                                </h2>
                                <!-- User Email -->
                                <p class="text-gray-500">{{ $user->email }}</p>

                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <!-- Admin Controls -->
                                        <div class="mt-4">
                                            <!-- Toggle Admin -->
                                            <form action="{{ route('users.toggle-admin', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700">
                                                    {{ $user->role === 'admin' ? 'Revoke Admin' : 'Make Admin' }}
                                                </button>
                                            </form>

                                            <!-- Delete User -->
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700"
                                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Controls -->
                    <div class="mt-6">
                        {{ $users->links('pagination::tailwind') }}
                    </div>
                </div>

                <!-- Add New User Modal -->
                @auth
                    @if(auth()->user()->role === 'admin')
                        <div id="addUserModal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
                            <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg">
                                <h2 class="text-xl font-bold mb-4">Create New User</h2>
                                <form id="addUserForm" method="POST" action="{{ route('users.store') }}">
                                    @csrf

                                    <!-- Name -->
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input id="name" name="name" type="text" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <!-- Email -->
                                    <div class="mt-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input id="email" name="email" type="email" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <!-- Birth Date -->
                                    <div class="mt-4">
                                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Birth Date</label>
                                        <input id="birth_date" name="birth_date" type="date" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <!-- Password -->
                                    <div class="mt-4">
                                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                        <input id="password" name="password" type="password" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mt-4">
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                        <input id="password_confirmation" name="password_confirmation" type="password" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <!-- Role -->
                                    <div class="mt-4">
                                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                        <select id="role" name="role"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>

                                    <!-- Address -->
                                    <div class="mt-4">
                                        <label for="address_line" class="block text-sm font-medium text-gray-700">Address Line</label>
                                        <input id="address_line" name="address_line" type="text" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <div class="mt-4">
                                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                        <input id="city" name="city" type="text" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <div class="mt-4">
                                        <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                                        <input id="state" name="state" type="text"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <div class="mt-4">
                                        <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                                        <input id="postal_code" name="postal_code" type="text" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <div class="mt-4">
                                        <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                        <input id="country" name="country" type="text" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <!-- Buttons -->
                                    <div class="mt-6 flex justify-end">
                                        <button type="button" id="closeModalButton"
                                            class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">
                                            Cancel
                                        </button>
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                            Add User
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <script>
        // Modal open/close logic
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const addUserModal = document.getElementById('addUserModal');
        const addUserForm = document.getElementById('addUserForm');

        // Open Modal
        openModalButton?.addEventListener('click', () => {
            addUserModal.classList.remove('hidden');
        });

        // Close Modal and Reset Form
        const closeModal = () => {
            addUserModal.classList.add('hidden');
            addUserForm.reset();
        };

        closeModalButton?.addEventListener('click', closeModal);
    </script>
</x-app-layout>
