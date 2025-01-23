<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
            <nav class="flex space-x-4">
                <a href="{{ route('profile.edit') }}"
                   class="text-gray-600 hover:text-gray-800 border-b-2 border-transparent hover:border-gray-800">
                    {{ __('Profile') }}
                </a>
                <a href="{{ route('cart.index') }}"
                   class="text-gray-600 hover:text-gray-800 border-b-2 border-transparent hover:border-gray-800">
                    {{ __('Cart') }}
                </a>
                <a href="{{ route('profile.orders') }}"
                   class="text-gray-600 hover:text-gray-800 border-b-2 border-transparent hover:border-gray-800">
                    {{ __('Orders') }}
                </a>
            </nav>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
