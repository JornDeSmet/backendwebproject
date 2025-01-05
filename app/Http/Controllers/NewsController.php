<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Policies\NewsPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Comment;


class NewsController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $news = News::latest()->get();
        $users = User::orderBy('name', 'asc')->get();

        return view('news.index', compact('news', 'users'));
    }

    public function show(News $news)
    {
        $comments = $news->comments()->whereNull('parent_id')->with('replies.user')->get();
        return view('news.show', compact('news', 'comments'));
    }

    public function edit(News $news)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('news.edit', compact('news'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_id' => 'required|exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        News::create([
            'title' => $validated['title'],
            'summary' => $validated['summary'],
            'content' => $validated['content'],
            'image' => $imagePath ?? null,
            'author_id' => $validated['author_id'],
        ]);

        return redirect()->route('news.index')->with('status', 'news added successfully!');
    }

    public function update(Request $request, News $news)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'summary' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|nullable|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news_images', 'public');
        }

        $news->update($validated);

        return redirect()->route('news.show', $news)->with('success', 'News updated successfully!');
    }

    public function destroy(News $news)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully!');
    }

    public function addComment(Request $request, News $news)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'news_id' => $news->id,
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        return redirect()->route('news.show', $news)->with('success', 'Comment added successfully!');
    }


}
