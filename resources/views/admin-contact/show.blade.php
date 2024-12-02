<x-app-layout>
    <div class="container mx-auto p-6">
        <!-- Page Title -->
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Contact Form Details</h1>


        <!-- Contact Form Details -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <p class="text-lg font-medium text-gray-700 mb-4"><strong>Name:</strong> {{ $contactForm->name }}</p>
            <p class="text-lg font-medium text-gray-700 mb-4"><strong>Email:</strong> {{ $contactForm->email }}</p>
            <p class="text-lg font-medium text-gray-700 mb-4"><strong>Message:</strong>
                <span class="block break-words">
                    {{ $contactForm->message }}
                </span>
            </p>
            <p class="text-lg font-medium text-gray-700 mb-4"><strong>Replied:</strong>
                <span class="{{ $contactForm->replied ? 'text-green-500' : 'text-red-500' }}">
                    {{ $contactForm->replied ? 'Yes' : 'No' }}
                </span>
            </p>
        </div>


        <!-- Reply Form -->
        @if (!$contactForm->replied)
        <div class="bg-white shadow-lg rounded-lg p-6">
            <form action="{{ route('admin-contact.reply', $contactForm->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="reply_message" class="block text-gray-700 font-medium mb-2">Reply Message:</label>
                    <textarea name="reply_message" id="reply_message" rows="5" class="w-full p-3 border border-gray-300 rounded-lg" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition duration-200">Send Reply</button>
            </form>
        </div>
        @else
        <p class="mt-4 text-gray-700 italic"><em>You have already replied to this message.</em></p>
        @endif

        <!-- Back to List Link -->
        <div class="mt-6">
            <a href="{{ route('admin-contact.index') }}" class="inline-block bg-gray-500 text-white py-2 px-6 rounded-lg hover:bg-gray-600 transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>
    </div>
</x-app-layout>
