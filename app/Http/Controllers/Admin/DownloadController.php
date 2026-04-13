<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class DownloadController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Downloads/Index', [
            'downloads' => Download::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Downloads/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'description' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer'],
            'file' => ['required', 'file', 'max:10240'],
        ]);

        $file = $request->file('file');
        $data['file_path'] = $file->store('downloads', 'public');
        $data['file_name'] = $file->getClientOriginalName();
        $data['file_size'] = $this->formatFileSize($file->getSize());
        $data['created_by'] = auth()->id();
        unset($data['file']);

        Download::create($data);

        return redirect()->route('admin.downloads.index')->with('success', 'Download created.');
    }

    public function edit(Download $download): Response
    {
        return Inertia::render('Admin/Downloads/Edit', ['download' => $download]);
    }

    public function update(Request $request, Download $download): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'description' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer'],
            'file' => ['nullable', 'file', 'max:10240'],
        ]);

        if ($request->hasFile('file')) {
            if ($download->file_path) Storage::disk('public')->delete($download->file_path);
            $file = $request->file('file');
            $data['file_path'] = $file->store('downloads', 'public');
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $this->formatFileSize($file->getSize());
        }
        unset($data['file']);
        $data['updated_by'] = auth()->id();
        $download->update($data);

        return redirect()->route('admin.downloads.index')->with('success', 'Download updated.');
    }

    public function destroy(Download $download): RedirectResponse
    {
        if ($download->file_path) Storage::disk('public')->delete($download->file_path);
        $download->delete();

        return back()->with('success', 'Download deleted.');
    }

    private function formatFileSize(int $bytes): string
    {
        if ($bytes >= 1048576) return round($bytes / 1048576, 2).' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 2).' KB';
        return $bytes.' B';
    }
}
