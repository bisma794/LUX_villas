@php
  $isCommunitiesHero = ($section->key ?? '') === 'communities_intro' || request()->is('communities');
  $introImg = !empty($c['image']) ? $c['image'] : ($isCommunitiesHero ? 'images/communities-hero-villa.jpg' : '');
  $introHeading = array_key_exists('heading_html', $c)
    ? $c['heading_html']
    : ($isCommunitiesHero ? 'Helping you to find the right <span class="script">location</span> in Dubai' : '');
@endphp

@if(!empty($introImg))
<section class="relative min-h-[420px] sm:min-h-[460px] md:min-h-[500px] flex items-center overflow-hidden font-inter">
  <img
    src="{{ asset($introImg) }}"
    alt="{{ $c['image_alt'] ?? 'Dubai Communities' }}"
    class="absolute inset-0 w-full h-full object-cover object-center"
  >
  <div class="absolute inset-0 bg-gradient-to-r from-white via-white/85 to-white/10 md:from-white md:via-white/80 md:to-transparent"></div>
  <div class="relative z-10 max-w-[1280px] mx-auto px-6 sm:px-8 w-full py-16 sm:py-20">
    <div class="max-w-2xl">
      @if(!empty($c['breadcrumb']))
        <p class="text-xs sm:text-[13px] tracking-widest uppercase font-medium text-neutral-500 mb-4 font-source">{{ $c['breadcrumb'] }}</p>
      @endif
      @if(!empty($introHeading))
        <h1 class="font-heading font-medium text-4xl sm:text-5xl md:text-[60px] leading-[1.08] text-[#0E3B2C] tracking-tight">{!! $introHeading !!}</h1>
      @endif
      @if(!empty($c['subtext']))
        <p class="mt-5 text-sm sm:text-base md:text-lg text-neutral-600 leading-relaxed max-w-xl font-source">{{ $c['subtext'] }}</p>
      @endif
      @if(!empty($c['button_text']))
        <div class="mt-7">
          <a href="{{ $c['button_link'] ?? '#communities-grid' }}" class="btn-tan text-sm px-7 py-3 shadow-sm">{{ $c['button_text'] }}</a>
        </div>
      @endif
    </div>
  </div>
</section>
@else
<section class="max-w-[1280px] mx-auto px-6 pt-12 pb-6">
  @if(!empty($c['breadcrumb']))<p class="text-sm tracking-widest text-neutral-500">{{ $c['breadcrumb'] }}</p>@endif
  <h1 class="text-5xl md:text-6xl mt-4">{!! $introHeading !!}</h1>
  @if(!empty($c['subtext']))<p class="mt-5 text-xl text-neutral-600 max-w-2xl">{{ $c['subtext'] }}</p>@endif
</section>
@endif
