<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Inertia\Inertia;
use Inertia\Response;

class ProgramController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Programs/Index', [
            'programs' => Program::where('is_active', true)
                ->orderBy('sort_order')
                ->get(['id', 'title', 'slug', 'category', 'duration', 'intake', 'image']),
        ]);
    }

    public function show(Program $program): Response
    {
        return Inertia::render('Programs/Show', ['program' => $program]);
    }
}
