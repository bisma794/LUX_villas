@php
  use App\Http\Controllers\Admin\EntityController;
  $communityList = EntityController::getCommunityStore();
@endphp

<section class="max-w-[1280px] mx-auto px-6 -mt-8 relative z-20">
  <form action="{{ $c['button_link'] ?? '/villas-for-sale' }}" method="GET" class="bg-white rounded-none shadow-[0_10px_35px_rgba(0,0,0,0.08)] p-6 md:p-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-5 items-end font-inter">
    
    {{-- Field 1: Property Type --}}
    <label class="block">
      <span class="text-xs font-semibold text-neutral-500 font-inter block mb-2">Property Type</span>
      <div class="relative">
        <select name="type" class="w-full bg-[#f8f9fa] border border-[#e2e8f0] text-neutral-800 text-xs sm:text-[13px] font-inter rounded-none px-3.5 py-3 pr-8 focus:outline-none focus:border-[#C5A47E] appearance-none cursor-pointer">
          <option value="">Villas &amp; Townhouses</option>
          <option value="villas">Villas</option>
          <option value="townhouses">Townhouses</option>
          <option value="penthouses">Penthouses</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-neutral-400 text-xs">▼</span>
      </div>
    </label>

    {{-- Field 2: Status --}}
    <label class="block">
      <span class="text-xs font-semibold text-neutral-500 font-inter block mb-2">Status</span>
      <div class="relative">
        <select name="status" class="w-full bg-[#f8f9fa] border border-[#e2e8f0] text-neutral-800 text-xs sm:text-[13px] font-inter rounded-none px-3.5 py-3 pr-8 focus:outline-none focus:border-[#C5A47E] appearance-none cursor-pointer">
          <option value="">All (Ready, Off-plan, resale)</option>
          <option value="ready">Ready</option>
          <option value="off-plan">Off-plan</option>
          <option value="resale">Resale</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-neutral-400 text-xs">▼</span>
      </div>
    </label>

    {{-- Field 3: Budget --}}
    <label class="block">
      <span class="text-xs font-semibold text-neutral-500 font-inter block mb-2">Budget</span>
      <div class="relative">
        <select name="budget" class="w-full bg-[#f8f9fa] border border-[#e2e8f0] text-neutral-800 text-xs sm:text-[13px] font-inter rounded-none px-3.5 py-3 pr-8 focus:outline-none focus:border-[#C5A47E] appearance-none cursor-pointer">
          <option value="">Any budget</option>
          <option value="under-2m">Under AED 2M</option>
          <option value="2m-3m">AED 2M–3M</option>
          <option value="3m-5m">AED 3M–5M</option>
          <option value="5m-plus">AED 5M+</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-neutral-400 text-xs">▼</span>
      </div>
    </label>

    {{-- Field 4: Community (Loaded directly from Database / Entity Store) --}}
    <label class="block">
      <span class="text-xs font-semibold text-neutral-500 font-inter block mb-2">Community</span>
      <div class="relative">
        <select name="community" class="w-full bg-[#f8f9fa] border border-[#e2e8f0] text-neutral-800 text-xs sm:text-[13px] font-inter rounded-none px-3.5 py-3 pr-8 focus:outline-none focus:border-[#C5A47E] appearance-none cursor-pointer">
          <option value="">All Communities</option>
          @foreach($communityList as $slug => $comm)
            <option value="{{ $slug }}">{{ $comm['name'] ?? ucfirst(str_replace('-', ' ', $slug)) }}</option>
          @endforeach
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-neutral-400 text-xs">▼</span>
      </div>
    </label>

    {{-- Submit Button --}}
    <button type="submit" class="w-full bg-[#C4A06B] hover:bg-[#B38F5B] text-white text-xs sm:text-[13px] font-semibold font-inter rounded-none py-3 px-4 flex items-center justify-center gap-2 transition-colors cursor-pointer shadow-xs">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      <span>Search Properties</span>
    </button>
  </form>
</section>
