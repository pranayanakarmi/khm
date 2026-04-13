<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Contact');
    }

    public function store(Request $request): RedirectResponse
    {
        // Honeypot check
        if ($request->filled('website')) {
            return redirect()->route('contact.index');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
        ]);

        Contact::create($data);

        return redirect()->route('contact.index')->with('success', 'Your message has been sent. We will get back to you soon!');
    }
}
