<section class="relative min-h-[480px] md:min-h-[540px] flex items-center overflow-hidden bg-neutral-100 font-inter">
  {{-- Hero Background Image --}}
  <img src="{{ asset('images/house-white.jpg') }}" alt="Buy your villa with confidence" class="absolute inset-0 w-full h-full object-cover object-right md:object-center">
  
  {{-- Soft white gradient on the left for text legibility, matching reference screenshot --}}
  <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/80 to-transparent"></div>

  {{-- Hero Content Container --}}
  <div class="relative z-10 max-w-[1280px] mx-auto px-6 w-full pt-12 pb-24">
    <div class="max-w-2xl">
      {{-- Breadcrumb: • HOME > PROJECT --}}
      <div class="flex items-center gap-1.5 text-xs text-neutral-600 font-medium font-inter mb-4">
        <span>•</span>
        <a href="/" class="hover:text-black">HOME</a>
        <span>&rsaquo;</span>
        <span class="text-neutral-800">PROJECT</span>
      </div>

      {{-- Main Heading: Buy your villa with confidence. --}}
      <h1 class="font-heading font-medium text-4xl sm:text-5xl md:text-[64px] text-[#0E3B2C] leading-[1.1] tracking-tight">
        Buy your villa <br>
        with <span class="font-script font-normal text-[52px] sm:text-[64px] md:text-[80px] lowercase tracking-normal -ml-1 text-[#0E3B2C]">confidence.</span>
      </h1>

      {{-- Tab Buttons: Buy, Rent, Offplan --}}
      <div class="flex items-center gap-2.5 mt-8" x-data="{ activeTab: 'buy' }">
        {{-- Buy Tab --}}
        <button 
          type="button" 
          @click="activeTab = 'buy'" 
          :class="activeTab === 'buy' ? 'bg-[#C5A47E] text-white shadow-xs' : 'bg-white/90 text-neutral-700 hover:bg-white'"
          class="w-24 sm:w-28 py-2.5 rounded-[8px] text-xs font-semibold font-inter transition-all cursor-pointer text-center"
        >
          Buy
        </button>

        {{-- Rent Tab --}}
        <button 
          type="button" 
          @click="activeTab = 'rent'" 
          :class="activeTab === 'rent' ? 'bg-[#C5A47E] text-white shadow-xs' : 'bg-white/90 text-neutral-700 hover:bg-white'"
          class="w-24 sm:w-28 py-2.5 rounded-[8px] text-xs font-semibold font-inter transition-all cursor-pointer text-center"
        >
          Rent
        </button>

        {{-- Offplan Tab --}}
        <button 
          type="button" 
          @click="activeTab = 'offplan'" 
          :class="activeTab === 'offplan' ? 'bg-[#C5A47E] text-white shadow-xs' : 'bg-white/90 text-neutral-700 hover:bg-white'"
          class="w-24 sm:w-28 py-2.5 rounded-[8px] text-xs font-semibold font-inter transition-all cursor-pointer text-center"
        >
          Offplan
        </button>
      </div>

    </div>
  </div>

  {{-- Floating Search Bar at Bottom matching Reference Screenshot --}}
  <div class="absolute bottom-4 inset-x-0 z-20 max-w-[1280px] mx-auto px-6">
    <div class="bg-white rounded-[14px] shadow-lg border border-neutral-200 p-2 sm:p-2.5 flex flex-col md:flex-row items-center justify-between gap-3 font-inter">
      
      {{-- 1. Location --}}
      <div class="flex-1 w-full md:w-auto flex items-center gap-3 px-3 py-1.5 md:border-r border-neutral-200">
        <svg class="w-4 h-4 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <div class="min-w-0 flex-1">
          <span class="block text-xs font-semibold text-[#10221C]">Location</span>
          <input type="text" placeholder="Community, project or developer" class="w-full text-[11px] text-neutral-500 placeholder-neutral-400 bg-transparent focus:outline-none truncate">
        </div>
      </div>

      {{-- 2. Property type --}}
      <div class="flex-1 w-full md:w-auto flex items-center gap-3 px-3 py-1.5 md:border-r border-neutral-200">
        <svg class="w-4 h-4 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        <div class="min-w-0 flex-1">
          <span class="block text-xs font-semibold text-[#10221C]">Property type</span>
          <span class="block text-[11px] text-neutral-400 truncate cursor-pointer">Any type</span>
        </div>
      </div>

      {{-- 3. Budget --}}
      <div class="flex-1 w-full md:w-auto flex items-center gap-3 px-3 py-1.5 md:border-r border-neutral-200">
        <span class="text-sm font-bold text-neutral-400 shrink-0">$</span>
        <div class="min-w-0 flex-1">
          <span class="block text-xs font-semibold text-[#10221C]">Budget</span>
          <span class="block text-[11px] text-neutral-400 truncate cursor-pointer">Any price</span>
        </div>
      </div>

      {{-- 4. Handover --}}
      <div class="flex-1 w-full md:w-auto flex items-center gap-3 px-3 py-1.5">
        <svg class="w-4 h-4 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        <div class="min-w-0 flex-1">
          <span class="block text-xs font-semibold text-[#10221C]">Handover</span>
          <span class="block text-[11px] text-neutral-400 truncate cursor-pointer">Any date</span>
        </div>
      </div>

      {{-- Search Button --}}
      <div class="w-full md:w-auto shrink-0">
        <button type="button" class="w-full md:w-auto inline-flex items-center justify-center gap-2 bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold font-inter px-8 py-3.5 rounded-[10px] transition-colors shadow-xs cursor-pointer">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          <span>Search</span>
        </button>
      </div>

    </div>
  </div>
</section>
