<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">News List</h1>

        @if (session('status') === 'news-added')
            <h1
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 4000)"
                class="text-sm text-gray-600 font-bold text-2xl"
            >{{ __('News added') }}</h1>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @if(auth()->user()->role === 'admin')
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <button id="openModalButton" class="text-2xl font-bold text-blue-500 hover:underline">Add New News</button>
                </div>
            @endif

            @foreach ($news as $item)
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <h2 class="text-xl font-semibold">
                        <a href="{{ route('news.show', $item->id) }}" class="text-blue-500 hover:underline">
                            {{ $item->title }}
                        </a>
                    </h2>
                    <p class="text-gray-500">{{ $item->summary }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div id="addNewsModal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white w-full max-w-4xl p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Create New News</h2>
            <form id="addNewsForm" method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input id="title" name="title" type="text" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Image -->
                <div class="mt-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input id="image" name="image" type="file" accept="image/*"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Summary -->
                <div class="mt-4">
                    <label for="summary" class="block text-sm font-medium text-gray-700">Summary</label>
                    <input id="summary" name="summary" type="text" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Content -->
                <div class="mt-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content" rows="4" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>

                <!-- Author (Dropdown) -->
                <div class="mt-4">
                    <label for="author_id" class="block text-sm font-medium text-gray-700">Author</label>
                    <select id="author_id" name="author_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="" disabled>Select an author</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                @if(auth()->user() && auth()->user()->id == $user->id) selected @endif>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end">
                    <button type="button" id="closeModalButton"
                        class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Add News
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal open/close logic
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const addNewsModal = document.getElementById('addNewsModal');
        const addNewsForm = document.getElementById('addNewsForm');

        // Open Modal
        openModalButton.addEventListener('click', () => {
            addNewsModal.classList.remove('hidden');
        });

        // Close Modal and Reset Form
        const closeModal = () => {
            addNewsModal.classList.add('hidden');
            addNewsForm.reset(); // Reset the form fields
        };

        closeModalButton.addEventListener('click', closeModal);
    </script>
</x-app-layout>
