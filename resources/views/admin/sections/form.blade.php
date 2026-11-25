@extends('layouts.admin')
@section('content')
<h1 class="font-serif text-4xl">{{ $section->exists ? 'Edit Section — ' . $section->name : 'New Section' }}</h1>
@if($section->exists)
<p class="text-neutral-600 mt-2">Used by {{ $section->pages->count() }} page(s):
  @forelse($section->pages as $p)<a href="{{ route('admin.pages.edit', $p) }}" class="text-[#B9975B] font-semibold">{{ $p->title }}</a>{{ !$loop->last ? ', ' : '' }}@empty <span class="text-neutral-400">none yet — add it to a page from the page builder.</span>@endforelse
  Saving here updates every page above.
</p>
@endif

<form action="{{ $section->exists ? route('admin.sections.update', $section) : route('admin.sections.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border p-6 mt-6">
  @csrf
  @if($section->exists) @method('PUT') @endif
  <div class="grid md:grid-cols-3 gap-5">
    <label class="block"><span class="font-semibold">Name</span><input type="text" name="name" value="{{ old('name', $section->name) }}" required class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Key (unique, admin only)</span><input type="text" name="key" value="{{ old('key', $section->key) }}" required pattern="[a-z0-9_]+" class="mt-2 w-full border rounded-lg px-3 py-3"><span class="text-sm text-neutral-500">Lowercase, numbers and underscores, e.g. home_hero.</span></label>
    <label class="block"><span class="font-semibold">Type</span><select name="type" class="mt-2 w-full border rounded-lg px-3 py-3">@foreach(\App\Models\Section::types() as $k => $label)<option value="{{ $k }}" {{ old('type', $section->type) === $k ? 'selected' : '' }}>{{ $label }}</option>@endforeach</select></label>
    <label class="block"><span class="font-semibold">Status</span><select name="status" class="mt-2 w-full border rounded-lg px-3 py-3"><option value="published" {{ old('status', $section->status) === 'published' ? 'selected' : '' }}>Published</option><option value="draft" {{ old('status', $section->status) === 'draft' ? 'selected' : '' }}>Draft (hidden from site)</option></select></label>
    <label class="flex items-center gap-2 mt-8"><input type="checkbox" name="is_global" value="1" {{ old('is_global', $section->is_global ?? true) ? 'checked' : '' }}> Global — reusable on any page</label>
  </div>

  @php $c = $section->c(); @endphp
  <h2 class="font-serif text-2xl mt-8">Content</h2>
  <div class="grid md:grid-cols-2 gap-5 mt-4">
    <label class="block"><span class="font-semibold">Eyebrow (small label)</span><input type="text" name="content_eyebrow" value="{{ old('content_eyebrow', $c['eyebrow'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Breadcrumb</span><input type="text" name="content_breadcrumb" value="{{ old('content_breadcrumb', $c['breadcrumb'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block md:col-span-2"><span class="font-semibold">Heading (HTML allowed — use &lt;span class="script"&gt;word&lt;/span&gt; for the italic word, &lt;br&gt; for a line break)</span><input type="text" name="content_heading_html" value="{{ old('content_heading_html', $c['heading_html'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block md:col-span-2"><span class="font-semibold">Subtext</span><textarea name="content_subtext" rows="3" class="mt-2 w-full border rounded-lg px-3 py-3">{{ old('content_subtext', $c['subtext'] ?? '') }}</textarea></label>
    <label class="block"><span class="font-semibold">Image (from library)</span><select name="content_image" class="mt-2 w-full border rounded-lg px-3 py-3"><option value="">— no image —</option>@foreach($images as $img)<option value="{{ $img }}" {{ ($c['image'] ?? '') === $img ? 'selected' : '' }}>{{ $img }}</option>@endforeach</select></label>
    <label class="block"><span class="font-semibold">…or upload a new image</span><input type="file" name="image_upload" accept="image/*" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Image alt text</span><input type="text" name="content_image_alt" value="{{ old('content_image_alt', $c['image_alt'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Image side (text+image sections)</span><select name="content_image_side" class="mt-2 w-full border rounded-lg px-3 py-3"><option value="right" {{ ($c['image_side'] ?? 'right') === 'right' ? 'selected' : '' }}>Right</option><option value="left" {{ ($c['image_side'] ?? '') === 'left' ? 'selected' : '' }}>Left</option></select></label>
    <label class="block"><span class="font-semibold">Button text</span><input type="text" name="content_button_text" value="{{ old('content_button_text', $c['button_text'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Button link (URL path, e.g. /villas-for-sale)</span><input type="text" name="content_button_link" value="{{ old('content_button_link', $c['button_link'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Second button text</span><input type="text" name="content_button2_text" value="{{ old('content_button2_text', $c['button2_text'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Second button link</span><input type="text" name="content_button2_link" value="{{ old('content_button2_link', $c['button2_link'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Price / count text</span><input type="text" name="content_price" value="{{ old('content_price', $c['price'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Variant (hero enquiry card etc.)</span><input type="text" name="content_variant" value="{{ old('content_variant', $c['variant'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
  </div>

  @php
    $scalars = \App\Http\Controllers\Admin\SectionController::SCALARS;
    $advanced = $c;
    foreach ($scalars as $k) unset($advanced[$k]);
  @endphp
  <label class="block mt-6"><span class="font-semibold">Advanced content — lists, FAQs, steps, tabs, sidebar, mortgage (valid JSON)</span><span class="block text-sm text-neutral-500 mt-1">Keys used here: items, blocks, faqs, steps, labels, tabs, panels, fields, search_fields, chips, filters, sidebar, mortgage, gallery, gallery_alts, trend_bars, trend_stats, similar, amenities, card_* — edit carefully, keep valid JSON.</span>
  <textarea name="content_json" rows="14" spellcheck="false" class="mt-2 w-full border rounded-lg px-3 py-3 font-mono text-sm">{{ old('content_json', json_encode($advanced, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)) }}</textarea></label>

  <div class="flex gap-3 mt-6"><button class="btn-tan">Save Section</button><a href="{{ route('admin.sections.index') }}" class="btn-dark">Back to Sections</a></div>
</form>
@if($section->exists)
<div class="mt-6 flex justify-end">
  <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" onsubmit="return confirm('Delete this section? It must not be used by any page.')">@csrf @method('DELETE')<button class="text-red-700 font-semibold">Delete this section</button></form>
</div>
@endif
@endsection
