@extends('layouts.admin')

@section('content')
<div class="space-y-6 font-inter">

  {{-- Top Page Bar --}}
  <div class="bg-white rounded-[16px] border border-slate-100 p-5 sm:p-6 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="font-heading font-medium text-2xl sm:text-[26px] text-[#10221C] tracking-tight">
        {{ $page->exists ? 'Update ' . $page->title : 'Create New Page' }}
      </h1>
      @if($page->exists)
        <p class="text-xs text-slate-400 mt-1">
          Page URL: <a href="{{ $page->url() }}" target="_blank" class="text-blue-600 hover:underline font-medium">{{ url($page->path ?: '/') }}</a>
        </p>
      @endif
    </div>

    <div class="flex items-center gap-3 shrink-0">
      @if($page->exists)
        <a 
          href="{{ $page->url() }}" 
          target="_blank" 
          class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-full bg-[#10221C] hover:bg-[#0E3B2C] text-white text-xs font-semibold shadow-xs transition-colors"
        >
          <span>Preview Live Page ↗</span>
        </a>
      @endif

      <a 
        href="{{ route('admin.pages.index') }}" 
        class="px-4 py-2.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors"
      >
        Back
      </a>
    </div>
  </div>

  {{-- Main 12-Col Grid: Left Sidebar Tabs (3 Cols) + Right Content Panel (9 Cols) --}}
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
    
    {{-- Left Navigation Tabs --}}
    <aside class="lg:col-span-3 bg-white rounded-[16px] border border-slate-100 p-3 shadow-xs sticky top-24">
      <div class="space-y-1">
        
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
            @if($sec->type === 'search_filter' || str_contains($sec->key, 'search') || in_array($sec->key, $staticSectionKeys) || $sec->key === 'blog_articles' || $sec->type === 'article_grid')
              @continue
            @endif

            @if($sec->type === 'listing_detail' || $sec->key === 'listing_detail')
              {{-- Split Buy Listing Details into 2 dedicated tabs: 1) Gallery, 2) USPs --}}
              @php $secTabCounter++; @endphp
              <button 
                type="button" 
                data-page-tab="sec_{{ $sec->id }}_gallery"
                class="page-nav-tab w-full text-left px-4 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer text-slate-600 hover:bg-slate-50 flex items-center justify-between group"
              >
                <span class="truncate">Gallery</span>
                <span class="text-[10px] font-mono text-neutral-400 group-hover:text-[#C5A47E] ml-1 shrink-0">#{{ $secTabCounter }}</span>
              </button>

              @php $secTabCounter++; @endphp
              <button 
                type="button" 
                data-page-tab="sec_{{ $sec->id }}_usps"
                class="page-nav-tab w-full text-left px-4 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer text-slate-600 hover:bg-slate-50 flex items-center justify-between group"
              >
                <span class="truncate">USPs</span>
                <span class="text-[10px] font-mono text-neutral-400 group-hover:text-[#C5A47E] ml-1 shrink-0">#{{ $secTabCounter }}</span>
              </button>

              @php $secTabCounter++; @endphp
              <button 
                type="button" 
                data-page-tab="sec_{{ $sec->id }}_amenities"
                class="page-nav-tab w-full text-left px-4 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer text-slate-600 hover:bg-slate-50 flex items-center justify-between group"
              >
                <span class="truncate">Amenities</span>
                <span class="text-[10px] font-mono text-neutral-400 group-hover:text-[#C5A47E] ml-1 shrink-0">#{{ $secTabCounter }}</span>
              </button>

              @php $secTabCounter++; @endphp
              <button 
                type="button" 
                data-page-tab="sec_{{ $sec->id }}_location"
                class="page-nav-tab w-full text-left px-4 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer text-slate-600 hover:bg-slate-50 flex items-center justify-between group"
              >
                <span class="truncate">Location</span>
                <span class="text-[10px] font-mono text-neutral-400 group-hover:text-[#C5A47E] ml-1 shrink-0">#{{ $secTabCounter }}</span>
              </button>

              @php $secTabCounter++; @endphp
              <button 
                type="button" 
                data-page-tab="sec_{{ $sec->id }}_similar"
                class="page-nav-tab w-full text-left px-4 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer text-slate-600 hover:bg-slate-50 flex items-center justify-between group"
              >
                <span class="truncate">Similar Projects</span>
                <span class="text-[10px] font-mono text-neutral-400 group-hover:text-[#C5A47E] ml-1 shrink-0">#{{ $secTabCounter }}</span>
              </button>
            @else
              @php
                $secTabCounter++;
                $cleanSecTabName = preg_replace('/^(Home|About|Blog|Communities|Enquiry|AI Assessment|Projects|Villas|Listing)\s*[—–-]\s*/iu', '', $sec->name);
              @endphp
              <button 
                type="button" 
                data-page-tab="sec_{{ $sec->id }}"
                class="page-nav-tab w-full text-left px-4 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer text-slate-600 hover:bg-slate-50 flex items-center justify-between group"
              >
                <span class="truncate">{{ $cleanSecTabName }}</span>
                <span class="text-[10px] font-mono text-neutral-400 group-hover:text-[#C5A47E] ml-1 shrink-0">#{{ $secTabCounter }}</span>
              </button>
            @endif
          @endforeach
        @endif

        {{-- Global Modules Tab at the end of all pages --}}
        <div class="pt-2 border-t border-slate-100 mt-2">
          <button
            type="button"
            data-page-tab="global_modules"
            class="page-nav-tab w-full text-left px-4 py-3 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer text-[#0E3B2C] hover:bg-[#FAF8F5] flex items-center justify-between"
          >
            <span>Global Modules</span>
            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-[#F2ECE3] text-[#C5A47E]">+ Call</span>
          </button>
        </div>

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

        <form id="page-settings-form" action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" method="POST">
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
                        onclick="switchToSectionTab('{{ ($s->type === 'listing_detail' || $s->key === 'listing_detail') ? 'sec_' . $s->id . '_gallery' : 'sec_' . $s->id }}')" 
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

            @if($page->exists)
            <form id="dnd-attach-form" action="{{ route('admin.pages.attach', $page) }}" method="POST" class="hidden">
              @csrf
              <input type="hidden" name="section_id" id="dnd-section-id">
            </form>
            @endif
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
          @if($sec->type === 'search_filter' || str_contains($sec->key, 'search') || in_array($sec->key, $staticSectionKeys ?? []) || $sec->key === 'blog_articles' || $sec->type === 'article_grid')
            @continue
          @endif
          @php 
            $c = $sec->c(); 
          @endphp

          @if($sec->type === 'listing_detail' || $sec->key === 'listing_detail')
            @php
              $gMain = !empty($c['gallery_main']) ? $c['gallery_main'] : (!empty($c['gallery'][0]) && $c['gallery'][0] !== 'images/buy-gallery-main.jpg' ? $c['gallery'][0] : 'images/dubai-marina.jpg');
              $gTopRight = !empty($c['gallery_top_right']) ? $c['gallery_top_right'] : (!empty($c['gallery'][1]) && $c['gallery'][1] !== 'images/buy-gallery-top-right.jpg' ? $c['gallery'][1] : 'images/house-white.jpg');
              $gBottomRight = !empty($c['gallery_bottom_right']) ? $c['gallery_bottom_right'] : (!empty($c['gallery'][2]) && $c['gallery'][2] !== 'images/buy-gallery-bottom-right.jpg' ? $c['gallery'][2] : 'images/family-park.jpg');

              if (!empty($c['usps']) && is_array($c['usps'])) {
                $uspItems = array_values(array_filter($c['usps']));
              } elseif (!empty($c['heading_html'])) {
                $rawHeading = strip_tags(html_entity_decode($c['heading_html'], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                $uspItems = array_values(array_filter(array_map('trim', explode('|', $rawHeading))));
              } else {
                $uspItems = ['The Valley', 'Prime Location', 'District Deal'];
              }
              if (empty($uspItems)) {
                $uspItems = ['The Valley', 'Prime Location', 'District Deal'];
              }

              $defaultOverview = "Engel & Voelkers is proud to present a rare opportunity to acquire a Garden Hall Villa in the prestigious Jumeirah Islands community.\n\nThis vacant property is situated on a 10,643 plot, offering enhanced privacy and stunning views of the lake. The villa features four generously sized bedrooms, a separate study room, a maid's room with private access, and three spacious living areas, providing ample space for family living and entertaining.\n\n- Garden Hall\n- 4 Bedrooms + Maid's";
            @endphp

            {{-- TAB A: GALLERY --}}
            <div data-tab-panel="sec_{{ $sec->id }}_gallery" class="page-tab-content space-y-6 hidden">
              <div class="border-b border-neutral-100 pb-4 flex items-center justify-between">
                <div>
                  <h2 class="font-heading font-medium text-xl text-[#10221C]">Gallery — Top Property Photos</h2>
                  <p class="text-xs text-slate-400 mt-0.5">Upload high-resolution pictures shown in the first section of the Buy Listing Details page.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
                  3 Gallery Slots
                </span>
              </div>

              <form action="{{ route('admin.sections.update', $sec) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="name" value="{{ $sec->name }}">
                <input type="hidden" name="key" value="{{ $sec->key }}">
                <input type="hidden" name="type" value="{{ $sec->type }}">
                <input type="hidden" name="status" value="{{ $sec->status }}">
                <input type="hidden" name="is_global" value="1">

                <div class="space-y-6">
                  {{-- 1. Large Left Hero Photo --}}
                  <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-5 space-y-3">
                    <div class="flex items-center justify-between">
                      <span class="text-xs font-bold text-slate-800 uppercase tracking-wider">1. Main Large Left Photo (Waterfront / Exterior)</span>
                      <span class="text-[11px] text-[#C5A47E] font-semibold">Primary Col-8 Image</span>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-5 bg-white p-4 rounded-xl border border-slate-200">
                      <div class="w-full sm:w-56 h-36 rounded-xl bg-slate-100 overflow-hidden border border-slate-200 shrink-0">
                        <img 
                          id="preview-gal-main-{{ $sec->id }}"
                          src="{{ asset($gMain) }}" 
                          alt="Main Gallery Image" 
                          class="w-full h-full object-cover"
                        >
                      </div>

                      <div class="flex-1 w-full space-y-2.5">
                        <div class="flex items-center justify-between">
                          <span class="text-xs font-medium text-slate-600">Select high-res image from laptop</span>
                          <label class="px-4 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs cursor-pointer transition-colors">
                            <span>Browse</span>
                            <input 
                              type="file" 
                              name="gallery_main_file" 
                              accept="image/*" 
                              class="hidden"
                              onchange="previewUploadedImage(this, 'preview-gal-main-{{ $sec->id }}')"
                            >
                          </label>
                        </div>
                        <input 
                          type="text" 
                          name="content_gallery_main" 
                          value="{{ $gMain }}" 
                          placeholder="images/dubai-marina.jpg"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-600 font-mono focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    </div>
                  </div>

                  {{-- 2 & 3. Right Stacked Photos --}}
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    {{-- 2. Top Right Image --}}
                    <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-5 space-y-3">
                      <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-800 uppercase tracking-wider">2. Top Right Photo</span>
                        <span class="text-[10px] text-[#C5A47E] font-semibold">Stacked Top</span>
                      </div>

                      <div class="bg-white p-3.5 rounded-xl border border-slate-200 space-y-3">
                        <div class="w-full h-36 rounded-lg bg-slate-100 overflow-hidden border border-slate-200">
                          <img 
                            id="preview-gal-tr-{{ $sec->id }}"
                            src="{{ asset($gTopRight) }}" 
                            alt="Top Right Gallery Image" 
                            class="w-full h-full object-cover"
                          >
                        </div>

                        <div class="flex items-center justify-between gap-2">
                          <span class="text-[11px] font-medium text-slate-600">Upload photo</span>
                          <label class="px-3.5 py-1.5 rounded-lg bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs cursor-pointer transition-colors">
                            <span>Browse</span>
                            <input 
                              type="file" 
                              name="gallery_top_right_file" 
                              accept="image/*" 
                              class="hidden"
                              onchange="previewUploadedImage(this, 'preview-gal-tr-{{ $sec->id }}')"
                            >
                          </label>
                        </div>

                        <input 
                          type="text" 
                          name="content_gallery_top_right" 
                          value="{{ $gTopRight }}" 
                          placeholder="images/house-white.jpg"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-600 font-mono focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    </div>

                    {{-- 3. Bottom Right Image --}}
                    <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-5 space-y-3">
                      <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-800 uppercase tracking-wider">3. Bottom Right Photo</span>
                        <span class="text-[10px] text-[#C5A47E] font-semibold">Stacked Bottom</span>
                      </div>

                      <div class="bg-white p-3.5 rounded-xl border border-slate-200 space-y-3">
                        <div class="w-full h-36 rounded-lg bg-slate-100 overflow-hidden border border-slate-200">
                          <img 
                            id="preview-gal-br-{{ $sec->id }}"
                            src="{{ asset($gBottomRight) }}" 
                            alt="Bottom Right Gallery Image" 
                            class="w-full h-full object-cover"
                          >
                        </div>

                        <div class="flex items-center justify-between gap-2">
                          <span class="text-[11px] font-medium text-slate-600">Upload photo</span>
                          <label class="px-3.5 py-1.5 rounded-lg bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs cursor-pointer transition-colors">
                            <span>Browse</span>
                            <input 
                              type="file" 
                              name="gallery_bottom_right_file" 
                              accept="image/*" 
                              class="hidden"
                              onchange="previewUploadedImage(this, 'preview-gal-br-{{ $sec->id }}')"
                            >
                          </label>
                        </div>

                        <input 
                          type="text" 
                          name="content_gallery_bottom_right" 
                          value="{{ $gBottomRight }}" 
                          placeholder="images/family-park.jpg"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-600 font-mono focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    </div>

                  </div>
                </div>

                <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
                  <button type="submit" class="px-6 py-3 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors cursor-pointer">
                    Save Gallery Photos
                  </button>
                  <a href="{{ $page->url() }}" target="_blank" class="text-xs font-semibold text-blue-600 hover:underline">
                    View Live Page ↗
                  </a>
                </div>
              </form>
            </div>

            {{-- TAB B: USPs & OVERVIEW --}}
            <div data-tab-panel="sec_{{ $sec->id }}_usps" class="page-tab-content space-y-6 hidden">
              <div class="border-b border-neutral-100 pb-4 flex items-center justify-between">
                <div>
                  <h2 class="font-heading font-medium text-xl text-[#10221C]">USPs, Price &amp; Property Overview</h2>
                  <p class="text-xs text-slate-400 mt-0.5">Manage price, property specs, dynamic USPs ("The Valley | Prime Location | District Deal") and Overview text.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
                  Second Section
                </span>
              </div>

              <form action="{{ route('admin.sections.update', $sec) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="name" value="{{ $sec->name }}">
                <input type="hidden" name="key" value="{{ $sec->key }}">
                <input type="hidden" name="type" value="{{ $sec->type }}">
                <input type="hidden" name="status" value="{{ $sec->status }}">
                <input type="hidden" name="is_global" value="1">

                <div class="space-y-6">
                  
                  {{-- 1. Price & Specs (Beds, Baths, Sq.ft) --}}
                  <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-5 space-y-4">
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">1. Price &amp; Property Specs</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                      <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1.5">Listing Price</label>
                        <input 
                          type="text" 
                          name="content_price" 
                          value="{{ $c['price'] ?? 'AED 2,740,000' }}" 
                          placeholder="AED 2,740,000"
                          class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] font-bold text-[#0E3B2C] focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1.5">Bedrooms</label>
                        <input 
                          type="text" 
                          name="content_beds" 
                          value="{{ $c['beds'] ?? '4' }}" 
                          placeholder="4"
                          class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1.5">Bathrooms</label>
                        <input 
                          type="text" 
                          name="content_baths" 
                          value="{{ $c['baths'] ?? '2' }}" 
                          placeholder="2"
                          class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1.5">Area (sq.ft)</label>
                        <input 
                          type="text" 
                          name="content_sqft" 
                          value="{{ $c['sqft'] ?? '1,004 sq.ft' }}" 
                          placeholder="1,004 sq.ft"
                          class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    </div>
                  </div>

                  {{-- 2. Dynamic USPs Builder with + Sign --}}
                  <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-5 space-y-4">
                    <div class="flex items-center justify-between">
                      <div>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">2. Property USPs (Separated by | on frontend)</h3>
                        <p class="text-[11px] text-slate-500 mt-0.5">e.g. The Valley | Prime Location | District Deal — click <strong>+</strong> to add more USPs.</p>
                      </div>
                      <button 
                        type="button" 
                        onclick="addUspField('usp-list-{{ $sec->id }}')" 
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-bold shadow-xs transition-colors cursor-pointer"
                        title="Add USP"
                      >
                        <span class="text-base leading-none">+</span>
                        <span>Add USP</span>
                      </button>
                    </div>

                    <div id="usp-list-{{ $sec->id }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                      @foreach($uspItems as $uIdx => $uspVal)
                        <div class="usp-item-row flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-3 py-2 shadow-2xs focus-within:border-[#C5A47E]">
                          <span class="text-[11px] font-bold text-[#C5A47E] shrink-0">USP</span>
                          <input 
                            type="text" 
                            name="usps[]" 
                            value="{{ $uspVal }}" 
                            placeholder="e.g. Prime Location"
                            class="w-full text-xs sm:text-[13px] font-semibold text-slate-800 bg-transparent focus:outline-none"
                          >
                          <button 
                            type="button" 
                            onclick="removeUspField(this)" 
                            class="text-slate-400 hover:text-rose-600 text-xs font-bold px-1 cursor-pointer"
                            title="Remove USP"
                          >
                            ✕
                          </button>
                        </div>
                      @endforeach
                    </div>

                    {{-- Subtitle below USPs --}}
                    <div class="pt-2">
                      <label class="block text-[11px] font-semibold text-slate-600 mb-1.5">Subtitle below USPs</label>
                      <input 
                        type="text" 
                        name="content_subtext" 
                        value="{{ $c['subtext'] ?? '4 Bedroom Villa for Sale in The Valley.' }}" 
                        placeholder="4 Bedroom Villa for Sale in The Valley."
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                      >
                    </div>
                  </div>

                  {{-- 3. Overview Text Box --}}
                  <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-5 space-y-4">
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">3. Overview Section</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1.5">Overview Heading</label>
                        <input 
                          type="text" 
                          name="content_overview_heading" 
                          value="{{ $c['overview_heading'] ?? 'Overview' }}" 
                          class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1.5">Action Button Label</label>
                        <input 
                          type="text" 
                          name="content_button_text" 
                          value="{{ $c['button_text'] ?? 'See full description' }}" 
                          class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    </div>

                    <div>
                      <label class="block text-[11px] font-semibold text-slate-600 mb-1.5">Overview Content / Description Text Box</label>
                      <textarea 
                        name="content_overview_text" 
                        rows="7" 
                        placeholder="Write the property overview description and bullet points here..."
                        class="w-full bg-white border border-slate-200 rounded-xl p-4 text-xs sm:text-[13px] text-slate-800 leading-relaxed focus:outline-none focus:border-[#C5A47E]"
                      >{{ $c['overview_text'] ?? $defaultOverview }}</textarea>
                    </div>
                  </div>

                </div>

                <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
                  <button type="submit" class="px-6 py-3 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors cursor-pointer">
                    Save USPs &amp; Overview
                  </button>
                  <a href="{{ $page->url() }}" target="_blank" class="text-xs font-semibold text-blue-600 hover:underline">
                    View Live Page ↗
                  </a>
                </div>
              </form>
            </div>

            {{-- TAB C: AMENITIES & FACILITIES --}}
            @php
              $allAmenitiesStore = \App\Http\Controllers\Admin\EntityController::getAmenitiesStore();
              $assignedAmenityKeys = !empty($c['assigned_amenities']) && is_array($c['assigned_amenities'])
                ? $c['assigned_amenities']
                : ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'];
            @endphp
            <div data-tab-panel="sec_{{ $sec->id }}_amenities" class="page-tab-content space-y-6 hidden">
              <div class="border-b border-neutral-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                  <h2 class="font-heading font-medium text-xl text-[#10221C]">Select Amenities &amp; Facilities</h2>
                  <p class="text-xs text-slate-400 mt-0.5">Amenities selected here will dynamically display in the cards grid on the Buy Listing Details page.</p>
                </div>
                <a 
                  href="{{ route('admin.amenities') }}" 
                  target="_blank" 
                  class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#FAF8F5] text-[#C5A47E] hover:bg-[#F2ECE3] border border-[#C5A47E]/30 text-xs font-bold transition-colors shrink-0"
                >
                  + Manage / Add New Amenity ↗
                </a>
              </div>

              <form action="{{ route('admin.sections.update', $sec) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="name" value="{{ $sec->name }}">
                <input type="hidden" name="key" value="{{ $sec->key }}">
                <input type="hidden" name="type" value="{{ $sec->type }}">
                <input type="hidden" name="status" value="{{ $sec->status }}">
                <input type="hidden" name="is_global" value="1">
                <input type="hidden" name="amenities_form_submitted" value="1">

                <div class="space-y-6">
                  {{-- Section Heading Input --}}
                  <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-2">Section Heading</label>
                    <input 
                      type="text" 
                      name="content_amenities_heading" 
                      value="{{ $c['amenities_heading'] ?? 'Amenities & Facilities' }}" 
                      placeholder="Amenities & Facilities"
                      class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                    >
                  </div>

                  {{-- Quick Dropdown Selector to add from Database Library --}}
                  <div class="space-y-2">
                    <label class="block text-xs font-semibold text-slate-700">Add Amenity from Database Library</label>
                    <div class="flex gap-3">
                      <select 
                        id="amenity-select-dropdown-{{ $sec->id }}" 
                        class="flex-1 bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                      >
                        <option value="">-- Choose an Amenity to add --</option>
                        @foreach($allAmenitiesStore as $amItem)
                          <option value="{{ $amItem['key'] }}">{{ $amItem['name'] }}</option>
                        @endforeach
                      </select>
                      <button 
                        type="button" 
                        onclick="addAmenityFromDropdown('{{ $sec->id }}')" 
                        class="px-5 py-3 rounded-xl bg-[#0E3B2C] hover:bg-[#16503c] text-white text-xs font-bold transition-colors shadow-xs cursor-pointer shrink-0"
                      >
                        + Add to Page
                      </button>
                    </div>
                  </div>

                  {{-- Interactive Checkboxes / Cards Grid of Registered Amenities --}}
                  <div class="space-y-3 pt-2">
                    <label class="block text-xs font-semibold text-slate-700">Active Amenities for this Listing</label>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4" id="amenities-selection-grid-{{ $sec->id }}">
                      @foreach($allAmenitiesStore as $am)
                        @php
                          $isChecked = in_array($am['key'], $assignedAmenityKeys);
                        @endphp
                        <label 
                          id="amenity-card-{{ $sec->id }}-{{ $am['key'] }}" 
                          class="flex items-center gap-3.5 p-3.5 rounded-xl border {{ $isChecked ? 'border-[#C5A47E] bg-[#FAF8F5]' : 'border-slate-200 bg-white opacity-60' }} hover:opacity-100 hover:border-[#C5A47E] transition-all cursor-pointer shadow-2xs group"
                        >
                          <input 
                            type="checkbox" 
                            name="selected_amenities[]" 
                            value="{{ $am['key'] }}" 
                            {{ $isChecked ? 'checked' : '' }} 
                            class="rounded text-[#0E3B2C] focus:ring-[#C5A47E] w-4 h-4 border-slate-300"
                            onchange="toggleAmenityCardStyle('{{ $sec->id }}', '{{ $am['key'] }}', this.checked)"
                          >
                          <div class="w-8 h-8 shrink-0 flex items-center justify-center p-1 bg-white rounded-lg border border-slate-200">
                            <img src="{{ asset($am['img']) }}" alt="{{ $am['name'] }}" class="w-full h-full object-contain">
                          </div>
                          <span class="text-xs font-semibold text-slate-800 leading-snug flex-1">
                            {{ $am['name'] }}
                          </span>
                        </label>
                      @endforeach
                    </div>
                  </div>
                </div>

                <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
                  <button type="submit" class="px-6 py-3 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors cursor-pointer">
                    Save Amenities &amp; Facilities
                  </button>
                  <a href="{{ $page->url() }}" target="_blank" class="text-xs font-semibold text-blue-600 hover:underline">
                    View Live Page ↗
                  </a>
                </div>
              </form>
            </div>

            {{-- TAB D: PROPERTY LOCATION (Latitude & Longitude Only) --}}
            <div data-tab-panel="sec_{{ $sec->id }}_location" class="page-tab-content space-y-6 hidden">
              <div class="border-b border-neutral-100 pb-4 flex items-center justify-between">
                <div>
                  <h2 class="font-heading font-medium text-xl text-[#10221C]">Property Location Coordinates</h2>
                  <p class="text-xs text-slate-400 mt-0.5">Enter Latitude and Longitude coordinates to automatically position the map on the frontend.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
                  Lat / Long Map Sync
                </span>
              </div>

              <form action="{{ route('admin.sections.update', $sec) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="name" value="{{ $sec->name }}">
                <input type="hidden" name="key" value="{{ $sec->key }}">
                <input type="hidden" name="type" value="{{ $sec->type }}">
                <input type="hidden" name="status" value="{{ $sec->status }}">
                <input type="hidden" name="is_global" value="1">

                <div class="space-y-5">
                  <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-5 space-y-4">
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Map Coordinates (Latitude &amp; Longitude)</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                      {{-- Latitude Text Box --}}
                      <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-2">Latitude</label>
                        <input 
                          type="text" 
                          name="content_latitude" 
                          value="{{ $c['latitude'] ?? '25.0245' }}" 
                          placeholder="e.g. 25.0245"
                          class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-mono text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      {{-- Longitude Text Box --}}
                      <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-2">Longitude</label>
                        <input 
                          type="text" 
                          name="content_longitude" 
                          value="{{ $c['longitude'] ?? '55.2286' }}" 
                          placeholder="e.g. 55.2286"
                          class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-mono text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
                      {{-- Location Name / Label --}}
                      <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-2">Location Label (Shown on Pin Badge)</label>
                        <input 
                          type="text" 
                          name="content_location_text" 
                          value="{{ $c['location_text'] ?? 'Nice, Damac Lagoons.' }}" 
                          placeholder="Nice, Damac Lagoons."
                          class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      {{-- Section Heading --}}
                      <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-2">Section Heading</label>
                        <input 
                          type="text" 
                          name="content_location_heading" 
                          value="{{ $c['location_heading'] ?? 'Property Location' }}" 
                          placeholder="Property Location"
                          class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    </div>
                  </div>
                </div>

                <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
                  <button type="submit" class="px-6 py-3 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors cursor-pointer">
                    Save Location Coordinates
                  </button>
                  <a href="{{ $page->url() }}" target="_blank" class="text-xs font-semibold text-blue-600 hover:underline">
                    View Live Page ↗
                  </a>
                </div>
              </form>
            </div>

            {{-- TAB E: SIMILAR PROJECTS (2-Column Drag & Drop without CMS card images) --}}
            @php
              $allSimOffplan = \App\Http\Controllers\Admin\EntityController::getAvailableOffplanProjects();
              $allSimReady = \App\Http\Controllers\Admin\EntityController::getAvailableReadyProjects();
              $selectedSimSlugs = !empty($c['assigned_similar_projects']) && is_array($c['assigned_similar_projects'])
                ? $c['assigned_similar_projects']
                : [
                    'golf-fields-by-emaar',
                    'terra-heights-by-emaar',
                    'greenville-2-at-emaar-south',
                    'golf-edge-at-emaar-south',
                  ];

              $allSimCatalog = [];
              foreach ($allSimOffplan as $op) {
                $allSimCatalog[$op['slug']] = [
                  'slug' => $op['slug'],
                  'name' => $op['name'],
                  'location' => $op['location'] ?? 'EMAAR SOUTH, DUBAI',
                  'price' => $op['price'] ?? 'AED 100,000',
                  'badge' => $op['badge'] ?? 'OFF-PLAN',
                ];
              }
              foreach ($allSimReady as $rp) {
                if (!isset($allSimCatalog[$rp['slug']])) {
                  $allSimCatalog[$rp['slug']] = [
                    'slug' => $rp['slug'],
                    'name' => $rp['name'],
                    'location' => $rp['location'] ?? 'DUBAI',
                    'price' => $rp['price'] ?? 'AED 100,000',
                    'badge' => $rp['tag'] ?? 'READY',
                  ];
                }
              }

              $availableSimList = [];
              $selectedSimList = [];

              foreach ($selectedSimSlugs as $sSlug) {
                if (isset($allSimCatalog[$sSlug])) {
                  $selectedSimList[] = $allSimCatalog[$sSlug];
                }
              }
              foreach ($allSimCatalog as $sSlug => $sItem) {
                if (!in_array($sSlug, $selectedSimSlugs)) {
                  $availableSimList[] = $sItem;
                }
              }
            @endphp
            <div data-tab-panel="sec_{{ $sec->id }}_similar" class="page-tab-content space-y-6 hidden">
              <div class="border-b border-neutral-100 pb-4 flex items-center justify-between">
                <div>
                  <h2 class="font-heading font-medium text-xl text-[#10221C]">Similar Projects Assignment</h2>
                  <p class="text-xs text-slate-400 mt-0.5">Drag projects from <strong>Column A</strong> into <strong>Column S</strong> to display in the Similar Project section on the Buy Listing page.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
                  Drag &amp; Drop Active
                </span>
              </div>

              <form action="{{ route('admin.sections.update', $sec) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="name" value="{{ $sec->name }}">
                <input type="hidden" name="key" value="{{ $sec->key }}">
                <input type="hidden" name="type" value="{{ $sec->type }}">
                <input type="hidden" name="status" value="{{ $sec->status }}">
                <input type="hidden" name="is_global" value="1">
                <input type="hidden" name="similar_projects_submitted" value="1">

                <div class="space-y-5">
                  <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-2">Section Heading</label>
                    <input 
                      type="text" 
                      name="content_similar_heading" 
                      value="{{ $c['similar_heading'] ?? 'Similar Project' }}" 
                      placeholder="Similar Project"
                      class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                    >
                  </div>

                  {{-- 2-Column Drag & Drop (Text-only cards in CMS) --}}
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start font-inter">
                    
                    {{-- COLUMN A: AVAILABLE PROJECTS --}}
                    <div class="bg-[#FAF8F5] rounded-[18px] border-2 border-dashed border-slate-200 p-4">
                      <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                          <span class="w-6 h-6 rounded-lg bg-[#0E3B2C] text-white text-xs font-bold flex items-center justify-center">A</span>
                          <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700">Column A (All Projects)</h4>
                        </div>
                        <span id="col-sim-a-count" class="text-[11px] font-semibold text-slate-400 bg-white px-2.5 py-0.5 rounded-full border border-slate-200">
                          {{ count($availableSimList) }} items
                        </span>
                      </div>

                      <div 
                        id="dropzone-sim-a" 
                        class="min-h-[300px] space-y-2.5 p-1 transition-colors"
                        ondragover="allowDrop(event)" 
                        ondrop="dropSimilar(event, 'a')"
                      >
                        @foreach($availableSimList as $item)
                          <div 
                            id="sim-card-{{ $item['slug'] }}" 
                            draggable="true" 
                            ondragstart="dragSimilar(event)" 
                            data-slug="{{ $item['slug'] }}"
                            class="sim-drag-card bg-white border border-slate-200 hover:border-[#C5A47E] rounded-xl p-3.5 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                          >
                            <div class="min-w-0">
                              <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[9px] font-bold uppercase tracking-wider">{{ $item['badge'] }}</span>
                                <span class="text-[10px] font-bold text-[#C5A47E]">{{ $item['price'] }}</span>
                              </div>
                              <p class="font-bold text-xs text-slate-800 truncate mt-1">{{ $item['name'] }}</p>
                              <p class="text-[10px] text-slate-400 truncate">{{ $item['location'] }}</p>
                            </div>
                            <span class="text-slate-400 hover:text-slate-600 text-xs shrink-0 cursor-grab">⋮⋮</span>
                          </div>
                        @endforeach
                      </div>
                    </div>

                    {{-- COLUMN S: SELECTED SIMILAR PROJECTS --}}
                    <div class="bg-white rounded-[18px] border-2 border-[#C5A47E]/40 p-4 shadow-xs">
                      <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                          <span class="w-6 h-6 rounded-lg bg-[#C5A47E] text-white text-xs font-bold flex items-center justify-center">S</span>
                          <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Column S (Show in Similar Project)</h4>
                        </div>
                        <span id="col-sim-s-count" class="text-[11px] font-bold text-[#0E3B2C] bg-[#FAF8F5] px-2.5 py-0.5 rounded-full border border-[#C5A47E]/30">
                          {{ count($selectedSimList) }} assigned
                        </span>
                      </div>

                      <div 
                        id="dropzone-sim-s" 
                        class="min-h-[300px] space-y-2.5 p-1 rounded-xl bg-slate-50/50 border border-dashed border-slate-200 transition-colors"
                        ondragover="allowDrop(event)" 
                        ondrop="dropSimilar(event, 's')"
                      >
                        @foreach($selectedSimList as $item)
                          <div 
                            id="sim-card-{{ $item['slug'] }}" 
                            draggable="true" 
                            ondragstart="dragSimilar(event)" 
                            data-slug="{{ $item['slug'] }}"
                            class="sim-drag-card bg-white border border-[#C5A47E] rounded-xl p-3.5 flex items-center justify-between gap-3 shadow-2xs cursor-grab active:cursor-grabbing transition-all select-none"
                          >
                            <div class="min-w-0">
                              <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[9px] font-bold uppercase tracking-wider">{{ $item['badge'] }}</span>
                                <span class="text-[10px] font-bold text-[#C5A47E]">{{ $item['price'] }}</span>
                              </div>
                              <p class="font-bold text-xs text-slate-800 truncate mt-1">{{ $item['name'] }}</p>
                              <p class="text-[10px] text-emerald-600 font-semibold truncate">{{ $item['location'] }} &bull; Active</p>
                            </div>
                            <span class="text-[#C5A47E] text-xs shrink-0 cursor-grab">⋮⋮</span>
                          </div>
                        @endforeach
                      </div>
                    </div>

                  </div>

                  {{-- Hidden inputs for Column S --}}
                  <div id="selected-sim-inputs">
                    @foreach($selectedSimList as $item)
                      <input type="hidden" name="selected_similar_projects[]" value="{{ $item['slug'] }}" id="input-sim-{{ $item['slug'] }}">
                    @endforeach
                  </div>
                </div>

                <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
                  <button type="submit" class="px-6 py-3 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors cursor-pointer">
                    Save Similar Projects
                  </button>
                  <a href="{{ $page->url() }}" target="_blank" class="text-xs font-semibold text-blue-600 hover:underline">
                    View Live Page ↗
                  </a>
                </div>
              </form>
            </div>

          @else
            {{-- STANDARD TAB FOR OTHER SECTIONS --}}
            <div data-tab-panel="sec_{{ $sec->id }}" class="page-tab-content space-y-6 hidden">
              @php
                $cleanSecHeading = preg_replace('/^(Home|About|Blog|Communities|Enquiry|AI Assessment|Projects|Villas|Listing)\s*[—–-]\s*/iu', '', $sec->name);
              @endphp
              <div class="border-b border-neutral-100 pb-4">
                <h2 class="font-heading font-medium text-xl text-[#10221C]">{{ $cleanSecHeading }}</h2>
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

                  @elseif($sec->type === 'map_view' || $sec->key === 'communities_map')
                    {{-- SPECIAL EDITOR FOR MAP VIEW (Longitude & Latitude) --}}
                    <div class="space-y-5">
                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Section Heading</label>
                        <input
                          type="text"
                          name="content_heading_html"
                          value="{{ html_entity_decode($c['heading_html'] ?? 'Map View', ENT_QUOTES | ENT_HTML5, 'UTF-8') }}"
                          placeholder="Map View"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Location / Subtitle</label>
                        <input
                          type="text"
                          name="content_subtext"
                          value="{{ $c['subtext'] ?? (!empty($c['card_text']) ? $c['card_text'] : 'Fairways Vistas, Dubai Hills Estate, Dubai, UAE') }}"
                          placeholder="Fairways Vistas, Dubai Hills Estate, Dubai, UAE"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                          <label class="block text-xs font-semibold text-neutral-700 mb-2">Latitude</label>
                          <input
                            type="text"
                            name="content_latitude"
                            value="{{ $c['latitude'] ?? '25.1072' }}"
                            placeholder="25.1072"
                            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 font-mono focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>

                        <div>
                          <label class="block text-xs font-semibold text-neutral-700 mb-2">Longitude</label>
                          <input
                            type="text"
                            name="content_longitude"
                            value="{{ $c['longitude'] ?? '55.2449' }}"
                            placeholder="55.2449"
                            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 font-mono focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>
                      </div>

                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Search Input Placeholder</label>
                        <input
                          type="text"
                          name="content_search_placeholder"
                          value="{{ $c['search_placeholder'] ?? 'Search Community' }}"
                          placeholder="Search Community"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
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

                  @elseif($sec->type === 'map_view' || $sec->key === 'communities_map')
                    {{-- SPECIAL EDITOR FOR MAP VIEW (Longitude & Latitude) --}}
                    <div class="space-y-5">
                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Section Heading</label>
                        <input
                          type="text"
                          name="content_heading_html"
                          value="{{ html_entity_decode($c['heading_html'] ?? 'Map View', ENT_QUOTES | ENT_HTML5, 'UTF-8') }}"
                          placeholder="Map View"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Location / Subtitle</label>
                        <input
                          type="text"
                          name="content_subtext"
                          value="{{ $c['subtext'] ?? (!empty($c['card_text']) ? $c['card_text'] : 'Fairways Vistas, Dubai Hills Estate, Dubai, UAE') }}"
                          placeholder="Fairways Vistas, Dubai Hills Estate, Dubai, UAE"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                          <label class="block text-xs font-semibold text-neutral-700 mb-2">Latitude</label>
                          <input
                            type="text"
                            name="content_latitude"
                            value="{{ $c['latitude'] ?? '25.1072' }}"
                            placeholder="25.1072"
                            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 font-mono focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>

                        <div>
                          <label class="block text-xs font-semibold text-neutral-700 mb-2">Longitude</label>
                          <input
                            type="text"
                            name="content_longitude"
                            value="{{ $c['longitude'] ?? '55.2449' }}"
                            placeholder="55.2449"
                            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 font-mono focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>
                      </div>

                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Search Input Placeholder</label>
                        <input
                          type="text"
                          name="content_search_placeholder"
                          value="{{ $c['search_placeholder'] ?? 'Search Community' }}"
                          placeholder="Search Community"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
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
                            value="{{ trim(strip_tags(preg_replace('/<br\s*\/?>/i', ' ', html_entity_decode($c['heading_html'] ?? 'Frequently asked questions', ENT_QUOTES | ENT_HTML5, 'UTF-8')))) }}" 
                            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>
                      </div>

                      {{-- Dynamic FAQ List Items --}}
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

                  @elseif($sec->type === 'map_view' || $sec->key === 'communities_map')
                    {{-- SPECIAL EDITOR FOR MAP VIEW (Longitude & Latitude) --}}
                    <div class="space-y-5">
                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Section Heading</label>
                        <input
                          type="text"
                          name="content_heading_html"
                          value="{{ html_entity_decode($c['heading_html'] ?? 'Map View', ENT_QUOTES | ENT_HTML5, 'UTF-8') }}"
                          placeholder="Map View"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Location / Subtitle</label>
                        <input
                          type="text"
                          name="content_subtext"
                          value="{{ $c['subtext'] ?? (!empty($c['card_text']) ? $c['card_text'] : 'Fairways Vistas, Dubai Hills Estate, Dubai, UAE') }}"
                          placeholder="Fairways Vistas, Dubai Hills Estate, Dubai, UAE"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                          <label class="block text-xs font-semibold text-neutral-700 mb-2">Latitude</label>
                          <input
                            type="text"
                            name="content_latitude"
                            value="{{ $c['latitude'] ?? '25.1072' }}"
                            placeholder="25.1072"
                            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 font-mono focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>

                        <div>
                          <label class="block text-xs font-semibold text-neutral-700 mb-2">Longitude</label>
                          <input
                            type="text"
                            name="content_longitude"
                            value="{{ $c['longitude'] ?? '55.2449' }}"
                            placeholder="55.2449"
                            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 font-mono focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>
                      </div>

                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Search Input Placeholder</label>
                        <input
                          type="text"
                          name="content_search_placeholder"
                          value="{{ $c['search_placeholder'] ?? 'Search Community' }}"
                          placeholder="Search Community"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>
                    </div>

                  @elseif($sec->type === 'stepper_quiz' || in_array($sec->key, ['enquiry_stepper', 'assessment_stepper']))
                    {{-- SPECIAL EDITOR FOR 5-STEP ENQUIRY & AI ASSESSMENT STEPPER --}}
                    @php
                      $isEnq = $sec->key === 'enquiry_stepper';
                      $defTabs = $isEnq
                        ? ['Purpose & Goals', 'Preferences', 'Budget & Financing', 'Timeline & Requirements', 'Review & Submit']
                        : ['Purpose', 'Preferences', 'Budget', 'Timeline', 'Results'];
                      $defSteps = $isEnq
                        ? [
                            1 => ['1. Purpose & Goals', 'What Is Your Main Purpose For Buying A Villa?'],
                            2 => ['2. Property Preferences', 'What Type Of Property Are You Looking For?'],
                            3 => ['3. Budget & Financing', 'What Is Your Budget Range?'],
                            4 => ['4. Timeline & Additional Requirements', 'When Do You Plan To Purchase?'],
                            5 => ['5. Your Personalised Shortlist', 'Submitting Opens WhatsApp With These Answers Prefilled, Ready To Send To Our Advisory Team On +92 332 2495575.'],
                          ]
                        : [
                            1 => ['1. What Is Your Main Purpose For Buying?', ''],
                            2 => ['2. Property Preferences', ''],
                            3 => ['3. Budget & Financing', ''],
                            4 => ['4. Timeline & Additional Requirements', ''],
                            5 => ['5. Your Personalised Shortlist', ''],
                          ];
                    @endphp
                    <div class="space-y-6">
                      <div>
                        <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-3">Top 5 Navigation Tabs</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                          @for($tIdx = 1; $tIdx <= 5; $tIdx++)
                            <div>
                              <label class="block text-[11px] font-semibold text-neutral-600 mb-1">Tab #{{ $tIdx }}</label>
                              <input
                                type="text"
                                name="content_tab_{{ $tIdx }}"
                                value="{{ $c['tab_' . $tIdx] ?? $defTabs[$tIdx - 1] }}"
                                class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                              >
                            </div>
                          @endfor
                        </div>
                      </div>

                      <div class="pt-4 border-t border-slate-200 space-y-4">
                        <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Step Headings &amp; Taglines</h3>
                        @for($sIdx = 1; $sIdx <= 5; $sIdx++)
                          <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                              <label class="block text-[11px] font-semibold text-neutral-700 mb-1">Step {{ $sIdx }} Heading</label>
                              <input
                                type="text"
                                name="content_step{{ $sIdx }}_title"
                                value="{{ $c['step' . $sIdx . '_title'] ?? $defSteps[$sIdx][0] }}"
                                class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                              >
                            </div>
                            <div>
                              <label class="block text-[11px] font-semibold text-neutral-700 mb-1">Step {{ $sIdx }} Tagline / Subtitle</label>
                              <input
                                type="text"
                                name="content_step{{ $sIdx }}_subtitle"
                                value="{{ $c['step' . $sIdx . '_subtitle'] ?? $defSteps[$sIdx][1] }}"
                                placeholder="Optional step subtitle..."
                                class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                              >
                            </div>
                          </div>
                        @endfor
                      </div>

                      <div class="pt-4 border-t border-slate-200 grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                          <label class="block text-xs font-semibold text-neutral-700 mb-2">WhatsApp Advisory Number</label>
                          <input
                            type="text"
                            name="content_whatsapp_number"
                            value="{{ $c['whatsapp_number'] ?? '+92 332 2495575' }}"
                            placeholder="+92 332 2495575"
                            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>
                        <div>
                          <label class="block text-xs font-semibold text-neutral-700 mb-2">Submit Button Label</label>
                          <input
                            type="text"
                            name="content_submit_button_text"
                            value="{{ $c['submit_button_text'] ?? ($isEnq ? 'Submit Enquiry' : 'Get My Shortlist via WhatsApp') }}"
                            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>
                      </div>
                    </div>

                  @elseif($sec->type === 'map_view' || $sec->key === 'communities_map')
                    {{-- SPECIAL EDITOR FOR MAP VIEW (Longitude & Latitude) --}}
                    <div class="space-y-5">
                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Section Heading</label>
                        <input
                          type="text"
                          name="content_heading_html"
                          value="{{ html_entity_decode($c['heading_html'] ?? 'Map View', ENT_QUOTES | ENT_HTML5, 'UTF-8') }}"
                          placeholder="Map View"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Location / Subtitle</label>
                        <input
                          type="text"
                          name="content_subtext"
                          value="{{ $c['subtext'] ?? (!empty($c['card_text']) ? $c['card_text'] : 'Fairways Vistas, Dubai Hills Estate, Dubai, UAE') }}"
                          placeholder="Fairways Vistas, Dubai Hills Estate, Dubai, UAE"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                          <label class="block text-xs font-semibold text-neutral-700 mb-2">Latitude</label>
                          <input
                            type="text"
                            name="content_latitude"
                            value="{{ $c['latitude'] ?? '25.1072' }}"
                            placeholder="25.1072"
                            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 font-mono focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>

                        <div>
                          <label class="block text-xs font-semibold text-neutral-700 mb-2">Longitude</label>
                          <input
                            type="text"
                            name="content_longitude"
                            value="{{ $c['longitude'] ?? '55.2449' }}"
                            placeholder="55.2449"
                            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 font-mono focus:outline-none focus:border-[#C5A47E]"
                          >
                        </div>
                      </div>

                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Search Input Placeholder</label>
                        <input
                          type="text"
                          name="content_search_placeholder"
                          value="{{ $c['search_placeholder'] ?? 'Search Community' }}"
                          placeholder="Search Community"
                          class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
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

                    {{-- Heading Input (Plain Text, Line Breaks Preserved) --}}
                    @php
                      $plainHeading = trim(strip_tags(preg_replace('/<br\s*\/?>/i', "\n", html_entity_decode($c['heading_html'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8'))));
                    @endphp
                    <div>
                      <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-semibold text-neutral-700">Section Heading</label>
                        <span class="text-[11px] text-neutral-400">Press Enter for 2 lines, or keep on 1 line</span>
                      </div>
                      <textarea 
                        name="content_heading_html" 
                        rows="2"
                        class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E] leading-relaxed"
                      >{{ $plainHeading }}</textarea>
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

                    {{-- Image Card with Browse Button & Live Preview (Hero / Page Intro / Promo) --}}
                    @if(in_array($sec->type, ['hero', 'page_intro', 'projects_hero']) || (isset($c['image']) && in_array($sec->type, ['promo_band', 'text_image'])))
                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Section Cover / Background Image</label>
                        <div class="border border-slate-200 rounded-2xl p-4 bg-white flex flex-col sm:flex-row items-center gap-5">
                          <div class="w-full sm:w-48 h-32 rounded-xl bg-slate-100 overflow-hidden border border-slate-200 shrink-0 relative group">
                            <img 
                              id="preview-img-{{ $sec->id }}"
                              src="{{ !empty($c['image']) ? asset($c['image']) : asset($sec->key === 'communities_intro' ? 'images/communities-hero-villa.jpg' : 'images/house-white.jpg') }}" 
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

                    {{-- Search Filter Bar CMS Fields for Projects Hero --}}
                    @if($sec->type === 'projects_hero' || $sec->key === 'projects_intro' || str_contains($sec->key, 'projects_hero'))
                      <div class="pt-4 border-t border-slate-100 space-y-4">
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Hero Search Filter Bar Options (Database-Driven)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                          <div>
                            <label class="block text-xs font-semibold text-neutral-700 mb-1.5">Location Input Placeholder</label>
                            <input type="text" name="content_location_placeholder" value="{{ $c['location_placeholder'] ?? 'Community, project or developer' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-[#C5A47E]">
                          </div>
                          <div>
                            <label class="block text-xs font-semibold text-neutral-700 mb-1.5">Property Type Options (comma-separated)</label>
                            <input type="text" name="content_search_types" value="{{ $c['search_types'] ?? 'Villa, Townhouse, Apartment, Penthouse' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-[#C5A47E]">
                          </div>
                          <div>
                            <label class="block text-xs font-semibold text-neutral-700 mb-1.5">Budget Options (comma-separated)</label>
                            <input type="text" name="content_search_budgets" value="{{ $c['search_budgets'] ?? 'Under AED 2M, AED 2M - 5M, AED 5M - 10M, AED 10M+' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-[#C5A47E]">
                          </div>
                          <div>
                            <label class="block text-xs font-semibold text-neutral-700 mb-1.5">Handover Options (comma-separated)</label>
                            <input type="text" name="content_search_handovers" value="{{ $c['search_handovers'] ?? 'Ready, 2026, 2027, 2028, 2029, 2030' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-[#C5A47E]">
                          </div>
                        </div>
                      </div>
                    @endif

                    {{-- Button Links --}}
                    @if(isset($c['button_text']) || str_contains($sec->key, 'promo') || (str_contains($sec->key, 'intro') && $sec->key !== 'communities_intro'))
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

                  {{-- Communities Main Page: Auto-synced Live Grid (Side-Panel Communities, Newest at Top) --}}
                  @if($sec->key === 'communities_grid')
                    @php
                      $allCommStore = \App\Http\Controllers\Admin\EntityController::getCommunityStore();
                      $orderedCommStore = array_reverse($allCommStore, true);
                    @endphp
                    <div class="pt-5 border-t border-slate-100 space-y-5">
                      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                          <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Communities Directory Grid (Auto-Synced)</h3>
                          <p class="text-xs text-slate-500 mt-0.5">All communities from <strong>Manage &gt; Community</strong> appear here automatically — newly added communities show at the top.</p>
                        </div>
                        <a
                          href="{{ route('admin.communities') }}"
                          class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs transition-colors shrink-0"
                        >
                          <span>+ Manage Communities</span>
                        </a>
                      </div>

                      <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-2">Card Link Label</label>
                        <input
                          type="text"
                          name="content_link_text"
                          value="{{ $c['link_text'] ?? 'view community' }}"
                          placeholder="view community"
                          class="w-full sm:w-80 bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                        >
                      </div>

                      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($orderedCommStore as $slugKey => $cItem)
                          @php
                            $cImg = !empty($cItem['hero_img']) ? $cItem['hero_img'] : (!empty($cItem['media_image']) ? $cItem['media_image'] : 'images/communities-hero-villa.jpg');
                          @endphp
                          <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl overflow-hidden flex flex-col justify-between">
                            <div>
                              <div class="h-28 w-full bg-slate-100 overflow-hidden">
                                <img src="{{ asset($cImg) }}" alt="{{ $cItem['name'] ?? '' }}" class="w-full h-full object-cover">
                              </div>
                              <div class="p-3.5">
                                <div class="flex items-center justify-between gap-2">
                                  <span class="text-xs font-bold text-[#10221C] truncate">{{ $cItem['name'] ?? $slugKey }}</span>
                                  <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-white border border-slate-200 text-slate-500 shrink-0">{{ $cItem['city'] ?? 'Dubai' }}</span>
                                </div>
                                <p class="text-[11px] text-slate-500 mt-1 line-clamp-2">{{ $cItem['hero_subtext'] ?? 'Dubai luxury community' }}</p>
                              </div>
                            </div>
                            <div class="px-3.5 pb-3 flex items-center justify-between text-[11px]">
                              <span class="text-slate-400 font-medium">{{ count($cItem['assigned_offplan_projects'] ?? [1, 2]) }} Projects</span>
                              <a href="{{ route('admin.communities.edit', $slugKey) }}" class="font-semibold text-[#C5A47E] hover:underline">Edit Community &rarr;</a>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  @endif

                  {{-- Two-Column Drag & Drop for Popular Communities (Home Page ONLY) --}}
                  @if($sec->key === 'home_communities')
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
                  @if($sec->key === 'home_listings' || in_array($sec->type, ['offplan_villas', 'offplan_townhouses', 'ready_to_move']) || ($sec->type === 'listings' && !str_contains($sec->key, 'projects_listings')))
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
          @endif
        @endforeach
      @endif

      {{-- GLOBAL MODULES TAB PANEL (Available on all pages) --}}
      <div data-tab-panel="global_modules" class="page-tab-content space-y-6 hidden">
        <div class="border-b border-neutral-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
          <div>
            <h2 class="font-heading font-medium text-xl text-[#10221C]">Global Modules</h2>
            <p class="text-xs text-neutral-400 mt-0.5">Call any section from the global library directly into this page (Hero and Footer remain fixed).</p>
          </div>
          <a
            href="{{ route('admin.sections.create') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs transition-colors shrink-0"
          >
            + New Section
          </a>
        </div>

        @if(!$page->exists)
          <div class="bg-[#FAF8F5] border border-[#EBE7DF] rounded-xl px-4 py-3 text-xs text-neutral-600">
            Select any Global Modules below — they will be attached automatically between the <strong>Hero</strong> section and <strong>Footer</strong> when you click <strong>Save Page Settings</strong>.
          </div>
        @endif

        {{-- SELECTED SECTIONS BOX (Drag & Drop to Reorder) --}}
        <div class="bg-[#FAF8F5] border-2 border-dashed border-[#D6CFC2] rounded-2xl p-4 space-y-3">
          <div class="flex items-center justify-between gap-2">
            <div>
              <h3 class="text-xs font-bold uppercase tracking-wider text-[#10221C]">Selected Sections for This Page</h3>
              <p class="text-[11px] text-neutral-500 mt-0.5">Drag &amp; drop items up or down to set which section appears first and which comes next.</p>
            </div>
            <span id="gm-selected-status" class="text-[11px] font-bold px-3 py-1 rounded-full bg-white border border-[#EBE7DF] text-[#C5A47E]">
              {{ $page->exists ? $page->sections->count() . ' active' : '0 selected' }}
            </span>
          </div>

          <div id="gm-selected-list" class="space-y-2 min-h-[54px]">
            @if($page->exists)
              @forelse($page->sections as $idx => $attSec)
                <div
                  class="gm-sel-item bg-white border border-[#EBE7DF] hover:border-[#C5A47E] rounded-xl px-3.5 py-2.5 flex items-center justify-between gap-3 cursor-grab active:cursor-grabbing select-none shadow-2xs"
                  draggable="true"
                  data-sec-id="{{ $attSec->id }}"
                >
                  <div class="flex items-center gap-3 min-w-0">
                    <span class="gm-order-num w-6 h-6 rounded-md bg-[#0E3B2C] text-white text-[11px] font-bold flex items-center justify-center shrink-0">{{ $idx + 1 }}</span>
                    <span class="text-neutral-400 text-sm shrink-0">⋮⋮</span>
                    <div class="min-w-0">
                      <p class="text-xs font-bold text-[#10221C] truncate">{{ $attSec->name }}</p>
                      <p class="text-[10px] text-neutral-400 font-mono truncate">{{ $attSec->key }}</p>
                    </div>
                  </div>
                  <form action="{{ route('admin.pages.detach', [$page, $attSec]) }}" method="POST" onsubmit="return confirm('Remove this section from the page?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-2 py-1 rounded-md text-xs font-bold text-rose-500 hover:bg-rose-50 cursor-pointer" title="Remove">✕</button>
                  </form>
                </div>
              @empty
                <div id="gm-empty-msg" class="text-center py-4 text-xs text-neutral-400">
                  No sections attached yet. Click <strong>+ Call Into This Page</strong> below to add sections.
                </div>
              @endforelse
            @else
              <div id="gm-empty-msg" class="text-center py-4 text-xs text-neutral-400">
                No sections selected yet. Click <strong>+ Select for New Page</strong> below to add sections.
              </div>
            @endif
          </div>
        </div>

        {{-- Instant Search & Type Filter --}}
        <div class="flex flex-wrap items-center gap-3 bg-[#FAF8F5] border border-[#EBE7DF] rounded-2xl p-3.5">
            <input
              type="text"
              id="gm-search-input"
              oninput="filterGlobalModules()"
              placeholder="Search section by name or key..."
              class="flex-1 min-w-[220px] bg-white border border-[#EBE7DF] rounded-xl px-4 py-2.5 text-xs text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#C5A47E]"
            >
            <select
              id="gm-type-filter"
              onchange="filterGlobalModules()"
              class="bg-white border border-[#EBE7DF] rounded-xl px-4 py-2.5 text-xs font-medium text-neutral-700 focus:outline-none focus:border-[#C5A47E]"
            >
              <option value="">All Types</option>
              @foreach(\App\Models\Section::types() as $tKey => $tLabel)
                <option value="{{ $tKey }}">{{ $tLabel }}</option>
              @endforeach
            </select>
          </div>

          <style>
            .gm-module-card {
              display: flex;
              align-items: center;
              gap: 14px;
              padding: 12px;
              background: #ffffff;
              border: 1px solid #EBE7DF;
              border-radius: 14px;
              transition: border-color 0.15s ease, box-shadow 0.15s ease;
            }
            .gm-module-card:hover {
              border-color: #C5A47E;
              box-shadow: 0 2px 8px rgba(16, 34, 28, 0.05);
            }
            .gm-thumb {
              position: relative;
              width: 132px;
              min-width: 132px;
              height: 82px;
              border-radius: 10px;
              overflow: hidden;
              background: #f3f4f6;
              border: 1px solid #EBE7DF;
              flex-shrink: 0;
            }
            .gm-thumb img {
              width: 100%;
              height: 100%;
              object-fit: cover;
              display: block;
            }
          </style>

          <div class="space-y-2.5 max-h-[680px] overflow-y-auto pr-1" id="gm-cards-list">
            @foreach($sections as $gm)
              @php
                $gmAttached = in_array($gm->id, $attachedIds ?? []);
                $gmImg = 'images/listing-pool-villa.jpg';
                $gmKey = $gm->key;
                if (str_contains($gmKey, 'amenit') || str_contains($gm->type, 'amenit')) $gmImg = 'images/amenities-section-preview.jpg';
                elseif (str_contains($gmKey, 'hero')) $gmImg = 'images/communities-hero-villa.jpg';
                elseif (str_contains($gmKey, 'map')) $gmImg = 'images/golf-vale-map-view.jpg';
                elseif (str_contains($gmKey, 'project')) $gmImg = 'images/golf-vale-main.jpg';
                elseif (str_contains($gmKey, 'stepper') || str_contains($gmKey, 'quiz')) $gmImg = 'images/palm-jumeirah-ai-hero.jpg';
                elseif (str_contains($gmKey, 'advisor')) $gmImg = 'images/agent.jpg';
                elseif (str_contains($gmKey, 'listing')) $gmImg = 'images/listing-modern-villa.jpg';
                elseif (str_contains($gmKey, 'community')) $gmImg = 'images/community-dubai-hills.jpg';
                elseif (str_contains($gmKey, 'blog')) $gmImg = 'images/dubai-skyline.jpg';
              @endphp
              <div
                class="gm-module-card"
                data-gm-search="{{ strtolower($gm->name . ' ' . $gm->key) }}"
                data-gm-type="{{ $gm->type }}"
              >
                <div class="gm-thumb">
                  <img src="{{ asset($gmImg) }}" alt="{{ $gm->name }}">
                  <span style="position:absolute;top:6px;right:6px;padding:2px 6px;border-radius:5px;background:rgba(0,0,0,0.62);color:#fff;font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Global</span>
                </div>

                <div class="flex-1 min-w-0">
                  <div class="flex items-center justify-between gap-2">
                    <h4 class="text-xs sm:text-[13px] font-bold text-[#10221C] truncate">{{ $gm->name }}</h4>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase shrink-0 {{ $gm->status === 'published' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                      {{ $gm->status }}
                    </span>
                  </div>
                  <p class="text-[11px] text-neutral-400 font-mono mt-0.5 truncate">{{ $gm->key }} &middot; {{ \App\Models\Section::types()[$gm->type] ?? $gm->type }}</p>

                  <div class="flex flex-wrap items-center gap-2 mt-2.5">
                    @if(!$page->exists)
                      <button
                        type="button"
                        data-gm-select-id="{{ $gm->id }}"
                        data-gm-name="{{ $gm->name }}"
                        data-gm-key="{{ $gm->key }}"
                        onclick="togglePreselectModule('{{ $gm->id }}', this)"
                        class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-[#0E3B2C] hover:bg-[#16523e] text-white text-[11px] font-semibold transition-colors cursor-pointer"
                      >
                        + Select for New Page
                      </button>
                    @elseif($gmAttached)
                      <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-semibold">
                        Added to This Page
                      </span>
                    @else
                      <button
                        type="button"
                        onclick="attachSection('{{ $gm->id }}')"
                        class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-[#0E3B2C] hover:bg-[#16523e] text-white text-[11px] font-semibold transition-colors cursor-pointer"
                      >
                        + Call Into This Page
                      </button>
                    @endif
                    <a
                      href="{{ route('admin.sections.edit', $gm) }}"
                      target="_blank"
                      class="inline-flex items-center px-2.5 py-1 rounded-lg bg-[#FAF8F5] hover:bg-[#F2ECE3] text-neutral-700 border border-[#EBE7DF] text-[11px] font-semibold transition-colors"
                    >
                      Edit Section &rarr;
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
      </div>

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

  function syncSelectedSectionsBox() {
    const list = document.getElementById('gm-selected-list');
    const status = document.getElementById('gm-selected-status');
    const form = document.getElementById('page-settings-form');
    if (!list) return;

    const items = Array.from(list.querySelectorAll('.gm-sel-item'));
    items.forEach((el, idx) => {
      const badge = el.querySelector('.gm-order-num');
      if (badge) badge.textContent = idx + 1;
    });

    const emptyMsg = document.getElementById('gm-empty-msg');
    if (emptyMsg) emptyMsg.style.display = items.length ? 'none' : '';

    const isExistingPage = {{ $page->exists ? 'true' : 'false' }};
    if (!isExistingPage && form) {
      form.querySelectorAll('input[name="selected_sections[]"]').forEach(el => el.remove());
      items.forEach(el => {
        const inp = document.createElement('input');
        inp.type = 'hidden';
        inp.name = 'selected_sections[]';
        inp.value = el.dataset.secId;
        form.appendChild(inp);
      });
      if (status) status.textContent = items.length + ' selected';
    } else if (isExistingPage) {
      if (status) status.textContent = 'Saving order...';
      const order = items.map(el => el.dataset.secId);
      fetch('{{ $page->exists ? route('admin.pages.reorder', $page) : '' }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ order })
      }).then(() => {
        if (status) status.textContent = items.length + ' active (Saved ✓)';
      }).catch(() => {
        if (status) status.textContent = items.length + ' active';
      });
    }
  }

  function togglePreselectModule(sectionId, btn) {
    const list = document.getElementById('gm-selected-list');
    if (!list) return;
    const existingRow = list.querySelector('.gm-sel-item[data-sec-id="' + sectionId + '"]');
    if (existingRow) {
      existingRow.remove();
      btn.textContent = '+ Select for New Page';
      btn.style.backgroundColor = '#0E3B2C';
      btn.style.color = '#ffffff';
    } else {
      const name = btn.dataset.gmName || ('Section #' + sectionId);
      const key = btn.dataset.gmKey || '';
      const row = document.createElement('div');
      row.className = 'gm-sel-item bg-white border border-[#EBE7DF] hover:border-[#C5A47E] rounded-xl px-3.5 py-2.5 flex items-center justify-between gap-3 cursor-grab active:cursor-grabbing select-none shadow-2xs';
      row.draggable = true;
      row.dataset.secId = sectionId;
      row.innerHTML =
        '<div class="flex items-center gap-3 min-w-0">' +
          '<span class="gm-order-num w-6 h-6 rounded-md bg-[#0E3B2C] text-white text-[11px] font-bold flex items-center justify-center shrink-0">1</span>' +
          '<span class="text-neutral-400 text-sm shrink-0">⋮⋮</span>' +
          '<div class="min-w-0">' +
            '<p class="text-xs font-bold text-[#10221C] truncate"></p>' +
            '<p class="text-[10px] text-neutral-400 font-mono truncate"></p>' +
          '</div>' +
        '</div>' +
        '<button type="button" class="px-2 py-1 rounded-md text-xs font-bold text-rose-500 hover:bg-rose-50 cursor-pointer" title="Remove">✕</button>';
      row.querySelector('p.font-bold').textContent = name;
      row.querySelector('p.font-mono').textContent = key;
      row.querySelector('button').addEventListener('click', function() {
        const cardBtn = document.querySelector('[data-gm-select-id="' + sectionId + '"]');
        if (cardBtn) togglePreselectModule(sectionId, cardBtn);
        else { row.remove(); syncSelectedSectionsBox(); }
      });
      list.appendChild(row);
      btn.textContent = 'Selected for Page ✓';
      btn.style.backgroundColor = '#C5A47E';
      btn.style.color = '#ffffff';
    }
    syncSelectedSectionsBox();
  }

  // Drag & Drop sorting inside Selected Sections Box
  (function initGmSelectedDragDrop() {
    const list = document.getElementById('gm-selected-list');
    if (!list) return;
    let draggedEl = null;

    list.addEventListener('dragstart', function(e) {
      const item = e.target.closest('.gm-sel-item');
      if (!item) return;
      draggedEl = item;
      item.style.opacity = '0.5';
      e.dataTransfer.effectAllowed = 'move';
    });

    list.addEventListener('dragend', function() {
      if (draggedEl) draggedEl.style.opacity = '1';
      draggedEl = null;
    });

    list.addEventListener('dragover', function(e) {
      e.preventDefault();
      if (!draggedEl) return;
      const target = e.target.closest('.gm-sel-item');
      if (!target || target === draggedEl) return;
      const rect = target.getBoundingClientRect();
      const after = (e.clientY - rect.top) > (rect.height / 2);
      if (after) {
        target.after(draggedEl);
      } else {
        target.before(draggedEl);
      }
    });

    list.addEventListener('drop', function(e) {
      e.preventDefault();
      if (draggedEl) syncSelectedSectionsBox();
    });
  })();

  function filterGlobalModules() {
    const q = (document.getElementById('gm-search-input')?.value || '').trim().toLowerCase();
    const type = (document.getElementById('gm-type-filter')?.value || '').trim();
    document.querySelectorAll('.gm-module-card').forEach(function(card) {
      const hay = card.dataset.gmSearch || '';
      const cardType = card.dataset.gmType || '';
      const matchQ = !q || hay.includes(q);
      const matchT = !type || cardType === type;
      card.style.display = (matchQ && matchT) ? '' : 'none';
    });
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

  // Dynamic USPs Add / Remove functions
  function addUspField(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    const div = document.createElement('div');
    div.className = 'usp-item-row flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-3 py-2 shadow-2xs focus-within:border-[#C5A47E]';
    div.innerHTML = `
      <span class="text-[11px] font-bold text-[#C5A47E] shrink-0">USP</span>
      <input 
        type="text" 
        name="usps[]" 
        placeholder="e.g. Rare to Market"
        class="w-full text-xs sm:text-[13px] font-semibold text-slate-800 bg-transparent focus:outline-none"
      >
      <button 
        type="button" 
        onclick="removeUspField(this)" 
        class="text-slate-400 hover:text-rose-600 text-xs font-bold px-1 cursor-pointer"
        title="Remove USP"
      >
        ✕
      </button>
    `;
    container.appendChild(div);
    const input = div.querySelector('input');
    if (input) input.focus();
  }

  function removeUspField(btn) {
    const row = btn.closest('.usp-item-row');
    if (!row) return;
    const container = row.parentElement;
    if (container && container.querySelectorAll('.usp-item-row').length <= 1) {
      row.querySelector('input').value = '';
      return;
    }
    row.remove();
  }

  // Amenities Dropdown & Checkbox Card Helpers
  function toggleAmenityCardStyle(secId, key, isChecked) {
    const card = document.getElementById('amenity-card-' + secId + '-' + key);
    if (!card) return;
    if (isChecked) {
      card.classList.remove('opacity-60', 'border-slate-200', 'bg-white');
      card.classList.add('border-[#C5A47E]', 'bg-[#FAF8F5]', 'opacity-100');
    } else {
      card.classList.remove('border-[#C5A47E]', 'bg-[#FAF8F5]', 'opacity-100');
      card.classList.add('opacity-60', 'border-slate-200', 'bg-white');
    }
  }

  function addAmenityFromDropdown(secId) {
    const select = document.getElementById('amenity-select-dropdown-' + secId);
    if (!select || !select.value) return;

    const key = select.value;
    const card = document.getElementById('amenity-card-' + secId + '-' + key);
    if (card) {
      const checkbox = card.querySelector('input[type="checkbox"]');
      if (checkbox) {
        checkbox.checked = true;
        toggleAmenityCardStyle(secId, key, true);
      }
    }
    select.value = '';
  }

  // Drag and Drop Logic for Similar Projects (Column A <-> Column S)
  function dragSimilar(ev) {
    window.__luxDraggedEl = ev.currentTarget;
    if (ev.dataTransfer) ev.dataTransfer.setData("text/plain", ev.currentTarget.id);
  }

  function dropSimilar(ev, zone) {
    ev.preventDefault();
    const id = ev.dataTransfer ? ev.dataTransfer.getData("text/plain") : '';
    const draggedEl = (id ? document.getElementById(id) : null) || window.__luxDraggedEl;
    if (!draggedEl) return;

    const targetZone = zone === 's' ? document.getElementById('dropzone-sim-s') : document.getElementById('dropzone-sim-a');
    if (!targetZone) return;

    targetZone.appendChild(draggedEl);

    if (zone === 's') {
      draggedEl.classList.remove('border-slate-200');
      draggedEl.classList.add('border-[#C5A47E]');
      const tag = draggedEl.querySelector('p:last-child');
      if (tag) {
        tag.className = 'text-[10px] text-emerald-600 font-semibold truncate';
      }
    } else {
      draggedEl.classList.remove('border-[#C5A47E]');
      draggedEl.classList.add('border-slate-200');
      const tag = draggedEl.querySelector('p:last-child');
      if (tag) {
        tag.className = 'text-[10px] text-slate-400 truncate';
      }
    }

    syncSelectedSimilar();
  }

  function syncSelectedSimilar() {
    const sZone = document.getElementById('dropzone-sim-s');
    const aZone = document.getElementById('dropzone-sim-a');
    const inputsContainer = document.getElementById('selected-sim-inputs');
    const sCount = document.getElementById('col-sim-s-count');
    const aCount = document.getElementById('col-sim-a-count');

    if (!sZone || !inputsContainer) return;

    inputsContainer.innerHTML = '';
    const sCards = sZone.querySelectorAll('.sim-drag-card');
    sCards.forEach(card => {
      const slug = card.getAttribute('data-slug');
      if (slug) {
        const inp = document.createElement('input');
        inp.type = 'hidden';
        inp.name = 'selected_similar_projects[]';
        inp.value = slug;
        inputsContainer.appendChild(inp);
      }
    });

    if (sCount) sCount.textContent = sCards.length + ' assigned';
    if (aCount && aZone) aCount.textContent = aZone.querySelectorAll('.sim-drag-card').length + ' items';
  }

  // Drag and Drop Logic for Popular Communities (Column A <-> Column S)
  function allowDrop(ev) {
    ev.preventDefault();
    if (ev.dataTransfer) ev.dataTransfer.dropEffect = 'move';
  }

  function dragComm(ev) {
    window.__luxDraggedEl = ev.currentTarget;
    if (ev.dataTransfer) ev.dataTransfer.setData("text/plain", ev.currentTarget.id);
  }

  function dropComm(ev, zone) {
    ev.preventDefault();
    const id = ev.dataTransfer ? ev.dataTransfer.getData("text/plain") : '';
    const draggedEl = (id ? document.getElementById(id) : null) || window.__luxDraggedEl;
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
    window.__luxDraggedEl = ev.currentTarget;
    if (ev.dataTransfer) ev.dataTransfer.setData("text/plain", ev.currentTarget.id);
  }

  function dropProp(ev, zone) {
    ev.preventDefault();
    const id = ev.dataTransfer ? ev.dataTransfer.getData("text/plain") : '';
    const draggedEl = (id ? document.getElementById(id) : null) || window.__luxDraggedEl;
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

  // Drag and Drop Logic for Offplan Projects Carousel (Column A <-> Column S)
  function dragOffplan(ev) {
    window.__luxDraggedEl = ev.currentTarget;
    if (ev.dataTransfer) ev.dataTransfer.setData("text/plain", ev.currentTarget.id);
  }

  function dropOffplan(ev, zone) {
    ev.preventDefault();
    const id = ev.dataTransfer ? ev.dataTransfer.getData("text/plain") : '';
    const draggedEl = (id ? document.getElementById(id) : null) || window.__luxDraggedEl;
    if (!draggedEl) return;

    const targetZone = zone === 's' ? document.getElementById('dropzone-offplan-s') : document.getElementById('dropzone-offplan-a');
    if (!targetZone) return;

    targetZone.appendChild(draggedEl);

    if (zone === 's') {
      draggedEl.classList.remove('border-slate-200');
      draggedEl.classList.add('border-[#C5A47E]');
      const tag = draggedEl.querySelector('p:last-child');
      if (tag) {
        tag.className = 'text-[10px] text-emerald-600 font-semibold truncate';
        tag.textContent = 'Under Construction • Active in Carousel';
      }
    } else {
      draggedEl.classList.remove('border-[#C5A47E]');
      draggedEl.classList.add('border-slate-200');
      const tag = draggedEl.querySelector('p:last-child');
      if (tag) {
        tag.className = 'text-[10px] text-slate-400 truncate';
        tag.textContent = 'Off-Plan Project';
      }
    }

    syncSelectedOffplans();
  }

  function syncSelectedOffplans() {
    const sZone = document.getElementById('dropzone-offplan-s');
    const aZone = document.getElementById('dropzone-offplan-a');
    const inputsContainer = document.getElementById('selected-offplan-inputs');
    const sCount = document.getElementById('col-offplan-s-count');
    const aCount = document.getElementById('col-offplan-a-count');

    if (!sZone || !inputsContainer) return;

    inputsContainer.innerHTML = '';
    const sCards = sZone.querySelectorAll('.offplan-drag-card');
    sCards.forEach(card => {
      const slug = card.getAttribute('data-slug');
      if (slug) {
        const inp = document.createElement('input');
        inp.type = 'hidden';
        inp.name = 'selected_offplan_projects[]';
        inp.value = slug;
        inputsContainer.appendChild(inp);
      }
    });

    if (sCount) sCount.textContent = sCards.length + ' assigned';
    if (aCount && aZone) aCount.textContent = aZone.querySelectorAll('.offplan-drag-card').length + ' items';
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
