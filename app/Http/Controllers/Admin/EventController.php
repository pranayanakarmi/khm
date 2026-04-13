<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Events/Index', [
            'events' => Event::orderByDesc('start_date')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Events/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'unique:events,slug'],
            'type' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'organizer' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'is_published' => ['boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }
        $data['created_by'] = auth()->id();
        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event created.');
    }

    public function edit(Event $event): Response
    {
        return Inertia::render('Admin/Events/Edit', ['event' => $event]);
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'unique:events,slug,'.$event->id],
            'type' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'organizer' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'is_published' => ['boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if (!$data['slug']) $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('image')) {
            if ($event->image) Storage::disk('public')->delete($event->image);
            $data['image'] = $request->file('image')->store('events', 'public');
        }
        $data['updated_by'] = auth()->id();
        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        if ($event->image) Storage::disk('public')->delete($event->image);
        $event->delete();

        return back()->with('success', 'Event deleted.');
    }
}
