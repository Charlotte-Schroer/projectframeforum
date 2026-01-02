<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Topic::with(['user', 'tags', 'posts'])
            ->withCount('posts')
            ->orderBy('created_at', 'desc');

        //Filter by Tag
        if ($request->has('tag') && $request->tag) {
            $query->withTag($request->tag);
        }

        //Search
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        $topics = $query->paginate(12);
        $tags = Tag::orderBy('name', 'asc')->get();

        return view('topics.index', compact('topics', 'tags'));
    }

    /**
     * Show the form for creating a new topic.
     */
    public function create()
    {
        $tags= Tag::orderBy('name', 'asc')->get();
        return view('topics.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'movie_title' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ], [
            'title.required' => 'Title is required',
            'title.max' => 'Title cannot be longer than 255 characters',
            'content.required' => 'Content is required',
            'movie_title.max' => 'Movie title cannot be longer than 255 characters',
            'tags.*.exists' => 'One or more tags does not exist',
        ]);

        $topic = Topic::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'movie_title' => $validated['movie_title'] ?? null,
        ]);

        if (isset($validated['tags'])) {
            $topic->tags()->attach($validated['tags']);
        }

        return redirect()
            ->route('forum.show', $topic)
            ->with('success', 'Topic created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        $topic->load(['user', 'tags', 'posts.user']);

        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        if (Auth::id() !== $topic->user_id && !Auth::user()->is_admin){
            abort(403,"You are not allowed to edit this topic");
        }

        $tags = Tag::orderBy('name', 'asc')->get();
        return view('topics.edit', compact('topic', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        if (Auth::id() !== $topic->user_id && !Auth::user()->is_admin){
            abort(403,"You are not allowed to edit this topic");
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'movie_title' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ], [
            'title.required' => 'Title is required',
            'title.max' => 'Title cannot be longer than 255 characters',
            'content.required' => 'Content is required',
            'movie_title.max' => 'Movie title cannot be longer than 255 characters',
            'tags.*.exists' => 'One or more tags does not exist',
        ]);

        $topic->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'movie_title' => $validated['movie_title'] ?? null,
        ]);

        if (isset($validated['tags'])) {
            $topic->tags()->sync($validated['tags']);
        } else {
            $topic->tags()->detach();
        }

        return redirect()
            ->route('forum.show', $topic)
            ->with('success', 'Topic updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        if (!Auth::user()->is_admin){
            abort(403,"Unauthorized action");
        }

        $topic->delete();

        return redirect()
            ->route('forum.index')
            ->with('success', 'Topic deleted successfully');
    }
}
