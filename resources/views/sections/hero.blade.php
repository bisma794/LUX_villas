@if(($c['variant'] ?? '') === 'enquiry_card')
<section class="relative font-inter">
  <img src="{{ asset($c['image'] ?? '') }}" alt="{{ $c['image_alt'] ?? '' }}" class="w-full h-[580px] lg:h-[620px] object-cover">
  <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-black/20"></div>
  <div class="absolute inset-0">
    <div class="max-w-[1280px] mx-auto px-6 w-full h-full flex items-end pb-12 gap-8">
      <div class="text-white flex-1 pb-2">
        @if(!empty($c['breadcrumb']))
          <div class="flex items-center gap-2 text-xs uppercase tracking-widest text-white/80 font-medium mb-3">
            <span>{{ $c['breadcrumb'] }}</span>
          </div>
        @endif
        <h1 class="font-heading font-medium text-4xl sm:text-5xl md:text-6xl text-white leading-tight">
          {!! $c['heading_html'] ?? '' !!}
        </h1>
        @if(!empty($c['subtext']))
          <p class="mt-4 text-base sm:text-lg text-white/90 max-w-xl font-inter leading-relaxed">
            {{ $c['subtext'] }}
          </p>
        @endif
      </div>

      {{-- Enquiry Card Form --}}
      <div class="bg-white rounded-[20px] shadow-2xl p-6 sm:p-7 w-[360px] shrink-0 hidden md:block border border-white/20">
        <h3 class="font-heading font-semibold text-2xl text-[#0E3B2C] leading-snug">
          {{ $c['card_title'] ?? 'Enquire Now' }}
        </h3>
        <input 
          type="text" 
          placeholder="{{ $c['card_name_placeholder'] ?? 'Full Name' }}" 
          class="border border-[#E5E7EB] rounded-lg px-4 py-3 w-full mt-4 text-xs font-inter focus:outline-none focus:border-[#C5A47E]"
        >
        <input 
          type="tel" 
          placeholder="{{ $c['card_phone_placeholder'] ?? 'Phone / Whatsapp (+971…)' }}" 
          class="border border-[#E5E7EB] rounded-lg px-4 py-3 w-full mt-3 text-xs font-inter focus:outline-none focus:border-[#C5A47E]"
        >
        <select class="border border-[#E5E7EB] rounded-lg px-4 py-3 w-full mt-3 text-xs font-inter bg-white text-neutral-700 focus:outline-none focus:border-[#C5A47E]">
          @foreach(($c['card_options'] ?? []) as $o)
            <option>{{ $o }}</option>
          @endforeach
        </select>
        <button class="w-full bg-[#C5A47E] hover:bg-[#b8956e] text-white font-inter font-semibold text-xs py-3.5 rounded-lg mt-4 shadow-sm transition-colors cursor-pointer">
          {{ $c['card_button_text'] ?? 'Request a Call Back' }}
        </button>
      </div>
    </div>
  </div>
</section>
@elseif(($section->key ?? '') === 'assessment_hero' || request()->is('ai-villa-assessment*'))
{{-- AI Villa Assessment Hero Section matching exact reference --}}
<section class="relative min-h-[460px] sm:min-h-[500px] md:min-h-[540px] flex items-center overflow-hidden font-inter">
  {{-- Background Palm Jumeirah Image --}}
  <img 
    src="{{ asset('images/palm-jumeirah-ai-hero.jpg') }}" 
    alt="Palm Jumeirah Aerial View" 
    class="absolute inset-0 w-full h-full object-cover object-center"
  >
  
  {{-- Soft Left-to-Right White Mist/Gradient Overlay --}}
  <div class="absolute inset-0 bg-gradient-to-r from-white via-white/85 to-white/10 md:from-white md:via-white/80 md:to-transparent"></div>

  {{-- Content Container --}}
  <div class="relative z-10 max-w-[1280px] mx-auto px-6 sm:px-8 w-full py-16 sm:py-20">
    <div class="max-w-2xl">
      
      {{-- Breadcrumb: • HOME > AI VILLA ASSESSMENT --}}
      <div class="flex items-center gap-2 text-xs sm:text-[13px] tracking-wider uppercase font-medium text-neutral-500 mb-5 font-inter">
        <span class="w-1.5 h-1.5 rounded-full bg-neutral-400"></span>
        <a href="/" class="hover:text-black transition-colors">HOME</a>
        <span class="text-neutral-400">&gt;</span>
        <span class="text-neutral-700 font-semibold">AI VILLA ASSESSMENT</span>
      </div>

      {{-- Main Heading: Find the Right Villa with AI Insights (Abhaya Libre Medium/SemiBold) --}}
      <h1 class="font-heading font-medium text-4xl sm:text-5xl md:text-[62px] lg:text-[66px] leading-[1.08] text-[#0E3B2C] tracking-tight mb-5">
        Find the Right Villa<br>with AI Insights
      </h1>

      {{-- Subtext: Answer a few questions... (Inter regular) --}}
      <p class="text-xs sm:text-sm md:text-[15px] text-neutral-600 font-inter leading-relaxed max-w-lg">
        Answer a few questions and get a personalised recommendation based on your goals, budget and market data.
      </p>

    </div>
  </div>
</section>
@else
<section class="relative min-h-[580px] md:min-h-[660px] flex items-center overflow-hidden">
  <img src="{{ asset($c['image'] ?? '') }}" alt="{{ $c['image_alt'] ?? '' }}" class="absolute inset-0 w-full h-full object-cover">
  {{-- White gradient overlay on hero image --}}
  <div class="absolute inset-0 bg-gradient-to-r from-white via-white/85 to-white/10 md:from-white md:via-white/75 md:to-transparent"></div>
  <div class="relative z-10 max-w-[1280px] mx-auto px-6 w-full pt-16 pb-24">
    <div class="max-w-3xl text-[#0E3B2C]">
      @if(!empty($c['breadcrumb']))<p class="text-xs tracking-widest uppercase font-semibold text-neutral-500 font-source mb-3">{{ $c['breadcrumb'] }}</p>@endif
      @if(!empty($c['eyebrow']))<p class="eyebrow text-neutral-600 font-source text-xs tracking-[0.2em] mb-2">{{ $c['eyebrow'] }}</p>@endif
      <h1 class="font-heading font-medium text-5xl md:text-[76px] lg:text-[82px] leading-[1.05] text-[#0E3B2C] tracking-tight">{!! $c['heading_html'] ?? '' !!}</h1>
      @if(!empty($c['subtext']))<p class="mt-6 text-lg md:text-xl text-[#0E3B2C]/85 leading-relaxed font-source max-w-2xl">{{ $c['subtext'] }}</p>@endif
      @if(!empty($c['button_text']))
      <div class="mt-8 mb-4">
        <a href="{{ $c['button_link'] ?? '#' }}" class="btn-tan text-sm md:text-base !px-7 !py-3.5 shadow-sm hover:shadow-md transition-all font-source">{{ $c['button_text'] }}</a>
      </div>
      @endif
    </div>
  </div>
</section>
@endif
