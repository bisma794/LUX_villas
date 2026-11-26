<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show(string $path = '')
    {
        $page = Page::where('path', $path)->where('status', 'published')->firstOrFail();
        $page->load(['sections' => fn ($q) => $q->where('status', 'published')]);

        if (in_array($page->slug, ['enquiry', 'ai-villa-assessment', 'blog'], true) || in_array($path, ['enquiry', 'ai-villa-assessment', 'blog'], true)) {
            $page->setRelation(
                'sections',
                $page->sections->reject(fn ($s) => $s->key === 'global_seo' || $s->type === 'seo_text')->values()
            );
        }

        return view('pages.dynamic', ['page' => $page]);
    }

    public function home()
    {
        return $this->show('');
    }
}
