<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = FaqCategory::withCount('items')->get();
        return view('admin.faq-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        FaqCategory::create($request->all());

        return redirect()->route('admin.faq-categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaqCategory $faqCategory)
    {
        return view('admin.faq-categories.edit', compact('faqCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FaqCategory $faqCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $faqCategory->update($request->all());

        return redirect()->route('admin.faq-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        return redirect()->route('admin.faq-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
