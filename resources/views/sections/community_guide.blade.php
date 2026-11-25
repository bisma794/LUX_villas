<section class="max-w-[1280px] mx-auto px-6 pt-10 pb-16 font-inter" data-tabs>
  
  {{-- Filter Pills Navigation Bar: Spans and aligns cleanly with the right side form edge --}}
  <div class="w-full">
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 sm:gap-4 w-full">
      @foreach(($c['tabs'] ?? []) as $i => $t)
        <button 
          type="button"
          data-tab="{{ $t['key'] }}" 
          class="tab-btn w-full py-3.5 px-4 rounded-full text-xs sm:text-sm font-semibold text-center transition-all cursor-pointer whitespace-nowrap {{ $i === 0 ? 'bg-[#C5A47E] text-white shadow-xs' : 'bg-white text-neutral-700 border border-[#D1D5DB] hover:border-[#0E3B2C] hover:bg-neutral-50' }}"
        >
          {{ $t['label'] }}
        </button>
      @endforeach
    </div>
  </div>

  {{-- Tab Panels --}}
  @foreach(($c['tabs'] ?? []) as $i => $t)
    @php $p = ($c['panels'] ?? [])[$t['key']] ?? []; @endphp
    <div data-panel="{{ $t['key'] }}" class="{{ $i === 0 ? '' : 'hidden' }} mt-12">
      
      @if(($p['kind'] ?? '') === 'guide')
        {{-- Swapped layout: Left side Text, Right side Video/Image --}}
        <div class="grid md:grid-cols-2 gap-10 lg:gap-14 items-center">
          
          {{-- Left: Text Content --}}
          <div class="order-2 md:order-1 font-inter">
            <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[42px] text-[#0E3B2C] leading-tight">
              {!! $p['heading_html'] ?? '' !!}
            </h2>
            <p class="mt-5 text-sm sm:text-base text-neutral-600 font-inter leading-relaxed max-w-xl">
              {{ $p['text'] ?? '' }}
            </p>
          </div>

          {{-- Right: Video / Image Card --}}
          <div class="order-1 md:order-2 relative rounded-[20px] overflow-hidden shadow-md">
            <img src="{{ asset($p['image'] ?? '') }}" alt="{{ $p['image_alt'] ?? '' }}" class="w-full h-[360px] sm:h-[400px] object-cover">
            <span class="absolute inset-0 flex items-center justify-center bg-black/10">
              <span class="w-16 h-16 rounded-full bg-white/90 shadow-lg flex items-center justify-center text-[#0E3B2C] text-xl pl-1 hover:scale-110 transition-transform cursor-pointer">
                <svg class="w-6 h-6 fill-current translate-x-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
              </span>
            </span>
          </div>

        </div>

      @elseif(($p['kind'] ?? '') === 'chips')
        <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[42px] text-[#0E3B2C] mb-6">
          {!! $p['heading_html'] ?? '' !!}
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6 font-inter">
          @php
            $amenityIconMap = [
              'Children Play Area' => 'images/amenity-children.png',
              'Schools' => 'images/amenity-schools.png',
              'Restaurants' => 'images/amenity-restaurants.png',
              'Shopping Malls' => 'images/amenity-mall.png',
              'Shopping Mall' => 'images/amenity-mall.png',
              'Sports Facilities' => 'images/amenity-sports.png',
              'Fitness Centre' => 'images/amenity-fitness.png',
              'Parking Area' => 'images/amenity-parking.png',
              'Walking Trails' => 'images/amenity-trails.png',
            ];
          @endphp
          @foreach(($p['chips'] ?? []) as $chip)
            @php $icon = $amenityIconMap[$chip] ?? 'images/amenity-children.png'; @endphp
            <div class="bg-white border border-[#D2D2D2] rounded-[15px] p-5 sm:p-6 flex items-center gap-3.5 sm:gap-4 shadow-2xs hover:border-[#0E3B2C] hover:shadow-xs transition-all duration-300">
              <div class="w-10 h-10 sm:w-11 sm:h-11 shrink-0 flex items-center justify-center">
                <img src="{{ asset($icon) }}" alt="{{ $chip }}" class="w-full h-full object-contain">
              </div>
              <span class="font-inter font-medium text-xs sm:text-sm text-[#10221C] leading-snug">
                {{ $chip }}
              </span>
            </div>
          @endforeach
        </div>

      @elseif(($p['kind'] ?? '') === 'cta')
        <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[42px] text-[#0E3B2C]">
          {!! $p['heading_html'] ?? '' !!}
        </h2>
        <p class="mt-4 text-sm sm:text-base text-neutral-600 max-w-2xl font-inter leading-relaxed">
          {{ $p['text'] ?? '' }}
        </p>
        @if(!empty($p['button_text']))
          <a href="{{ $p['button_link'] ?? '#' }}" class="inline-flex items-center gap-2 bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold px-6 py-3 rounded-md mt-6 transition-colors shadow-xs font-inter">
            {{ $p['button_text'] }}
          </a>
        @endif

      @else
        <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[42px] text-[#0E3B2C]">
          {!! $p['heading_html'] ?? '' !!}
        </h2>
        <p class="mt-4 text-sm sm:text-base text-neutral-600 max-w-3xl font-inter leading-relaxed">
          {{ $p['text'] ?? '' }}
        </p>
      @endif

    </div>
  @endforeach

  @if(!empty($c['amenities']) && empty(($c['panels'] ?? [])['amenities']))
    <div class="mt-14">
      <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[42px] text-[#0E3B2C]">
        {!! $c['amenities_heading_html'] ?? 'Amenities &amp; Facilities' !!}
      </h2>
      <div class="flex flex-wrap gap-3 mt-6 font-inter">
        @foreach($c['amenities'] as $a)
          <span class="px-5 py-2.5 rounded-full border border-[#E5E7EB] bg-white text-xs font-medium text-neutral-700 shadow-2xs font-inter">
            {{ $a }}
          </span>
        @endforeach
      </div>
    </div>
  @endif

</section>

{{-- Full-Width Stats Band Section matching reference screenshot --}}
@if(!isset($c['hide_stats_band']) || !$c['hide_stats_band'])
<section class="w-full bg-[#C2A37D] py-8 sm:py-10 text-white font-inter">
  <div class="max-w-[1280px] mx-auto px-6">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 items-start">
      
      {{-- Stat 1 --}}
      <div>
        <h3 class="font-heading font-medium text-2xl sm:text-3xl text-white tracking-tight">
          7,000+
        </h3>
        <p class="font-inter text-xs sm:text-sm text-white/90 mt-1 font-normal">
          Acres planned
        </p>
      </div>

      {{-- Stat 2 --}}
      <div>
        <h3 class="font-heading font-medium text-2xl sm:text-3xl text-white tracking-tight">
          Residential
        </h3>
        <p class="font-inter text-xs sm:text-sm text-white/90 mt-1 font-normal">
          Villas, townhouses.
        </p>
      </div>

      {{-- Stat 3 --}}
      <div>
        <h3 class="font-heading font-medium text-2xl sm:text-3xl text-white tracking-tight">
          Green Spaces
        </h3>
        <p class="font-inter text-xs sm:text-sm text-white/90 mt-1 font-normal">
          Parks, lakes and trails
        </p>
      </div>

      {{-- Stat 4 --}}
      <div>
        <h3 class="font-heading font-medium text-2xl sm:text-3xl text-white tracking-tight">
          Integrated
        </h3>
        <p class="font-inter text-xs sm:text-sm text-white/90 font-inter mt-1 font-normal">
          Live, work, shop and relax
        </p>
      </div>

    </div>
  </div>
</section>
@endif

{{-- Community Highlights Section (6 Cards with 20px rounded corners) --}}
<section class="max-w-[1280px] mx-auto px-6 py-16 sm:py-20 font-inter">
  {{-- Section Heading: Abhaya Libre Medium, No Cursive --}}
  <div class="mb-8 sm:mb-10">
    <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[42px] text-[#10221C] tracking-tight">
      Community Highlights
    </h2>
  </div>

  @php
    $highlights = [
      [
        'title' => 'Lakes & Waterfronts',
        'image' => 'images/highlight-golf.png',
        'link' => '#'
      ],
      [
        'title' => 'Lakes & Waterfronts',
        'image' => 'images/highlight-island.png',
        'link' => '#'
      ],
      [
        'title' => 'Lakes & Waterfronts',
        'image' => 'images/highlight-marina.jpg',
        'link' => '#'
      ],
      [
        'title' => 'Lakes & Waterfronts',
        'image' => 'images/highlight-marina.jpg',
        'link' => '#'
      ],
      [
        'title' => 'Lakes & Waterfronts',
        'image' => 'images/highlight-lagoon.jpg',
        'link' => '#'
      ],
      [
        'title' => 'Lakes & Waterfronts',
        'image' => 'images/highlight-futuristic.png',
        'link' => '#'
      ],
    ];
  @endphp

  {{-- 6 Cards Grid: 3 per row on lg, 2 per row on sm/md --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7">
    @foreach($highlights as $h)
      <a href="{{ $h['link'] }}" class="group block bg-white rounded-[20px] border border-[#E5E7EB] overflow-hidden shadow-2xs hover:shadow-md transition-all duration-300">
        {{-- Card Image (Corner radius 20 at top) --}}
        <div class="w-full h-[200px] sm:h-[220px] overflow-hidden bg-neutral-100">
          <img 
            src="{{ asset($h['image']) }}" 
            alt="{{ $h['title'] }}" 
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
          >
        </div>

        {{-- Card Footer Bar: Inter Regular, Arrow on right --}}
        <div class="px-5 py-4 flex items-center justify-between bg-white">
          <span class="font-inter font-normal text-sm sm:text-[15px] text-[#10221C] group-hover:text-[#C5A47E] transition-colors">
            {{ $h['title'] }}
          </span>
          <span class="text-neutral-400 group-hover:text-[#C5A47E] group-hover:translate-x-1 transition-all text-sm">
            &gt;
          </span>
        </div>
      </a>
    @endforeach
  </div>
</section>

@php
  $valleyCards1 = [
    [
      'tag' => 'OFF-PLAN',
      'tag_bg' => 'bg-[#C5A47E]',
      'image' => 'images/property-photo-1.jpg',
      'title' => 'The Fairway Villa',
      'location' => 'Villa Â· Jumeirah Golf Estates, Dubai',
      'beds' => '5 Beds',
      'baths' => '6 Baths',
      'sqft' => '7,200 sq ft',
      'price' => 'AED 18.5M',
      'yield' => '5.1%',
      'link' => '/buy-listing'
    ],
    [
      'tag' => 'OFF-PLAN',
      'tag_bg' => 'bg-[#C5A47E]',
      'image' => 'images/property-photo-2.jpg',
      'title' => 'Maple Row Villa',
      'location' => 'Villa Â· Dubai Hills Estate, Dubai',
      'beds' => '4 Beds',
      'baths' => '5 Baths',
      'sqft' => '4,100 sq ft',
      'price' => 'AED 7.9M',
      'yield' => '5.6%',
      'link' => '/buy-listing'
    ],
    [
      'tag' => 'OFF-PLAN',
      'tag_bg' => 'bg-[#C5A47E]',
      'image' => 'images/property-photo-4.jpg',
      'title' => 'Nara Townhouse',
      'location' => 'Townhouse Â· The Valley, Dubai',
      'beds' => '3 Beds',
      'baths' => '4 Baths',
      'sqft' => '2,100 sq ft',
      'price' => 'AED 2.15M',
      'yield' => '6.8%',
      'link' => '/buy-listing'
    ],
  ];

  $valleyCards2 = [
    [
      'tag' => 'READY',
      'tag_bg' => 'bg-[#18392B]',
      'image' => 'images/property-photo-5.jpg',
      'title' => 'The Fairway Villa',
      'location' => 'Villa Â· Jumeirah Golf Estates, Dubai',
      'beds' => '5 Beds',
      'baths' => '6 Baths',
      'sqft' => '7,200 sq ft',
      'price' => 'AED 18.5M',
      'yield' => '5.1%',
      'link' => '/buy-listing'
    ],
    [
      'tag' => 'READY',
      'tag_bg' => 'bg-[#18392B]',
      'image' => 'images/valley-card-6.png',
      'title' => 'Maple Row Villa',
      'location' => 'Villa Â· Dubai Hills Estate, Dubai',
      'beds' => '4 Beds',
      'baths' => '5 Baths',
      'sqft' => '4,100 sq ft',
      'price' => 'AED 7.9M',
      'yield' => '5.6%',
      'link' => '/buy-listing'
    ],
    [
      'tag' => 'OFF-PLAN',
      'tag_bg' => 'bg-[#C5A47E]',
      'image' => 'images/property-photo-1.jpg',
      'title' => 'Nara Townhouse',
      'location' => 'Townhouse Â· The Valley, Dubai',
      'beds' => '3 Beds',
      'baths' => '4 Baths',
      'sqft' => '2,100 sq ft',
      'price' => 'AED 2.15M',
      'yield' => '6.8%',
      'link' => '/buy-listing'
    ],
  ];
@endphp

{{-- Section 1: Offplan The Valley Projects --}}
<section class="max-w-[1280px] mx-auto px-6 py-12 font-inter relative">
  {{-- Header: Left Title, Right Pills (Villas, Town Houses, Off-Plan) --}}
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[42px] text-[#10221C] tracking-tight">
      Offplan The Valley Projects
    </h2>

    <div class="flex items-center gap-2">
      <button type="button" class="bg-[#C5A47E] text-white text-xs font-medium px-5 py-2 rounded-[6px] shadow-2xs">
        Villas
      </button>
      <button type="button" class="bg-white hover:bg-neutral-50 text-neutral-600 text-xs font-medium px-4 py-2 rounded-[6px] border border-neutral-200 transition-colors">
        Town Houses
      </button>
      <button type="button" class="bg-white hover:bg-neutral-50 text-neutral-600 text-xs font-medium px-4 py-2 rounded-[6px] border border-neutral-200 transition-colors">
        Off-Plan
      </button>
    </div>
  </div>

  {{-- Cards Carousel Container with Left/Right Arrow Buttons --}}
  <div class="relative">
    {{-- Left Arrow --}}
    <button type="button" class="absolute -left-4 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-full bg-white shadow-md border border-neutral-200 flex items-center justify-center text-neutral-600 hover:text-black hover:scale-105 transition-all cursor-pointer">
      &lsaquo;
    </button>
    {{-- Right Arrow --}}
    <button type="button" class="absolute -right-4 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-full bg-white shadow-md border border-neutral-200 flex items-center justify-center text-neutral-600 hover:text-black hover:scale-105 transition-all cursor-pointer">
      &rsaquo;
    </button>

    {{-- 3 Cards Row --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($valleyCards1 as $item)
      <div class="bg-white rounded-[14px] border border-[#E5E7EB] overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between">
        <div>
          <div class="relative w-full h-[180px] bg-neutral-100 overflow-hidden">
            <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
            <span class="absolute top-3 left-3 {{ $item['tag_bg'] }} text-white text-[10px] font-semibold tracking-wider px-2.5 py-0.5 rounded-[4px] uppercase font-inter shadow-xs">
              {{ $item['tag'] }}
            </span>
          </div>

          <div class="p-5">
            <h3 class="font-heading font-medium text-2xl text-[#10221C] leading-snug">
              {{ $item['title'] }}
            </h3>
            <p class="text-xs text-neutral-400 font-inter mt-0.5">
              {{ $item['location'] }}
            </p>

            <div class="grid grid-cols-3 gap-2 py-3 mt-4 border-t border-b border-neutral-100 text-xs text-neutral-500 font-inter">
              <span class="inline-flex items-center gap-1.5 truncate">
                <svg class="w-3.5 h-3.5 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>{{ $item['beds'] }}</span>
              </span>
              <span class="inline-flex items-center gap-1.5 truncate">
                <svg class="w-3.5 h-3.5 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>{{ $item['baths'] }}</span>
              </span>
              <span class="inline-flex items-center gap-1.5 truncate">
                <svg class="w-3.5 h-3.5 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                <span>{{ $item['sqft'] }}</span>
              </span>
            </div>

            <div class="flex items-baseline justify-between pt-3.5 pb-2">
              <div>
                <span class="font-heading font-bold text-xl sm:text-2xl text-[#10221C]">
                  {{ $item['price'] }}
                </span>
              </div>
              <div class="text-right">
                <span class="block text-[9px] uppercase tracking-wider text-neutral-400 font-medium">Gross yield</span>
                <span class="font-inter font-bold text-xs text-[#10221C]">{{ $item['yield'] }}</span>
              </div>
            </div>
          </div>
        </div>

        <div class="px-5 pb-5 grid grid-cols-2 gap-2.5">
          <a href="{{ $item['link'] }}" class="inline-flex items-center justify-center bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold py-2 px-3 rounded-[6px] transition-colors shadow-2xs text-center cursor-pointer">
            View Details
          </a>
          <button type="button" class="inline-flex items-center justify-center bg-white hover:bg-neutral-50 text-neutral-700 text-xs font-medium py-2 px-3 rounded-[6px] border border-neutral-300 transition-colors shadow-2xs text-center cursor-pointer">
            + Compare
          </button>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Section 2: Ready The Valley Projects --}}
<section class="max-w-[1280px] mx-auto px-6 py-12 font-inter relative">
  {{-- Header: Left Title, Right Pills (Villas, Town Houses, Off-Plan) --}}
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[42px] text-[#10221C] tracking-tight">
      Ready The Valley Projects
    </h2>

    <div class="flex items-center gap-2">
      <button type="button" class="bg-[#C5A47E] text-white text-xs font-medium px-5 py-2 rounded-[6px] shadow-2xs">
        Villas
      </button>
      <button type="button" class="bg-white hover:bg-neutral-50 text-neutral-600 text-xs font-medium px-4 py-2 rounded-[6px] border border-neutral-200 transition-colors">
        Town Houses
      </button>
      <button type="button" class="bg-white hover:bg-neutral-50 text-neutral-600 text-xs font-medium px-4 py-2 rounded-[6px] border border-neutral-200 transition-colors">
        Off-Plan
      </button>
    </div>
  </div>

  {{-- Cards Carousel Container with Left/Right Arrow Buttons --}}
  <div class="relative">
    {{-- Left Arrow --}}
    <button type="button" class="absolute -left-4 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-full bg-white shadow-md border border-neutral-200 flex items-center justify-center text-neutral-600 hover:text-black hover:scale-105 transition-all cursor-pointer">
      &lsaquo;
    </button>
    {{-- Right Arrow --}}
    <button type="button" class="absolute -right-4 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-full bg-white shadow-md border border-neutral-200 flex items-center justify-center text-neutral-600 hover:text-black hover:scale-105 transition-all cursor-pointer">
      &rsaquo;
    </button>

    {{-- 3 Cards Row --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($valleyCards2 as $item)
      <div class="bg-white rounded-[14px] border border-[#E5E7EB] overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between">
        <div>
          <div class="relative w-full h-[180px] bg-neutral-100 overflow-hidden">
            <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
            <span class="absolute top-3 left-3 {{ $item['tag_bg'] }} text-white text-[10px] font-semibold tracking-wider px-2.5 py-0.5 rounded-[4px] uppercase font-inter shadow-xs">
              {{ $item['tag'] }}
            </span>
          </div>

          <div class="p-5">
            <h3 class="font-heading font-medium text-2xl text-[#10221C] leading-snug">
              {{ $item['title'] }}
            </h3>
            <p class="text-xs text-neutral-400 font-inter mt-0.5">
              {{ $item['location'] }}
            </p>

            <div class="grid grid-cols-3 gap-2 py-3 mt-4 border-t border-b border-neutral-100 text-xs text-neutral-500 font-inter">
              <span class="inline-flex items-center gap-1.5 truncate">
                <svg class="w-3.5 h-3.5 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>{{ $item['beds'] }}</span>
              </span>
              <span class="inline-flex items-center gap-1.5 truncate">
                <svg class="w-3.5 h-3.5 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>{{ $item['baths'] }}</span>
              </span>
              <span class="inline-flex items-center gap-1.5 truncate">
                <svg class="w-3.5 h-3.5 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                <span>{{ $item['sqft'] }}</span>
              </span>
            </div>

            <div class="flex items-baseline justify-between pt-3.5 pb-2">
              <div>
                <span class="font-heading font-bold text-xl sm:text-2xl text-[#10221C]">
                  {{ $item['price'] }}
                </span>
              </div>
              <div class="text-right">
                <span class="block text-[9px] uppercase tracking-wider text-neutral-400 font-medium">Gross yield</span>
                <span class="font-inter font-bold text-xs text-[#10221C]">{{ $item['yield'] }}</span>
              </div>
            </div>
          </div>
        </div>

        <div class="px-5 pb-5 grid grid-cols-2 gap-2.5">
          <a href="{{ $item['link'] }}" class="inline-flex items-center justify-center bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold py-2 px-3 rounded-[6px] transition-colors shadow-2xs text-center cursor-pointer">
            View Details
          </a>
          <button type="button" class="inline-flex items-center justify-center bg-white hover:bg-neutral-50 text-neutral-700 text-xs font-medium py-2 px-3 rounded-[6px] border border-neutral-300 transition-colors shadow-2xs text-center cursor-pointer">
            + Compare
          </button>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- A complete lifestyle community Section --}}
<section class="max-w-[1280px] mx-auto px-6 py-16 sm:py-20 font-inter">
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
    
    {{-- Left: Image with Corner Radius 21 --}}
    <div class="lg:col-span-6">
      <div class="relative overflow-hidden rounded-[21px] shadow-sm bg-neutral-100 h-[380px] sm:h-[420px] md:h-[460px]">
        <img 
          src="{{ asset('images/lifestyle-community-walk.jpg') }}" 
          alt="A complete lifestyle community in Dubai" 
          class="w-full h-full object-cover object-center"
        >
      </div>
    </div>

    {{-- Right: Content with Corner Radius 14 Feature Cards --}}
    <div class="lg:col-span-6 font-inter">
      
      {{-- Subtitle / Eyebrow: Inter --}}
      <p class="font-inter text-xs sm:text-sm font-semibold text-neutral-600 tracking-wider mb-2">
        Lifestyle
      </p>

      {{-- Heading: Abhaya Libre Medium --}}
      <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[46px] lg:text-[48px] text-[#0E3B2C] leading-[1.15] tracking-tight mb-4">
        A complete lifestyle<br>community
      </h2>

      {{-- Description: Inter --}}
      <p class="font-inter text-xs sm:text-sm text-neutral-500 leading-relaxed max-w-xl mb-8">
        Bahria Town Dubai offers a balanced lifestyle with residential, retail, educational and recreational facilities, all within a secure, well-planned environment.
      </p>

      {{-- 4 Feature Rectangles: Corner Radius 14, Soft Warm Cream Background --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
        
        {{-- Card 1: Live --}}
        <div class="bg-[#F8F5EF] rounded-[14px] p-4.5 sm:p-5 flex flex-col justify-center">
          <h4 class="font-inter font-bold text-sm text-[#10221C] mb-1">
            Live
          </h4>
          <p class="font-inter text-[11px] sm:text-xs text-neutral-500 leading-normal">
            Villas, townhouses, apartments
          </p>
        </div>

        {{-- Card 2: Shop --}}
        <div class="bg-[#F8F5EF] rounded-[14px] p-4.5 sm:p-5 flex flex-col justify-center">
          <h4 class="font-inter font-bold text-sm text-[#10221C] mb-1">
            Shop
          </h4>
          <p class="font-inter text-[11px] sm:text-xs text-neutral-500 leading-normal">
            Retail and dining close by
          </p>
        </div>

        {{-- Card 3: Learn --}}
        <div class="bg-[#F8F5EF] rounded-[14px] p-4.5 sm:p-5 flex flex-col justify-center">
          <h4 class="font-inter font-bold text-sm text-[#10221C] mb-1">
            Learn
          </h4>
          <p class="font-inter text-[11px] sm:text-xs text-neutral-500 leading-normal">
            Educational facilities
          </p>
        </div>

        {{-- Card 4: Relax --}}
        <div class="bg-[#F8F5EF] rounded-[14px] p-4.5 sm:p-5 flex flex-col justify-center">
          <h4 class="font-inter font-bold text-sm text-[#10221C] mb-1">
            Relax
          </h4>
          <p class="font-inter text-[11px] sm:text-xs text-neutral-500 leading-normal">
            Parks, lakes and trails
          </p>
        </div>

      </div>

    </div>

  </div>
</section>

{{-- Amenities & Facilities Section in continuity --}}
<section class="max-w-[1280px] mx-auto px-6 py-16 sm:py-20 font-inter">
  <div class="mb-8 sm:mb-10">
    <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[42px] text-[#0E3B2C] tracking-tight">
      Amenities &amp; Facilities
    </h2>
  </div>

  <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6">
    @php
      $valleyAmenities = [
        ['name' => 'Children Play Area', 'img' => 'images/amenity-children.png'],
        ['name' => 'Schools', 'img' => 'images/amenity-schools.png'],
        ['name' => 'Restaurants', 'img' => 'images/amenity-restaurants.png'],
        ['name' => 'Shopping Mall', 'img' => 'images/amenity-mall.png'],
        ['name' => 'Sports Facilities', 'img' => 'images/amenity-sports.png'],
        ['name' => 'Fitness Centre', 'img' => 'images/amenity-fitness.png'],
        ['name' => 'Parking Area', 'img' => 'images/amenity-parking.png'],
        ['name' => 'Walking Trails', 'img' => 'images/amenity-trails.png'],
      ];
    @endphp

    @foreach($valleyAmenities as $am)
      <div class="bg-white border border-[#D2D2D2] rounded-[15px] p-5 sm:p-6 flex items-center gap-3.5 sm:gap-4 shadow-2xs hover:border-[#0E3B2C] hover:shadow-xs transition-all duration-300">
        <div class="w-10 h-10 sm:w-11 sm:h-11 shrink-0 flex items-center justify-center">
          <img src="{{ asset($am['img']) }}" alt="{{ $am['name'] }}" class="w-full h-full object-contain">
        </div>
        <span class="font-inter font-medium text-xs sm:text-sm text-[#10221C] leading-snug">
          {{ $am['name'] }}
        </span>
      </div>
    @endforeach
  </div>
</section>

