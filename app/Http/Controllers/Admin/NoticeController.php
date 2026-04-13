<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class NoticeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Notices/Index', [
            'notices' => Notice::orderByDesc('created_at')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Notices/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'unique:notices,slug'],
            'category' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'is_published' => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'attachment' => ['nullable', 'file', 'max:5120'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('notices/attachments', 'public');
        }
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('notices/images', 'public');
        }
        $data['created_by'] = auth()->id();

        Notice::create($data);

        return redirect()->route('admin.notices.index')->with('success', 'Notice created.');
    }

    public function edit(Notice $notice): Response
    {
        return Inertia::render('Admin/Notices/Edit', ['notice' => $notice]);
    }

    public function update(Request $request, Notice $notice): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'unique:notices,slug,'.$notice->id],
            'category' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'is_published' => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'attachment' => ['nullable', 'file', 'max:5120'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if (!$data['slug']) $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('attachment')) {
            if ($notice->attachment) Storage::disk('public')->delete($notice->attachment);
            $data['attachment'] = $request->file('attachment')->store('notices/attachments', 'public');
        }
        if ($request->hasFile('image')) {
            if ($notice->image) Storage::disk('public')->delete($notice->image);
            $data['image'] = $request->file('image')->store('notices/images', 'public');
        }
        $data['updated_by'] = auth()->id();
        $notice->update($data);

        return redirect()->route('admin.notices.index')->with('success', 'Notice updated.');
    }

    public function destroy(Notice $notice): RedirectResponse
    {
        if ($notice->attachment) Storage::disk('public')->delete($notice->attachment);
        if ($notice->image) Storage::disk('public')->delete($notice->image);
        $notice->delete();

        return back()->with('success', 'Notice deleted.');
    }
}
