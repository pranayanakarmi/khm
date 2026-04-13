<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NoticeController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Notice::where('is_published', true);

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        return Inertia::render('Notices/Index', [
            'notices' => $query->orderByDesc('published_at')->paginate(12)->withQueryString(),
            'filters' => $request->only(['search', 'category']),
        ]);
    }

    public function show(Notice $notice): Response
    {
        abort_unless($notice->is_published, 404);

        return Inertia::render('Notices/Show', ['notice' => $notice]);
    }
}
