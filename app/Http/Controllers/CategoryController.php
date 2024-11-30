<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Category::create($validated);
        return redirect()->route('faq.index')->with('status', 'Category added successfully!');
    }

    public function update(Request $request, Category $category)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);
        return redirect()->route('faq.index')->with('status', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        $category->faqs()->delete();
        $category->delete();

        return redirect()->route('faq.index')->with('status', 'Category and its FAQs deleted successfully!');
    }
}
