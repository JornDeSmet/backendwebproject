<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Profile') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <x-go-back/>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">{{ $user->name }}</h1>

            @if($user->profile_picture)
                <div class="mt-3">
                    <img src="{{ asset('storage/images/' . $user->profile_picture) }}"
                         alt="Profile Picture"
                         style="width: 150px; height: 150px; border-radius: 50%;">
                </div>
            @endif

            <p class="text-lg mb-2">
                <strong>Email:</strong> {{ $user->email }}
            </p>
            <p class="text-lg mb-2">
                <strong>Birth Date:</strong> {{ $user->birth_date->format('F j, Y') }}
            </p>
            <p class="text-lg mb-2">
                <strong>About me:</strong> {{ $user->about_me }}
            </p>

            {{-- Address --}}
            <p class="text-lg mt-4 mb-2 font-semibold">Address</p>
            <ul class="list-disc list-inside text-gray-700">
                <li><strong>Line:</strong> {{ $user->address_line }}</li>
                <li><strong>City:</strong> {{ $user->city }}</li>
                <li><strong>State:</strong> {{ $user->state ?? 'N/A' }}</li>
                <li><strong>Postal Code:</strong> {{ $user->postal_code }}</li>
                <li><strong>Country:</strong> {{ $user->country }}</li>
            </ul>
            @auth
            @if(auth()->user()->role === 'admin' || auth()->id() === $user->id)
                <div class="mt-4">
                    <a href="{{ route('users.edit', $user->id) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Edit Profile
                    </a>
                </div>
            @endif
        @endauth
        </div>
    </div>
</x-app-layout>
