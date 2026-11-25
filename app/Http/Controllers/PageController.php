<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show(string $path = '')
    {
        $page = Page::where('path', $path)->where('status', 'published')->firstOrFail();
        $page->load(['sections' => fn ($q) => $q->where('status', 'published')]);

        return view('pages.dynamic', ['page' => $page]);
    }

    public function home()
    {
        return $this->show('');
    }
}
