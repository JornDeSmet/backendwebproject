<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">{{ $news->title }}</h1>

        <img src="{{ $news->image ? asset('storage/' . $news->image) : 'default-image.jpg' }}" alt="News Image" class="w-full h-auto rounded-lg mb-4">


        <div class="text-base text-gray-800 mb-4">
            {{ $news->content }}
        </div>

        <p>summary:</p>
        <p class="text-lg text-gray-700 mb-4">{{ $news->summary }}</p>

        <div class="text-sm text-gray-500">
            <p>By {{ $news->author->name }}</p>
            <p>Published: {{ $news->created_at->format('M d, Y') }}</p>
            <p>Last Updated: {{ $news->updated_at->format('M d, Y') }}</p>
        </div>

        @if(auth()->user()->role === 'admin')
            <div class="mt-6">
                <a href="{{ route('news.edit', $news) }}" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-700 transition duration-200 inline-block">Edit</a>

                <form action="{{ route('news.destroy', $news) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-700 transition duration-200 inline-block">Delete</button>
                </form>
            </div>
        @endif
    </div>
</x-app-layout>
