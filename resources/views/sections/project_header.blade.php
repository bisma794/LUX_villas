{{-- Golf Vale Emaar South Hero Section matching reference --}}
<section class="w-full bg-[#C5A47E] text-white pt-8 pb-14 font-inter">
  <div class="max-w-[1280px] mx-auto px-6">
    
    {{-- Breadcrumb: 1. Home > Off-plan > EMAAR Properties > Golf Vale Emaar South --}}
    <div class="flex items-center gap-2 text-xs sm:text-[13px] text-white/90 font-inter mb-4">
      <a href="/" class="hover:underline">1. Home</a>
      <span>&gt;</span>
      <a href="/projects" class="hover:underline">Off-plan</a>
      <span>&gt;</span>
      <span>EMAAR Properties</span>
      <span>&gt;</span>
      <span class="text-white font-medium">Golf Vale Emaar South</span>
    </div>

    {{-- Main Heading: Golf Vale Emaar South | EMAAR Properties | Dubai South, Dubai --}}
    <h1 class="font-heading font-medium text-3xl sm:text-4xl md:text-[44px] lg:text-[46px] text-white leading-tight tracking-tight mb-8">
      Golf Vale Emaar South | EMAAR Properties | Dubai South, Dubai
    </h1>

    {{-- 3-Image Gallery Layout with Pill Buttons on Big Image --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-stretch">
      
      {{-- Big Left Photo (Span 8) --}}
      <div class="lg:col-span-8 relative rounded-[20px] overflow-hidden shadow-md bg-neutral-200 group min-h-[380px] sm:min-h-[440px] md:min-h-[480px]">
        <img 
          src="{{ asset('images/golf-vale-main.jpg') }}" 
          alt="Golf Vale Emaar South Villa Exterior" 
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-102"
        >

        {{-- Floating Action Pill Buttons on bottom left: Default white, Hover Golden/Tan --}}
        <div class="absolute left-5 sm:left-6 bottom-5 sm:bottom-6 z-20 flex items-center gap-2.5 sm:gap-3 flex-wrap">
          {{-- Photos Button: Active/hover tan --}}
          <button 
            type="button" 
            class="px-5 sm:px-6 py-2.5 rounded-full text-xs sm:text-sm font-medium transition-all duration-300 shadow-sm cursor-pointer bg-[#C5A47E] text-white hover:bg-[#b8956e]"
          >
            Photos
          </button>

          {{-- Brochure Button: Default White, Hover Golden/Tan --}}
          <button 
            type="button" 
            class="px-5 sm:px-6 py-2.5 rounded-full text-xs sm:text-sm font-medium transition-all duration-300 shadow-sm cursor-pointer bg-white text-[#10221C] hover:bg-[#C5A47E] hover:text-white"
          >
            Brochure
          </button>

          {{-- Map Button: Default White, Hover Golden/Tan --}}
          <button 
            type="button" 
            class="px-5 sm:px-6 py-2.5 rounded-full text-xs sm:text-sm font-medium transition-all duration-300 shadow-sm cursor-pointer bg-white text-[#10221C] hover:bg-[#C5A47E] hover:text-white"
          >
            Map
          </button>
        </div>
      </div>

      {{-- 2 Right Side Stacked Photos (Span 4) --}}
      <div class="lg:col-span-4 flex flex-col gap-5 justify-between">
        
        {{-- Top Right Photo: Balcony Pool View --}}
        <div class="relative rounded-[20px] overflow-hidden shadow-md bg-neutral-200 group h-[210px] sm:h-[230px]">
          <img 
            src="{{ asset('images/golf-vale-pool.png') }}" 
            alt="Golf Vale Pool and Balcony View" 
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-102"
          >
        </div>

        {{-- Bottom Right Photo: Master Bedroom Interior with 'More Photos' badge --}}
        <div class="relative rounded-[20px] overflow-hidden shadow-md bg-neutral-200 group h-[210px] sm:h-[230px]">
          <img 
            src="{{ asset('images/golf-vale-bedroom.png') }}" 
            alt="Golf Vale Master Bedroom Interior" 
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-102"
          >

          {{-- More Photos Floating Badge at bottom right --}}
          <button 
            type="button"
            class="absolute right-4 bottom-4 z-20 flex items-center gap-1.5 bg-white/95 hover:bg-[#C5A47E] hover:text-white text-[#10221C] text-[11px] sm:text-xs font-medium px-3.5 py-1.5 rounded-[8px] shadow-sm transition-all cursor-pointer"
          >
            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M4 4h3l2-2h6l2 2h3a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm8 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6z"/></svg>
            <span>More Photos</span>
          </button>
        </div>

      </div>

    </div>

  </div>
</section>

{{-- Key Project Stats / Tabs Section right below Hero --}}
<section class="w-full bg-white border-b border-[#E5E7EB] py-7 sm:py-8 font-inter">
  <div class="max-w-[1280px] mx-auto px-6">
    <div class="grid grid-cols-2 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-neutral-300">
      
      {{-- Stat 1: Developer / Emaar --}}
      <div class="py-3 sm:py-2 px-3 sm:px-6 md:first:pl-0 flex flex-col justify-center">
        <h4 class="font-inter font-bold text-base sm:text-lg text-[#10221C] tracking-tight leading-snug">
          Developer
        </h4>
        <p class="font-inter font-normal text-xs sm:text-sm text-neutral-500 mt-0.5">
          Emaar
        </p>
      </div>

      {{-- Stat 2: AED 1,099,888 / Starting Price from --}}
      <div class="py-3 sm:py-2 px-3 sm:px-6 flex flex-col justify-center">
        <h4 class="font-inter font-bold text-base sm:text-lg text-[#10221C] tracking-tight leading-snug">
          AED 1,099,888
        </h4>
        <p class="font-inter font-normal text-xs sm:text-sm text-neutral-500 mt-0.5">
          Starting Price from
        </p>
      </div>

      {{-- Stat 3: 1-4br / Available Units --}}
      <div class="py-3 sm:py-2 px-3 sm:px-6 flex flex-col justify-center">
        <h4 class="font-inter font-bold text-base sm:text-lg text-[#10221C] tracking-tight leading-snug">
          1-4br
        </h4>
        <p class="font-inter font-normal text-xs sm:text-sm text-neutral-500 mt-0.5">
          Available Units
        </p>
      </div>

      {{-- Stat 4: 2030 Q1 / Handover --}}
      <div class="py-3 sm:py-2 px-3 sm:px-6 flex flex-col justify-center">
        <h4 class="font-inter font-bold text-base sm:text-lg text-[#10221C] tracking-tight leading-snug">
          2030 Q1
        </h4>
        <p class="font-inter font-normal text-xs sm:text-sm text-neutral-500 mt-0.5">
          Handover
        </p>
      </div>

    </div>
  </div>
</section>
