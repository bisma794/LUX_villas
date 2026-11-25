<section class="max-w-[1280px] mx-auto px-6 py-16 font-inter">
  
  {{-- Header: Heading & Subtitle --}}
  <div class="mb-10 max-w-3xl">
    <h2 class="font-heading font-medium text-4xl sm:text-[44px] text-[#0E3B2C] leading-tight mb-3">
      Offplan Villa For Sale
    </h2>
    <p class="text-xs sm:text-sm text-neutral-500 font-inter leading-relaxed">
      Discover premium apartments for sale in Dubai, UAE. Explore luxury residences, stunning waterfront homes, and affordable investment opportunities in prime locations with strong rental yields and long-term ROI potential.
    </p>
  </div>

  @php
    $properties = [
      [
        'tag' => 'READY',
        'tag_bg' => 'bg-[#18392B]',
        'image' => 'images/project-fairway-villa.jpg',
        'title' => 'The Fairway Villa',
        'location' => 'Villa · Jumeirah Golf Estates, Dubai',
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
        'image' => 'images/project-maple-row.jpg',
        'title' => 'Maple Row Villa',
        'location' => 'Villa · Dubai Hills Estate, Dubai',
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
        'image' => 'images/project-nara-townhouse.jpg',
        'title' => 'Nara Townhouse',
        'location' => 'Townhouse · The Valley, Dubai',
        'beds' => '3 Beds',
        'baths' => '4 Baths',
        'sqft' => '2,100 sq ft',
        'price' => 'AED 2.15M',
        'yield' => '6.8%',
        'link' => '/buy-listing'
      ],
      [
        'tag' => 'READY',
        'tag_bg' => 'bg-[#18392B]',
        'image' => 'images/project-fairway-villa.jpg',
        'title' => 'The Fairway Villa',
        'location' => 'Villa · Jumeirah Golf Estates, Dubai',
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
        'image' => 'images/project-maple-row.jpg',
        'title' => 'Maple Row Villa',
        'location' => 'Villa · Dubai Hills Estate, Dubai',
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
        'image' => 'images/project-nara-townhouse.jpg',
        'title' => 'Nara Townhouse',
        'location' => 'Townhouse · The Valley, Dubai',
        'beds' => '3 Beds',
        'baths' => '4 Baths',
        'sqft' => '2,100 sq ft',
        'price' => 'AED 2.15M',
        'yield' => '6.8%',
        'link' => '/buy-listing'
      ]
    ];
  @endphp

  {{-- 3 Columns Grid matching Reference Image --}}
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 font-inter">
    @foreach($properties as $item)
    <div class="bg-white border border-[#E5E7EB] rounded-[16px] overflow-hidden shadow-2xs hover:shadow-md transition-shadow flex flex-col justify-between">
      
      {{-- Card Top: Image + Tag --}}
      <div>
        <div class="relative w-full h-[180px] bg-neutral-100 overflow-hidden">
          <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
          <span class="absolute top-3 left-3 {{ $item['tag_bg'] }} text-white text-[10px] font-semibold tracking-wider px-2.5 py-0.5 rounded-[4px] uppercase font-inter shadow-xs">
            {{ $item['tag'] }}
          </span>
        </div>

        {{-- Card Body --}}
        <div class="p-5">
          <h3 class="font-heading font-medium text-2xl text-[#10221C] leading-snug">
            {{ $item['title'] }}
          </h3>
          <p class="text-xs text-neutral-400 font-inter mt-0.5">
            {{ $item['location'] }}
          </p>

          {{-- Specs Row: Beds, Baths, Sqft with Line Icons --}}
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

          {{-- Price & Gross Yield --}}
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

      {{-- Card Actions: View Details (Tan) & Compare (White) --}}
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

</section>
