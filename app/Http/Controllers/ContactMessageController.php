<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\User;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class ContactMessageController extends Controller
{
    /**
     * Show the contact form.
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store and send the contact message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'Please enter a subject.',
            'message.required' => 'Please enter your message.',
        ]);

        // Send the email to the admin
        try {
            $adminEmail = 'admin@ehb.be';

            Mail::to($adminEmail)->send(new ContactMessageMail($validated));

            return redirect()->route('contact.create')->with('success', 'Your message has been sent successfully! We will contact you soon.');
        } catch (Exception $e){
            Log::error("Mail error: ".$e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'There was an error sending your message. Please try again.');
        }
    }
}
