<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    public function index(Request $request): Response
    {
        $upcoming = Event::where('is_published', true)
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->get(['id', 'title', 'slug', 'type', 'start_date', 'end_date', 'location', 'image']);

        $past = Event::where('is_published', true)
            ->where('start_date', '<', now())
            ->orderByDesc('start_date')
            ->limit(8)
            ->get(['id', 'title', 'slug', 'type', 'start_date', 'end_date', 'location', 'image']);

        return Inertia::render('Events/Index', [
            'upcoming' => $upcoming,
            'past' => $past,
        ]);
    }

    public function show(Event $event): Response
    {
        abort_unless($event->is_published, 404);

        return Inertia::render('Events/Show', ['event' => $event]);
    }
}
