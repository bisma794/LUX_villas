@extends('layouts.admin')

@section('content')
<div class="space-y-6 font-inter max-w-4xl">
  <div class="flex items-center justify-between">
    <div>
      <h1 class="font-heading font-medium text-3xl text-[#10221C]">
        {{ $isNew ? 'Add New Blog Post' : 'Edit Blog Post' }}
      </h1>
      <p class="text-xs text-slate-400 mt-1">Posts published here appear at the top of the /blog page automatically.</p>
    </div>
    <a href="{{ route('admin.blogs') }}" class="px-4 py-2 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold">Back</a>
  </div>

  <form action="{{ $isNew ? route('admin.blogs.store') : route('admin.blogs.update', $slug) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[16px] border border-slate-100 p-6 sm:p-8 shadow-xs space-y-5">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
      <div>
        <label class="block text-xs font-semibold text-neutral-700 mb-2">Blog Post Title *</label>
        <input type="text" name="name" value="{{ old('name', $blog['name']) }}" required class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
      </div>
      <div>
        <label class="block text-xs font-semibold text-neutral-700 mb-2">Category Badge</label>
        <input type="text" name="badge" value="{{ old('badge', $blog['badge']) }}" placeholder="Buying Advice & Investment" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
      </div>
      <div>
        <label class="block text-xs font-semibold text-neutral-700 mb-2">Published Date</label>
        <input type="text" name="meta" value="{{ old('meta', $blog['meta']) }}" placeholder="23rd March 2026" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
      </div>
      <div>
        <label class="block text-xs font-semibold text-neutral-700 mb-2">Status</label>
        <select name="status" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
          <option value="PUBLISHED" {{ ($blog['status'] ?? '') === 'PUBLISHED' ? 'selected' : '' }}>PUBLISHED</option>
          <option value="DRAFT" {{ ($blog['status'] ?? '') === 'DRAFT' ? 'selected' : '' }}>DRAFT</option>
        </select>
      </div>
      <div>
        <label class="block text-xs font-semibold text-neutral-700 mb-2">Read More Link URL</label>
        <input type="text" name="link" value="{{ old('link', $blog['link'] ?? '#') }}" placeholder="#" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
      </div>
      <div>
        <label class="block text-xs font-semibold text-neutral-700 mb-2">City</label>
        <input type="text" name="city" value="{{ old('city', $blog['city'] ?? 'Dubai') }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
      </div>
    </div>

    <div>
      <label class="block text-xs font-semibold text-neutral-700 mb-2">Cover Image</label>
      <div class="border border-slate-200 rounded-2xl p-4 bg-white flex flex-col sm:flex-row items-center gap-5">
        <div class="w-full sm:w-48 h-32 rounded-xl bg-slate-100 overflow-hidden border border-slate-200 shrink-0">
          <img id="blog-cover-preview" src="{{ asset($blog['image'] ?? 'images/dubai-skyline.jpg') }}" alt="Cover preview" class="w-full h-full object-cover">
        </div>
        <div class="flex-1 w-full space-y-2">
          <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-slate-600">Upload image from laptop</span>
            <label class="px-4 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold cursor-pointer">
              <span>Browse</span>
              <input type="file" name="image_file" accept="image/*" class="hidden" onchange="if(this.files && this.files[0]){ const r = new FileReader(); r.onload = e => document.getElementById('blog-cover-preview').src = e.target.result; r.readAsDataURL(this.files[0]); }">
            </label>
          </div>
          <input type="text" name="image" value="{{ old('image', $blog['image'] ?? 'images/dubai-skyline.jpg') }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-500 font-mono">
        </div>
      </div>
    </div>

    <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
      <button type="submit" class="px-6 py-3 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold shadow-xs cursor-pointer">
        {{ $isNew ? 'Publish Blog Post' : 'Save Changes' }}
      </button>
    </div>
  </form>
</div>
@endsection
