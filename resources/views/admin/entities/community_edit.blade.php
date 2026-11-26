@extends('layouts.admin')

@section('content')
<div class="space-y-6 font-inter">

  {{-- Header: Update Community Title + Live Page URL + Status dropdown --}}
  <div class="bg-white rounded-[16px] border border-slate-100 p-5 sm:p-6 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight">
        {{ !empty($isNew) ? 'Add New Community' : 'Update Community — ' . ($community['name'] ?? '') }}
      </h1>
      @if(empty($isNew))
        <p class="text-xs text-slate-500 font-medium mt-1">
          Page URL: <a href="{{ $community['url'] }}" target="_blank" class="text-blue-600 hover:underline">{{ url($community['url']) }}</a>
        </p>
      @else
        <p class="text-xs text-slate-500 font-medium mt-1">
          Fill out the 9-tab Community template below so every Community page shares the same design.
        </p>
      @endif
    </div>

    <div class="flex items-center gap-3">
      {{-- Status Selector --}}
      <div class="relative">
        <select onchange="document.getElementById('community-status-hidden').value = this.value" class="appearance-none bg-white border border-slate-200 rounded-xl px-4 py-2 pr-8 text-xs font-bold text-emerald-600 focus:outline-none focus:border-emerald-500 cursor-pointer">
          <option value="DRAFT" {{ ($community['status'] ?? 'DRAFT') === 'DRAFT' ? 'selected' : '' }}>DRAFT</option>
          <option value="PUBLISHED" {{ ($community['status'] ?? '') === 'PUBLISHED' ? 'selected' : '' }}>PUBLISHED</option>
        </select>
        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </div>
      </div>

      <a href="{{ route('admin.communities') }}" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
        Back
      </a>
    </div>
  </div>

  {{-- Two Column Editor Layout: Left Vertical Tabs + Right Form Content --}}
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
    
    {{-- Left Sidebar: Form Section Tabs matching screenshot --}}
    <aside class="lg:col-span-3 space-y-2">
      @php
        $editorTabs = [
          ['id' => 'basic', 'label' => 'Basic Detail', 'active' => true],
          ['id' => 'hero', 'label' => 'Hero Section', 'active' => false],
          ['id' => 'offplan', 'label' => 'Content Section', 'active' => false],
          ['id' => 'sale', 'label' => 'Community Highlight', 'active' => false],
          ['id' => 'about', 'label' => 'Offplan Projects', 'active' => false],
          ['id' => 'why', 'label' => 'Ready Projects', 'active' => false],
          ['id' => 'content', 'label' => 'Amenities', 'active' => false],
          ['id' => 'full_content', 'label' => 'Full Content', 'active' => false],
          ['id' => 'faqs', 'label' => 'FAQS', 'active' => false],
        ];
      @endphp

      <div class="bg-white rounded-[16px] border border-slate-100 p-2 shadow-xs space-y-1">
        @foreach($editorTabs as $tab)
          <button 
            type="button" 
            data-editor-tab="{{ $tab['id'] }}"
            class="editor-nav-tab w-full text-left px-4 py-3 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer {{ $tab['active'] ? 'bg-[#F2ECE3] text-[#10221C] border-l-4 border-[#C5A47E] font-bold' : 'text-slate-600 hover:bg-slate-50' }}"
          >
            {{ $tab['label'] }}
          </button>
        @endforeach
      </div>
    </aside>

    {{-- Right Form Panel Container --}}
    <div class="lg:col-span-9 bg-white rounded-[16px] border border-slate-100 p-6 sm:p-8 shadow-xs">
      
      <form action="{{ !empty($isNew) ? route('admin.communities.store') : route('admin.communities.update', $community['slug']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="status" id="community-status-hidden" value="{{ $community['status'] ?? 'DRAFT' }}">

        {{-- TAB 1: BASIC DETAIL --}}
        <div data-tab-content="basic" class="tab-pane space-y-5">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- Community Name --}}
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Community Name *</label>
              <input 
                type="text" 
                name="name" 
                id="comm-name-input"
                value="{{ old('name', $community['name']) }}" 
                required
                placeholder="e.g. Dubai Creek Harbour"
                class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
              >
            </div>

            {{-- Slug --}}
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Slug</label>
              <input 
                type="text" 
                name="slug" 
                id="comm-slug-input"
                value="{{ old('slug', $community['slug']) }}" 
                placeholder="auto-generated-from-name"
                class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
              >
            </div>

            {{-- City Dropdown --}}
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">City</label>
              <div class="relative">
                <select name="city" class="w-full appearance-none bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
                  <option value="Dubai" {{ $community['city'] === 'Dubai' ? 'selected' : '' }}>Dubai</option>
                  <option value="Abu Dhabi" {{ $community['city'] === 'Abu Dhabi' ? 'selected' : '' }}>Abu Dhabi</option>
                  <option value="Sharjah" {{ $community['city'] === 'Sharjah' ? 'selected' : '' }}>Sharjah</option>
                </select>
                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
              </div>
            </div>

            {{-- Meta Title --}}
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Meta Title</label>
              <input 
                type="text" 
                name="meta_title" 
                value="{{ $community['meta_title'] ?? (!empty($community['name']) ? 'Properties for sale in ' . $community['name'] . ' | Top Off Plan Properties' : '') }}" 
                class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
              >
            </div>
          </div>

          {{-- Meta Keyword --}}
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Meta Keyword</label>
            <input 
              type="text" 
              name="meta_keywords" 
              placeholder="Enter Meta Keyword" 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >
          </div>

          {{-- Meta Description --}}
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Meta Description</label>
            <textarea 
              name="meta_description" 
              rows="3" 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl p-4 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >Looking for properties in {{ $community['name'] }}? Check out top off-plan listings and find your dream luxury home with ease.</textarea>
          </div>

          {{-- OG Image Upload Box matching screenshot --}}
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">OG Image</label>
            <div class="w-48 h-36 border-2 border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center text-slate-300 hover:border-[#C5A47E] transition-colors cursor-pointer bg-[#FAF8F5]">
              <svg class="w-10 h-10 stroke-current mb-1" fill="none" viewBox="0 0 24 24">
                <rect x="3" y="3" width="18" height="18" rx="2" stroke-width="1.5"/>
                <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"/>
                <path d="M21 15l-5-5L5 21" stroke-width="1.5"/>
              </svg>
              <span class="text-[11px] text-slate-400 font-medium">Click to upload</span>
            </div>
          </div>
        </div>

        {{-- TAB 2: HERO SECTION --}}
        <div data-tab-content="hero" class="tab-pane hidden space-y-6">
          
          {{-- 1. Breadcrumbs --}}
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Breadcrumbs</label>
            <input 
              type="text" 
              name="breadcrumbs" 
              value="{{ $community['breadcrumbs'] ?? 'HOME > COMMUNITIES' }}" 
              placeholder="e.g. HOME > COMMUNITIES" 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >
          </div>

          {{-- 2. Hero Heading --}}
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Hero Heading</label>
            <input 
              type="text" 
              name="hero_heading" 
              value="{{ $community['hero_heading'] ?? ($community['name'] . ' Dubai') }}" 
              placeholder="e.g. The Valley Dubai" 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >
          </div>

          {{-- 3. Hero Description --}}
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Hero Description</label>
            <textarea 
              name="hero_subtext" 
              rows="3" 
              placeholder="Enter hero description..." 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl p-4 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >{{ $community['hero_subtext'] ?? 'Green open spaces, real amenities and the numbers behind each villa community.' }}</textarea>
          </div>

          {{-- 4. Hero Background Image Option (Uploaded Image Card with Browse button matching reference) --}}
          <div>
            <div class="flex items-center justify-between mb-2">
              <label class="block text-xs font-semibold text-slate-700">Cover Image <span class="text-rose-500">*</span></label>
              <span class="text-[11px] text-slate-400">Allowed file types: png, jpg, jpeg, svg, webp.</span>
            </div>

            {{-- Image Preview Card with Browse Button in top right --}}
            <div class="relative w-full max-w-[480px] h-[260px] rounded-[16px] overflow-hidden border border-slate-200 bg-[#FAF8F5] shadow-xs group">
              <img 
                id="hero-img-preview"
                src="{{ asset($community['hero_img'] ?? 'images/communities-hero-villa.jpg') }}" 
                alt="Cover Image Preview" 
                class="w-full h-full object-cover"
                onerror="this.src='{{ asset('images/communities-hero-villa.jpg') }}'"
              >

              {{-- Hidden File Input --}}
              <input 
                type="file" 
                id="hero-img-file" 
                name="hero_img_file" 
                accept="image/*" 
                class="hidden" 
                onchange="previewUploadedImage(this, 'hero-img-preview')"
              >
              <input 
                type="hidden" 
                name="hero_img" 
                value="{{ $community['hero_img'] ?? 'images/communities-hero-villa.jpg' }}"
              >

              {{-- Browse Button Overlay (Replacing pencil icon) --}}
              <button 
                type="button" 
                onclick="document.getElementById('hero-img-file').click()" 
                class="absolute top-3 right-3 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/95 hover:bg-white text-slate-700 hover:text-emerald-700 shadow-md border border-slate-200 text-xs font-bold transition-all cursor-pointer backdrop-blur-xs hover:scale-105"
                title="Browse Image from Laptop"
              >
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Browse</span>
              </button>
            </div>
          </div>

          {{-- 5. Form Option --}}
          <div class="pt-2 border-t border-slate-100 space-y-4">
            <div class="flex items-center justify-between">
              <div>
                <label class="block text-xs font-semibold text-slate-700">Display Hero Enquiry Form</label>
                <p class="text-[11px] text-slate-400">Show right-side consultation / enquiry card overlay in the hero</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input 
                  type="checkbox" 
                  name="show_form" 
                  value="1" 
                  class="sr-only peer" 
                  {{ (!isset($community['show_form']) || $community['show_form']) ? 'checked' : '' }}
                >
                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0E3B2C]"></div>
              </label>
            </div>

            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Form Card Title</label>
              <input 
                type="text" 
                name="form_title" 
                value="{{ $community['form_title'] ?? ('Enquire about ' . ($community['hero_heading'] ?? $community['name'])) }}" 
                placeholder="e.g. Enquire about The Valley Dubai" 
                class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
              >
            </div>
          </div>

        </div>

        {{-- TAB 3: CONTENT SECTION (Changed from Off Plan Property) --}}
        <div data-tab-content="offplan" class="tab-pane hidden space-y-6">
          
          {{-- Heading --}}
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Section Heading</label>
            <input 
              type="text" 
              name="guide_heading" 
              value="{{ $community['guide_heading'] ?? ($community['name'] . ' Community Guide') }}" 
              placeholder="e.g. The Valley Community Guide" 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >
          </div>

          {{-- Description --}}
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Section Description</label>
            <textarea 
              name="guide_description" 
              rows="4" 
              placeholder="Enter guide description..." 
              class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl p-4 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
            >{{ $community['guide_description'] ?? 'The Valley is a green, family-first community by Emaar — parks, trails, schools and townhouses and villas set around open space. It suits families who want room to grow, and investors who want strong rental demand at an accessible price point.' }}</textarea>
          </div>

          {{-- Media Display Mode: Video, Image, or Hide --}}
          <div class="pt-2 border-t border-slate-100 space-y-4">
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Media Option (Right Side)</label>
              <div class="grid grid-cols-3 gap-3">
                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-slate-200 bg-[#FAF8F5] hover:border-[#C5A47E] cursor-pointer transition-colors">
                  <input 
                    type="radio" 
                    name="media_type" 
                    value="video" 
                    class="text-[#0E3B2C] focus:ring-[#C5A47E]"
                    {{ (!isset($community['media_type']) || $community['media_type'] === 'video') ? 'checked' : '' }}
                    onchange="toggleMediaInputs(this.value)"
                  >
                  <span class="text-xs font-semibold text-slate-800">Show Video</span>
                </label>

                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-slate-200 bg-[#FAF8F5] hover:border-[#C5A47E] cursor-pointer transition-colors">
                  <input 
                    type="radio" 
                    name="media_type" 
                    value="image" 
                    class="text-[#0E3B2C] focus:ring-[#C5A47E]"
                    {{ (isset($community['media_type']) && $community['media_type'] === 'image') ? 'checked' : '' }}
                    onchange="toggleMediaInputs(this.value)"
                  >
                  <span class="text-xs font-semibold text-slate-800">Image Only</span>
                </label>

                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-slate-200 bg-[#FAF8F5] hover:border-[#C5A47E] cursor-pointer transition-colors">
                  <input 
                    type="radio" 
                    name="media_type" 
                    value="hidden" 
                    class="text-[#0E3B2C] focus:ring-[#C5A47E]"
                    {{ (isset($community['media_type']) && $community['media_type'] === 'hidden') ? 'checked' : '' }}
                    onchange="toggleMediaInputs(this.value)"
                  >
                  <span class="text-xs font-semibold text-slate-800">Hide Media</span>
                </label>
              </div>
            </div>

            {{-- Image Upload Card matching reference --}}
            <div id="media-image-group" class="{{ (isset($community['media_type']) && $community['media_type'] === 'hidden') ? 'hidden' : '' }} space-y-2">
              <div class="flex items-center justify-between">
                <label class="block text-xs font-semibold text-slate-700">About / Section Image <span class="text-rose-500">*</span></label>
                <span class="text-[11px] text-slate-400">Allowed file types: png, jpg, jpeg, svg, webp.</span>
              </div>

              <div class="relative w-full max-w-[480px] h-[260px] rounded-[16px] overflow-hidden border border-slate-200 bg-[#FAF8F5] shadow-xs group">
                <img 
                  id="guide-img-preview"
                  src="{{ asset($community['media_image'] ?? 'images/family-park.jpg') }}" 
                  alt="Section Image Preview" 
                  class="w-full h-full object-cover"
                  onerror="this.src='{{ asset('images/family-park.jpg') }}'"
                >

                {{-- Hidden File Input --}}
                <input 
                  type="file" 
                  id="guide-img-file" 
                  name="media_image_file" 
                  accept="image/*" 
                  class="hidden" 
                  onchange="previewUploadedImage(this, 'guide-img-preview')"
                >
                <input 
                  type="hidden" 
                  name="media_image" 
                  value="{{ $community['media_image'] ?? 'images/family-park.jpg' }}"
                >

                {{-- Browse Button Overlay (Replacing pencil icon) --}}
                <button 
                  type="button" 
                  onclick="document.getElementById('guide-img-file').click()" 
                  class="absolute top-3 right-3 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/95 hover:bg-white text-slate-700 hover:text-emerald-700 shadow-md border border-slate-200 text-xs font-bold transition-all cursor-pointer backdrop-blur-xs hover:scale-105"
                  title="Browse Image from Laptop"
                >
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  <span>Browse</span>
                </button>
              </div>
            </div>

            {{-- Video Upload Card (Visible when Video is selected) --}}
            <div id="media-video-group" class="{{ (!isset($community['media_type']) || $community['media_type'] === 'video') ? '' : 'hidden' }} space-y-2">
              <div class="flex items-center justify-between">
                <label class="block text-xs font-semibold text-slate-700">Video File / URL <span class="text-rose-500">*</span></label>
                <span class="text-[11px] text-slate-400">Allowed file types: mp4, webm, or video link.</span>
              </div>

              <div class="relative w-full max-w-[480px] p-4 rounded-[16px] border border-slate-200 bg-[#FAF8F5] shadow-xs space-y-3">
                <div class="flex items-center justify-between">
                  <div class="text-xs font-semibold text-slate-700" id="video-file-label">
                    {{ !empty($community['video_url']) ? basename($community['video_url']) : 'Upload video file from laptop' }}
                  </div>
                  {{-- Browse Video Button --}}
                  <button 
                    type="button" 
                    onclick="document.getElementById('video-file-input').click()" 
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white hover:bg-slate-50 text-slate-700 hover:text-emerald-700 shadow-xs border border-slate-200 text-xs font-bold transition-all cursor-pointer hover:scale-105"
                  >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    <span>Browse Video</span>
                  </button>
                </div>

                <input 
                  type="file" 
                  id="video-file-input" 
                  name="video_file" 
                  accept="video/mp4,video/webm" 
                  class="hidden" 
                  onchange="if(this.files[0]) document.getElementById('video-file-label').innerText = this.files[0].name"
                >
                <input 
                  type="hidden" 
                  name="video_url" 
                  value="{{ $community['video_url'] ?? '' }}"
                >
              </div>
            </div>
          </div>

          {{-- Feature Stats Bar (8 Boxes in 4 Pairs: Upper & Lower text) --}}
          <div class="pt-6 border-t border-slate-100 space-y-4">
            <div>
              <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">Feature Bar (4 Pairs)</label>
              <p class="text-[11px] text-slate-400 mt-0.5">Upper box holds primary value/title and lower box holds subtitle/details</p>
            </div>

            @php
              $featureDefaults = [
                ['upper' => '7,000+', 'lower' => 'Acres planned'],
                ['upper' => 'Residential', 'lower' => 'Villas, townhouses.'],
                ['upper' => 'Green Spaces', 'lower' => 'Parks, lakes and trails'],
                ['upper' => 'Integrated', 'lower' => 'Live, work, shop and relax'],
              ];
              $features = $community['features'] ?? $featureDefaults;
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
              @for($i = 0; $i < 4; $i++)
                @php 
                  $item = $features[$i] ?? ($featureDefaults[$i] ?? ['upper' => '', 'lower' => '']); 
                @endphp
                <div class="bg-[#FAF8F5] border border-slate-200 rounded-xl p-3.5 space-y-2">
                  <div class="text-[11px] font-bold text-[#C5A47E] uppercase tracking-wider">Feature #{{ $i + 1 }}</div>
                  
                  {{-- Upper Box --}}
                  <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Upper Text</label>
                    <input 
                      type="text" 
                      name="features_upper[]" 
                      value="{{ $item['upper'] }}" 
                      placeholder="e.g. 7,000+" 
                      class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                    >
                  </div>

                  {{-- Lower Box (Closely placed) --}}
                  <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Lower Text</label>
                    <input 
                      type="text" 
                      name="features_lower[]" 
                      value="{{ $item['lower'] }}" 
                      placeholder="e.g. Acres planned" 
                      class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-600 focus:outline-none focus:border-[#C5A47E]"
                    >
                  </div>
                </div>
              @endfor
            </div>
          </div>

        </div>

        <div data-tab-content="sale" class="tab-pane hidden space-y-4">
          <p class="text-xs font-semibold text-slate-700">Sale Properties for {{ $community['name'] }}</p>
          <div class="p-4 bg-[#FAF8F5] rounded-xl border border-slate-200 text-xs text-slate-600">Configure ready-to-move villas and townhouses in this community.</div>
        </div>

        {{-- TAB 5: OFFPLAN PROJECTS (2 Column Drag & Drop: Column A -> Column S) --}}
        <div data-tab-content="about" class="tab-pane hidden space-y-6">
          
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-slate-100">
            <div>
              <h3 class="text-sm font-bold text-slate-800">Offplan Projects Assignment</h3>
              <p class="text-xs text-slate-400">Drag projects from <strong>Column A (All Offplan Projects)</strong> into <strong>Column S (Selected for this Community)</strong></p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
              Drag &amp; Drop Active
            </span>
          </div>

          @php
            $assignedSlugs = $community['assigned_offplan_projects'] ?? ['nara-townhouse', 'the-fairway-villa'];
            $allProjects = $allOffplanProjects ?? \App\Http\Controllers\Admin\EntityController::getAvailableOffplanProjects();
            
            $availableList = [];
            $selectedList = [];

            foreach ($allProjects as $proj) {
              if (in_array($proj['slug'], $assignedSlugs)) {
                $selectedList[] = $proj;
              } else {
                $availableList[] = $proj;
              }
            }
          @endphp

          {{-- Drag & Drop 2 Columns Grid: Column A & Column S --}}
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start font-inter">
            
            {{-- COLUMN A: ALL OFFPLAN PROJECTS --}}
            <div class="bg-[#FAF8F5] rounded-[18px] border-2 border-dashed border-slate-200 p-4 sm:p-5">
              <div class="flex items-center justify-between mb-3.5">
                <div class="flex items-center gap-2">
                  <span class="w-6 h-6 rounded-lg bg-[#0E3B2C] text-white text-xs font-bold flex items-center justify-center">A</span>
                  <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700">Column A (Available Projects)</h4>
                </div>
                <span id="col-a-count" class="text-[11px] font-semibold text-slate-400 bg-white px-2.5 py-0.5 rounded-full border border-slate-200">
                  {{ count($availableList) }} items
                </span>
              </div>

              {{-- Drop Zone A --}}
              <div 
                id="dropzone-a" 
                class="min-h-[380px] space-y-3 p-1 transition-colors"
                ondragover="allowDrop(event)" 
                ondrop="drop(event, 'a')"
              >
                @foreach($availableList as $item)
                  <div 
                    id="proj-{{ $item['slug'] }}" 
                    data-slug="{{ $item['slug'] }}" 
                    draggable="true" 
                    ondragstart="drag(event)" 
                    class="project-drag-card bg-white rounded-xl p-3 border border-slate-200 shadow-2xs hover:shadow-md hover:border-[#C5A47E] transition-all cursor-grab active:cursor-grabbing flex items-center gap-3.5 select-none"
                  >
                    <div class="w-16 h-12 rounded-lg overflow-hidden bg-slate-100 shrink-0">
                      <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                      <div class="flex items-center justify-between gap-1">
                        <h5 class="text-xs font-bold text-slate-800 truncate">{{ $item['name'] }}</h5>
                        <span class="text-[10px] font-bold text-[#C5A47E] shrink-0">{{ $item['price'] }}</span>
                      </div>
                      <p class="text-[11px] text-slate-400 truncate">{{ $item['specs'] }}</p>
                      <div class="text-[10px] text-slate-500 font-medium">{{ $item['location'] }}</div>
                    </div>
                    <div class="text-slate-300 hover:text-slate-500 cursor-grab px-1">
                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M7 2a2 2 0 10.001 4.001A2 2 0 007 2zm0 6a2 2 0 10.001 4.001A2 2 0 007 8zm0 6a2 2 0 10.001 4.001A2 2 0 007 14zm6-12a2 2 0 10.001 4.001A2 2 0 0013 2zm0 6a2 2 0 10.001 4.001A2 2 0 0013 8zm0 6a2 2 0 10.001 4.001A2 2 0 0013 14z"/></svg>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            {{-- COLUMN S: SELECTED FOR THIS COMMUNITY --}}
            <div class="bg-white rounded-[18px] border-2 border-[#C5A47E]/40 p-4 sm:p-5 shadow-xs">
              <div class="flex items-center justify-between mb-3.5">
                <div class="flex items-center gap-2">
                  <span class="w-6 h-6 rounded-lg bg-[#C5A47E] text-white text-xs font-bold flex items-center justify-center">S</span>
                  <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Column S (Show On Community Page)</h4>
                </div>
                <span id="col-s-count" class="text-[11px] font-bold text-[#0E3B2C] bg-[#FAF8F5] px-2.5 py-0.5 rounded-full border border-[#C5A47E]/30">
                  {{ count($selectedList) }} assigned
                </span>
              </div>

              {{-- Drop Zone S --}}
              <div 
                id="dropzone-s" 
                class="min-h-[380px] space-y-3 p-1 rounded-xl bg-slate-50/50 border border-dashed border-slate-200 transition-colors"
                ondragover="allowDrop(event)" 
                ondrop="drop(event, 's')"
              >
                @foreach($selectedList as $item)
                  <div 
                    id="proj-{{ $item['slug'] }}" 
                    data-slug="{{ $item['slug'] }}" 
                    draggable="true" 
                    ondragstart="drag(event)" 
                    class="project-drag-card bg-white rounded-xl p-3 border border-emerald-200 shadow-2xs hover:shadow-md hover:border-[#0E3B2C] transition-all cursor-grab active:cursor-grabbing flex items-center gap-3.5 select-none"
                  >
                    <div class="w-16 h-12 rounded-lg overflow-hidden bg-slate-100 shrink-0">
                      <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                      <div class="flex items-center justify-between gap-1">
                        <h5 class="text-xs font-bold text-slate-800 truncate">{{ $item['name'] }}</h5>
                        <span class="text-[10px] font-bold text-emerald-600 shrink-0">{{ $item['price'] }}</span>
                      </div>
                      <p class="text-[11px] text-slate-400 truncate">{{ $item['specs'] }}</p>
                      <div class="text-[10px] text-slate-500 font-medium">{{ $item['location'] }}</div>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 uppercase tracking-wider">Visible</span>
                  </div>
                @endforeach
              </div>
            </div>

          </div>

          {{-- Hidden form container for Column S slugs --}}
          <div id="selected-projects-inputs">
            @foreach($selectedList as $item)
              <input type="hidden" name="selected_offplan_projects[]" value="{{ $item['slug'] }}" id="input-proj-{{ $item['slug'] }}">
            @endforeach
          </div>

        </div>

        {{-- TAB 6: READY PROJECTS (2 Column Drag & Drop: Column A [Listing Projects] -> Column S [Selected for Community]) --}}
        <div data-tab-content="why" class="tab-pane hidden space-y-6">
          
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-slate-100">
            <div>
              <h3 class="text-sm font-bold text-slate-800">Ready Projects Assignment (Listing)</h3>
              <p class="text-xs text-slate-400">Drag projects from <strong>Column A (All Listing Projects)</strong> into <strong>Column S (Show On Community Page)</strong></p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
              Drag &amp; Drop Active
            </span>
          </div>

          @php
            $assignedReadySlugs = $community['assigned_ready_projects'] ?? ['the-fairway-villa', 'maple-row-villa'];
            $allReady = $allReadyProjects ?? \App\Http\Controllers\Admin\EntityController::getAvailableReadyProjects();
            
            $availableReadyList = [];
            $selectedReadyList = [];

            foreach ($allReady as $rproj) {
              if (in_array($rproj['slug'], $assignedReadySlugs)) {
                $selectedReadyList[] = $rproj;
              } else {
                $availableReadyList[] = $rproj;
              }
            }
          @endphp

          {{-- Drag & Drop 2 Columns Grid: Column A & Column S --}}
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start font-inter">
            
            {{-- COLUMN A: ALL LISTING / READY PROJECTS --}}
            <div class="bg-[#FAF8F5] rounded-[18px] border-2 border-dashed border-slate-200 p-4 sm:p-5">
              <div class="flex items-center justify-between mb-3.5">
                <div class="flex items-center gap-2">
                  <span class="w-6 h-6 rounded-lg bg-[#0E3B2C] text-white text-xs font-bold flex items-center justify-center">A</span>
                  <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700">Column A (Listing Projects)</h4>
                </div>
                <span id="col-ready-a-count" class="text-[11px] font-semibold text-slate-400 bg-white px-2.5 py-0.5 rounded-full border border-slate-200">
                  {{ count($availableReadyList) }} items
                </span>
              </div>

              {{-- Drop Zone Ready A --}}
              <div 
                id="dropzone-ready-a" 
                class="min-h-[360px] space-y-3 p-1 transition-colors"
                ondragover="allowDrop(event)" 
                ondrop="dropReady(event, 'a')"
              >
                @foreach($availableReadyList as $item)
                  <div 
                    id="ready-proj-{{ $item['slug'] }}" 
                    data-slug="{{ $item['slug'] }}" 
                    draggable="true" 
                    ondragstart="drag(event)" 
                    class="ready-drag-card bg-white rounded-xl p-3 border border-slate-200 shadow-2xs hover:shadow-md hover:border-[#C5A47E] transition-all cursor-grab active:cursor-grabbing flex items-center gap-3.5 select-none"
                  >
                    <div class="w-16 h-12 rounded-lg overflow-hidden bg-slate-100 shrink-0">
                      <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                      <div class="flex items-center justify-between gap-1">
                        <h5 class="text-xs font-bold text-slate-800 truncate">{{ $item['name'] }}</h5>
                        <span class="text-[10px] font-bold text-[#C5A47E] shrink-0">{{ $item['price'] }}</span>
                      </div>
                      <p class="text-[11px] text-slate-400 truncate">{{ $item['specs'] }}</p>
                      <div class="text-[10px] text-slate-500 font-medium">{{ $item['location'] }}</div>
                    </div>
                    <div class="text-slate-300 hover:text-slate-500 cursor-grab px-1">
                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M7 2a2 2 0 10.001 4.001A2 2 0 007 2zm0 6a2 2 0 10.001 4.001A2 2 0 007 8zm0 6a2 2 0 10.001 4.001A2 2 0 007 14zm6-12a2 2 0 10.001 4.001A2 2 0 0013 2zm0 6a2 2 0 10.001 4.001A2 2 0 0013 8zm0 6a2 2 0 10.001 4.001A2 2 0 0013 14z"/></svg>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            {{-- COLUMN S: SELECTED READY PROJECTS --}}
            <div class="bg-white rounded-[18px] border-2 border-[#C5A47E]/40 p-4 sm:p-5 shadow-xs">
              <div class="flex items-center justify-between mb-3.5">
                <div class="flex items-center gap-2">
                  <span class="w-6 h-6 rounded-lg bg-[#C5A47E] text-white text-xs font-bold flex items-center justify-center">S</span>
                  <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Column S (Show On Community Page)</h4>
                </div>
                <span id="col-ready-s-count" class="text-[11px] font-bold text-[#0E3B2C] bg-[#FAF8F5] px-2.5 py-0.5 rounded-full border border-[#C5A47E]/30">
                  {{ count($selectedReadyList) }} assigned
                </span>
              </div>

              {{-- Drop Zone Ready S --}}
              <div 
                id="dropzone-ready-s" 
                class="min-h-[360px] space-y-3 p-1 rounded-xl bg-slate-50/50 border border-dashed border-slate-200 transition-colors"
                ondragover="allowDrop(event)" 
                ondrop="dropReady(event, 's')"
              >
                @foreach($selectedReadyList as $item)
                  <div 
                    id="ready-proj-{{ $item['slug'] }}" 
                    data-slug="{{ $item['slug'] }}" 
                    draggable="true" 
                    ondragstart="drag(event)" 
                    class="ready-drag-card bg-white rounded-xl p-3 border border-emerald-200 shadow-2xs hover:shadow-md hover:border-[#0E3B2C] transition-all cursor-grab active:cursor-grabbing flex items-center gap-3.5 select-none"
                  >
                    <div class="w-16 h-12 rounded-lg overflow-hidden bg-slate-100 shrink-0">
                      <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                      <div class="flex items-center justify-between gap-1">
                        <h5 class="text-xs font-bold text-slate-800 truncate">{{ $item['name'] }}</h5>
                        <span class="text-[10px] font-bold text-emerald-600 shrink-0">{{ $item['price'] }}</span>
                      </div>
                      <p class="text-[11px] text-slate-400 truncate">{{ $item['specs'] }}</p>
                      <div class="text-[10px] text-slate-500 font-medium">{{ $item['location'] }}</div>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 uppercase tracking-wider">Visible</span>
                  </div>
                @endforeach
              </div>
            </div>

          </div>

          {{-- Hidden form container for Column S slugs --}}
          <div id="selected-ready-projects-inputs">
            @foreach($selectedReadyList as $item)
              <input type="hidden" name="selected_ready_projects[]" value="{{ $item['slug'] }}" id="input-ready-proj-{{ $item['slug'] }}">
            @endforeach
          </div>

        </div>

        {{-- TAB 7: AMENITIES (Renamed from Page Content - Select from Database Library) --}}
        <div data-tab-content="content" class="tab-pane hidden space-y-6">
          
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
            <div>
              <h3 class="text-sm font-bold text-slate-800">Select Amenities &amp; Facilities</h3>
              <p class="text-xs text-slate-400">Amenities selected here will dynamically display in the 8-card grid on the frontend community page</p>
            </div>
            <a 
              href="{{ route('admin.amenities') }}" 
              target="_blank" 
              class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#FAF8F5] text-[#C5A47E] hover:bg-[#F2ECE3] border border-[#C5A47E]/30 text-xs font-bold transition-colors"
            >
              + Manage / Add New Amenity ↗
            </a>
          </div>

          @php
            $amenityList = $allAmenities ?? \App\Http\Controllers\Admin\EntityController::getAmenitiesStore();
            $assignedAmenities = $community['assigned_amenities'] ?? ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'];
          @endphp

          {{-- Quick Dropdown Selector to add --}}
          <div class="space-y-2">
            <label class="block text-xs font-semibold text-slate-700">Add Amenity from Database Library</label>
            <div class="flex gap-3">
              <select 
                id="amenity-select-dropdown" 
                class="flex-1 bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
              >
                <option value="">-- Choose an Amenity to add --</option>
                @foreach($amenityList as $amItem)
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

          {{-- Interactive Checkboxes / Cards Grid of Registered Amenities --}}
          <div class="space-y-3 pt-2">
            <label class="block text-xs font-semibold text-slate-700">Active Amenities for this Community</label>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4" id="amenities-selection-grid">
              @foreach($amenityList as $am)
                @php
                  $isChecked = in_array($am['key'], $assignedAmenities);
                @endphp
                <label 
                  id="amenity-card-{{ $am['key'] }}" 
                  class="flex items-center gap-3.5 p-3.5 rounded-xl border {{ $isChecked ? 'border-[#C5A47E] bg-[#FAF8F5]' : 'border-slate-200 bg-white opacity-60' }} hover:opacity-100 hover:border-[#C5A47E] transition-all cursor-pointer shadow-2xs group"
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
                  <span class="text-xs font-semibold text-slate-800 leading-snug flex-1">
                    {{ $am['name'] }}
                  </span>
                </label>
              @endforeach
            </div>
          </div>

        </div>

        {{-- TAB 8: FULL CONTENT (Summernote Rich Text Editor) --}}
        <div data-tab-content="full_content" class="tab-pane hidden space-y-5">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-slate-100">
            <div>
              <h3 class="text-sm font-bold text-slate-800">Full Content Editor</h3>
              <p class="text-xs text-slate-400">Write in-depth lifestyle guides, investment opportunities, and upload embedded images directly with Summernote</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#0E3B2C] border border-[#0E3B2C]/20">
              Summernote Active
            </span>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Full Content</label>
            <textarea 
              id="summernote-editor" 
              name="full_content" 
              class="w-full"
            >{{ $community['full_content'] ?? '<h3>Modern lifestyle and residential opportunities</h3><p>Dubai offers a diverse range of residential properties designed to meet different needs. From contemporary apartments to spacious villas and premium residential developments, buyers can explore various options based on their requirements.</p><p>When researching property communities in Dubai, potential buyers should consider important factors such as property location, accessibility, available facilities, and nearby commercial areas.</p><h3>Luxury villas and real estate investment opportunities</h3><p>Dubai has established itself as a significant international real estate destination. Its business-friendly environment, tourism industry, modern infrastructure, and international connectivity contribute to continued interest from property investors.</p>' }}</textarea>
          </div>
        </div>

        {{-- TAB 9: FAQS (Dynamic Community FAQ Manager) --}}
        <div data-tab-content="faqs" class="tab-pane hidden space-y-6">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
            <div>
              <h3 class="text-sm font-bold text-slate-800">Frequently Asked Questions</h3>
              <p class="text-xs text-slate-400">Add community-specific FAQs. Each community has its own custom questions and answers.</p>
            </div>
            <button 
              type="button" 
              onclick="addFaqRow()" 
              class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#0E3B2C] hover:bg-[#16503c] text-white text-xs font-bold transition-colors shadow-xs cursor-pointer"
            >
              + Add FAQ Question
            </button>
          </div>

          @php
            $defaultFaqs = [
              ['q' => 'What is The Valley Dubai?', 'a' => 'The Valley is a master-planned community by Emaar designed for family living with green open spaces, interconnected parks, and world-class leisure facilities.'],
              ['q' => 'Who is the developer behind The Valley?', 'a' => 'The Valley is developed by Emaar Properties, the premier master-developer of Burj Khalifa and Downtown Dubai.'],
              ['q' => 'Where is The Valley located?', 'a' => 'The Valley is strategically positioned on the Dubai–Al Ain Road, offering seamless connectivity to Downtown Dubai, DXB Airport, and academic hubs.'],
              ['q' => 'What types of properties are available in The Valley?', 'a' => 'The community features spacious 3 and 4-bedroom townhouses and 4 to 5-bedroom luxury villas with contemporary finishes.'],
              ['q' => 'Is The Valley a good investment opportunity?', 'a' => 'Yes, with competitive entry prices, robust capital growth projections, and high rental yields favored by families and long-term expatriates.'],
              ['q' => 'Does The Valley offer a flexible payment plan?', 'a' => 'Yes, off-plan projects in The Valley typically provide attractive 80/20 or 70/30 construction-linked payment plans with post-handover options.'],
            ];
            $communityFaqs = $community['faqs'] ?? $defaultFaqs;
          @endphp

          {{-- FAQ Container List --}}
          <div id="faq-list-container" class="space-y-4 font-inter">
            @foreach($communityFaqs as $idx => $faq)
              <div class="faq-row-item bg-[#FAF8F5] border border-slate-200 rounded-2xl p-4 sm:p-5 relative space-y-3 group">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-bold text-[#C5A47E] uppercase tracking-wider faq-num-badge">FAQ #{{ $idx + 1 }}</span>
                  <button 
                    type="button" 
                    onclick="this.closest('.faq-row-item').remove(); renumberFaqs();" 
                    class="text-slate-400 hover:text-rose-600 text-xs font-semibold transition-colors"
                    title="Delete Question"
                  >
                    Delete ✕
                  </button>
                </div>

                <div>
                  <label class="block text-[11px] font-semibold text-slate-600 uppercase tracking-wider mb-1">Question</label>
                  <input 
                    type="text" 
                    name="faq_q[]" 
                    value="{{ $faq['q'] }}" 
                    placeholder="Enter question..." 
                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                  >
                </div>

                <div>
                  <label class="block text-[11px] font-semibold text-slate-600 uppercase tracking-wider mb-1">Answer</label>
                  <textarea 
                    name="faq_a[]" 
                    rows="2" 
                    placeholder="Enter answer..." 
                    class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs sm:text-[13px] text-slate-700 focus:outline-none focus:border-[#C5A47E]"
                  >{{ $faq['a'] }}</textarea>
                </div>
              </div>
            @endforeach
          </div>

        </div>

        {{-- Save Button --}}
        <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
          <button type="submit" class="px-6 py-3 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors cursor-pointer">
            {{ !empty($isNew) ? 'Create & Publish Community' : 'Save Changes' }}
          </button>

          @if(empty($isNew))
          <a href="{{ $community['url'] }}" target="_blank" class="text-xs font-semibold text-blue-600 hover:underline">
            View Live Page ↗
          </a>
          @endif
        </div>

      </form>

    </div>

  </div>

</div>

{{-- Tab Switching & Image Upload Preview Script --}}
<script>
  // Drag and Drop Logic for Column A -> Column S
  function allowDrop(ev) {
    ev.preventDefault();
    if (ev.dataTransfer) ev.dataTransfer.dropEffect = 'move';
  }

  function drag(ev) {
    window.__luxDraggedEl = ev.currentTarget;
    if (ev.dataTransfer) ev.dataTransfer.setData("text/plain", ev.currentTarget.id);
  }

  function drop(ev, zone) {
    ev.preventDefault();
    const id = ev.dataTransfer ? ev.dataTransfer.getData("text/plain") : '';
    const draggedEl = (id ? document.getElementById(id) : null) || window.__luxDraggedEl;
    if (!draggedEl) return;

    let targetZone = zone === 's' ? document.getElementById('dropzone-s') : document.getElementById('dropzone-a');
    if (targetZone) {
      targetZone.appendChild(draggedEl);
      updateSelectedOffplanInputs();
    }
  }

  function dropReady(ev, zone) {
    ev.preventDefault();
    const id = ev.dataTransfer ? ev.dataTransfer.getData("text/plain") : '';
    const draggedEl = (id ? document.getElementById(id) : null) || window.__luxDraggedEl;
    if (!draggedEl) return;

    let targetZone = zone === 's' ? document.getElementById('dropzone-ready-s') : document.getElementById('dropzone-ready-a');
    if (targetZone) {
      targetZone.appendChild(draggedEl);
      updateSelectedReadyInputs();
    }
  }

  function updateSelectedReadyInputs() {
    const dropzoneS = document.getElementById('dropzone-ready-s');
    const container = document.getElementById('selected-ready-projects-inputs');
    if (!dropzoneS || !container) return;

    container.innerHTML = '';
    const cards = dropzoneS.querySelectorAll('.ready-drag-card');
    
    cards.forEach(card => {
      const slug = card.getAttribute('data-slug');
      if (slug) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'selected_ready_projects[]';
        input.value = slug;
        container.appendChild(input);
      }
    });

    const colACount = document.getElementById('dropzone-ready-a').querySelectorAll('.ready-drag-card').length;
    const colSCount = cards.length;

    const countAEl = document.getElementById('col-ready-a-count');
    const countSEl = document.getElementById('col-ready-s-count');
    if (countAEl) countAEl.innerText = colACount + ' items';
    if (countSEl) countSEl.innerText = colSCount + ' assigned';
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

  function updateSelectedOffplanInputs() {
    const dropzoneS = document.getElementById('dropzone-s');
    const container = document.getElementById('selected-projects-inputs');
    if (!dropzoneS || !container) return;

    container.innerHTML = '';
    const cards = dropzoneS.querySelectorAll('.project-drag-card');
    
    cards.forEach(card => {
      const slug = card.getAttribute('data-slug');
      if (slug) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'selected_offplan_projects[]';
        input.value = slug;
        container.appendChild(input);
      }
    });

    const colACount = document.getElementById('dropzone-a').querySelectorAll('.project-drag-card').length;
    const colSCount = cards.length;

    const countAEl = document.getElementById('col-a-count');
    const countSEl = document.getElementById('col-s-count');
    if (countAEl) countAEl.innerText = colACount + ' items';
    if (countSEl) countSEl.innerText = colSCount + ' assigned';
  }

  // FAQ Helpers
  function addFaqRow() {
    const container = document.getElementById('faq-list-container');
    if (!container) return;

    const count = container.querySelectorAll('.faq-row-item').length + 1;
    const row = document.createElement('div');
    row.className = 'faq-row-item bg-[#FAF8F5] border border-slate-200 rounded-2xl p-4 sm:p-5 relative space-y-3 group';
    row.innerHTML = `
      <div class="flex items-center justify-between">
        <span class="text-xs font-bold text-[#C5A47E] uppercase tracking-wider faq-num-badge">FAQ #${count}</span>
        <button 
          type="button" 
          onclick="this.closest('.faq-row-item').remove(); renumberFaqs();" 
          class="text-slate-400 hover:text-rose-600 text-xs font-semibold transition-colors"
          title="Delete Question"
        >
          Delete ✕
        </button>
      </div>
      <div>
        <label class="block text-[11px] font-semibold text-slate-600 uppercase tracking-wider mb-1">Question</label>
        <input 
          type="text" 
          name="faq_q[]" 
          value="" 
          placeholder="Enter question..." 
          class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-[13px] font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
        >
      </div>
      <div>
        <label class="block text-[11px] font-semibold text-slate-600 uppercase tracking-wider mb-1">Answer</label>
        <textarea 
          name="faq_a[]" 
          rows="2" 
          placeholder="Enter answer..." 
          class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs sm:text-[13px] text-slate-700 focus:outline-none focus:border-[#C5A47E]"
        ></textarea>
      </div>
    `;
    container.appendChild(row);
  }

  function renumberFaqs() {
    const badges = document.querySelectorAll('.faq-num-badge');
    badges.forEach((b, idx) => {
      b.innerText = `FAQ #${idx + 1}`;
    });
  }

  function previewUploadedImage(input, previewId) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const preview = document.getElementById(previewId);
        if (preview) {
          preview.src = e.target.result;
        }
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  function toggleMediaInputs(val) {
    const imgGroup = document.getElementById('media-image-group');
    const vidGroup = document.getElementById('media-video-group');
    if (!imgGroup || !vidGroup) return;

    if (val === 'hidden') {
      imgGroup.classList.add('hidden');
      vidGroup.classList.add('hidden');
    } else if (val === 'image') {
      imgGroup.classList.remove('hidden');
      vidGroup.classList.add('hidden');
    } else { // video
      imgGroup.classList.remove('hidden');
      vidGroup.classList.remove('hidden');
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    @if(!empty($isNew))
    const nameInput = document.getElementById('comm-name-input');
    const slugInput = document.getElementById('comm-slug-input');
    let slugTouched = false;
    if (slugInput) slugInput.addEventListener('input', () => { slugTouched = true; });
    if (nameInput && slugInput) {
      nameInput.addEventListener('input', function() {
        if (!slugTouched) {
          slugInput.value = this.value.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        }
      });
    }
    @endif
    // Initialize Summernote Lite
    if (typeof $ !== 'undefined' && $('#summernote-editor').length) {
      $('#summernote-editor').summernote({
        placeholder: 'Write your full content here, add headings, format text, and insert images...',
        tabsize: 2,
        height: 320,
        toolbar: [
          ['style', ['style', 'bold', 'underline', 'italic', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
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
