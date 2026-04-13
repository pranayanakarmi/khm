<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Event;
use App\Models\Notice;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home', [
            'banners' => Banner::where('is_active', true)->orderBy('sort_order')->get(),
            'latestNotices' => Notice::where('is_published', true)
                ->orderByDesc('published_at')
                ->limit(6)
                ->get(['id', 'title', 'slug', 'category', 'published_at']),
            'upcomingEvents' => Event::where('is_published', true)
                ->where('start_date', '>=', now())
                ->orderBy('start_date')
                ->limit(4)
                ->get(['id', 'title', 'slug', 'type', 'start_date', 'location', 'image']),
        ]);
    }
}
