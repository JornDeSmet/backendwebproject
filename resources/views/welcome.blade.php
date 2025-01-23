<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-4">Welcome to Our Platform!</h1>
                    <p class="text-gray-700 mb-4">
                        Our platform offers a range of features and tools to help you get the best experience. Here’s what you can do once you log in:
                    </p>

                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>
                            <strong>Access Your Dashboard:</strong> Once logged in, you’ll have a personalized dashboard where you can view your activity and manage your profile.
                        </li>
                        <li>
                            <strong>Shop for Products:</strong> Browse and shop for a wide variety of products directly from our store.
                        </li>
                        <li>
                            <strong>View News and Updates:</strong> Stay updated with the latest news and announcements through our news section.
                        </li>
                        <li>
                            <strong>Participate in Discussions:</strong> Add comments and engage with the community on news articles and other discussions.
                        </li>
                        <li>
                            <strong>Manage Your Orders:</strong> Track your orders and view detailed order histories in your profile.
                        </li>
                        <li>
                            <strong>Contact Us:</strong> Reach out to our support team for any questions or assistance.
                        </li>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <li>
                                    <strong>Admin Tools:</strong> As an admin, you can manage users, products, orders, and more through the admin panel.
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <p class="text-gray-700 mt-6">
                        Don’t have an account yet? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Sign up here</a> to unlock all the features and get started!
                    </p>

                    <div class="mt-6">
                        <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 shadow">
                            Login Now
                        </a>
                        <a href="{{ route('register') }}" class="ml-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 shadow">
                            Register
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
