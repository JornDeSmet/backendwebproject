<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Category;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $categories = Category::with('faqs')->get();
        return view('faq.index', compact('categories'));
    }
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        Faq::create($validated);
        return redirect()->route('faq.index')->with('status', 'FAQ added successfully!');
    }

    public function update(Request $request, Faq $faq)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:1000',
        ]);

        $faq->update($request->only(['question', 'answer']));

        return redirect()->route('faq.index')->with('status', 'FAQ updated successfully');
    }
    public function destroy(Faq $faq)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $faq->delete();
        return redirect()->route('faq.index')->with('status', 'FAQ deleted successfully!');
    }
}
