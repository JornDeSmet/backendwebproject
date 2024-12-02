<x-app-layout>
    <div class="container mx-auto p-6">
        <!-- Page Title -->
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Contact Form Submissions</h1>
        @if(session('success'))
            <div x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 4000)"
                class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif


        <!-- Table Section -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
            <table class="w-full min-w-full table-auto border-collapse">
                <!-- Table Header -->
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-6 py-3 text-left font-medium">Name</th>
                        <th class="px-6 py-3 text-left font-medium">Email</th>
                        <th class="px-6 py-3 text-left font-medium">Message</th>
                        <th class="px-6 py-3 text-left font-medium">Replied</th>
                        <th class="px-6 py-3 text-left font-medium">Actions</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    @foreach ($contactForms as $contactForm)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-6 py-4">{{ $contactForm->name }}</td>
                        <td class="px-6 py-4">{{ $contactForm->email }}</td>
                        <td class="px-6 py-4">{{ Str::limit($contactForm->message, 50) }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-3 py-1 text-sm font-semibold
                                {{ $contactForm->replied ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }} rounded-full">
                                {{ $contactForm->replied ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin-contact.show', $contactForm->id) }}"
                               class="inline-block bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

