<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-6">Welcome to the Dashboard!</h1>
                    <p class="text-gray-700 mb-4">
                        Here you can manage and explore different sections of the website. Use the buttons below to navigate:
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- News Section -->
                        <div class="bg-blue-100 border border-blue-500 rounded-lg p-4 text-center shadow">
                            <h2 class="text-xl font-bold mb-2">News</h2>
                            <p class="text-gray-700 mb-4">Stay updated with the latest news and announcements.</p>
                            <a href="{{ route('news.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Go to News
                            </a>
                        </div>

                        <!-- Shop Section -->
                        <div class="bg-green-100 border border-green-500 rounded-lg p-4 text-center shadow">
                            <h2 class="text-xl font-bold mb-2">Shop</h2>
                            <p class="text-gray-700 mb-4">Explore and manage products available in the shop.</p>
                            <a href="{{ route('shop.index') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                Visit Shop
                            </a>
                        </div>

                        <!-- Contact Section -->
                        <div class="bg-yellow-100 border border-yellow-500 rounded-lg p-4 text-center shadow">
                            <h2 class="text-xl font-bold mb-2">Contact</h2>
                            <p class="text-gray-700 mb-4">Reach out for support or manage contact requests.</p>
                            <a href="{{ route('contact.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                Contact Us
                            </a>
                        </div>

                        <!-- Users Section -->
                        <div class="bg-purple-100 border border-purple-500 rounded-lg p-4 text-center shadow">
                            <h2 class="text-xl font-bold mb-2">Users</h2>
                            <p class="text-gray-700 mb-4">View and manage registered users.</p>
                            <a href="{{ route('users.index') }}" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
                                Manage Users
                            </a>
                        </div>

                        <!-- FAQ Section -->
                        <div class="bg-red-100 border border-red-500 rounded-lg p-4 text-center shadow">
                            <h2 class="text-xl font-bold mb-2">FAQ</h2>
                            <p class="text-gray-700 mb-4">Find or manage frequently asked questions.</p>
                            <a href="{{ route('faq.index') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                FAQ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
