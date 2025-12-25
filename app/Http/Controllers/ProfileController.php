<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the public 'searcher' or list profile viewer of a user
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            $query->where(function($q)use($search){
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%');
            });
        }, function ($query) {
            $query->inRandomOrder();
        })->paginate(12)
            ->withQueryString();

        return view('profiles.index', compact('users', 'search'));
    }

    /**
     * Display the public profile of a user.
     */
    public function show(string $username): View
    {
        $user = User::where('username', $username)->firstOrFail();

        $news = $user->news()
            ->orderBy('publication_date', 'desc')
            ->take(6)
            ->get();

        // Get user's forum topics
        $topics = $user->topics()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('profile.show', compact('user', 'news', 'topics'));
    }

    /**
     * Display the user's profile form
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'birthday' => ['nullable', 'date', 'before:today'],
            'about_me' => ['nullable', 'string', 'max:500'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'name.required' => 'Name is required.',
            'username.required' => 'Username is required.',
            'username.alpha_dash' => 'Username may only contain letters, numbers, dashes, and underscores.',
            'username.unique' => 'This username is already in use.',
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email is already in use.',
            'birthday.before' => 'Birthday must be in the past.',
            'about_me.max' => 'About me may contain a maximum of 500 characters.',
            'profile_photo.image' => 'The file must be an image.',
            'profile_photo.mimes' => 'Profile photo must be jpeg, png, jpg or gif.',
            'profile_photo.max' => 'Profile photo may be a maximum of 2MB.',
        ]);

        //Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            //Delete old profile photo if it exists
            if ($user->profile_photo) {
                Storage::delete($user->profile_photo);
            }

            $path = $request->file('profile_photo')->store('profile-photos');
            $user->profile_photo = $path;
        }

        // Update user
        $user->fill($validated);

        // If email changed, reset verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Delete profile photo if it exists
        if ($user->profile_photo) {
            Storage::delete($user->profile_photo);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
