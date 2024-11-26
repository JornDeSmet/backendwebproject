<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Users</h1>
        @if (session('status') === 'user-added')
            <h1
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 4000)"
                class="text-sm text-gray-600 font-bold text-2xl"
            >{{ __('user added') }}</h1>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @if(auth()->user()->role === 'admin')
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <button id="openModalButton" class="text-2xl font-bold text-blue-500 hover:underline"> Add New User </button>
                </div>
            @endif
            @foreach ($users as $user)
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <h2 class="text-xl font-semibold">
                        <a href="{{ route('users.show', $user->id) }}" class="text-blue-500 hover:underline">
                            {{ $user->name }}
                        </a>
                    </h2>
                    <p class="text-gray-500">{{ $user->email }}</p>
                    @if(auth()->user()->role === 'admin')
                        <form action="{{ route('users.toggle-admin', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700">
                                {{ $user->role === 'admin' ? 'Revoke Admin' : 'Make Admin' }}
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
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

                <!-- Email Address -->
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

                <!-- Role Selection -->
                <div class="mt-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="role"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end">
                    <button type="button" id="closeModalButton"
                        class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        {{ __('Add user') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Modal open/close logic
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const addUserModal = document.getElementById('addUserModal');
        const addUserForm = document.getElementById('addUserForm');

        // Open Modal
        openModalButton.addEventListener('click', () => {
            addUserModal.classList.remove('hidden');
        });

        // Close Modal and Reset Form
        const closeModal = () => {
            addUserModal.classList.add('hidden');
            addUserForm.reset(); // Reset the form fields
        };

        closeModalButton.addEventListener('click', closeModal);

    </script>
</x-app-layout>
