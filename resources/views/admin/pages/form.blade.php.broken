@extends('layouts.admin')

@section('content')
<div class="space-y-6 font-inter">

  {{-- Top Header Card: Title + Page URL + Status Dropdown + Preview Live Page Button --}}
  <div class="bg-white rounded-[16px] border border-slate-100 p-5 sm:p-6 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight">
        {{ $page->exists ? 'Update ' . $page->title : 'New Dynamic Page' }}
      </h1>
      <p class="text-xs text-slate-500 font-medium mt-1">
        Page URL: <a href="{{ $page->exists ? $page->url() : '#' }}" target="_blank" class="text-blue-600 hover:underline">{{ $page->exists ? url($page->path ?: '/') : url('/') }}</a>
      </p>
    </div>

    <div class="flex items-center gap-3">
      @if($page->exists)
        <a 
          href="{{ $page->url() }}" 
          target="_blank" 
          class="inline-flex items-center gap-1.5 px-4.5 py-2 rounded-xl bg-[#0E3B2C] hover:bg-[#16503c] text-white text-xs font-semibold shadow-xs transition-colors"
        >
          <span>Preview Live Page ↗</span>
        </a>
      @endif

      <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
        Back
      </a>
    </div>
  </div>

  {{-- Two Column Editor Layout: Left Vertical Tabs + Right Form Content Panels --}}
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
    
    {{-- Left Sidebar: Side-Tab Navigation --}}
    <aside class="lg:col-span-3 space-y-2">
      <div class="bg-white rounded-[16px] border border-slate-100 p-2 shadow-xs space-y-1">
        
        {{-- Tab 1: Page Settings --}}
        <button 
          type="button" 
          data-page-tab="settings"
          class="page-nav-tab w-full text-left px-4 py-3 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer bg-[#F2ECE3] text-[#10221C] border-l-4 border-[#C5A47E] font-bold"
        >
          Page Settings
        </button>

        {{-- Tab 2: Canvas & Active Sections (Drag & Drop Reordering) --}}
        <button 
          type="button" 
          data-page-tab="layout_builder"
          class="page-nav-tab w-full text-left px-4 py-3 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer text-slate-600 hover:bg-slate-50"
        >
          Layout Builder
        </button>

        {{-- Dynamic Tabs for each active editable section --}}
        @if($page->exists && $page->sections->count() > 0)
          <div class="pt-2 pb-1 px-3 text-[10px] font-bold uppercase tracking-wider text-neutral-400">
            Page Sections
          </div>

          @php 
            $secTabCounter = 0; 
            $staticSectionKeys = [
              'home_journey', 
              'home_numbers', 
              'home_report', 
              'global_advisor', 
              'home_insights', 
              'home_testimonials', 
              'global_register'
            ];
          @endphp
          @foreach($page->sections as $sec)
            @if($sec->type === 'search_filter' || str_contains($sec->key, 'search') || in_array($sec->key, $staticSectionKeys))
              @continue
            @endif
            @php $secTabCounter++; @endphp
            <button 
              type="button" 
              data-page-tab="sec_{{ $sec->id }}"
              class="page-nav-tab w-full text-left px-4 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer text-slate-600 hover:bg-slate-50 flex items-center justify-between group"
            >
              <span class="truncate">{{ $sec->name }}</span>
              <span class="text-[10px] font-mono text-neutral-400 group-hover:text-[#C5A47E] ml-1 shrink-0">#{{ $secTabCounter }}</span>
            </button>
          @endforeach
        @endif

      </div>
    </aside>

    {{-- Right Form Content Panel Container --}}
    <div class="lg:col-span-9 bg-white rounded-[16px] border border-slate-100 p-6 sm:p-8 shadow-xs">
      
      {{-- TAB 1: PAGE SETTINGS --}}
      <div data-tab-panel="settings" class="page-tab-content space-y-6">
        <div class="border-b border-neutral-100 pb-4 flex items-center justify-between">
          <div>
            <h2 class="font-heading font-medium text-xl text-[#10221C]">General Page Settings</h2>
            <p class="text-xs text-neutral-400 mt-0.5">Configure URL, SEO tags and publication status.</p>
          </div>
          <span class="text-xs font-bold px-3 py-1 rounded-full {{ $page->status === 'published' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-neutral-100 text-neutral-600' }}">
            {{ strtoupper($page->status ?? 'DRAFT') }}
          </span>
        </div>

        <form action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" method="POST">
          @csrf
          @if($page->exists) @method('PUT') @endif

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">Page Title *</label>
              <input type="text" name="title" value="{{ old('title', $page->title) }}" required class="w-full bg-[#FAF8F5] border border-[#EBE7DF] rounded-xl px-4 py-3 text-xs sm:text-[13px] text-neutral-800 focus:outline-none focus:border-[#C5A47E]">
            </div>

            <div>
              <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">Slug (Admin identifier) *</label>
              <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" required pattern="[a-z0-9-]+" class="w-full bg-[#FAF8F5] border border-[#EBE7DF] rounded-xl px-4 py-3 text-xs sm:text-[13px] text-neutral-800 focus:outline-none focus:border-[#C5A47E]">
            </div>

            <div>
              <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">URL Path (e.g. projects, about, or empty for home)</label>
              <input type="text" name="path" value="{{ old('path', $page->path) }}" class="w-full bg-[#FAF8F5] border border-[#EBE7DF] rounded-xl px-4 py-3 text-xs sm:text-[13px] text-neutral-800 focus:outline-none focus:border-[#C5A47E]">
            </div>

            <div>
              <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">Status</label>
              <select name="status" class="w-full bg-[#FAF8F5] border border-[#EBE7DF] rounded-xl px-4 py-3 text-xs sm:text-[13px] text-neutral-800 focus:outline-none focus:border-[#C5A47E]">
                <option value="published" {{ old('status', $page->status) === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ old('status', $page->status) === 'draft' ? 'selected' : '' }}>Draft</option>
              </select>
            </div>

            <div>
              <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">SEO Title</label>
              <input type="text" name="seo_title" value="{{ old('seo_title', $page->seo_title) }}" class="w-full bg-[#FAF8F5] border border-[#EBE7DF] rounded-xl px-4 py-3 text-xs sm:text-[13px] text-neutral-800 focus:outline-none focus:border-[#C5A47E]">
            </div>

            <div>
              <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">SEO Description</label>
              <input type="text" name="seo_description" value="{{ old('seo_description', $page->seo_description) }}" class="w-full bg-[#FAF8F5] border border-[#EBE7DF] rounded-xl px-4 py-3 text-xs sm:text-[13px] text-neutral-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
          </div>

          <div class="flex items-center gap-3 mt-6 pt-5 border-t border-neutral-100">
            <button type="submit" class="px-6 py-3 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors cursor-pointer">
              Save Page Settings
            </button>
            <a href="{{ route('admin.pages.index') }}" class="px-5 py-3 rounded-xl bg-neutral-100 hover:bg-neutral-200 text-neutral-700 text-xs sm:text-sm font-semibold transition-colors">
              Back to Pages
            </a>
          </div>
        </form>
      </div>

      {{-- TAB 2: LAYOUT BUILDER & DRAG/DROP CANVAS --}}
      <div data-tab-panel="layout_builder" class="page-tab-content space-y-6 hidden">
        <div class="border-b border-neutral-100 pb-4 flex items-center justify-between">
          <div>
            <h2 class="font-heading font-medium text-xl text-[#10221C]">Layout Canvas &amp; Global Modules</h2>
            <p class="text-xs text-neutral-400 mt-0.5">Drag to reorder sections on this page or attach modules from the right library.</p>
          </div>
          <span class="text-xs font-bold px-3 py-1 rounded-full bg-[#FAF8F5] text-[#C5A47E] border border-[#EBE7DF]">
            {{ $page->sections->count() }} active
          </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
          
          {{-- Canvas Dropzone (Active Sections) --}}
          <div class="lg:col-span-7 bg-[#FAF8F5]/60 border border-[#EBE7DF] rounded-[16px] p-4 sm:p-5">
            <div class="flex items-center justify-between mb-3">
              <h3 class="font-semibold text-xs text-neutral-700 uppercase tracking-wider">Canvas Order</h3>
              <span class="text-[11px] text-neutral-400">Top to bottom order</span>
            </div>

            <div id="page-dropzone" class="space-y-2.5 min-h-[220px] p-2 rounded-[14px] border-2 border-dashed border-[#EBE7DF] transition-colors">
              @forelse($page->sections as $i => $s)
                @php
                  $secImg = 'images/listing-pool-villa.jpg';
                  if (str_contains($s->key, 'amenit') || str_contains($s->type, 'amenit')) $secImg = 'images/amenities-section-preview.jpg';
                  elseif (str_contains($s->key, 'hero')) $secImg = 'images/communities-hero-villa.jpg';
                  elseif (str_contains($s->key, 'map')) $secImg = 'images/golf-vale-map-view.jpg';
                  elseif (str_contains($s->key, 'project')) $secImg = 'images/golf-vale-main.jpg';
                  elseif (str_contains($s->key, 'stepper') || str_contains($s->key, 'quiz')) $secImg = 'images/palm-jumeirah-ai-hero.jpg';
                  elseif (str_contains($s->key, 'advisor')) $secImg = 'images/agent.jpg';
                @endphp

                <div 
                  class="canvas-section-item bg-white border border-[#EBE7DF] hover:border-[#C5A47E] rounded-[12px] p-3 flex items-center justify-between gap-3 transition-all shadow-2xs group"
                  data-section-id="{{ $s->id }}"
                >
                  <div class="flex items-center gap-3 min-w-0">
                    <span class="w-6 h-6 rounded-md bg-[#FAF8F5] border border-[#EBE7DF] text-neutral-400 flex items-center justify-center text-xs font-bold shrink-0">
                      {{ $i + 1 }}
                    </span>

                    <div class="w-12 h-9 rounded-lg overflow-hidden bg-neutral-100 shrink-0 border border-[#EBE7DF]">
                      <img src="{{ asset($secImg) }}" alt="{{ $s->name }}" class="w-full h-full object-cover">
                    </div>

                    <div class="min-w-0">
                      <button 
                        type="button" 
                        onclick="switchToSectionTab('sec_{{ $s->id }}')" 
                        class="font-semibold text-xs sm:text-[13px] text-[#10221C] hover:text-[#C5A47E] truncate block text-left cursor-pointer"
                      >
                        {{ $s->name }}
                      </button>
                      <span class="text-[10px] font-mono text-neutral-400 block truncate">{{ $s->key }}</span>
                    </div>
                  </div>

                  <div class="flex items-center gap-1.5 shrink-0">
                    <form action="{{ route('admin.pages.move', [$page, $s]) }}" method="POST" class="inline">
                      @csrf
                      <input type="hidden" name="direction" value="up">
                      <button type="submit" class="w-7 h-7 rounded-lg bg-neutral-50 hover:bg-neutral-200 border border-[#EBE7DF] text-xs font-bold text-neutral-600 flex items-center justify-center transition-colors" title="Move Up">
                        ↑
                      </button>
                    </form>

                    <form action="{{ route('admin.pages.move', [$page, $s]) }}" method="POST" class="inline">
                      @csrf
                      <input type="hidden" name="direction" value="down">
                      <button type="submit" class="w-7 h-7 rounded-lg bg-neutral-50 hover:bg-neutral-200 border border-[#EBE7DF] text-xs font-bold text-neutral-600 flex items-center justify-center transition-colors" title="Move Down">
                        ↓
                      </button>
                    </form>

                    <form action="{{ route('admin.pages.detach', [$page, $s]) }}" method="POST" class="inline" onsubmit="return confirm('Remove section from this page?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="w-7 h-7 rounded-lg bg-neutral-50 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 border border-[#EBE7DF] text-xs font-bold text-neutral-400 flex items-center justify-center transition-colors" title="Remove">
                        ✕
                      </button>
                    </form>
                  </div>
                </div>
              @empty
                <div class="py-12 text-center text-neutral-400 text-xs">
                  No active sections. Add modules from the list on the right.
                </div>
              @endforelse
            </div>

            <form id="dnd-attach-form" action="{{ route('admin.pages.attach', $page) }}" method="POST" class="hidden">
              @csrf
              <input type="hidden" name="section_id" id="dnd-section-id">
            </form>
          </div>

          {{-- Available Modules Panel --}}
          <div class="lg:col-span-5 bg-white border border-[#EBE7DF] rounded-[16px] p-4">
            <div class="flex items-center justify-between mb-3">
              <h3 class="font-semibold text-xs text-neutral-700 uppercase tracking-wider">Available Modules</h3>
              <a href="{{ route('admin.sections.index') }}" class="text-[11px] font-semibold text-[#C5A47E] hover:underline">
                Manage All →
              </a>
            </div>

            <div class="mb-3">
              <input 
                type="text" 
                id="search-modules-input"
                placeholder="Filter modules…" 
                class="w-full bg-[#FAF8F5] border border-[#EBE7DF] rounded-xl px-3 py-2 text-xs text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#C5A47E]"
              >
            </div>

            <div id="draggable-modules-list" class="space-y-2 max-h-[500px] overflow-y-auto pr-1">
              @foreach($sections as $s)
                @php
                  $isAlreadyAttached = in_array($s->id, $attachedIds ?? []);
                  $thumb = 'images/listing-pool-villa.jpg';
                  if (str_contains($s->key, 'amenit') || str_contains($s->type, 'amenit')) $thumb = 'images/amenities-section-preview.jpg';
                  elseif (str_contains($s->key, 'hero')) $thumb = 'images/communities-hero-villa.jpg';
                  elseif (str_contains($s->key, 'map')) $thumb = 'images/golf-vale-map-view.jpg';
                  elseif (str_contains($s->key, 'project')) $thumb = 'images/golf-vale-main.jpg';
                  elseif (str_contains($s->key, 'stepper') || str_contains($s->key, 'quiz')) $thumb = 'images/palm-jumeirah-ai-hero.jpg';
                @endphp

                <div 
                  class="draggable-module-card border rounded-[12px] p-2.5 transition-all flex items-center justify-between gap-3 {{ $isAlreadyAttached ? 'bg-neutral-50/80 border-[#EBE7DF] opacity-60' : 'bg-white border-[#EBE7DF] hover:border-[#C5A47E] cursor-grab' }}"
                  draggable="{{ $isAlreadyAttached ? 'false' : 'true' }}"
                  data-section-id="{{ $s->id }}"
                  data-module-name="{{ strtolower($s->name) }}"
                >
                  <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-10 h-8 rounded-lg overflow-hidden bg-neutral-100 shrink-0 border border-[#EBE7DF]">
                      <img src="{{ asset($thumb) }}" alt="{{ $s->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="min-w-0">
                      <p class="font-semibold text-xs text-[#10221C] truncate leading-tight">
                        {{ $s->name }}
                      </p>
                      <span class="text-[9px] text-neutral-400 font-mono truncate block mt-0.5">
                        {{ $s->key }}
                      </span>
                    </div>
                  </div>

                  <div class="shrink-0">
                    @if($isAlreadyAttached)
                      <span class="text-[9px] font-bold text-neutral-400 bg-neutral-200/60 px-2 py-0.5 rounded-md">
                        Added
                      </span>
                    @else
                      <button 
                        type="button" 
                        onclick="attachSection('{{ $s->id }}')"
                        class="px-2.5 py-1 rounded-lg bg-[#FAF8F5] hover:bg-[#C5A47E] hover:text-white border border-[#EBE7DF] text-[#10221C] text-[10px] font-bold transition-colors cursor-pointer"
                      >
                        + Add
                      </button>
                    @endif
                  </div>
                </div>
              @endforeach
            </div>
          </div>

        </div>
      </div>

      {{-- DYNAMIC TABS FOR EACH ACTIVE SECTION --}}
      @if($page->exists)
        @foreach($page->sections as $sec)
          @if($sec->type === 'search_filter' || str_contains($sec->key, 'search') || in_array($sec->key, $staticSectionKeys ?? []))
            @continue
          @endif
          @php 
            $c = $sec->c(); 
          @endphp

          <div data-tab-panel="sec_{{ $sec->id }}" class="page-tab-content space-y-6 hidden">
            <div class="border-b border-neutral-100 pb-4">
              <h2 class="font-heading font-medium text-xl text-[#10221C]">{{ $sec->name }}</h2>
            </div>

            <form action="{{ route('admin.sections.update', $sec) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <input type="hidden" name="name" value="{{ $sec->name }}">
              <input type="hidden" name="key" value="{{ $sec->key }}">
              <input type="hidden" name="type" value="{{ $sec->type }}">
              <input type="hidden" name="status" value="{{ $sec->status }}">
              <input type="hidden" name="is_global" value="1">

              {{-- Friendly Inputs for Common Content Fields --}}
              <div class="space-y-5">
                
                @if($sec->key === 'home_quiz')
                  {{-- SPECIAL EDITOR FOR PROPERTY QUIZ CTA --}}
                  {{-- 1. Summernote for Heading, Content, and Bullets --}}
                  <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                      Main Content &amp; Bullets (WYSIWYG Editor)
                    </label>
                    <textarea 
                      id="summernote-quiz-content" 
                      name="content_quiz_rich_content" 
                      class="summernote-editor w-full"
                    >{!! $c['quiz_rich_content'] ?? '<h2>Confused About Where to Buy or<br>Invest in Dubai?</h2><p>Take the 30-Second Dubai Property Quiz and instantly get matched with the best projects in Dubai — tailored to your budget, goals, and lifestyle. Perfect for investors and end users alike.</p><ul><li><strong>Personalized Matches:</strong> Find projects tailored to your goals/budget in seconds</li><li><strong>Handpicked Projects:</strong> Explore the most in-demand Dubai developments</li><li><strong>Smart Investment Insights:</strong> See which projects offer the best returns and growth.</li><li><strong>Free Guidebook:</strong> Access market insights, top launches, and expert tips.</li></ul>' !!}</textarea>
                  </div>

                  {{-- 2. Normal Action Buttons --}}
                  <div class="pt-3 border-t border-slate-100 space-y-4">
                    <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Buttons</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                      {{-- Button 1 (Tan) --}}
                      <div class="bg-[#FAF8F5] border border-slate-200 rounded-xl p-4 space-y-3">
                        <span class="text-xs font-bold text-slate-700 block">Button 1 (Primary Tan)</span>
                        <div>
                          <label class="block text-[11px] font-semibold text-slate-600 mb-1">Button Label</label>
                          <input 
                            type="text" 
                            name="content_button_text" 
                            value="{{ $c['button_text'] ?? 'Find my dream homes' }}" 
                            class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>
                        <div>
                          <label class="block text-[11px] font-semibold text-slate-600 mb-1">Link URL</label>
                          <input 
                            type="text" 
                            name="content_button_link" 
                            value="{{ $c['button_link'] ?? '/ai-villa-assessment' }}" 
                            class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>
                      </div>

                      {{-- Button 2 (Dark) --}}
                      <div class="bg-[#FAF8F5] border border-slate-200 rounded-xl p-4 space-y-3">
                        <span class="text-xs font-bold text-slate-700 block">Button 2 (Secondary Dark)</span>
                        <div>
                          <label class="block text-[11px] font-semibold text-slate-600 mb-1">Button Label</label>
                          <input 
                            type="text" 
                            name="content_button2_text" 
                            value="{{ $c['button2_text'] ?? 'It takes only 30 seconds' }}" 
                            class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>
                        <div>
                          <label class="block text-[11px] font-semibold text-slate-600 mb-1">Link URL</label>
                          <input 
                            type="text" 
                            name="content_button2_link" 
                            value="{{ $c['button2_link'] ?? '/ai-villa-assessment' }}" 
                            class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- 3. Take Quiz Now Note Heading & Content --}}
                  <div class="pt-3 border-t border-slate-100 space-y-4">
                    <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Take the 30-Second Quiz Now Box</h3>
                    
                    <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">Note Heading</label>
                      <input 
                        type="text" 
                        name="content_note_title" 
                        value="{{ $c['note_title'] ?? 'Take the 30-Second Quiz Now' }}" 
                        class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                      >
                    </div>

                    <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">Note Content / Description</label>
                      <textarea 
                        name="content_note" 
                        rows="3" 
                        class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl p-3.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E] leading-relaxed"
                      >{{ $c['note'] ?? 'Find your ideal property in Dubai — and unlock your personalized results plus the Dubai Investment Guidebook instantly.' }}</textarea>
                    </div>
                  </div>

                  {{-- 4. Left Picture Upload & Live Preview --}}
                  <div class="pt-3 border-t border-slate-100">
                    <label class="block text-xs font-semibold text-neutral-700 mb-2">Left Side Image (Skyline)</label>
                    <div class="border border-slate-200 rounded-2xl p-4 bg-white flex flex-col sm:flex-row items-center gap-5">
                      <div class="w-full sm:w-48 h-32 rounded-xl bg-slate-100 overflow-hidden border border-slate-200 shrink-0 relative group">
                        <img 
                          id="preview-img-{{ $sec->id }}"
                          src="{{ !empty($c['image']) ? asset($c['image']) : asset('images/dubai-skyline.jpg') }}" 
                          alt="Section preview" 
                          class="w-full h-full object-cover"
                        >
                      </div>

                      <div class="flex-1 w-full space-y-2">
                        <div class="flex items-center justify-between">
                          <span class="text-xs font-medium text-slate-600">Upload new image file from laptop</span>
                          <label class="px-4 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs cursor-pointer transition-colors">
                            <span>Browse</span>
                            <input 
                              type="file" 
                              name="image_upload" 
                              accept="image/*" 
                              class="hidden"
                              onchange="previewUploadedImage(this, 'preview-img-{{ $sec->id }}')"
                            >
                          </label>
                        </div>
                        <input 
                          type="text" 
                          name="content_image" 
                          value="{{ $c['image'] ?? 'images/dubai-skyline.jpg' }}" 
                          placeholder="images/dubai-skyline.jpg"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-500 font-mono focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    </div>
                  </div>

                @elseif(str_contains($sec->key, 'seo') || $sec->type === 'seo_text')
                  {{-- SPECIAL EDITOR FOR SEO TEXT BLOCK --}}
                  <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                      Full Content (WYSIWYG Editor)
                    </label>
                    <textarea 
                      id="summernote-seo-{{ $sec->id }}" 
                      name="content_full_content" 
                      class="summernote-editor w-full"
                    >{!! $c['full_content'] ?? '<h3 style="color:#C5A47E; font-size:24px; font-weight:700; margin-bottom:12px;">Modern lifestyle and residential opportunities</h3><p style="color:#4A5550; font-size:16px; line-height:1.7; margin-bottom:16px;">dubai offers a diverse range of residential properties designed to meet different needs. from contemporary apartments to spacious villas and premium residential developments, buyers can explore various options based on their requirements.</p><p style="color:#4A5550; font-size:16px; line-height:1.7; margin-bottom:16px;">when researching baharia town dubai, potential buyers should consider important factors such as property location, accessibility, available facilities, and nearby commercial areas. a well-planned residential community can provide convenient access to shopping centers, schools, healthcare facilities, recreational spaces, and major transportation routes.</p><p style="color:#4A5550; font-size:16px; line-height:1.7; margin-bottom:32px;">these features make dubai an attractive destination for families, professionals, and international property investors seeking a modern urban lifestyle.</p><h3 style="color:#C5A47E; font-size:24px; font-weight:700; margin-bottom:12px;">luxury villas and real estate investment opportunities</h3><p style="color:#4A5550; font-size:16px; line-height:1.7; margin-bottom:16px;">dubai has established itself as a significant international real estate destination. its business-friendly environment, tourism industry, modern infrastructure, and international connectivity contribute to continued interest from property investors.</p><p style="color:#4A5550; font-size:16px; line-height:1.7; margin-bottom:16px;">investors researching baharia town dubai may also explore other residential developments throughout the city to compare prices, locations, amenities, and potential rental demand.</p><p style="color:#4A5550; font-size:16px; line-height:1.7; margin-bottom:16px;">before purchasing a property, it is essential to evaluate the total cost of ownership, applicable service charges, payment plans, and the legal status of the development. buyers should also verify whether a property is located in an area where foreign ownership is permitted and review the relevant registration requirements.</p>' !!}</textarea>
                  </div>

                @elseif(str_contains($sec->key, 'faq') || $sec->type === 'faq')
                  {{-- SPECIAL EDITOR FOR FAQS --}}
                  <div class="space-y-6">
                    {{-- Eyebrow & Section Heading --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Eyebrow</label>
                        <input 
                          type="text" 
                          name="content_eyebrow" 
                          value="{{ $c['eyebrow'] ?? 'FAQS' }}" 
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Section Heading</label>
                        <input 
                          type="text" 
                          name="content_heading_html" 
                          value="{{ html_entity_decode($c['heading_html'] ?? 'Frequently asked questions', ENT_QUOTES | ENT_HTML5, 'UTF-8') }}" 
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    </div>

                    {{-- Dynamic FAQ List Items --}}
                    {{-- Two-Column Drag & Drop for View New Projects in Dubai (Off-Plan Projects Carousel: Column A -> Column S) --}}
                @if($sec->key === 'villas_rows' || $sec->type === 'listing_rows')
                  @php
                    $allOffplanList = \App\Http\Controllers\Admin\EntityController::getAvailableOffplanProjects();
                    $selectedOffplanSlugs = $c['assigned_offplan_projects'] ?? [
                      'golf-vale-emaar-south',
                      'the-fairway-villa',
                      'maple-row-villa',
                      'nara-townhouse'
                    ];

                    $availableOffplans = [];
                    $selectedOffplans = [];

                    foreach ($allOffplanList as $op) {
                      $opData = [
                        'slug' => $op['slug'],
                        'name' => $op['name'],
                        'developer' => $op['developer'] ?? 'Binghatti',
                        'location' => $op['location'] ?? 'Dubai',
                        'price' => $op['price'] ?? 'Launch Price AED 1.7M',
                        'image' => $op['image'] ?? 'images/project-binghatti-1.jpg',
                        'badge' => 'Under Construction',
                      ];

                      if (in_array($op['slug'], $selectedOffplanSlugs)) {
                        $selectedOffplans[] = $opData;
                      } else {
                        $availableOffplans[] = $opData;
                      }
                    }
                  @endphp

                  <div class="pt-5 border-t border-slate-100 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2">
                      <div>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">View New Projects in Dubai (Off-Plan Carousel)</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Drag projects from <strong>Column A (All Offplan Projects)</strong> into <strong>Column S</strong> to show in the "View New Projects in Dubai" carousel.</p>
                      </div>
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
                        Drag &amp; Drop Active
                      </span>
                    </div>

                    {{-- 2 Columns Grid: Column A & Column S --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start font-inter">
                      
                      {{-- COLUMN A: ALL OFFPLAN PROJECTS --}}
                      <div class="bg-[#FAF8F5] rounded-[18px] border-2 border-dashed border-slate-200 p-4">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#0E3B2C] text-white text-xs font-bold flex items-center justify-center">A</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700">Column A (All Offplan Projects)</h4>
                          </div>
                          <span id="col-offplan-a-count" class="text-[11px] font-semibold text-slate-400 bg-white px-2.5 py-0.5 rounded-full border border-slate-200">
                            {{ count($availableOffplans) }} items
                          </span>
                        </div>

                        {{-- Dropzone A --}}
                        <div 
                          id="dropzone-offplan-a" 
                          class="min-h-[300px] space-y-2.5 p-1 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropOffplan(event, 'a')"
                        >
                          @foreach($availableOffplans as $item)
                            <div 
                              id="offplan-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragOffplan(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="offplan-drag-card bg-white border border-slate-200 hover:border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[10px] text-slate-400 truncate">{{ $item['location'] }} &bull; {{ $item['price'] }}</p>
                                </div>
                              </div>
                              <span class="text-slate-400 hover:text-slate-600 text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                      {{-- COLUMN S: SELECTED OFFPLAN PROJECTS --}}
                      <div class="bg-white rounded-[18px] border-2 border-[#C5A47E]/40 p-4 shadow-xs">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#C5A47E] text-white text-xs font-bold flex items-center justify-center">S</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Column S (Show in Carousel)</h4>
                          </div>
                          <span id="col-offplan-s-count" class="text-[11px] font-bold text-[#0E3B2C] bg-[#FAF8F5] px-2.5 py-0.5 rounded-full border border-[#C5A47E]/30">
                            {{ count($selectedOffplans) }} assigned
                          </span>
                        </div>

                        {{-- Dropzone S --}}
                        <div 
                          id="dropzone-offplan-s" 
                          class="min-h-[300px] space-y-2.5 p-1 rounded-xl bg-slate-50/50 border border-dashed border-slate-200 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropOffplan(event, 's')"
                        >
                          @foreach($selectedOffplans as $item)
                            <div 
                              id="offplan-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragOffplan(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="offplan-drag-card bg-white border border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[10px] text-emerald-600 font-semibold truncate">{{ $item['badge'] }} &bull; Active in Carousel</p>
                                </div>
                              </div>
                              <span class="text-[#C5A47E] text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                    </div>

                    {{-- Hidden inputs for Column S --}}
                    <div id="selected-offplan-inputs">
                      @foreach($selectedOffplans as $item)
                        <input type="hidden" name="selected_offplan_projects[]" value="{{ $item['slug'] }}" id="input-offplan-{{ $item['slug'] }}">
                      @endforeach
                    </div>

                  </div>
                @endif

                @php
                      $faqItems = !empty($c['faqs']) && is_array($c['faqs']) ? $c['faqs'] : [
                        ['q' => 'What Is Lux Villa Dubai?', 'a' => 'LUX Villa Dubai is a luxury real estate advisory and portfolio showcasing curated villas, townhouses, and premier off-plan opportunities across Dubai\'s most prestigious neighborhoods.'],
                        ['q' => 'Who Is The Developer Behind Lux Villa Dubai?', 'a' => 'We partner directly with leading developers including Emaar, Nakheel, Meraas, Sobha, and Damac to bring you verified, tier-one properties with developer-direct pricing.'],
                        ['q' => 'Where Is Lux Villa Dubai Located?', 'a' => 'Our flagship properties span prime Dubai locations including Palm Jumeirah, Dubai Hills Estate, Emirates Hills, The Valley, and Emaar South.'],
                        ['q' => 'What Types Of Properties Are Available In Lux Villa Dubai?', 'a' => 'We specialize exclusively in luxury standalone villas, modern semi-detached homes, waterfront townhouses, and signature branded estates.'],
                        ['q' => 'Is Lux Villa Dubai A Good Investment Opportunity?', 'a' => 'Yes, our properties are curated for strong capital appreciation and attractive rental yields (typically 6% - 8%+ gross yields) in zero capital gains tax jurisdictions.'],
                        ['q' => 'Does Lux Villa Dubai Have Government Or Authority Backing?', 'a' => 'All advertised projects are 100% compliant and registered with the Dubai Land Department (DLD) and the Real Estate Regulatory Agency (RERA), with secure escrow accounts.'],
                      ];
                    @endphp

                    <div class="pt-4 border-t border-slate-200">
                      <div class="flex items-center justify-between mb-4">
                        <div>
                          <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Frequently Asked Questions Items</h3>
                          <p class="text-[11px] text-slate-500 mt-0.5">Add, edit, or delete questions and answers shown in the FAQ accordion</p>
                        </div>
                        <button 
                          type="button" 
                          onclick="addFaqRow('faq-container-{{ $sec->id }}')" 
                          class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs transition-colors cursor-pointer"
                        >
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                          <span>Add New FAQ</span>
                        </button>
                      </div>

                      <div id="faq-container-{{ $sec->id }}" class="space-y-4">
                        @foreach($faqItems as $fIdx => $faq)
                        <div class="faq-row bg-[#FAF8F5] border border-slate-200 rounded-2xl p-4.5 space-y-3 relative group transition-all hover:border-[#C5A47E]/60">
                          <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Question #<span class="faq-num">{{ $loop->iteration }}</span></span>
                            <button 
                              type="button" 
                              onclick="removeFaqRow(this)" 
                              class="text-xs font-semibold text-rose-500 hover:text-rose-700 transition-colors flex items-center gap-1 cursor-pointer"
                            >
                              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                              <span>Delete</span>
                            </button>
                          </div>

                          <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">Question</label>
                            <input 
                              type="text" 
                              name="faqs[{{ $fIdx }}][q]" 
                              value="{{ $faq['q'] ?? '' }}" 
                              placeholder="e.g. What is the booking process?" 
                              class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] font-medium text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                            >
                          </div>

                          <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">Answer</label>
                            <textarea 
                              name="faqs[{{ $fIdx }}][a]" 
                              rows="3" 
                              placeholder="Type the detailed answer here..." 
                              class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E] leading-relaxed"
                            >{{ $faq['a'] ?? '' }}</textarea>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>

                @else
                  {{-- DEFAULT FORM INPUTS FOR OTHER SECTIONS --}}
                  {{-- Breadcrumbs / Eyebrow Row --}}
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @if(isset($c['breadcrumb']) || str_contains($sec->key, 'intro') || str_contains($sec->key, 'hero'))
                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Breadcrumb</label>
                        <input 
                          type="text" 
                          name="content_breadcrumb" 
                          value="{{ $c['breadcrumb'] ?? '' }}" 
                          placeholder="HOME > PROJECT" 
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    @endif

                    @if(isset($c['eyebrow']) || str_contains($sec->key, 'promo') || str_contains($sec->key, 'faq'))
                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Eyebrow</label>
                        <input 
                          type="text" 
                          name="content_eyebrow" 
                          value="{{ $c['eyebrow'] ?? '' }}" 
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    @endif
                  </div>

                  {{-- Heading Input --}}
                  <div>
                    <label class="block text-xs font-semibold text-neutral-700 mb-2">
                      Section Heading
                    </label>
                    <input 
                      type="text" 
                      name="content_heading_html" 
                      value="{{ html_entity_decode($c['heading_html'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8') }}" 
                      class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                    >
                  </div>

                  {{-- Subtext / Description --}}
                  <div>
                    <label class="block text-xs font-semibold text-neutral-700 mb-2">Description</label>
                    <textarea 
                      name="content_subtext" 
                      rows="3" 
                      class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl p-4 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                    >{{ $c['subtext'] ?? '' }}</textarea>
                  </div>

                  {{-- Image Card with Browse Button & Live Preview (Hero / Promo only) --}}
                  @if(isset($c['image']) && in_array($sec->type, ['promo_band', 'text_image', 'hero']))
                    <div>
                      <label class="block text-xs font-semibold text-neutral-700 mb-2">Section Cover / Background Image</label>
                      <div class="border border-slate-200 rounded-2xl p-4 bg-white flex flex-col sm:flex-row items-center gap-5">
                        <div class="w-full sm:w-48 h-32 rounded-xl bg-slate-100 overflow-hidden border border-slate-200 shrink-0 relative group">
                          <img 
                            id="preview-img-{{ $sec->id }}"
                            src="{{ !empty($c['image']) ? asset($c['image']) : asset('images/house-white.jpg') }}" 
                            alt="Section preview" 
                            class="w-full h-full object-cover"
                          >
                        </div>

                        <div class="flex-1 w-full space-y-2">
                          <div class="flex items-center justify-between">
                            <span class="text-xs font-medium text-slate-600">Upload new image file from laptop</span>
                            <label class="px-4 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs cursor-pointer transition-colors">
                              <span>Browse</span>
                              <input 
                                type="file" 
                                name="image_upload" 
                                accept="image/*" 
                                class="hidden"
                                onchange="previewUploadedImage(this, 'preview-img-{{ $sec->id }}')"
                              >
                            </label>
                          </div>
                          <input 
                            type="text" 
                            name="content_image" 
                            value="{{ $c['image'] ?? '' }}" 
                            placeholder="images/house-white.jpg"
                            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-500 font-mono focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>
                      </div>
                    </div>
                  @endif

                  {{-- Button Links --}}
                  @if(isset($c['button_text']) || str_contains($sec->key, 'promo') || str_contains($sec->key, 'intro'))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Button Label</label>
                        <input 
                          type="text" 
                          name="content_button_text" 
                          value="{{ $c['button_text'] ?? '' }}" 
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Button Link URL</label>
                        <input 
                          type="text" 
                          name="content_button_link" 
                          value="{{ $c['button_link'] ?? '' }}" 
                          placeholder="/enquiry"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    </div>
                  @endif

                  {{-- Header Top Right Action Button for Section (e.g. View All Properties button) --}}
                  @if(isset($c['header_button_text']) || $sec->type === 'cards_3col')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Header Button Label</label>
                        <input 
                          type="text" 
                          name="content_header_button_text" 
                          value="{{ $c['header_button_text'] ?? 'View All Properties →' }}" 
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Header Button Link URL</label>
                        <input 
                          type="text" 
                          name="content_header_button_link" 
                          value="{{ $c['header_button_link'] ?? '/villas-for-sale' }}" 
                          placeholder="/villas-for-sale"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    </div>
                  @endif
                @endif

                {{-- Three Dedicated Cards for cards_3col (Explore Properties ONLY, not Popular Communities) --}}
                @if($sec->type === 'cards_3col' && $sec->key !== 'home_communities')
                  <div class="pt-4 border-t border-slate-100">
                    <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-4">Property Cards (3 Cards)</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                      {{-- Two-Column Drag & Drop for View New Projects in Dubai (Off-Plan Projects Carousel: Column A -> Column S) --}}
                @if($sec->key === 'villas_rows' || $sec->type === 'listing_rows')
                  @php
                    $allOffplanList = \App\Http\Controllers\Admin\EntityController::getAvailableOffplanProjects();
                    $selectedOffplanSlugs = $c['assigned_offplan_projects'] ?? [
                      'golf-vale-emaar-south',
                      'the-fairway-villa',
                      'maple-row-villa',
                      'nara-townhouse'
                    ];

                    $availableOffplans = [];
                    $selectedOffplans = [];

                    foreach ($allOffplanList as $op) {
                      $opData = [
                        'slug' => $op['slug'],
                        'name' => $op['name'],
                        'developer' => $op['developer'] ?? 'Binghatti',
                        'location' => $op['location'] ?? 'Dubai',
                        'price' => $op['price'] ?? 'Launch Price AED 1.7M',
                        'image' => $op['image'] ?? 'images/project-binghatti-1.jpg',
                        'badge' => 'Under Construction',
                      ];

                      if (in_array($op['slug'], $selectedOffplanSlugs)) {
                        $selectedOffplans[] = $opData;
                      } else {
                        $availableOffplans[] = $opData;
                      }
                    }
                  @endphp

                  <div class="pt-5 border-t border-slate-100 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2">
                      <div>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">View New Projects in Dubai (Off-Plan Carousel)</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Drag projects from <strong>Column A (All Offplan Projects)</strong> into <strong>Column S</strong> to show in the "View New Projects in Dubai" carousel.</p>
                      </div>
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
                        Drag &amp; Drop Active
                      </span>
                    </div>

                    {{-- 2 Columns Grid: Column A & Column S --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start font-inter">
                      
                      {{-- COLUMN A: ALL OFFPLAN PROJECTS --}}
                      <div class="bg-[#FAF8F5] rounded-[18px] border-2 border-dashed border-slate-200 p-4">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#0E3B2C] text-white text-xs font-bold flex items-center justify-center">A</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700">Column A (All Offplan Projects)</h4>
                          </div>
                          <span id="col-offplan-a-count" class="text-[11px] font-semibold text-slate-400 bg-white px-2.5 py-0.5 rounded-full border border-slate-200">
                            {{ count($availableOffplans) }} items
                          </span>
                        </div>

                        {{-- Dropzone A --}}
                        <div 
                          id="dropzone-offplan-a" 
                          class="min-h-[300px] space-y-2.5 p-1 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropOffplan(event, 'a')"
                        >
                          @foreach($availableOffplans as $item)
                            <div 
                              id="offplan-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragOffplan(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="offplan-drag-card bg-white border border-slate-200 hover:border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[10px] text-slate-400 truncate">{{ $item['location'] }} &bull; {{ $item['price'] }}</p>
                                </div>
                              </div>
                              <span class="text-slate-400 hover:text-slate-600 text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                      {{-- COLUMN S: SELECTED OFFPLAN PROJECTS --}}
                      <div class="bg-white rounded-[18px] border-2 border-[#C5A47E]/40 p-4 shadow-xs">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#C5A47E] text-white text-xs font-bold flex items-center justify-center">S</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Column S (Show in Carousel)</h4>
                          </div>
                          <span id="col-offplan-s-count" class="text-[11px] font-bold text-[#0E3B2C] bg-[#FAF8F5] px-2.5 py-0.5 rounded-full border border-[#C5A47E]/30">
                            {{ count($selectedOffplans) }} assigned
                          </span>
                        </div>

                        {{-- Dropzone S --}}
                        <div 
                          id="dropzone-offplan-s" 
                          class="min-h-[300px] space-y-2.5 p-1 rounded-xl bg-slate-50/50 border border-dashed border-slate-200 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropOffplan(event, 's')"
                        >
                          @foreach($selectedOffplans as $item)
                            <div 
                              id="offplan-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragOffplan(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="offplan-drag-card bg-white border border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[10px] text-emerald-600 font-semibold truncate">{{ $item['badge'] }} &bull; Active in Carousel</p>
                                </div>
                              </div>
                              <span class="text-[#C5A47E] text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                    </div>

                    {{-- Hidden inputs for Column S --}}
                    <div id="selected-offplan-inputs">
                      @foreach($selectedOffplans as $item)
                        <input type="hidden" name="selected_offplan_projects[]" value="{{ $item['slug'] }}" id="input-offplan-{{ $item['slug'] }}">
                      @endforeach
                    </div>

                  </div>
                @endif

                @php
                        $items = $c['items'] ?? [
                          ['title' => 'Ready Villas & Town Houses', 'image' => 'images/readyvilla.png', 'button_text' => 'Explore More', 'link' => '/villas-for-sale'],
                          ['title' => 'Resale Villas & Town Houses', 'image' => 'images/realestet.png', 'button_text' => 'Explore More', 'link' => '/villas-for-sale'],
                          ['title' => 'Off-Plan Villas & Town Houses', 'image' => 'images/offplan.png', 'button_text' => 'Explore More', 'link' => '/villas-for-sale'],
                        ];
                      @endphp

                      @foreach($items as $idx => $it)
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs space-y-3.5">
                          <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <span class="text-xs font-bold text-slate-700">Card #{{ $idx + 1 }}</span>
                            <span class="text-[10px] font-mono text-[#C5A47E] font-semibold">Active</span>
                          </div>

                          {{-- Card Image Preview & Browse Button --}}
                          <div>
                            <label class="block text-[11px] font-semibold text-slate-600 mb-1.5">Card Image</label>
                            <div class="relative h-28 rounded-xl overflow-hidden bg-slate-100 border border-slate-200 mb-2">
                              <img 
                                id="preview-card-img-{{ $sec->id }}-{{ $idx }}"
                                src="{{ !empty($it['image']) ? asset($it['image']) : asset('images/readyvilla.png') }}" 
                                alt="{{ $it['title'] ?? 'Card preview' }}" 
                                class="w-full h-full object-cover"
                              >
                            </div>
                            
                            <div class="flex items-center justify-between gap-2">
                              <label class="px-3 py-1.5 rounded-lg bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs cursor-pointer transition-colors inline-flex items-center gap-1">
                                <span>Browse</span>
                                <input 
                                  type="file" 
                                  name="items[{{ $idx }}][image_file]" 
                                  accept="image/*" 
                                  class="hidden"
                                  onchange="previewUploadedImage(this, 'preview-card-img-{{ $sec->id }}-{{ $idx }}')"
                                >
                              </label>
                              <input 
                                type="text" 
                                name="items[{{ $idx }}][image]" 
                                value="{{ $it['image'] ?? '' }}" 
                                class="w-full bg-[#FAF8F5] border border-slate-200 rounded-lg px-2.5 py-1 text-[11px] text-slate-500 font-mono focus:outline-none focus:border-[#C5A47E]"
                              >
                            </div>
                          </div>

                          {{-- Card Title --}}
                          <div>
                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Card Title</label>
                            <input 
                              type="text" 
                              name="items[{{ $idx }}][title]" 
                              value="{{ $it['title'] ?? '' }}" 
                              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3 py-2 text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                            >
                          </div>

                          {{-- Button Text --}}
                          <div>
                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Button Text</label>
                            <input 
                              type="text" 
                              name="items[{{ $idx }}][button_text]" 
                              value="{{ $it['button_text'] ?? 'Explore More' }}" 
                              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                            >
                          </div>

                          {{-- Link URL --}}
                          <div>
                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Target Link URL</label>
                            <input 
                              type="text" 
                              name="items[{{ $idx }}][link]" 
                              value="{{ $it['link'] ?? '/villas-for-sale' }}" 
                              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                            >
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endif

                {{-- Two-Column Drag & Drop for Popular Communities (Column A -> Column S) --}}
                @if($sec->key === 'home_communities' || $sec->type === 'communities_grid')
                  {{-- Two-Column Drag & Drop for View New Projects in Dubai (Off-Plan Projects Carousel: Column A -> Column S) --}}
                @if($sec->key === 'villas_rows' || $sec->type === 'listing_rows')
                  @php
                    $allOffplanList = \App\Http\Controllers\Admin\EntityController::getAvailableOffplanProjects();
                    $selectedOffplanSlugs = $c['assigned_offplan_projects'] ?? [
                      'golf-vale-emaar-south',
                      'the-fairway-villa',
                      'maple-row-villa',
                      'nara-townhouse'
                    ];

                    $availableOffplans = [];
                    $selectedOffplans = [];

                    foreach ($allOffplanList as $op) {
                      $opData = [
                        'slug' => $op['slug'],
                        'name' => $op['name'],
                        'developer' => $op['developer'] ?? 'Binghatti',
                        'location' => $op['location'] ?? 'Dubai',
                        'price' => $op['price'] ?? 'Launch Price AED 1.7M',
                        'image' => $op['image'] ?? 'images/project-binghatti-1.jpg',
                        'badge' => 'Under Construction',
                      ];

                      if (in_array($op['slug'], $selectedOffplanSlugs)) {
                        $selectedOffplans[] = $opData;
                      } else {
                        $availableOffplans[] = $opData;
                      }
                    }
                  @endphp

                  <div class="pt-5 border-t border-slate-100 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2">
                      <div>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">View New Projects in Dubai (Off-Plan Carousel)</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Drag projects from <strong>Column A (All Offplan Projects)</strong> into <strong>Column S</strong> to show in the "View New Projects in Dubai" carousel.</p>
                      </div>
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
                        Drag &amp; Drop Active
                      </span>
                    </div>

                    {{-- 2 Columns Grid: Column A & Column S --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start font-inter">
                      
                      {{-- COLUMN A: ALL OFFPLAN PROJECTS --}}
                      <div class="bg-[#FAF8F5] rounded-[18px] border-2 border-dashed border-slate-200 p-4">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#0E3B2C] text-white text-xs font-bold flex items-center justify-center">A</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700">Column A (All Offplan Projects)</h4>
                          </div>
                          <span id="col-offplan-a-count" class="text-[11px] font-semibold text-slate-400 bg-white px-2.5 py-0.5 rounded-full border border-slate-200">
                            {{ count($availableOffplans) }} items
                          </span>
                        </div>

                        {{-- Dropzone A --}}
                        <div 
                          id="dropzone-offplan-a" 
                          class="min-h-[300px] space-y-2.5 p-1 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropOffplan(event, 'a')"
                        >
                          @foreach($availableOffplans as $item)
                            <div 
                              id="offplan-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragOffplan(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="offplan-drag-card bg-white border border-slate-200 hover:border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[10px] text-slate-400 truncate">{{ $item['location'] }} &bull; {{ $item['price'] }}</p>
                                </div>
                              </div>
                              <span class="text-slate-400 hover:text-slate-600 text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                      {{-- COLUMN S: SELECTED OFFPLAN PROJECTS --}}
                      <div class="bg-white rounded-[18px] border-2 border-[#C5A47E]/40 p-4 shadow-xs">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#C5A47E] text-white text-xs font-bold flex items-center justify-center">S</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Column S (Show in Carousel)</h4>
                          </div>
                          <span id="col-offplan-s-count" class="text-[11px] font-bold text-[#0E3B2C] bg-[#FAF8F5] px-2.5 py-0.5 rounded-full border border-[#C5A47E]/30">
                            {{ count($selectedOffplans) }} assigned
                          </span>
                        </div>

                        {{-- Dropzone S --}}
                        <div 
                          id="dropzone-offplan-s" 
                          class="min-h-[300px] space-y-2.5 p-1 rounded-xl bg-slate-50/50 border border-dashed border-slate-200 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropOffplan(event, 's')"
                        >
                          @foreach($selectedOffplans as $item)
                            <div 
                              id="offplan-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragOffplan(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="offplan-drag-card bg-white border border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[10px] text-emerald-600 font-semibold truncate">{{ $item['badge'] }} &bull; Active in Carousel</p>
                                </div>
                              </div>
                              <span class="text-[#C5A47E] text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                    </div>

                    {{-- Hidden inputs for Column S --}}
                    <div id="selected-offplan-inputs">
                      @foreach($selectedOffplans as $item)
                        <input type="hidden" name="selected_offplan_projects[]" value="{{ $item['slug'] }}" id="input-offplan-{{ $item['slug'] }}">
                      @endforeach
                    </div>

                  </div>
                @endif

                @php
                    $allCommStore = \App\Http\Controllers\Admin\EntityController::getCommunityStore();
                    $selectedCommSlugs = $c['assigned_communities'] ?? ['the-valley'];

                    $availableComm = [];
                    $selectedComm = [];

                    foreach ($allCommStore as $slugKey => $cItem) {
                      $cData = [
                        'slug' => $slugKey,
                        'name' => $cItem['name'] ?? ucfirst(str_replace('-', ' ', $slugKey)),
                        'city' => $cItem['city'] ?? 'Dubai',
                        'image' => !empty($cItem['hero_img']) ? $cItem['hero_img'] : (!empty($cItem['media_image']) ? $cItem['media_image'] : 'images/the valley.png'),
                      ];
                      if (in_array($slugKey, $selectedCommSlugs)) {
                        $selectedComm[] = $cData;
                      } else {
                        $availableComm[] = $cData;
                      }
                    }
                  @endphp

                  <div class="pt-5 border-t border-slate-100 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2">
                      <div>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Popular Communities Assignment</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Drag communities from <strong>Column A</strong> into <strong>Column S</strong> to show on the Home Page carousel.</p>
                      </div>
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
                        Drag &amp; Drop Active
                      </span>
                    </div>

                    {{-- 2 Columns Grid: Column A & Column S --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start font-inter">
                      
                      {{-- COLUMN A: ALL COMMUNITIES --}}
                      <div class="bg-[#FAF8F5] rounded-[18px] border-2 border-dashed border-slate-200 p-4">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#0E3B2C] text-white text-xs font-bold flex items-center justify-center">A</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700">Column A (All Communities)</h4>
                          </div>
                          <span id="col-comm-a-count" class="text-[11px] font-semibold text-slate-400 bg-white px-2.5 py-0.5 rounded-full border border-slate-200">
                            {{ count($availableComm) }} items
                          </span>
                        </div>

                        {{-- Dropzone A --}}
                        <div 
                          id="dropzone-comm-a" 
                          class="min-h-[280px] space-y-2.5 p-1 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropComm(event, 'a')"
                        >
                          @foreach($availableComm as $item)
                            <div 
                              id="comm-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragComm(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="comm-drag-card bg-white border border-slate-200 hover:border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[11px] text-slate-400 truncate">{{ $item['city'] }}</p>
                                </div>
                              </div>
                              <span class="text-slate-400 hover:text-slate-600 text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                      {{-- COLUMN S: SELECTED POPULAR COMMUNITIES --}}
                      <div class="bg-white rounded-[18px] border-2 border-[#C5A47E]/40 p-4 shadow-xs">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#C5A47E] text-white text-xs font-bold flex items-center justify-center">S</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Column S (Show On Home Page)</h4>
                          </div>
                          <span id="col-comm-s-count" class="text-[11px] font-bold text-[#0E3B2C] bg-[#FAF8F5] px-2.5 py-0.5 rounded-full border border-[#C5A47E]/30">
                            {{ count($selectedComm) }} assigned
                          </span>
                        </div>

                        {{-- Dropzone S --}}
                        <div 
                          id="dropzone-comm-s" 
                          class="min-h-[280px] space-y-2.5 p-1 rounded-xl bg-slate-50/50 border border-dashed border-slate-200 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropComm(event, 's')"
                        >
                          @foreach($selectedComm as $item)
                            <div 
                              id="comm-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragComm(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="comm-drag-card bg-white border border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[11px] text-emerald-600 font-semibold truncate">Active on Home</p>
                                </div>
                              </div>
                              <span class="text-[#C5A47E] text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                    </div>

                    {{-- Hidden inputs for Column S --}}
                    <div id="selected-comm-inputs">
                      @foreach($selectedComm as $item)
                        <input type="hidden" name="selected_communities[]" value="{{ $item['slug'] }}" id="input-comm-{{ $item['slug'] }}">
                      @endforeach
                    </div>

                  </div>
                @endif

                {{-- Two-Column Drag & Drop for Explore Property Listings (Offplan & Listing Projects: Column A -> Column S) --}}
                @if($sec->key === 'home_listings' || ($sec->type === 'listings' && !str_contains($sec->key, 'projects_listings')))
                  {{-- Two-Column Drag & Drop for View New Projects in Dubai (Off-Plan Projects Carousel: Column A -> Column S) --}}
                @if($sec->key === 'villas_rows' || $sec->type === 'listing_rows')
                  @php
                    $allOffplanList = \App\Http\Controllers\Admin\EntityController::getAvailableOffplanProjects();
                    $selectedOffplanSlugs = $c['assigned_offplan_projects'] ?? [
                      'golf-vale-emaar-south',
                      'the-fairway-villa',
                      'maple-row-villa',
                      'nara-townhouse'
                    ];

                    $availableOffplans = [];
                    $selectedOffplans = [];

                    foreach ($allOffplanList as $op) {
                      $opData = [
                        'slug' => $op['slug'],
                        'name' => $op['name'],
                        'developer' => $op['developer'] ?? 'Binghatti',
                        'location' => $op['location'] ?? 'Dubai',
                        'price' => $op['price'] ?? 'Launch Price AED 1.7M',
                        'image' => $op['image'] ?? 'images/project-binghatti-1.jpg',
                        'badge' => 'Under Construction',
                      ];

                      if (in_array($op['slug'], $selectedOffplanSlugs)) {
                        $selectedOffplans[] = $opData;
                      } else {
                        $availableOffplans[] = $opData;
                      }
                    }
                  @endphp

                  <div class="pt-5 border-t border-slate-100 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2">
                      <div>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">View New Projects in Dubai (Off-Plan Carousel)</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Drag projects from <strong>Column A (All Offplan Projects)</strong> into <strong>Column S</strong> to show in the "View New Projects in Dubai" carousel.</p>
                      </div>
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
                        Drag &amp; Drop Active
                      </span>
                    </div>

                    {{-- 2 Columns Grid: Column A & Column S --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start font-inter">
                      
                      {{-- COLUMN A: ALL OFFPLAN PROJECTS --}}
                      <div class="bg-[#FAF8F5] rounded-[18px] border-2 border-dashed border-slate-200 p-4">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#0E3B2C] text-white text-xs font-bold flex items-center justify-center">A</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700">Column A (All Offplan Projects)</h4>
                          </div>
                          <span id="col-offplan-a-count" class="text-[11px] font-semibold text-slate-400 bg-white px-2.5 py-0.5 rounded-full border border-slate-200">
                            {{ count($availableOffplans) }} items
                          </span>
                        </div>

                        {{-- Dropzone A --}}
                        <div 
                          id="dropzone-offplan-a" 
                          class="min-h-[300px] space-y-2.5 p-1 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropOffplan(event, 'a')"
                        >
                          @foreach($availableOffplans as $item)
                            <div 
                              id="offplan-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragOffplan(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="offplan-drag-card bg-white border border-slate-200 hover:border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[10px] text-slate-400 truncate">{{ $item['location'] }} &bull; {{ $item['price'] }}</p>
                                </div>
                              </div>
                              <span class="text-slate-400 hover:text-slate-600 text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                      {{-- COLUMN S: SELECTED OFFPLAN PROJECTS --}}
                      <div class="bg-white rounded-[18px] border-2 border-[#C5A47E]/40 p-4 shadow-xs">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#C5A47E] text-white text-xs font-bold flex items-center justify-center">S</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Column S (Show in Carousel)</h4>
                          </div>
                          <span id="col-offplan-s-count" class="text-[11px] font-bold text-[#0E3B2C] bg-[#FAF8F5] px-2.5 py-0.5 rounded-full border border-[#C5A47E]/30">
                            {{ count($selectedOffplans) }} assigned
                          </span>
                        </div>

                        {{-- Dropzone S --}}
                        <div 
                          id="dropzone-offplan-s" 
                          class="min-h-[300px] space-y-2.5 p-1 rounded-xl bg-slate-50/50 border border-dashed border-slate-200 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropOffplan(event, 's')"
                        >
                          @foreach($selectedOffplans as $item)
                            <div 
                              id="offplan-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragOffplan(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="offplan-drag-card bg-white border border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[10px] text-emerald-600 font-semibold truncate">{{ $item['badge'] }} &bull; Active in Carousel</p>
                                </div>
                              </div>
                              <span class="text-[#C5A47E] text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                    </div>

                    {{-- Hidden inputs for Column S --}}
                    <div id="selected-offplan-inputs">
                      @foreach($selectedOffplans as $item)
                        <input type="hidden" name="selected_offplan_projects[]" value="{{ $item['slug'] }}" id="input-offplan-{{ $item['slug'] }}">
                      @endforeach
                    </div>

                  </div>
                @endif

                @php
                    $allOffplanList = \App\Http\Controllers\Admin\EntityController::getAvailableOffplanProjects();
                    $allReadyList = \App\Http\Controllers\Admin\EntityController::getAvailableReadyProjects();
                    $selectedPropSlugs = $c['assigned_listings'] ?? ['the-fairway-villa', 'maple-row-villa', 'nara-townhouse'];

                    $allCombinedProps = [];
                    foreach ($allReadyList as $rp) {
                      $allCombinedProps[$rp['slug']] = [
                        'slug' => $rp['slug'],
                        'name' => $rp['name'],
                        'type' => 'Ready / Listing',
                        'location' => $rp['location'] ?? 'Dubai',
                        'price' => $rp['price'] ?? '',
                        'image' => $rp['image'] ?? 'images/villa-modern.jpg',
                      ];
                    }
                    foreach ($allOffplanList as $op) {
                      if (!isset($allCombinedProps[$op['slug']])) {
                        $allCombinedProps[$op['slug']] = [
                          'slug' => $op['slug'],
                          'name' => $op['name'],
                          'type' => 'Off-Plan',
                          'location' => $op['location'] ?? 'Dubai',
                          'price' => $op['price'] ?? '',
                          'image' => $op['image'] ?? 'images/golf-vale-main.jpg',
                        ];
                      }
                    }

                    $availableProps = [];
                    $selectedProps = [];

                    foreach ($allCombinedProps as $slugKey => $pItem) {
                      if (in_array($slugKey, $selectedPropSlugs)) {
                        $selectedProps[] = $pItem;
                      } else {
                        $availableProps[] = $pItem;
                      }
                    }
                  @endphp

                  <div class="pt-5 border-t border-slate-100 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2">
                      <div>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Property Listings Assignment</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Drag properties from <strong>Column A (Offplan &amp; Ready Listings)</strong> into <strong>Column S (Show On Section)</strong>.</p>
                      </div>
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
                        Drag &amp; Drop Active
                      </span>
                    </div>

                    {{-- 2 Columns Grid: Column A & Column S --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start font-inter">
                      
                      {{-- COLUMN A: ALL PROPERTIES --}}
                      <div class="bg-[#FAF8F5] rounded-[18px] border-2 border-dashed border-slate-200 p-4">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#0E3B2C] text-white text-xs font-bold flex items-center justify-center">A</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700">Column A (Available Properties)</h4>
                          </div>
                          <span id="col-prop-a-count" class="text-[11px] font-semibold text-slate-400 bg-white px-2.5 py-0.5 rounded-full border border-slate-200">
                            {{ count($availableProps) }} items
                          </span>
                        </div>

                        {{-- Dropzone A --}}
                        <div 
                          id="dropzone-prop-a" 
                          class="min-h-[300px] space-y-2.5 p-1 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropProp(event, 'a')"
                        >
                          @foreach($availableProps as $item)
                            <div 
                              id="prop-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragProp(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="prop-drag-card bg-white border border-slate-200 hover:border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[10px] text-slate-400 truncate">{{ $item['type'] }} &bull; {{ $item['price'] }}</p>
                                </div>
                              </div>
                              <span class="text-slate-400 hover:text-slate-600 text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                      {{-- COLUMN S: SELECTED PROPERTIES --}}
                      <div class="bg-white rounded-[18px] border-2 border-[#C5A47E]/40 p-4 shadow-xs">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#C5A47E] text-white text-xs font-bold flex items-center justify-center">S</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Column S (Show On Home Page)</h4>
                          </div>
                          <span id="col-prop-s-count" class="text-[11px] font-bold text-[#0E3B2C] bg-[#FAF8F5] px-2.5 py-0.5 rounded-full border border-[#C5A47E]/30">
                            {{ count($selectedProps) }} assigned
                          </span>
                        </div>

                        {{-- Dropzone S --}}
                        <div 
                          id="dropzone-prop-s" 
                          class="min-h-[300px] space-y-2.5 p-1 rounded-xl bg-slate-50/50 border border-dashed border-slate-200 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropProp(event, 's')"
                        >
                          @foreach($selectedProps as $item)
                            <div 
                              id="prop-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragProp(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="prop-drag-card bg-white border border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[10px] text-emerald-600 font-semibold truncate">{{ $item['type'] }} &bull; Active</p>
                                </div>
                              </div>
                              <span class="text-[#C5A47E] text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                    </div>

                    {{-- Hidden inputs for Column S --}}
                    <div id="selected-prop-inputs">
                      @foreach($selectedProps as $item)
                        <input type="hidden" name="selected_listings[]" value="{{ $item['slug'] }}" id="input-prop-{{ $item['slug'] }}">
                      @endforeach
                    </div>

                  </div>
                @endif

                {{-- Two-Column Drag & Drop for View New Projects in Dubai (Off-Plan Projects Carousel: Column A -> Column S) --}}
                @if($sec->key === 'villas_rows' || $sec->type === 'listing_rows')
                  @php
                    $allOffplanList = \App\Http\Controllers\Admin\EntityController::getAvailableOffplanProjects();
                    $selectedOffplanSlugs = $c['assigned_offplan_projects'] ?? [
                      'golf-vale-emaar-south',
                      'the-fairway-villa',
                      'maple-row-villa',
                      'nara-townhouse'
                    ];

                    $availableOffplans = [];
                    $selectedOffplans = [];

                    foreach ($allOffplanList as $op) {
                      $opData = [
                        'slug' => $op['slug'],
                        'name' => $op['name'],
                        'developer' => $op['developer'] ?? 'Binghatti',
                        'location' => $op['location'] ?? 'Dubai',
                        'price' => $op['price'] ?? 'Launch Price AED 1.7M',
                        'image' => $op['image'] ?? 'images/project-binghatti-1.jpg',
                        'badge' => 'Under Construction',
                      ];

                      if (in_array($op['slug'], $selectedOffplanSlugs)) {
                        $selectedOffplans[] = $opData;
                      } else {
                        $availableOffplans[] = $opData;
                      }
                    }
                  @endphp

                  <div class="pt-5 border-t border-slate-100 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2">
                      <div>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">View New Projects in Dubai (Off-Plan Carousel)</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Drag projects from <strong>Column A (All Offplan Projects)</strong> into <strong>Column S</strong> to show in the "View New Projects in Dubai" carousel.</p>
                      </div>
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
                        Drag &amp; Drop Active
                      </span>
                    </div>

                    {{-- 2 Columns Grid: Column A & Column S --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start font-inter">
                      
                      {{-- COLUMN A: ALL OFFPLAN PROJECTS --}}
                      <div class="bg-[#FAF8F5] rounded-[18px] border-2 border-dashed border-slate-200 p-4">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#0E3B2C] text-white text-xs font-bold flex items-center justify-center">A</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700">Column A (All Offplan Projects)</h4>
                          </div>
                          <span id="col-offplan-a-count" class="text-[11px] font-semibold text-slate-400 bg-white px-2.5 py-0.5 rounded-full border border-slate-200">
                            {{ count($availableOffplans) }} items
                          </span>
                        </div>

                        {{-- Dropzone A --}}
                        <div 
                          id="dropzone-offplan-a" 
                          class="min-h-[300px] space-y-2.5 p-1 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropOffplan(event, 'a')"
                        >
                          @foreach($availableOffplans as $item)
                            <div 
                              id="offplan-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragOffplan(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="offplan-drag-card bg-white border border-slate-200 hover:border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[10px] text-slate-400 truncate">{{ $item['location'] }} &bull; {{ $item['price'] }}</p>
                                </div>
                              </div>
                              <span class="text-slate-400 hover:text-slate-600 text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                      {{-- COLUMN S: SELECTED OFFPLAN PROJECTS --}}
                      <div class="bg-white rounded-[18px] border-2 border-[#C5A47E]/40 p-4 shadow-xs">
                        <div class="flex items-center justify-between mb-3">
                          <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#C5A47E] text-white text-xs font-bold flex items-center justify-center">S</span>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Column S (Show in Carousel)</h4>
                          </div>
                          <span id="col-offplan-s-count" class="text-[11px] font-bold text-[#0E3B2C] bg-[#FAF8F5] px-2.5 py-0.5 rounded-full border border-[#C5A47E]/30">
                            {{ count($selectedOffplans) }} assigned
                          </span>
                        </div>

                        {{-- Dropzone S --}}
                        <div 
                          id="dropzone-offplan-s" 
                          class="min-h-[300px] space-y-2.5 p-1 rounded-xl bg-slate-50/50 border border-dashed border-slate-200 transition-colors"
                          ondragover="allowDrop(event)" 
                          ondrop="dropOffplan(event, 's')"
                        >
                          @foreach($selectedOffplans as $item)
                            <div 
                              id="offplan-card-{{ $item['slug'] }}" 
                              draggable="true" 
                              ondragstart="dragOffplan(event)" 
                              data-slug="{{ $item['slug'] }}"
                              class="offplan-drag-card bg-white border border-[#C5A47E] rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                            >
                              <div class="flex items-center gap-3 min-w-0">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                  <p class="font-bold text-xs text-slate-800 truncate">{{ $item['name'] }}</p>
                                  <p class="text-[10px] text-emerald-600 font-semibold truncate">{{ $item['badge'] }} &bull; Active in Carousel</p>
                                </div>
                              </div>
                              <span class="text-[#C5A47E] text-xs shrink-0 cursor-grab">⋮⋮</span>
                            </div>
                          @endforeach
                        </div>
                      </div>

                    </div>

                    {{-- Hidden inputs for Column S --}}
                    <div id="selected-offplan-inputs">
                      @foreach($selectedOffplans as $item)
                        <input type="hidden" name="selected_offplan_projects[]" value="{{ $item['slug'] }}" id="input-offplan-{{ $item['slug'] }}">
                      @endforeach
                    </div>

                  </div>
                @endif

                @php
                  $scalars = \App\Http\Controllers\Admin\SectionController::SCALARS;
                  $advanced = $c;
                  foreach ($scalars as $k) unset($advanced[$k]);
                  if ($sec->type === 'cards_3col') unset($advanced['items']);
                @endphp
                @if(!empty($advanced))
                  <input type="hidden" name="content_json" value="{{ json_encode($advanced, JSON_UNESCAPED_SLASHES) }}">
                @endif

              </div>

              {{-- Save Button --}}
              <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
                <button type="submit" class="px-6 py-3 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors cursor-pointer">
                  Save Changes to {{ $sec->name }}
                </button>
                
                <a href="{{ $page->url() }}" target="_blank" class="text-xs font-semibold text-blue-600 hover:underline">
                  View Live Page ↗
                </a>
              </div>
            </form>
          </div>
        @endforeach
      @endif

    </div>

  </div>

</div>

{{-- Scripts for Side Tabs, Live Image Preview & Module Drag & Drop --}}
<script>
  function attachSection(sectionId) {
    const form = document.getElementById('dnd-attach-form');
    const input = document.getElementById('dnd-section-id');
    if (form && input) {
      input.value = sectionId;
      form.submit();
    }
  }

  function switchToSectionTab(tabId) {
    const tabBtn = document.querySelector(`.page-nav-tab[data-page-tab="${tabId}"]`);
    if (tabBtn) {
      tabBtn.click();
    }
  }

  function previewUploadedImage(input, targetImgId) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const targetImg = document.getElementById(targetImgId);
        if (targetImg) {
          targetImg.src = e.target.result;
        }
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  // Drag and Drop Logic for Popular Communities (Column A <-> Column S)
  function allowDrop(ev) {
    ev.preventDefault();
  }

  function dragComm(ev) {
    ev.dataTransfer.setData("text/plain", ev.currentTarget.id);
  }

  function dropComm(ev, zone) {
    ev.preventDefault();
    const id = ev.dataTransfer.getData("text/plain");
    const draggedEl = document.getElementById(id);
    if (!draggedEl) return;

    const targetZone = zone === 's' ? document.getElementById('dropzone-comm-s') : document.getElementById('dropzone-comm-a');
    if (!targetZone) return;

    targetZone.appendChild(draggedEl);

    if (zone === 's') {
      draggedEl.classList.remove('border-slate-200');
      draggedEl.classList.add('border-[#C5A47E]');
      const tag = draggedEl.querySelector('p:last-child');
      if (tag) {
        tag.className = 'text-[11px] text-emerald-600 font-semibold truncate';
        tag.textContent = 'Active on Home';
      }
    } else {
      draggedEl.classList.remove('border-[#C5A47E]');
      draggedEl.classList.add('border-slate-200');
      const tag = draggedEl.querySelector('p:last-child');
      if (tag) {
        tag.className = 'text-[11px] text-slate-400 truncate';
        tag.textContent = 'Dubai';
      }
    }

    syncSelectedCommunities();
  }

  function syncSelectedCommunities() {
    const sZone = document.getElementById('dropzone-comm-s');
    const aZone = document.getElementById('dropzone-comm-a');
    const inputsContainer = document.getElementById('selected-comm-inputs');
    const sCount = document.getElementById('col-comm-s-count');
    const aCount = document.getElementById('col-comm-a-count');

    if (!sZone || !inputsContainer) return;

    inputsContainer.innerHTML = '';
    const sCards = sZone.querySelectorAll('.comm-drag-card');
    sCards.forEach(card => {
      const slug = card.getAttribute('data-slug');
      if (slug) {
        const inp = document.createElement('input');
        inp.type = 'hidden';
        inp.name = 'selected_communities[]';
        inp.value = slug;
        inputsContainer.appendChild(inp);
      }
    });

    if (sCount) sCount.textContent = sCards.length + ' assigned';
    if (aCount && aZone) aCount.textContent = aZone.querySelectorAll('.comm-drag-card').length + ' items';
  }

  // Drag and Drop Logic for Property Listings (Column A <-> Column S)
  function dragProp(ev) {
    ev.dataTransfer.setData("text/plain", ev.currentTarget.id);
  }

  function dropProp(ev, zone) {
    ev.preventDefault();
    const id = ev.dataTransfer.getData("text/plain");
    const draggedEl = document.getElementById(id);
    if (!draggedEl) return;

    const targetZone = zone === 's' ? document.getElementById('dropzone-prop-s') : document.getElementById('dropzone-prop-a');
    if (!targetZone) return;

    targetZone.appendChild(draggedEl);

    if (zone === 's') {
      draggedEl.classList.remove('border-slate-200');
      draggedEl.classList.add('border-[#C5A47E]');
      const tag = draggedEl.querySelector('p:last-child');
      if (tag) {
        tag.className = 'text-[10px] text-emerald-600 font-semibold truncate';
        tag.textContent = 'Active on Home';
      }
    } else {
      draggedEl.classList.remove('border-[#C5A47E]');
      draggedEl.classList.add('border-slate-200');
      const tag = draggedEl.querySelector('p:last-child');
      if (tag) {
        tag.className = 'text-[10px] text-slate-400 truncate';
        tag.textContent = 'Dubai Property';
      }
    }

    syncSelectedProperties();
  }

  function syncSelectedProperties() {
    const sZone = document.getElementById('dropzone-prop-s');
    const aZone = document.getElementById('dropzone-prop-a');
    const inputsContainer = document.getElementById('selected-prop-inputs');
    const sCount = document.getElementById('col-prop-s-count');
    const aCount = document.getElementById('col-prop-a-count');

    if (!sZone || !inputsContainer) return;

    inputsContainer.innerHTML = '';
    const sCards = sZone.querySelectorAll('.prop-drag-card');
    sCards.forEach(card => {
      const slug = card.getAttribute('data-slug');
      if (slug) {
        const inp = document.createElement('input');
        inp.type = 'hidden';
        inp.name = 'selected_listings[]';
        inp.value = slug;
        inputsContainer.appendChild(inp);
      }
    });

    if (sCount) sCount.textContent = sCards.length + ' assigned';
    if (aCount && aZone) aCount.textContent = aZone.querySelectorAll('.prop-drag-card').length + ' items';
  }

  function addFaqRow(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    const count = container.querySelectorAll('.faq-row').length;
    const newIdx = count > 0 ? Date.now() : 0;
    const num = count + 1;

    const row = document.createElement('div');
    row.className = 'faq-row bg-[#FAF8F5] border border-slate-200 rounded-2xl p-4.5 space-y-3 relative group transition-all hover:border-[#C5A47E]/60';
    row.innerHTML = `
      <div class="flex items-center justify-between">
        <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Question #<span class="faq-num">${num}</span></span>
        <button 
          type="button" 
          onclick="removeFaqRow(this)" 
          class="text-xs font-semibold text-rose-500 hover:text-rose-700 transition-colors flex items-center gap-1 cursor-pointer"
        >
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
          <span>Delete</span>
        </button>
      </div>

      <div>
        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Question</label>
        <input 
          type="text" 
          name="faqs[${newIdx}][q]" 
          placeholder="e.g. What is the booking process?" 
          class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] font-medium text-slate-800 focus:outline-none focus:border-[#C5A47E]"
        >
      </div>

      <div>
        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Answer</label>
        <textarea 
          name="faqs[${newIdx}][a]" 
          rows="3" 
          placeholder="Type the detailed answer here..." 
          class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E] leading-relaxed"
        ></textarea>
      </div>
    `;
    container.appendChild(row);
  }

  function removeFaqRow(btn) {
    const row = btn.closest('.faq-row');
    if (!row) return;
    const container = row.parentElement;
    row.remove();
    if (container) {
      container.querySelectorAll('.faq-row').forEach((r, idx) => {
        const numSpan = r.querySelector('.faq-num');
        if (numSpan) numSpan.textContent = idx + 1;
      });
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    // Initialize Summernote WYSIWYG Editors
    if (typeof $ !== 'undefined' && $.fn.summernote) {
      $('.summernote-editor').summernote({
        height: 280,
        placeholder: 'Write formatted content here...',
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview']]
        ]
      });
    }

    // Tab switching
    const tabButtons = document.querySelectorAll('.page-nav-tab');
    const tabPanels = document.querySelectorAll('.page-tab-content');

    tabButtons.forEach(btn => {
      btn.addEventListener('click', function() {
        const target = this.getAttribute('data-page-tab');

        tabButtons.forEach(b => {
          b.classList.remove('bg-[#F2ECE3]', 'text-[#10221C]', 'border-l-4', 'border-[#C5A47E]', 'font-bold');
          b.classList.add('text-slate-600', 'hover:bg-slate-50');
        });

        this.classList.add('bg-[#F2ECE3]', 'text-[#10221C]', 'border-l-4', 'border-[#C5A47E]', 'font-bold');
        this.classList.remove('text-slate-600', 'hover:bg-slate-50');

        tabPanels.forEach(p => {
          if (p.getAttribute('data-tab-panel') === target) {
            p.classList.remove('hidden');
          } else {
            p.classList.add('hidden');
          }
        });
      });
    });

    // Drag and Drop & Module Filtering
    const draggables = document.querySelectorAll('.draggable-module-card[draggable="true"]');
    const dropzone = document.getElementById('page-dropzone');
    const searchInput = document.getElementById('search-modules-input');

    draggables.forEach(card => {
      card.addEventListener('dragstart', function(e) {
        e.dataTransfer.setData('text/plain', this.getAttribute('data-section-id'));
        this.classList.add('opacity-40');
      });

      card.addEventListener('dragend', function() {
        this.classList.remove('opacity-40');
      });
    });

    if (dropzone) {
      dropzone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropzone.classList.add('border-[#C5A47E]', 'bg-[#FAF8F5]');
      });

      dropzone.addEventListener('dragleave', function() {
        dropzone.classList.remove('border-[#C5A47E]', 'bg-[#FAF8F5]');
      });

      dropzone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropzone.classList.remove('border-[#C5A47E]', 'bg-[#FAF8F5]');
        const sectionId = e.dataTransfer.getData('text/plain');
        if (sectionId) {
          attachSection(sectionId);
        }
      });
    }

    if (searchInput) {
      searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.draggable-module-card');
        cards.forEach(card => {
          const name = card.getAttribute('data-module-name') || '';
          if (name.includes(query)) {
            card.classList.remove('hidden');
          } else {
            card.classList.add('hidden');
          }
        });
      });
    }
  });
</script>
@endsection
