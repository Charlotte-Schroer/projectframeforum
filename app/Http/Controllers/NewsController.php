<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with('user')
            ->orderBy('publication_date', 'desc')
            ->paginate(9);

        return view('news.index', compact('news'));
    }

    /**
     * Display a listing of news for admin
     */
    public function adminIndex()
    {
        $news = News::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'publication_date' => 'required|date',
        ], [
            'title.required' => 'A title is required',
            'title.max' => 'A title may not be greater than 255 characters',
            'content.required' => 'Content is required',
            'image.required' => 'Image is required',
            'image.image' => 'The file must be an image',
            'image.mimes' => 'The image must be a jpeg, png, jpg or gif',
            'image.max' => 'The image may not be greater than 2MB',
            'publication_date.required' => 'A publication date is required',
            'publication_date.date' => 'A publication date must be a valid date',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
            $validated['image'] = $imagePath;
        }

        // Add user_id
        $validated['user_id'] = Auth::id();

        News::create($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News succesfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        $news->load('user');

        // Get related news (same date range or random)
        $relatedNews = News::where('id', '!=', $news->id)
            ->latest('publication_date')
            ->take(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'publication_date' => 'required|date',
        ], [
            'title.required' => 'A title is required',
            'title.max' => 'A title may not be greater than 255 characters',
            'content.required' => 'Content is required',
            'image.image' => 'The file must be an image',
            'image.mimes' => 'The image must be a jpeg, png, jpg or gif',
            'image.max' => 'The image may not be greater than 2MB',
            'publication_date.required' => 'The publication date is required',
            'publication_date.date' => 'The publication date must be a valid date',
        ]);

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            $imagePath = $request->file('image')->store('news', 'public');
            $validated['image'] = $imagePath;
        }

        $news->update($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News succesfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if($news->image){
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News succesfully deleted!');
    }
}
