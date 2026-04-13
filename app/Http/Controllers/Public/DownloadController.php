<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Download::where('is_active', true);

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        return Inertia::render('Downloads/Index', [
            'downloads' => $query->orderBy('sort_order')->get(),
            'filters' => $request->only(['search', 'category']),
        ]);
    }

    public function download(Download $download): BinaryFileResponse
    {
        $download->increment('download_count');
        $path = storage_path('app/public/'.$download->file_path);

        return response()->download($path, $download->file_name ?? basename($path));
    }
}
