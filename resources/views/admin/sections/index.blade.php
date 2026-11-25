@extends('layouts.admin')

@section('content')
<div class="space-y-6 font-inter">

  {{-- Header: Global Modules with + New Section button --}}
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="font-heading font-medium text-3xl sm:text-[34px] text-[#10221C] tracking-tight leading-snug">
        Global Modules
      </h1>
      <p class="text-xs sm:text-[13px] text-neutral-400 font-medium mt-1">
        Visual library of all page sections. Drag and drop into any dynamic page builder.
      </p>
    </div>

    <a 
      href="{{ route('admin.sections.create') }}" 
      class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs transition-colors shrink-0"
    >
      <span>+ New Section</span>
    </a>
  </div>

  {{-- Search & Type Filter Bar --}}
  <div class="bg-white rounded-[20px] border border-[#EBE7DF] p-5 shadow-xs">
    <form method="GET" class="flex flex-wrap items-center gap-3">
      <div class="relative flex-1 min-w-[260px]">
        <input 
          type="text" 
          name="q" 
          value="{{ $q }}" 
          placeholder="Search section by name or key…" 
          class="w-full bg-[#FAF8F5] border border-[#EBE7DF] rounded-xl px-4 py-2.5 text-xs text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#C5A47E]"
        >
      </div>

      <select 
        name="type" 
        class="bg-[#FAF8F5] border border-[#EBE7DF] rounded-xl px-4 py-2.5 text-xs font-medium text-neutral-700 focus:outline-none focus:border-[#C5A47E]"
      >
        <option value="">All Types</option>
        @foreach($types as $k => $label)
          <option value="{{ $k }}" {{ $type === $k ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
      </select>

      <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#10221C] hover:bg-[#1a382e] text-white text-xs font-semibold shadow-xs transition-colors cursor-pointer">
        Filter
      </button>

      @if(!empty($q) || !empty($type))
        <a href="{{ route('admin.sections.index') }}" class="text-xs text-neutral-400 hover:text-neutral-700 underline px-2">
          Clear
        </a>
      @endif
    </form>
  </div>

  {{-- HORIZONTAL LISTING ROWS (Left Picture + Right Details & Actions) --}}
  <div class="space-y-4">
    @forelse($sections as $s)
      @php
        // Map section to relevant screenshot thumbnail
        $img = 'images/listing-pool-villa.jpg';
        $key = $s->key;
        if (str_contains($key, 'amenit') || str_contains($s->type, 'amenit')) $img = 'images/amenities-section-preview.jpg';
        elseif (str_contains($key, 'hero')) $img = 'images/communities-hero-villa.jpg';
        elseif (str_contains($key, 'map')) $img = 'images/golf-vale-map-view.jpg';
        elseif (str_contains($key, 'project')) $img = 'images/golf-vale-main.jpg';
        elseif (str_contains($key, 'stepper') || str_contains($key, 'quiz')) $img = 'images/palm-jumeirah-ai-hero.jpg';
        elseif (str_contains($key, 'advisor')) $img = 'images/agent.jpg';
        elseif (str_contains($key, 'listing')) $img = 'images/listing-modern-villa.jpg';
        elseif (str_contains($key, 'community')) $img = 'images/community-dubai-hills.jpg';
        elseif (str_contains($key, 'blog')) $img = 'images/dubai-skyline.jpg';
      @endphp

      <div 
        class="bg-white rounded-[20px] border border-[#EBE7DF] overflow-hidden p-4 sm:p-5 hover:border-[#C5A47E] hover:shadow-xs transition-all duration-300 flex flex-col md:flex-row items-stretch md:items-center gap-5 sm:gap-6 group"
        draggable="true"
        data-section-id="{{ $s->id }}"
      >
        {{-- Left: Section Thumbnail Image with Drag Handle & Global Badge --}}
        <div class="relative w-full md:w-[260px] lg:w-[280px] h-[150px] md:h-[135px] shrink-0 rounded-[14px] overflow-hidden bg-neutral-100 border border-[#EBE7DF]">
          <img 
            src="{{ asset($img) }}" 
            alt="{{ $s->name }}" 
            class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500"
          >

          {{-- Drag Handle Pill --}}
          <div class="absolute top-2.5 left-2.5 bg-[#10221C]/85 backdrop-blur-xs text-white text-[10px] font-semibold px-2.5 py-1 rounded-full flex items-center gap-1 shadow-xs cursor-grab">
            <svg class="w-3 h-3 text-[#C5A47E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
            <span>Drag</span>
          </div>

          {{-- Global Badge --}}
          @if($s->is_global)
            <div class="absolute top-2.5 right-2.5">
              <span class="bg-[#C5A47E] text-white text-[9px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider shadow-xs">
                Global
              </span>
            </div>
          @endif
        </div>

        {{-- Right: Section Details & Specifications (Horizontally Aligned) --}}
        <div class="flex-1 flex flex-col justify-between h-full min-w-0">
          <div>
            <div class="flex items-start justify-between gap-4">
              <div>
                <h3 class="font-heading font-medium text-xl sm:text-[22px] text-[#10221C] group-hover:text-[#C5A47E] transition-colors leading-snug">
                  {{ $s->name }}
                </h3>
                <p class="text-xs text-neutral-400 font-mono mt-1">
                  {{ $s->key }} · <span class="text-neutral-600 font-sans font-medium">{{ $types[$s->type] ?? $s->type }}</span>
                </p>
              </div>

              {{-- Status Badge --}}
              <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full {{ $s->status === 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-neutral-200 text-neutral-700' }} shrink-0">
                {{ $s->status }}
              </span>
            </div>

            <p class="text-xs text-neutral-500 mt-2 font-normal">
              Used across <strong class="text-[#10221C] font-semibold">{{ $s->pages_count }}</strong> published page(s) in LUX Villa CMS.
            </p>
          </div>

          {{-- Action Row --}}
          <div class="mt-4 pt-3.5 border-t border-neutral-100 flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs text-neutral-400">
              <svg class="w-3.5 h-3.5 text-[#C5A47E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              <span>Instant preview ready</span>
            </div>

            <div class="flex items-center gap-2.5">
              <a 
                href="{{ route('admin.sections.edit', $s) }}" 
                class="px-4.5 py-2 rounded-xl bg-[#FAF8F5] hover:bg-[#F2ECE3] border border-[#EBE7DF] text-[#10221C] text-xs font-semibold transition-colors"
              >
                Edit Section →
              </a>
            </div>
          </div>
        </div>

      </div>
    @empty
      <div class="py-16 text-center text-neutral-400 bg-white rounded-[20px] border border-[#EBE7DF]">
        No modules found matching your search.
      </div>
    @endforelse
  </div>

  {{-- Pagination --}}
  @if($sections->hasPages())
    <div class="mt-8 pt-4 border-t border-neutral-200">
      {{ $sections->links() }}
    </div>
  @endif

</div>
@endsection
