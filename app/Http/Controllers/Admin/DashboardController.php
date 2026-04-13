<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Download;
use App\Models\Event;
use App\Models\Notice;
use App\Models\Program;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'programs' => Program::count(),
                'notices' => Notice::where('is_published', true)->count(),
                'events' => Event::where('is_published', true)->count(),
                'downloads' => Download::where('is_active', true)->count(),
                'contacts' => Contact::where('is_read', false)->count(),
            ],
            'recentContacts' => Contact::latest()->limit(5)->get(),
            'latestNotices' => Notice::latest()->limit(5)->get(['id', 'title', 'is_published', 'created_at']),
        ]);
    }
}
