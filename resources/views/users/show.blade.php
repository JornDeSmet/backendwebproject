<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">{{ $user->name }}</h1>
            @if($user->profile_picture)
            <div class="mt-3">
                <img src="{{ asset('storage/images/' . $user->profile_picture) }}" alt="Profile Picture" style="width: 150px; height: 150px; border-radius: 50%;">
            </div>
            @endif
            <p class="text-lg mb-2"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="text-lg mb-2"><strong>Birth Date:</strong> {{ $user->birth_date->format('F j, Y')}}</p>
            <p class="text-lg mb-2"><strong>About me:</strong> {{ $user->about_me}}</p>
        </div>
    </div>
</x-app-layout>
