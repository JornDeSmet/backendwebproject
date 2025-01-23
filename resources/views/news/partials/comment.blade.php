<div class="p-4 border rounded bg-gray-50">
    <p class="break-words whitespace-normal"><strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}</p>

    <!-- Reply Form -->
    @auth
        <div x-data="{ showReplyBox: false }" class="mt-2">
            <button @click="showReplyBox = !showReplyBox"
                class="text-blue-500 text-sm hover:underline">
                Reply
            </button>

            <div x-show="showReplyBox" class="mt-2">
                <form action="{{ route('news.addComment', $news) }}" method="POST">
                    @csrf
                    <textarea name="content" rows="2" class="w-full p-2 border rounded" placeholder="Write your reply..." required></textarea>
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <button type="submit" class="mt-1 bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">Reply</button>
                </form>
            </div>
        </div>
    @endauth

    <!-- Render Replies -->
    <div class="ml-6 mt-4 space-y-4">
        @foreach($comment->replies as $reply)
            @include('news.partials.comment', ['comment' => $reply])
        @endforeach
    </div>
</div>
