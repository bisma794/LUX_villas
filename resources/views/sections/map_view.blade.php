<section class="max-w-[1280px] mx-auto px-6 py-10 font-inter">
  
  {{-- Header Row: Left Title & Subtitle, Right Search Input --}}
  <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
    
    {{-- Left: Map View Heading + Subtitle --}}
    <div>
      <h2 class="font-heading font-medium text-3xl sm:text-[34px] text-[#0E3B2C] leading-snug">
        Map View
      </h2>
      <p class="text-sm sm:text-base text-neutral-400 font-inter mt-1">
        Fairways Vistas, Dubai Hills Estate, Dubai, UAE
      </p>
    </div>

    {{-- Right: Search Community Input with Menu Icon and Search Icon --}}
    <div class="w-full md:w-[320px] shrink-0">
      <div class="relative flex items-center bg-white border border-[#E5E7EB] rounded-full px-4 py-2.5 shadow-2xs hover:border-[#0E3B2C] focus-within:border-[#0E3B2C] transition-colors">
        {{-- Menu / Filter Icon on the left --}}
        <svg class="w-4 h-4 text-neutral-400 shrink-0 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h10M4 18h16"/>
        </svg>

        {{-- Input Field --}}
        <input 
          type="text" 
          placeholder="Search Community" 
          class="w-full text-xs text-neutral-700 placeholder-neutral-400 bg-transparent focus:outline-none"
        >

        {{-- Search Icon on the right --}}
        <svg class="w-3.5 h-3.5 text-neutral-400 shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </div>
    </div>

  </div>

  {{-- Map Container matching Reference Screenshot --}}
  <div class="relative w-full rounded-[20px] overflow-hidden border border-[#E5E7EB] shadow-xs bg-[#EBF1F6]">
    <img 
      src="{{ asset('images/communities-map-view.jpg') }}" 
      alt="Fairways Vistas Map View" 
      class="w-full h-auto object-cover min-h-[380px] sm:min-h-[460px] md:min-h-[520px]"
    >
  </div>

</section>
