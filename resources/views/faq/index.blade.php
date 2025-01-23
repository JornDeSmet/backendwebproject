<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('FAQ and Categories') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">FAQ and Categories</h1>
        @if(session('status'))
            <div x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 4000)"
                class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif
        <div class="mt-6">
            @auth
                @if(auth()->user()->role === 'admin')
                    <button id="addCategoryBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Category</button>
                @endif
            @endauth
            <div class="mt-4">
                @foreach ($categories as $category)
                    <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                        <h3 class="text-xl font-semibold">{{ $category->name }}</h3>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <button
                                    class="text-blue-500 openEditCategoryModal"
                                    data-category-id="{{ $category->id }}"
                                    data-category-name="{{ $category->name }}">
                                    Edit
                                </button>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            @endif
                        @endauth


                        <div class="mt-4">
                            @foreach ($category->faqs as $faq)
                                <div class="bg-gray-100 p-3 rounded-md mb-2">
                                    <strong>{{ $faq->question }}</strong>
                                    <p>{{ $faq->answer }}</p>
                                    @auth
                                        @if(auth()->user()->role === 'admin')
                                            <button
                                                class="text-blue-500 openEditFaqModal"
                                                data-faq-id="{{ $faq->id }}"
                                                data-faq-question="{{ $faq->question }}"
                                                data-faq-answer="{{ $faq->answer }}"
                                                data-category-id="{{ $category->id }}">
                                                Edit
                                            </button>
                                            <form action="{{ route('faqs.destroy', $faq) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500">Delete FAQ</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            @endforeach
                        </div>

                        @auth
                            @if(auth()->user()->role === 'admin')
                                <button class="bg-green-500 text-white px-4 py-2 rounded mt-4 openFaqModal" data-category-id="{{ $category->id }}">
                                    Add FAQ
                                </button>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Add Category Modal -->
        <div id="addCategoryModal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-4">Add New Category</h2>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="category_name" class="block text-sm font-medium text-gray-700">Category Name</label>
                        <input type="text" name="name" id="category_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500" required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mr-2">Create Category</button>
                        <button type="button" id="closeCategoryModal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Edit Category Modal -->
        <div id="editCategoryModal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-4">Edit Category</h2>
                <form id="editCategoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="edit_category_name" class="block text-sm font-medium text-gray-700">Category Name</label>
                        <input id="edit_category_name" name="name" type="text" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500">
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="button" id="closeEditCategoryModal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Add FAQ Modal -->
        <div id="faqModal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-4">Add New FAQ</h2>
                <form action="{{ route('faqs.store') }}" method="POST" id="faqForm">
                    @csrf
                    <div>
                        <label for="faq_question" class="block text-sm font-medium text-gray-700">Question</label>
                        <input type="text" name="question" id="faq_question" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500" required>
                    </div>

                    <div class="mt-4">
                        <label for="faq_answer" class="block text-sm font-medium text-gray-700">Answer</label>
                        <textarea name="answer" id="faq_answer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500" rows="4" required></textarea>
                    </div>

                    <input type="hidden" name="category_id" id="category_id">

                    <div class="mt-4 flex justify-end">
                        <button type="button" id="closeFaqModal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add FAQ</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit FAQ Modal -->
        <div id="editFaqModal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-4">Edit FAQ</h2>
                <form id="editFaqForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="edit_faq_question" class="block text-sm font-medium text-gray-700">Question</label>
                        <input id="edit_faq_question" name="question" type="text" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500">
                    </div>

                    <div class="mt-4">
                        <label for="edit_faq_answer" class="block text-sm font-medium text-gray-700">Answer</label>
                        <textarea id="edit_faq_answer" name="answer" rows="4" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500"></textarea>
                    </div>

                    <input type="hidden" id="edit_faq_category_id" name="category_id">

                    <div class="mt-4 flex justify-end">
                        <button type="button" id="closeEditFaqModal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        // Open Add Category Modal
        document.getElementById('addCategoryBtn').addEventListener('click', function() {
            document.getElementById('addCategoryModal').classList.remove('hidden');
        });

        // Close Add Category Modal
        document.getElementById('closeCategoryModal').addEventListener('click', function() {
            document.getElementById('addCategoryModal').classList.add('hidden');
        });
        // Open Edit Category Modal
        document.querySelectorAll('.openEditCategoryModal').forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-category-id');
                const categoryName = this.getAttribute('data-category-name');

                const form = document.getElementById('editCategoryForm');
                form.action = `/categories/${categoryId}`;

                document.getElementById('edit_category_name').value = categoryName;

                document.getElementById('editCategoryModal').classList.remove('hidden');
            });
        });

        // Close Edit Category Modal
        document.getElementById('closeEditCategoryModal').addEventListener('click', function() {
            document.getElementById('editCategoryModal').classList.add('hidden');
        });

        // Open Add FAQ Modal
        document.querySelectorAll('.openFaqModal').forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-category-id');
                document.getElementById('category_id').value = categoryId;
                document.getElementById('faqModal').classList.remove('hidden');
            });
        });

        // Close Add FAQ Modal
        document.getElementById('closeFaqModal').addEventListener('click', function() {
            document.getElementById('faqModal').classList.add('hidden');
        });

        // Open Edit FAQ Modal
        document.querySelectorAll('.openEditFaqModal').forEach(button => {
            button.addEventListener('click', function() {
                const faqId = this.getAttribute('data-faq-id');
                const question = this.getAttribute('data-faq-question');
                const answer = this.getAttribute('data-faq-answer');
                const categoryId = this.getAttribute('data-category-id');

                const form = document.getElementById('editFaqForm');
                form.action = `/faq/${faqId}`;

                document.getElementById('edit_faq_question').value = question;
                document.getElementById('edit_faq_answer').value = answer;
                document.getElementById('edit_faq_category_id').value = categoryId;

                document.getElementById('editFaqModal').classList.remove('hidden');
            });
        });


        // Close Edit FAQ Modal
        document.getElementById('closeEditFaqModal').addEventListener('click', function() {
            document.getElementById('editFaqModal').classList.add('hidden');
        });
    </script>
</x-app-layout>
