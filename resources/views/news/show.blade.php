<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-custom mx-auto sm:px-8 lg:px-10" style="width: 60%">
            <x-go-back/>
            <div class="bg-white shadow-md sm:rounded-lg m-4">
                <div class="container mx-auto p-6">
                @if(session('success'))
                    <div x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 4000)"
                        class="bg-green-500 text-white p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <h1 class="text-3xl font-bold mb-4">{{ $news->title }}</h1>

                <div class="w-full max-h-[800px] bg-white flex items-center justify-center overflow-hidden rounded-lg mb-4">
                    <img
                        src="{{ $news->image ? asset('storage/' . $news->image) : 'default-image.jpg' }}"
                        alt="News Image"
                        class="max-w-full max-h-full object-contain"
                    />
                </div>



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
                @auth
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
                @endauth
                <div class="mt-6">
                    <h3 class="text-2xl font-bold mb-4">Comments</h3>

                    <!-- Add Comment Form -->
                    @auth
                        <form action="{{ route('news.addComment', $news) }}" method="POST" class="mb-6">
                            @csrf
                            <textarea name="content" rows="3" class="w-full p-2 border rounded" placeholder="Add a public comment..." required></textarea>
                            <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Comment</button>
                        </form>
                    @endauth

                    <!-- Recursive Comments -->
                    <div class="space-y-4">
                        @foreach($comments as $comment)
                            @include('news.partials.comment', ['comment' => $comment])
                        @endforeach
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>


</x-app-layout>
