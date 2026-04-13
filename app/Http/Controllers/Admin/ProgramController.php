<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ProgramController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Programs/Index', [
            'programs' => Program::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Programs/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'unique:programs,slug'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'duration' => ['nullable', 'string', 'max:100'],
            'intake' => ['nullable', 'string', 'max:100'],
            'eligibility' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('programs', 'public');
        }
        $data['created_by'] = auth()->id();

        Program::create($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program created.');
    }

    public function edit(Program $program): Response
    {
        return Inertia::render('Admin/Programs/Edit', ['program' => $program]);
    }

    public function update(Request $request, Program $program): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'unique:programs,slug,'.$program->id],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'duration' => ['nullable', 'string', 'max:100'],
            'intake' => ['nullable', 'string', 'max:100'],
            'eligibility' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if (!$data['slug']) $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('image')) {
            if ($program->image) Storage::disk('public')->delete($program->image);
            $data['image'] = $request->file('image')->store('programs', 'public');
        }
        $data['updated_by'] = auth()->id();
        $program->update($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program updated.');
    }

    public function destroy(Program $program): RedirectResponse
    {
        if ($program->image) Storage::disk('public')->delete($program->image);
        $program->delete();

        return back()->with('success', 'Program deleted.');
    }
}
