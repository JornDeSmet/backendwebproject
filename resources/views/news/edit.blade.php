<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit News</h1>

        <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $news->title)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div class="mt-4">
                <x-input-label for="image" :value="__('Image')" />
                <input type="file" name="image" id="image" class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>

            <div class="mt-4">
                <x-input-label for="summary" :value="__('Summary')" />
                <x-text-input id="summary" name="summary" type="text" class="mt-1 block w-full" :value="old('summary', $news->summary)" required />
                <x-input-error class="mt-2" :messages="$errors->get('summary')" />
            </div>


            <div class="mt-4">
                <x-input-label for="content" :value="__('Content')" />
                <textarea name="content" id="content" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-y h-64" required>{{ old('content', $news->content) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('content')" />
            </div>

            <div class="mt-4 flex items-center space-x-4">
                <a href="{{ route('news.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Cancel</a>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
