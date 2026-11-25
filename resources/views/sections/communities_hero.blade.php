<section class="relative min-h-[380px] sm:min-h-[440px] md:min-h-[480px] flex items-center overflow-hidden bg-white font-inter">
  
  {{-- Right Side Villa Architecture Image (Provided high-res crisp photo) --}}
  <div class="absolute right-0 top-0 bottom-0 w-full md:w-[60%] lg:w-[54%] h-full overflow-hidden select-none pointer-events-none">
    <img 
      src="{{ asset('images/communities-hero-villa.jpg') }}?v={{ time() }}" 
      alt="Dubai Communities Luxury Villa" 
      class="w-full h-full object-cover object-left"
    >
    {{-- Soft gradient blend on left so typography on white stays 100% sharp and readable --}}
    <div class="absolute inset-y-0 left-0 w-32 sm:w-48 bg-gradient-to-r from-white via-white/85 to-transparent"></div>
  </div>

  {{-- Content Container --}}
  <div class="relative z-10 max-w-[1280px] mx-auto px-6 w-full py-16 sm:py-20">
    <div class="max-w-2xl font-inter">
      
      {{-- Breadcrumb: • HOME › COMMUNITIES --}}
      <div class="flex items-center gap-1.5 text-xs text-neutral-500 font-medium font-inter mb-4 tracking-wider">
        <span>•</span>
        <a href="/" class="hover:text-black">HOME</a>
        <span>&rsaquo;</span>
        <span class="text-neutral-800 uppercase">COMMUNITIES</span>
      </div>

      {{-- Main Heading: Helping you to find the right location in Dubai --}}
      <h1 class="font-heading font-medium text-4xl sm:text-5xl md:text-[56px] lg:text-[60px] text-[#0E3B2C] leading-[1.12] tracking-tight">
        Helping you to find the <br>
        right location in <span class="font-script font-normal text-[52px] sm:text-[62px] md:text-[76px] text-[#0E3B2C] lowercase tracking-normal -ml-1">Dubai</span>
      </h1>

      {{-- Subtitle text --}}
      <p class="mt-4 sm:mt-5 text-xs sm:text-sm md:text-base text-neutral-600 font-inter leading-relaxed max-w-xl">
        Discover the heart and soul of Dubai's communities with our expertly curated community guides
      </p>

    </div>
  </div>
</section>
