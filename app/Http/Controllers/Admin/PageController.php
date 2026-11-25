<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        
        // Fixed main pages only (excluding detail pages, inner sub-pages, or temporary demo pages)
        $fixedSlugs = [
            'home',
            'about',
            'villas-for-sale',
            'listing-the-valley-prime-location',
            'projects',
            'communities',
            'ai-villa-assessment',
            'enquiry',
            'blog',
        ];

        $pages = Page::withCount('sections')
            ->whereIn('slug', $fixedSlugs)
            ->when($q, fn ($query) => $query->where('title', 'like', "%{$q}%")->orWhere('slug', 'like', "%{$q}%")->orWhere('path', 'like', "%{$q}%"))
            ->orderByRaw("FIELD(slug, 'home', 'about', 'villas-for-sale', 'listing-the-valley-prime-location', 'projects', 'communities', 'ai-villa-assessment', 'enquiry', 'blog')")
            ->paginate(20);

        return view('admin.pages.index', compact('pages', 'q'));
    }

    public function create()
    {
        $sections = Section::where('type', '!=', 'faq')
            ->where('key', 'not like', '%faq%')
            ->where('name', 'not like', '%faq%')
            ->orderBy('name')->get();
        return view('admin.pages.form', ['page' => new Page(['status' => 'draft']), 'sections' => $sections]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $page = Page::create($data);
        return redirect()->route('admin.pages.edit', $page)->with('ok', 'Page created. Now call sections from the library below.');
    }

    public function edit(Page $page)
    {
        $page->load('sections');
        $sections = Section::where('type', '!=', 'faq')
            ->where('key', 'not like', '%faq%')
            ->where('name', 'not like', '%faq%')
            ->orderBy('name')->get();
        return view('admin.pages.form', [
            'page' => $page,
            'sections' => $sections,
            'attachedIds' => $page->sections->pluck('id')->all(),
        ]);
    }

    public function update(Request $request, Page $page)
    {
        $page->update($this->validated($request, $page->id));
        return redirect()->route('admin.pages.edit', $page)->with('ok', 'Page saved.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('ok', 'Page deleted.');
    }

    /** Attach a global section to this page (the "call section" feature). */
    public function attach(Request $request, Page $page)
    {
        $request->validate(['section_id' => ['required', 'exists:sections,id']]);
        if (! $page->sections()->where('section_id', $request->section_id)->exists()) {
            $order = (int) ($page->sections()->max('page_section.sort_order') ?? -1) + 1;
            $page->sections()->attach($request->section_id, ['sort_order' => $order]);
        }
        return back()->with('ok', 'Section added to the page.');
    }

    public function detach(Page $page, Section $section)
    {
        $page->sections()->detach($section->id);
        $this->renumber($page);
        return back()->with('ok', 'Section removed from the page.');
    }

    public function move(Request $request, Page $page, Section $section)
    {
        $ids = $page->sections()->orderBy('page_section.sort_order')->pluck('sections.id')->all();
        $pos = array_search($section->id, $ids);
        if ($pos === false) return back();
        $swap = $request->direction === 'up' ? $pos - 1 : $pos + 1;
        if ($swap < 0 || $swap >= count($ids)) return back();
        [$ids[$pos], $ids[$swap]] = [$ids[$swap], $ids[$pos]];
        foreach ($ids as $i => $id) {
            $page->sections()->updateExistingPivot($id, ['sort_order' => $i]);
        }
        return back();
    }

    private function renumber(Page $page): void
    {
        foreach ($page->sections()->orderBy('page_section.sort_order')->pluck('sections.id') as $i => $id) {
            $page->sections()->updateExistingPivot($id, ['sort_order' => $i]);
        }
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/', 'unique:pages,slug,'.$ignoreId],
            'path' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9\/-]*$/', 'unique:pages,path,'.$ignoreId],
            'status' => ['required', 'in:published,draft'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
        ]);
    }
}
