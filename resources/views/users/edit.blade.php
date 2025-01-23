<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>

                <!-- Birth Date -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="birth_date">
                        Birth Date
                    </label>
                    <input
                        type="date"
                        name="birth_date"
                        id="birth_date"
                        value="{{ old('birth_date', optional($user->birth_date)->format('Y-m-d')) }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>

                <!-- About Me -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="about_me">
                        About Me
                    </label>
                    <textarea
                        name="about_me"
                        id="about_me"
                        rows="4"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >{{ old('about_me', $user->about_me) }}</textarea>
                </div>

                <!-- Profile Picture -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="profile_picture">
                        Profile Picture
                    </label>
                    <input
                        type="file"
                        name="profile_picture"
                        id="profile_picture"
                        class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                    @if ($user->profile_picture)
                        <div class="mt-2">
                            <img
                                src="{{ asset('storage/images/' . $user->profile_picture) }}"
                                alt="Profile Picture"
                                class="w-16 h-16 rounded-full"
                            />
                        </div>
                    @endif
                </div>

                <!-- Address Fields -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="address_line">
                        Address Line
                    </label>
                    <input
                        type="text"
                        name="address_line"
                        id="address_line"
                        value="{{ old('address_line', $user->address_line) }}"
                        required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="city">
                            City
                        </label>
                        <input
                            type="text"
                            name="city"
                            id="city"
                            value="{{ old('city', $user->city) }}"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="state">
                            State
                        </label>
                        <input
                            type="text"
                            name="state"
                            id="state"
                            value="{{ old('state', $user->state) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="postal_code">
                            Postal Code
                        </label>
                        <input
                            type="text"
                            name="postal_code"
                            id="postal_code"
                            value="{{ old('postal_code', $user->postal_code) }}"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="country">
                            Country
                        </label>
                        <input
                            type="text"
                            name="country"
                            id="country"
                            value="{{ old('country', $user->country) }}"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                    </div>
                </div>

                <!-- Password Fields -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="password">
                        New Password
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Leave blank to keep current password"
                    />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="password_confirmation">
                        Confirm New Password
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Confirm new password"
                    />
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <a href="javascript:history.back()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
