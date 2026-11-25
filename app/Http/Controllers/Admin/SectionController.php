<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    /** Scalar content keys edited with friendly fields; the rest via the JSON editor. */
    public const SCALARS = ['eyebrow', 'heading_html', 'subtext', 'image', 'image_alt', 'image_side', 'button_text', 'button_link', 'button2_text', 'button2_link', 'button2_style', 'breadcrumb', 'price', 'variant', 'count_text', 'header_button_text', 'header_button_link', 'note_title', 'note', 'quiz_rich_content', 'rich_content', 'full_content'];

    public function index(Request $request)
    {
        $q = $request->get('q');
        $type = $request->get('type');
        $sections = Section::withCount('pages')
            ->where('type', '!=', 'faq')
            ->where('key', 'not like', '%faq%')
            ->where('name', 'not like', '%faq%')
            ->when($q, fn ($query) => $query->where('name', 'like', "%{$q}%")->orWhere('key', 'like', "%{$q}%"))
            ->when($type, fn ($query) => $query->where('type', $type))
            ->orderBy('name')->paginate(25);
        return view('admin.sections.index', ['sections' => $sections, 'q' => $q, 'type' => $type, 'types' => Section::types()]);
    }

    public function create()
    {
        return view('admin.sections.form', ['section' => new Section(['status' => 'published', 'is_global' => true]), 'images' => $this->imageLibrary()]);
    }

    public function store(Request $request)
    {
        $section = Section::create($this->validated($request));
        $section->update(['content' => $this->contentFromRequest($request, $section->content ?? [])]);
        return redirect()->route('admin.sections.edit', $section)->with('ok', 'Section created. It is now available in the page builder.');
    }

    public function edit(Section $section)
    {
        $section->load('pages');
        return view('admin.sections.form', ['section' => $section, 'images' => $this->imageLibrary()]);
    }

    public function update(Request $request, Section $section)
    {
        $section->update($this->validated($request, $section->id));
        $section->update(['content' => $this->contentFromRequest($request, $section->content ?? [])]);
        return redirect()->route('admin.sections.edit', $section)->with('ok', 'Section saved — every page using it now shows the new content.');
    }

    public function destroy(Section $section)
    {
        if ($section->pages()->exists()) {
            return back()->withErrors(['section' => 'This section is used by ' . $section->pages()->count() . ' page(s). Remove it from those pages first.']);
        }
        $section->delete();
        return redirect()->route('admin.sections.index')->with('ok', 'Section deleted.');
    }

    /** Upload a new image into the library (public disk). */
    public function upload(Request $request)
    {
        $request->validate(['image' => ['required', 'image', 'max:5120']]);
        $path = $request->file('image')->store('uploads', 'public');
        return back()->with('ok', 'Image uploaded: storage/' . $path . ' — select it in the image dropdown.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'key' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9_]+$/', 'unique:sections,key,'.$ignoreId],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:' . implode(',', array_keys(Section::types()))],
            'is_global' => ['nullable', 'boolean'],
            'status' => ['required', 'in:published,draft'],
        ]) + ['is_global' => $request->boolean('is_global')];
    }

    /** Merge friendly scalar fields + uploaded image + advanced JSON into content. */
    private function contentFromRequest(Request $request, array $existing): array
    {
        $content = $existing;
        foreach (self::SCALARS as $key) {
            $value = $request->input('content_' . $key);
            if ($value !== null && $value !== '') {
                $content[$key] = $value;
            } elseif ($value === '' && array_key_exists($key, $content)) {
                unset($content[$key]);
            }
        }
        if ($request->hasFile('image_upload')) {
            $request->validate(['image_upload' => ['image', 'max:5120']]);
            $content['image'] = 'storage/' . $request->file('image_upload')->store('uploads', 'public');
        }

        // Handle structured card items array if submitted directly from form
        if ($request->has('items') && is_array($request->input('items'))) {
            $submittedItems = $request->input('items');
            $existingItems = $content['items'] ?? [];
            foreach ($submittedItems as $idx => $it) {
                if ($request->hasFile("items.{$idx}.image_file")) {
                    $file = $request->file("items.{$idx}.image_file");
                    $filename = time() . "_{$idx}_" . $file->getClientOriginalName();
                    $file->move(public_path('images'), $filename);
                    $it['image'] = 'images/' . $filename;
                } else {
                    $it['image'] = $it['image'] ?? ($existingItems[$idx]['image'] ?? '');
                }
                $submittedItems[$idx] = $it;
            }
            $content['items'] = array_values($submittedItems);
        }

        // Handle selected communities from Column S drag and drop
        if ($request->has('selected_communities')) {
            $content['assigned_communities'] = (array) $request->input('selected_communities');
        }

        // Handle selected properties for explore listings from Column S drag and drop
        if ($request->has('selected_listings')) {
            $content['assigned_listings'] = (array) $request->input('selected_listings');
        }

        // Handle selected offplan projects for View New Projects Carousel from Column S drag and drop
        if ($request->has('selected_offplan_projects')) {
            $content['assigned_offplan_projects'] = (array) $request->input('selected_offplan_projects');
        }

        // Handle FAQ items (q, a)
        if ($request->has('faqs') && is_array($request->input('faqs'))) {
            $faqs = [];
            foreach ($request->input('faqs') as $faq) {
                if (!empty($faq['q']) || !empty($faq['a'])) {
                    $faqs[] = [
                        'q' => $faq['q'] ?? '',
                        'a' => $faq['a'] ?? '',
                    ];
                }
            }
            $content['faqs'] = $faqs;
        }
        $advanced = $request->input('content_json', '');
        if (trim($advanced) !== '') {
            $decoded = json_decode($advanced, true);
            if (! is_array($decoded)) {
                abort(422, 'Advanced content is not valid JSON.');
            }
            foreach ($decoded as $k => $v) {
                $content[$k] = $v;
            }
        }
        return $content;
    }

    /** Selectable image library: bundled photos + uploads. */
    public function imageLibrary(): array
    {
        $files = [];
        foreach (glob(public_path('images/*.{jpg,jpeg,png,webp,svg}'), GLOB_BRACE) ?: [] as $f) {
            $files[] = 'images/' . basename($f);
        }
        foreach (Storage::disk('public')->files('uploads') as $f) {
            $files[] = 'storage/' . $f;
        }
        sort($files);
        return $files;
    }
}
