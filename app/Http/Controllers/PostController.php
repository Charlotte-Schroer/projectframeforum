<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Store a newly created post (reply) in storage
     */
    public function store(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:3',
        ], [
            'content.required' => 'Content is required',
            'content.min' => 'Content is minimum 3 characters',
        ]);

        Post::create([
            'topic_id' => $topic->id,
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        return redirect()
            ->route('forum.show', $topic)
            ->with('success', 'Post created successfully');
    }

    /**
     * Update specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::id() !==$post->user_id && !Auth::user()->is_admin){
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'content' => 'required|string|min:3',
        ], [
            'content.required' => 'Content is required',
            'content.min' => 'Content is minimum 3 characters',
        ]);

        $post->update([$validated]);

        return redirect()
            ->route('forum.show', $post->topic)
            ->with('success', 'Post updated successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::id() !== $post->user_id && !Auth::user()->is_admin){
            abort(403, 'Unauthorized action.');
        }

        return view('forum.posts.edit', compact('post'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!Auth::user()->is_admin){
            abort(403, 'Unauthorized action.');
        }

        $topic = $post->topic;
        $post->delete();

        return redirect()
            ->route('forum.show', $topic)
            ->with('success', 'Post deleted successfully');
    }
}
