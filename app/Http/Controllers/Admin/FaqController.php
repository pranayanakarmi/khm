<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FaqController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Faqs/Index', [
            'faqs' => Faq::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Faqs/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
            'category' => ['required', 'string'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer'],
        ]);

        $data['created_by'] = auth()->id();
        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created.');
    }

    public function edit(Faq $faq): Response
    {
        return Inertia::render('Admin/Faqs/Edit', ['faq' => $faq]);
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $data = $request->validate([
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
            'category' => ['required', 'string'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer'],
        ]);

        $data['updated_by'] = auth()->id();
        $faq->update($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return back()->with('success', 'FAQ deleted.');
    }
}
