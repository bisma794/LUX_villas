@extends('layouts.admin')

@section('content')
<div class="space-y-6 font-inter">

  {{-- Header: Update Off Plan Project Title + Live Page URL + Status dropdown --}}
  <div class="bg-white rounded-[16px] border border-slate-100 p-5 sm:p-6 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight">
        {{ !empty($isNew) ? 'Add New Off Plan Project' : 'Update Off Plan Project — ' . $project['name'] }}
      </h1>
      @if(empty($isNew))
        <p class="text-xs text-slate-500 font-medium mt-1">
          Page URL: <a href="{{ $project['url'] }}" target="_blank" class="text-blue-600 hover:underline">{{ url($project['url']) }}</a>
        </p>
      @else
        <p class="text-xs text-slate-500 font-medium mt-1">
          Fill out the Project Details template below to publish a new Off-Plan Project.
        </p>
      @endif
    </div>

    <div class="flex items-center gap-3">
      @if(empty($isNew))
        <a 
          href="{{ $project['url'] }}" 
          target="_blank" 
          class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#10221C] hover:bg-[#0E3B2C] text-white text-xs font-semibold shadow-xs transition-colors"
        >
          <span>Preview Live Page ↗</span>
        </a>
      @endif

      <a href="{{ route('admin.offplan-projects') }}" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
        Back
      </a>
    </div>
  </div>

  {{-- Two Column Editor Layout: Left Vertical Tabs + Right Form Content --}}
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
    
    {{-- Left Sidebar: Section Tabs matching Project Detail Page Format --}}
    <aside class="lg:col-span-3 space-y-2 sticky top-24">
      @php
        $editorTabs = [
          ['id' => 'basic', 'label' => 'Basic Detail', 'active' => true],
          ['id' => 'hero_gallery', 'label' => 'Hero & Gallery', 'active' => false],
          ['id' => 'key_stats', 'label' => 'Key Stats Bar (4 Pairs)', 'active' => false],
          ['id' => 'about_dev', 'label' => 'About Development', 'active' => false],
          ['id' => 'property_types', 'label' => 'Property Types', 'active' => false],
          ['id' => 'similar_projects', 'label' => 'Similar Projects', 'active' => false],
          ['id' => 'amenities', 'label' => 'Amenities', 'active' => false],
          ['id' => 'location', 'label' => 'Location (Lat / Lng)', 'active' => false],
          ['id' => 'payment_plan', 'label' => 'Payment Plan', 'active' => false],
          ['id' => 'full_content', 'label' => 'Full Content', 'active' => false],
          ['id' => 'faqs', 'label' => 'FAQs', 'active' => false],
        ];
      @endphp

      <div class="bg-white rounded-[16px] border border-slate-100 p-2 shadow-xs space-y-1">
        @foreach($editorTabs as $idx => $tab)
          <button 
            type="button" 
            data-editor-tab="{{ $tab['id'] }}"
            class="editor-nav-tab w-full text-left px-4 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer flex items-center justify-between group {{ $tab['active'] ? 'bg-[#F2ECE3] text-[#10221C] border-l-4 border-[#C5A47E] font-bold' : 'text-slate-600 hover:bg-slate-50' }}"
          >
            <span class="truncate">{{ $tab['label'] }}</span>
            <span class="text-[10px] font-mono text-neutral-400 group-hover:text-[#C5A47E] ml-1 shrink-0">#{{ $idx + 1 }}</span>
          </button>
        @endforeach
      </div>
    </aside>

    {{-- Right Form Panel Container --}}
    <div class="lg:col-span-9 bg-white rounded-[16px] border border-slate-100 p-6 sm:p-8 shadow-xs">
      
      <form action="{{ !empty($isNew) ? route('admin.offplan-projects.store') : route('admin.offplan-projects.update', $project['slug']) }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- TAB 1: BASIC DETAIL --}}
        <div data-tab-content="basic" class="tab-pane space-y-5">
          <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <div>
              <h2 class="font-heading font-medium text-xl text-[#10221C]">Basic Project Details &amp; SEO</h2>
              <p class="text-xs text-slate-400 mt-0.5">Configure project name, slug, city, status and meta tags.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
              Project Settings
            </span>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Project Name</label>
              <input 
                type="text" 
                name="name" 
                value="{{ $project['name'] }}" 
                class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
              >
            </div>

            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Slug</label>
              <input 
                type="text" 
                name="slug" 
                value="{{ $project['slug'] }}" 
                readonly
                class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-500 font-mono focus:outline-none"
              >
            </div>

            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">City</label>
              <select name="city" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
                <option value="Dubai" {{ ($project['city'] ?? 'Dubai') === 'Dubai' ? 'selected' : '' }}>Dubai</option>
                <option value="Abu Dhabi" {{ ($project['city'] ?? '') === 'Abu Dhabi' ? 'selected' : '' }}>Abu Dhabi</option>
                <option value="Sharjah" {{ ($project['city'] ?? '') === 'Sharjah' ? 'selected' : '' }}>Sharjah</option>
              </select>
            </div>

            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Status</label>
              <select name="status" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-bold text-emerald-700 focus:outline-none focus:border-[#C5A47E]">
                <option value="DRAFT" {{ ($project['status'] ?? 'DRAFT') === 'DRAFT' ? 'selected' : '' }}>DRAFT</option>
                <option value="PUBLISHED" {{ ($project['status'] ?? '') === 'PUBLISHED' ? 'selected' : '' }}>PUBLISHED</option>
              </select>
            </div>

            @php
              $selectedCat = $project['property_category'] ?? (str_contains(strtolower(($project['name'] ?? '') . ' ' . ($project['slug'] ?? '')), 'townhouse') ? 'townhouse' : 'villa');
            @endphp
            <div class="md:col-span-2">
              <label class="block text-xs font-semibold text-slate-700 mb-2">Projects Page Section Category</label>
              <select name="property_category" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
                <option value="villa" {{ $selectedCat === 'villa' ? 'selected' : '' }}>Offplan Villa For Sale (Projects Page)</option>
                <option value="townhouse" {{ $selectedCat === 'townhouse' ? 'selected' : '' }}>Offplan Townhouses (Projects Page)</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Meta Title</label>
            <input 
              type="text" 
              name="meta_title" 
              value="{{ $project['meta_title'] ?? ($project['name'] . ' — Lux Villa Dubai') }}" 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Meta Keywords</label>
            <input 
              type="text" 
              name="meta_keywords" 
              value="{{ $project['meta_keyword'] ?? '' }}"
              placeholder="e.g. Golf Vale Emaar South, Emaar Offplan Dubai" 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Meta Description</label>
            <textarea 
              name="meta_description" 
              rows="3" 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl p-4 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >{{ $project['meta_description'] ?? ('Explore ' . $project['name'] . ' off-plan project in Dubai — floor plans, payment plans, amenities and investment insights.') }}</textarea>
          </div>
        </div>

        {{-- TAB 2: HERO & GALLERY (Breadcrumbs, Dynamic USPs Heading + 3 High-Res Gallery Slots) --}}
        <div data-tab-content="hero_gallery" class="tab-pane hidden space-y-6">
          <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <div>
              <h2 class="font-heading font-medium text-xl text-[#10221C]">Hero Banner, USPs &amp; 3-Image Gallery</h2>
              <p class="text-xs text-slate-400 mt-0.5">Configure top golden hero breadcrumbs, USPs heading ("Golf Vale Emaar South | EMAAR Properties | Dubai South, Dubai") and 3 gallery photos.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
              Top Hero &amp; Gallery
            </span>
          </div>

          {{-- Breadcrumbs --}}
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Breadcrumbs</label>
            <input 
              type="text" 
              name="breadcrumbs" 
              value="{{ $project['breadcrumbs'] ?? ('1. Home > Off-plan > EMAAR Properties > ' . $project['name']) }}" 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >
          </div>

          {{-- Dynamic USPs Heading with + Add USP button --}}
          @php
            $uspItems = !empty($project['usps']) && is_array($project['usps'])
              ? $project['usps']
              : [$project['name'], 'EMAAR Properties', 'Dubai South, Dubai'];
          @endphp
          <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-5 space-y-4">
            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Hero Heading USPs (Separated by | on frontend)</h3>
                <p class="text-[11px] text-slate-500 mt-0.5">e.g. Golf Vale Emaar South | EMAAR Properties | Dubai South, Dubai — click <strong>+ Add USP</strong> to add more.</p>
              </div>
              <button 
                type="button" 
                onclick="addUspField('offplan-usp-list')" 
                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-bold shadow-xs transition-colors cursor-pointer"
              >
                <span class="text-base leading-none">+</span>
                <span>Add USP</span>
              </button>
            </div>

            <div id="offplan-usp-list" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
              @foreach($uspItems as $uspVal)
                <div class="usp-item-row flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-3 py-2 shadow-2xs focus-within:border-[#C5A47E]">
                  <span class="text-[11px] font-bold text-[#C5A47E] shrink-0">USP</span>
                  <input 
                    type="text" 
                    name="usps[]" 
                    value="{{ $uspVal }}" 
                    placeholder="e.g. EMAAR Properties"
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
          </div>

          {{-- 3 Gallery Photos with Browse Button --}}
          @php
            $gMain = $project['gallery_main'] ?? 'images/golf-vale-main.jpg';
            $gTopRight = $project['gallery_top_right'] ?? 'images/golf-vale-pool.png';
            $gBottomRight = $project['gallery_bottom_right'] ?? 'images/golf-vale-bedroom.png';
          @endphp
          <div class="space-y-5">
            {{-- 1. Main Large Left Photo --}}
            <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-5 space-y-3">
              <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-800 uppercase tracking-wider">1. Main Large Left Photo</span>
                <span class="text-[11px] text-[#C5A47E] font-semibold">Primary Col-8 Image</span>
              </div>

              <div class="flex flex-col sm:flex-row items-center gap-5 bg-white p-4 rounded-xl border border-slate-200">
                <div class="w-full sm:w-56 h-36 rounded-xl bg-slate-100 overflow-hidden border border-slate-200 shrink-0">
                  <img id="preview-offplan-gal-main" src="{{ asset($gMain) }}" alt="Main Photo" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 w-full space-y-2.5">
                  <div class="flex items-center justify-between">
                    <span class="text-xs font-medium text-slate-600">Select high-res image from laptop</span>
                    <label class="px-4 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs cursor-pointer transition-colors">
                      <span>Browse</span>
                      <input type="file" name="gallery_main_file" accept="image/*" class="hidden" onchange="previewUploadedImage(this, 'preview-offplan-gal-main')">
                    </label>
                  </div>
                  <input type="text" name="gallery_main" value="{{ $gMain }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-600 font-mono focus:outline-none focus:border-[#C5A47E]">
                </div>
              </div>
            </div>

            {{-- 2 & 3. Right Stacked Photos --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              {{-- 2. Top Right Photo --}}
              <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-5 space-y-3">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-bold text-slate-800 uppercase tracking-wider">2. Top Right Photo</span>
                  <span class="text-[10px] text-[#C5A47E] font-semibold">Pool / Exterior</span>
                </div>
                <div class="bg-white p-3.5 rounded-xl border border-slate-200 space-y-3">
                  <div class="w-full h-36 rounded-lg bg-slate-100 overflow-hidden border border-slate-200">
                    <img id="preview-offplan-gal-tr" src="{{ asset($gTopRight) }}" alt="Top Right Photo" class="w-full h-full object-cover">
                  </div>
                  <div class="flex items-center justify-between gap-2">
                    <span class="text-[11px] font-medium text-slate-600">Upload photo</span>
                    <label class="px-3.5 py-1.5 rounded-lg bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs cursor-pointer transition-colors">
                      <span>Browse</span>
                      <input type="file" name="gallery_top_right_file" accept="image/*" class="hidden" onchange="previewUploadedImage(this, 'preview-offplan-gal-tr')">
                    </label>
                  </div>
                  <input type="text" name="gallery_top_right" value="{{ $gTopRight }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-600 font-mono focus:outline-none focus:border-[#C5A47E]">
                </div>
              </div>

              {{-- 3. Bottom Right Photo --}}
              <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-5 space-y-3">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-bold text-slate-800 uppercase tracking-wider">3. Bottom Right Photo</span>
                  <span class="text-[10px] text-[#C5A47E] font-semibold">Interior / Bedroom</span>
                </div>
                <div class="bg-white p-3.5 rounded-xl border border-slate-200 space-y-3">
                  <div class="w-full h-36 rounded-lg bg-slate-100 overflow-hidden border border-slate-200">
                    <img id="preview-offplan-gal-br" src="{{ asset($gBottomRight) }}" alt="Bottom Right Photo" class="w-full h-full object-cover">
                  </div>
                  <div class="flex items-center justify-between gap-2">
                    <span class="text-[11px] font-medium text-slate-600">Upload photo</span>
                    <label class="px-3.5 py-1.5 rounded-lg bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs cursor-pointer transition-colors">
                      <span>Browse</span>
                      <input type="file" name="gallery_bottom_right_file" accept="image/*" class="hidden" onchange="previewUploadedImage(this, 'preview-offplan-gal-br')">
                    </label>
                  </div>
                  <input type="text" name="gallery_bottom_right" value="{{ $gBottomRight }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-600 font-mono focus:outline-none focus:border-[#C5A47E]">
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- TAB 3: KEY STATS BAR (4 Pairs: Developer, Starting Price, Available Units, Handover) --}}
        <div data-tab-content="key_stats" class="tab-pane hidden space-y-6">
          <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <div>
              <h2 class="font-heading font-medium text-xl text-[#10221C]">Key Project Stats Bar (4 Pairs)</h2>
              <p class="text-xs text-slate-400 mt-0.5">Shown directly below the Hero section (e.g. Developer / Emaar, AED 1,099,888 / Starting Price from, 1-4br / Available Units, 2030 Q1 / Handover).</p>
            </div>
            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
              4 Stat Pairs
            </span>
          </div>

          @php
            $statDefaults = [
              ['upper' => 'Developer', 'lower' => 'Emaar'],
              ['upper' => 'AED 1,099,888', 'lower' => 'Starting Price from'],
              ['upper' => '1-4br', 'lower' => 'Available Units'],
              ['upper' => '2030 Q1', 'lower' => 'Handover'],
            ];
            $stats = $project['stats'] ?? $statDefaults;
          @endphp

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @for($i = 0; $i < 4; $i++)
              @php $st = $stats[$i] ?? ($statDefaults[$i] ?? ['upper' => '', 'lower' => '']); @endphp
              <div class="bg-[#FAF8F5] border border-slate-200 rounded-xl p-4 space-y-3">
                <div class="text-[11px] font-bold text-[#C5A47E] uppercase tracking-wider">Stat Box #{{ $i + 1 }}</div>
                <div>
                  <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Upper Value (Bold)</label>
                  <input 
                    type="text" 
                    name="stats_upper[]" 
                    value="{{ $st['upper'] }}" 
                    class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-bold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                  >
                </div>
                <div>
                  <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Lower Label</label>
                  <input 
                    type="text" 
                    name="stats_lower[]" 
                    value="{{ $st['lower'] }}" 
                    class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-600 focus:outline-none focus:border-[#C5A47E]"
                  >
                </div>
              </div>
            @endfor
          </div>
        </div>

        {{-- TAB 4: ABOUT DEVELOPMENT & EXPERT ADVICE FORM --}}
        <div data-tab-content="about_dev" class="tab-pane hidden space-y-6">
          <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <div>
              <h2 class="font-heading font-medium text-xl text-[#10221C]">About This Development &amp; Expert Form</h2>
              <p class="text-xs text-slate-400 mt-0.5">Configure eyebrow, heading, Summernote rich description, and right-hand expert consultation form card.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#0E3B2C] border border-[#0E3B2C]/20">
              Summernote Active
            </span>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Eyebrow Text</label>
              <input 
                type="text" 
                name="about_eyebrow" 
                value="{{ $project['about_eyebrow'] ?? '1, 2 and 3-bedroom apartments' }}" 
                class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
              >
            </div>

            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Section Heading</label>
              <input 
                type="text" 
                name="about_heading" 
                value="{{ $project['about_heading'] ?? 'About this development' }}" 
                class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
              >
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Development Overview Description (Summernote Editor)</label>
            <textarea 
              name="about_description" 
              class="summernote-editor w-full"
            >{!! $project['about_description'] ?? '' !!}</textarea>
          </div>

          {{-- Expert Advice Form Card Settings --}}
          <div class="pt-4 border-t border-slate-100 space-y-4">
            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Right Column: Expert Consultation Form Card</h3>
                <p class="text-[11px] text-slate-400">Toggle or customize "Get expert advice about {{ $project['name'] }}" card</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="show_form" value="1" class="sr-only peer" {{ (!isset($project['show_form']) || $project['show_form']) ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0E3B2C]"></div>
              </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Form Card Title</label>
                <input 
                  type="text" 
                  name="form_title" 
                  value="{{ $project['form_title'] ?? ('Get expert advice about ' . $project['name']) }}" 
                  class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                >
              </div>
              <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Form Card Subtitle</label>
                <input 
                  type="text" 
                  name="form_subtitle" 
                  value="{{ $project['form_subtitle'] ?? ('Connect with our experts to learn more about ' . $project['name'] . '.') }}" 
                  class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                >
              </div>
            </div>
          </div>
        </div>

        {{-- TAB 5: PROPERTY TYPES (Dynamic Add / Edit / Delete Rows) --}}
        <div data-tab-content="property_types" class="tab-pane hidden space-y-6">
          <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <div>
              <h2 class="font-heading font-medium text-xl text-[#10221C]">Property Types &amp; Floorplan Rows</h2>
              <p class="text-xs text-slate-400 mt-0.5">Add, edit or delete available unit types (e.g. 4 Bedroom Townhouse | Townhouse | 4 Bedroom | 2,789 sq ft | AED 5,060,000).</p>
            </div>
            <button 
              type="button" 
              onclick="addPropertyTypeRow()" 
              class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-bold shadow-xs transition-colors cursor-pointer"
            >
              + Add Property Type
            </button>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Section Heading</label>
            <input 
              type="text" 
              name="property_types_heading" 
              value="{{ $project['property_types_heading'] ?? 'Property types' }}" 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >
          </div>

          @php
            $propTypesList = !empty($project['property_types']) && is_array($project['property_types'])
              ? $project['property_types']
              : [
                  ['title' => '4 Bedroom Townhouse', 'type' => 'Townhouse', 'beds' => '4 Bedroom', 'size' => '2,789 sq ft', 'price' => 'AED 5,060,000'],
                  ['title' => '4 Bedroom Townhouse', 'type' => 'Townhouse', 'beds' => '4 Bedroom', 'size' => '2,789 sq ft', 'price' => 'AED 5,060,000'],
                  ['title' => '4 Bedroom Townhouse', 'type' => 'Townhouse', 'beds' => '4 Bedroom', 'size' => '2,789 sq ft', 'price' => 'AED 5,060,000'],
                ];
          @endphp

          <div id="property-types-container" class="space-y-3.5">
            @foreach($propTypesList as $idx => $pt)
              <div class="pt-row-item bg-[#FAF8F5] border border-slate-200 rounded-2xl p-4 space-y-3">
                <div class="flex items-center justify-between">
                  <span class="text-[11px] font-bold text-[#C5A47E] uppercase tracking-wider pt-num-badge">Unit Type #{{ $idx + 1 }}</span>
                  <button 
                    type="button" 
                    onclick="this.closest('.pt-row-item').remove(); renumberPropertyTypes();" 
                    class="text-xs font-semibold text-rose-500 hover:text-rose-700 cursor-pointer"
                  >
                    Delete ✕
                  </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3">
                  <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Row Title</label>
                    <input type="text" name="pt_title[]" value="{{ $pt['title'] ?? '' }}" placeholder="4 Bedroom Townhouse" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-bold text-slate-800 focus:outline-none focus:border-[#C5A47E]">
                  </div>
                  <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Property Type</label>
                    <input type="text" name="pt_type[]" value="{{ $pt['type'] ?? '' }}" placeholder="Townhouse" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-[#C5A47E]">
                  </div>
                  <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Bedrooms</label>
                    <input type="text" name="pt_beds[]" value="{{ $pt['beds'] ?? '' }}" placeholder="4 Bedroom" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-[#C5A47E]">
                  </div>
                  <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Area (sq ft)</label>
                    <input type="text" name="pt_size[]" value="{{ $pt['size'] ?? '' }}" placeholder="2,789 sq ft" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-[#C5A47E]">
                  </div>
                  <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Starting Price</label>
                    <input type="text" name="pt_price[]" value="{{ $pt['price'] ?? '' }}" placeholder="AED 5,060,000" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-semibold text-[#0E3B2C] focus:outline-none focus:border-[#C5A47E]">
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        {{-- TAB 6: SIMILAR PROJECTS (2-Column Drag & Drop without CMS card images) --}}
        <div data-tab-content="similar_projects" class="tab-pane hidden space-y-6">
          <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <div>
              <h2 class="font-heading font-medium text-xl text-[#10221C]">Similar Projects Assignment</h2>
              <p class="text-xs text-slate-400 mt-0.5">Drag projects from <strong>Column A</strong> into <strong>Column S</strong> to show in the Similar Project stack on the right side of Property Types.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
              Drag &amp; Drop Active
            </span>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Section Heading</label>
            <input 
              type="text" 
              name="similar_heading" 
              value="{{ $project['similar_heading'] ?? 'Similar Project' }}" 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >
          </div>

          @php
            $selectedSimSlugs = !empty($project['assigned_similar_projects']) && is_array($project['assigned_similar_projects'])
              ? $project['assigned_similar_projects']
              : ['the-fairway-villa', 'maple-row-villa', 'nara-townhouse', 'the-oasis-by-emaar'];

            $allSimCatalog = [];
            foreach ($allOffplanProjects as $op) {
              $allSimCatalog[$op['slug']] = [
                'slug' => $op['slug'],
                'name' => $op['name'],
                'location' => $op['location'] ?? 'Dubai',
                'price' => $op['price'] ?? 'AED 4,000,000',
                'badge' => $op['badge'] ?? 'OFF-PLAN',
              ];
            }
            foreach ($allReadyProjects as $rp) {
              if (!isset($allSimCatalog[$rp['slug']])) {
                $allSimCatalog[$rp['slug']] = [
                  'slug' => $rp['slug'],
                  'name' => $rp['name'],
                  'location' => $rp['location'] ?? 'Dubai',
                  'price' => $rp['price'] ?? 'AED 4,000,000',
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

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start font-inter">
            {{-- COLUMN A --}}
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

              <div id="dropzone-sim-a" class="min-h-[300px] space-y-2.5 p-1" ondragover="allowDrop(event)" ondrop="dropSimilar(event, 'a')">
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
                    <span class="text-slate-400 text-xs shrink-0 cursor-grab">⋮⋮</span>
                  </div>
                @endforeach
              </div>
            </div>

            {{-- COLUMN S --}}
            <div class="bg-white rounded-[18px] border-2 border-[#C5A47E]/40 p-4 shadow-xs">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                  <span class="w-6 h-6 rounded-lg bg-[#C5A47E] text-white text-xs font-bold flex items-center justify-center">S</span>
                  <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Column S (Show on Project Page)</h4>
                </div>
                <span id="col-sim-s-count" class="text-[11px] font-bold text-[#0E3B2C] bg-[#FAF8F5] px-2.5 py-0.5 rounded-full border border-[#C5A47E]/30">
                  {{ count($selectedSimList) }} assigned
                </span>
              </div>

              <div id="dropzone-sim-s" class="min-h-[300px] space-y-2.5 p-1 rounded-xl bg-slate-50/50 border border-dashed border-slate-200" ondragover="allowDrop(event)" ondrop="dropSimilar(event, 's')">
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

          <div id="selected-sim-inputs">
            @foreach($selectedSimList as $item)
              <input type="hidden" name="selected_similar_projects[]" value="{{ $item['slug'] }}">
            @endforeach
          </div>
        </div>

        {{-- TAB 7: AMENITIES (Database Library Dropdown + Checkboxes Grid) --}}
        <div data-tab-content="amenities" class="tab-pane hidden space-y-6">
          <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
              <h2 class="font-heading font-medium text-xl text-[#10221C]">Select Amenities &amp; Facilities</h2>
              <p class="text-xs text-slate-400 mt-0.5">Select amenities from the database library to display on the project detail page.</p>
            </div>
            <a 
              href="{{ route('admin.amenities') }}" 
              target="_blank" 
              class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#FAF8F5] text-[#C5A47E] hover:bg-[#F2ECE3] border border-[#C5A47E]/30 text-xs font-bold transition-colors"
            >
              + Manage / Add New Amenity ↗
            </a>
          </div>

          @php
            $assignedAmenities = !empty($project['assigned_amenities']) && is_array($project['assigned_amenities'])
              ? $project['assigned_amenities']
              : ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'];
          @endphp

          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Section Heading</label>
            <input 
              type="text" 
              name="amenities_heading" 
              value="{{ $project['amenities_heading'] ?? 'Amenities & Facilities' }}" 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >
          </div>

          <div class="space-y-2">
            <label class="block text-xs font-semibold text-slate-700">Add Amenity from Database Library</label>
            <div class="flex gap-3">
              <select id="amenity-select-dropdown" class="flex-1 bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
                <option value="">-- Choose an Amenity to add --</option>
                @foreach($allAmenities as $amItem)
                  <option value="{{ $amItem['key'] }}">{{ $amItem['name'] }}</option>
                @endforeach
              </select>
              <button 
                type="button" 
                onclick="addAmenityFromDropdown()" 
                class="px-5 py-3 rounded-xl bg-[#0E3B2C] hover:bg-[#16503c] text-white text-xs font-bold transition-colors shadow-xs cursor-pointer shrink-0"
              >
                + Add to Page
              </button>
            </div>
          </div>

          <div class="space-y-3 pt-2">
            <label class="block text-xs font-semibold text-slate-700">Active Amenities for this Project</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
              @foreach($allAmenities as $am)
                @php $isChecked = in_array($am['key'], $assignedAmenities); @endphp
                <label 
                  id="amenity-card-{{ $am['key'] }}" 
                  class="flex items-center gap-3.5 p-3.5 rounded-xl border {{ $isChecked ? 'border-[#C5A47E] bg-[#FAF8F5]' : 'border-slate-200 bg-white opacity-60' }} hover:opacity-100 hover:border-[#C5A47E] transition-all cursor-pointer shadow-2xs"
                >
                  <input 
                    type="checkbox" 
                    name="selected_amenities[]" 
                    value="{{ $am['key'] }}" 
                    {{ $isChecked ? 'checked' : '' }} 
                    class="rounded text-[#0E3B2C] focus:ring-[#C5A47E] w-4 h-4 border-slate-300"
                    onchange="toggleAmenityCardStyle('{{ $am['key'] }}', this.checked)"
                  >
                  <div class="w-8 h-8 shrink-0 flex items-center justify-center p-1 bg-white rounded-lg border border-slate-200">
                    <img src="{{ asset($am['img']) }}" alt="{{ $am['name'] }}" class="w-full h-full object-contain">
                  </div>
                  <span class="text-xs font-semibold text-slate-800 leading-snug flex-1">{{ $am['name'] }}</span>
                </label>
              @endforeach
            </div>
          </div>
        </div>

        {{-- TAB 8: LOCATION (Latitude & Longitude Text Boxes) --}}
        <div data-tab-content="location" class="tab-pane hidden space-y-6">
          <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <div>
              <h2 class="font-heading font-medium text-xl text-[#10221C]">Map View Coordinates (Latitude &amp; Longitude)</h2>
              <p class="text-xs text-slate-400 mt-0.5">Enter Latitude and Longitude coordinates to set the interactive map on the frontend.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
              Lat / Long Map Sync
            </span>
          </div>

          <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-5 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2">Latitude</label>
                <input 
                  type="text" 
                  name="latitude" 
                  value="{{ $project['latitude'] ?? '24.8962' }}" 
                  placeholder="e.g. 24.8962"
                  class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-mono text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                >
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2">Longitude</label>
                <input 
                  type="text" 
                  name="longitude" 
                  value="{{ $project['longitude'] ?? '55.1614' }}" 
                  placeholder="e.g. 55.1614"
                  class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-mono text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                >
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
              <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2">Section Heading</label>
                <input 
                  type="text" 
                  name="location_heading" 
                  value="{{ $project['location_heading'] ?? 'Map View' }}" 
                  class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                >
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2">Address / Location Subtitle</label>
                <input 
                  type="text" 
                  name="location_text" 
                  value="{{ $project['location_text'] ?? 'Fairways Vistas, Dubai Hills Estate, Dubai, UAE' }}" 
                  class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                >
              </div>
            </div>
          </div>
        </div>

        {{-- TAB 9: PAYMENT PLAN (3 Milestones + Disclaimer) --}}
        <div data-tab-content="payment_plan" class="tab-pane hidden space-y-6">
          <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <div>
              <h2 class="font-heading font-medium text-xl text-[#10221C]">Payment Plan Milestones</h2>
              <p class="text-xs text-slate-400 mt-0.5">Configure the 3 payment plan milestones (On Booking, During Construction, On Handover) and disclaimer note.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
              3 Steps Timeline
            </span>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-1.5">Banner Heading</label>
              <input type="text" name="payment_heading" value="{{ $project['payment_heading'] ?? 'Payment Plan' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-1.5">Banner Subtitle</label>
              <input type="text" name="payment_subtitle" value="{{ $project['payment_subtitle'] ?? 'For 1 Bedroom · AED 1,250,000' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-1.5">Right Options Label</label>
              <input type="text" name="payment_options_label" value="{{ $project['payment_options_label'] ?? '3 Options' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Step 1 --}}
            <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-4 space-y-3">
              <div class="text-xs font-bold text-[#C5A47E] uppercase">Step 1 (On Booking)</div>
              <div>
                <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Percentage (%)</label>
                <input type="number" name="payment_step1_pct" value="{{ $project['payment_step1_pct'] ?? '20' }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-bold text-slate-800">
              </div>
              <div>
                <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Title</label>
                <input type="text" name="payment_step1_title" value="{{ $project['payment_step1_title'] ?? 'On Booking' }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-semibold text-slate-800">
              </div>
              <div>
                <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Subtitle</label>
                <input type="text" name="payment_step1_sub" value="{{ $project['payment_step1_sub'] ?? 'Step 1 · 20% paid' }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-600">
              </div>
            </div>

            {{-- Step 2 --}}
            <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-4 space-y-3">
              <div class="text-xs font-bold text-[#0E3B2C] uppercase">Step 2 (During Construction)</div>
              <div>
                <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Percentage (%)</label>
                <input type="number" name="payment_step2_pct" value="{{ $project['payment_step2_pct'] ?? '40' }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-bold text-slate-800">
              </div>
              <div>
                <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Title</label>
                <input type="text" name="payment_step2_title" value="{{ $project['payment_step2_title'] ?? 'During Construction' }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-semibold text-slate-800">
              </div>
              <div>
                <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Subtitle</label>
                <input type="text" name="payment_step2_sub" value="{{ $project['payment_step2_sub'] ?? 'Step 2 · 60% paid' }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-600">
              </div>
            </div>

            {{-- Step 3 --}}
            <div class="bg-[#FAF8F5] border border-slate-200 rounded-2xl p-4 space-y-3">
              <div class="text-xs font-bold text-slate-600 uppercase">Step 3 (On Handover)</div>
              <div>
                <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Percentage (%)</label>
                <input type="number" name="payment_step3_pct" value="{{ $project['payment_step3_pct'] ?? '40' }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-bold text-slate-800">
              </div>
              <div>
                <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Title</label>
                <input type="text" name="payment_step3_title" value="{{ $project['payment_step3_title'] ?? 'On Handover' }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-semibold text-slate-800">
              </div>
              <div>
                <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Subtitle</label>
                <input type="text" name="payment_step3_sub" value="{{ $project['payment_step3_sub'] ?? 'Step 3 · 100% paid' }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-600">
              </div>
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Payment Plan Disclaimer Text Box</label>
            <textarea name="payment_disclaimer" rows="3" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl p-4 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">{{ $project['payment_disclaimer'] ?? '' }}</textarea>
          </div>
        </div>

        {{-- TAB 10: FULL CONTENT (Summernote Rich Text Editor) --}}
        <div data-tab-content="full_content" class="tab-pane hidden space-y-5">
          <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <div>
              <h2 class="font-heading font-medium text-xl text-[#10221C]">Full Content (SEO Text Block)</h2>
              <p class="text-xs text-slate-400 mt-0.5">Write formatted SEO content using the Summernote editor.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#0E3B2C] border border-[#0E3B2C]/20">
              Summernote Active
            </span>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Full Content</label>
            @php
              $cleanEditorFc = preg_replace('/(<(?:p|h[1-6])\b[^>]*?)\sstyle="[^"]*"/i', '$1', $project['full_content'] ?? '');
            @endphp
            <textarea name="full_content" class="summernote-editor w-full">{!! $cleanEditorFc !!}</textarea>
          </div>
        </div>

        {{-- TAB 11: FAQS (Dynamic Add / Edit / Delete) --}}
        <div data-tab-content="faqs" class="tab-pane hidden space-y-6">
          <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <div>
              <h2 class="font-heading font-medium text-xl text-[#10221C]">Frequently Asked Questions</h2>
              <p class="text-xs text-slate-400 mt-0.5">Add, edit, or delete questions and answers for this project.</p>
            </div>
            <button 
              type="button" 
              onclick="addFaqRow()" 
              class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#0E3B2C] hover:bg-[#16503c] text-white text-xs font-bold shadow-xs transition-colors cursor-pointer"
            >
              + Add FAQ Question
            </button>
          </div>

          @php
            $projectFaqs = !empty($project['faqs']) && is_array($project['faqs']) ? $project['faqs'] : [];
          @endphp

          <div id="faq-list-container" class="space-y-4">
            @foreach($projectFaqs as $idx => $faq)
              <div class="faq-row-item bg-[#FAF8F5] border border-slate-200 rounded-2xl p-4 sm:p-5 relative space-y-3">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-bold text-[#C5A47E] uppercase tracking-wider faq-num-badge">FAQ #{{ $idx + 1 }}</span>
                  <button 
                    type="button" 
                    onclick="this.closest('.faq-row-item').remove(); renumberFaqs();" 
                    class="text-slate-400 hover:text-rose-600 text-xs font-semibold transition-colors cursor-pointer"
                  >
                    Delete ✕
                  </button>
                </div>

                <div>
                  <label class="block text-[11px] font-semibold text-slate-600 uppercase tracking-wider mb-1">Question</label>
                  <input type="text" name="faq_q[]" value="{{ $faq['q'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]">
                </div>

                <div>
                  <label class="block text-[11px] font-semibold text-slate-600 uppercase tracking-wider mb-1">Answer</label>
                  <textarea name="faq_a[]" rows="2" class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs sm:text-[13px] text-slate-700 focus:outline-none focus:border-[#C5A47E]">{{ $faq['a'] ?? '' }}</textarea>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        {{-- Save Button --}}
        <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
          <button type="submit" class="px-6 py-3 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors cursor-pointer">
            Save Changes to {{ $project['name'] }}
          </button>

          <a href="{{ $project['url'] }}" target="_blank" class="text-xs font-semibold text-blue-600 hover:underline">
            View Live Page ↗
          </a>
        </div>

      </form>

    </div>

  </div>

</div>

<script>
  function allowDrop(ev) {
    ev.preventDefault();
  }

  function previewUploadedImage(input, previewId) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const preview = document.getElementById(previewId);
        if (preview) preview.src = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  // Dynamic USPs
  function addUspField(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    const div = document.createElement('div');
    div.className = 'usp-item-row flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-3 py-2 shadow-2xs focus-within:border-[#C5A47E]';
    div.innerHTML = `
      <span class="text-[11px] font-bold text-[#C5A47E] shrink-0">USP</span>
      <input type="text" name="usps[]" placeholder="e.g. Prime Golf Views" class="w-full text-xs sm:text-[13px] font-semibold text-slate-800 bg-transparent focus:outline-none">
      <button type="button" onclick="removeUspField(this)" class="text-slate-400 hover:text-rose-600 text-xs font-bold px-1 cursor-pointer">✕</button>
    `;
    container.appendChild(div);
    div.querySelector('input').focus();
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

  // Dynamic Property Types
  function addPropertyTypeRow() {
    const container = document.getElementById('property-types-container');
    if (!container) return;
    const count = container.querySelectorAll('.pt-row-item').length + 1;
    const div = document.createElement('div');
    div.className = 'pt-row-item bg-[#FAF8F5] border border-slate-200 rounded-2xl p-4 space-y-3';
    div.innerHTML = `
      <div class="flex items-center justify-between">
        <span class="text-[11px] font-bold text-[#C5A47E] uppercase tracking-wider pt-num-badge">Unit Type #${count}</span>
        <button type="button" onclick="this.closest('.pt-row-item').remove(); renumberPropertyTypes();" class="text-xs font-semibold text-rose-500 hover:text-rose-700 cursor-pointer">Delete ✕</button>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3">
        <div>
          <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Row Title</label>
          <input type="text" name="pt_title[]" value="4 Bedroom Townhouse" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-bold text-slate-800">
        </div>
        <div>
          <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Property Type</label>
          <input type="text" name="pt_type[]" value="Townhouse" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-700">
        </div>
        <div>
          <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Bedrooms</label>
          <input type="text" name="pt_beds[]" value="4 Bedroom" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-700">
        </div>
        <div>
          <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Area (sq ft)</label>
          <input type="text" name="pt_size[]" value="2,789 sq ft" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-700">
        </div>
        <div>
          <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-1">Starting Price</label>
          <input type="text" name="pt_price[]" value="AED 5,060,000" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-semibold text-[#0E3B2C]">
        </div>
      </div>
    `;
    container.appendChild(div);
  }

  function renumberPropertyTypes() {
    document.querySelectorAll('.pt-num-badge').forEach((b, i) => {
      b.textContent = 'Unit Type #' + (i + 1);
    });
  }

  // Similar Projects Drag & Drop
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
    } else {
      draggedEl.classList.remove('border-[#C5A47E]');
      draggedEl.classList.add('border-slate-200');
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

  // Amenities Helpers
  function toggleAmenityCardStyle(key, isChecked) {
    const card = document.getElementById('amenity-card-' + key);
    if (!card) return;
    if (isChecked) {
      card.classList.remove('opacity-60', 'border-slate-200', 'bg-white');
      card.classList.add('border-[#C5A47E]', 'bg-[#FAF8F5]', 'opacity-100');
    } else {
      card.classList.remove('border-[#C5A47E]', 'bg-[#FAF8F5]', 'opacity-100');
      card.classList.add('opacity-60', 'border-slate-200', 'bg-white');
    }
  }

  function addAmenityFromDropdown() {
    const select = document.getElementById('amenity-select-dropdown');
    if (!select || !select.value) return;
    const key = select.value;
    const card = document.getElementById('amenity-card-' + key);
    if (card) {
      const checkbox = card.querySelector('input[type="checkbox"]');
      if (checkbox) {
        checkbox.checked = true;
        toggleAmenityCardStyle(key, true);
      }
    }
    select.value = '';
  }

  // FAQ Helpers
  function addFaqRow() {
    const container = document.getElementById('faq-list-container');
    if (!container) return;
    const count = container.querySelectorAll('.faq-row-item').length + 1;
    const row = document.createElement('div');
    row.className = 'faq-row-item bg-[#FAF8F5] border border-slate-200 rounded-2xl p-4 sm:p-5 relative space-y-3';
    row.innerHTML = `
      <div class="flex items-center justify-between">
        <span class="text-xs font-bold text-[#C5A47E] uppercase tracking-wider faq-num-badge">FAQ #${count}</span>
        <button type="button" onclick="this.closest('.faq-row-item').remove(); renumberFaqs();" class="text-slate-400 hover:text-rose-600 text-xs font-semibold cursor-pointer">Delete ✕</button>
      </div>
      <div>
        <label class="block text-[11px] font-semibold text-slate-600 uppercase tracking-wider mb-1">Question</label>
        <input type="text" name="faq_q[]" placeholder="Enter question..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]">
      </div>
      <div>
        <label class="block text-[11px] font-semibold text-slate-600 uppercase tracking-wider mb-1">Answer</label>
        <textarea name="faq_a[]" rows="2" placeholder="Enter answer..." class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs sm:text-[13px] text-slate-700 focus:outline-none focus:border-[#C5A47E]"></textarea>
      </div>
    `;
    container.appendChild(row);
  }

  function renumberFaqs() {
    document.querySelectorAll('.faq-num-badge').forEach((b, idx) => {
      b.innerText = `FAQ #${idx + 1}`;
    });
  }

  document.addEventListener('DOMContentLoaded', function() {
    if (typeof $ !== 'undefined' && $.fn.summernote) {
      $('.summernote-editor').summernote({
        height: 260,
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

    const tabs = document.querySelectorAll('[data-editor-tab]');
    const panes = document.querySelectorAll('[data-tab-content]');

    tabs.forEach(tab => {
      tab.addEventListener('click', function() {
        const target = this.getAttribute('data-editor-tab');

        tabs.forEach(t => {
          t.classList.remove('bg-[#F2ECE3]', 'text-[#10221C]', 'border-l-4', 'border-[#C5A47E]', 'font-bold');
          t.classList.add('text-slate-600');
        });

        this.classList.add('bg-[#F2ECE3]', 'text-[#10221C]', 'border-l-4', 'border-[#C5A47E]', 'font-bold');
        this.classList.remove('text-slate-600');

        panes.forEach(p => {
          if (p.getAttribute('data-tab-content') === target) {
            p.classList.remove('hidden');
          } else {
            p.classList.add('hidden');
          }
        });
      });
    });
  });
</script>
@endsection
