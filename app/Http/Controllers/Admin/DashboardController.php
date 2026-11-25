<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Section;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'pagesCount' => Page::count(),
            'publishedPages' => Page::where('status', 'published')->count(),
            'draftPages' => Page::where('status', 'draft')->count(),
            'sectionsCount' => Section::count(),
            'globalSections' => Section::where('is_global', true)->count(),
            'pages' => Page::withCount('sections')->orderBy('title')->get(),
            'sections' => Section::withCount('pages')->orderBy('name')->get(),
        ]);
    }
}
