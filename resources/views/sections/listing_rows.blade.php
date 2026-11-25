<section class="max-w-[1280px] mx-auto px-6 pt-10 font-inter">
  {{-- Breadcrumb: New > Villas for Sale in Dubai --}}
  <div class="flex items-center gap-2 text-xs text-neutral-500 font-inter mb-4">
    <span class="hover:text-black cursor-pointer">New</span>
    <span>&gt;</span>
    <span class="text-neutral-800 font-medium">Villas for Sale in Dubai</span>
  </div>

  {{-- Title Bar: Heading + Ads count + Right Controls (Clear Filters, Sort: Popular, Save Search) --}}
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div class="flex items-baseline flex-wrap gap-3">
      <h1 class="font-heading font-medium text-3xl md:text-[40px] text-[#0E3B2C] leading-none tracking-tight">
        Villas for Sale in Dubai
      </h1>
      <span class="font-inter text-lg md:text-xl text-[#777777] font-normal">
        • 14,913 Ads
      </span>
    </div>

    {{-- Top Right Buttons matching screenshot --}}
    <div class="flex items-center gap-3 shrink-0 font-inter text-xs">
      <button type="button" class="text-[#D35B47] hover:underline font-medium cursor-pointer">
        Clear Filters
      </button>
      <div class="relative">
        <button type="button" class="inline-flex items-center gap-1.5 bg-[#0E3B2C] text-white px-4 py-2 rounded-full font-medium shadow-xs cursor-pointer">
          <span>Sort: Popular</span>
          <span class="text-[10px]">▼</span>
        </button>
      </div>
      <button type="button" class="inline-flex items-center gap-1.5 bg-[#E5CFB3] text-[#0E3B2C] px-4 py-2 rounded-full font-medium shadow-xs cursor-pointer hover:bg-[#d8bf9f]">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
        <span>Save Search</span>
      </button>
    </div>
  </div>

  {{-- Location Quick Pills --}}
  <div class="flex flex-wrap items-center gap-2.5 mb-6 font-inter text-xs">
    @foreach(($c['chips'] ?? ['The Valley by Emaar (1189)', 'The Oasis by Emaar (1014)', 'Mohammed Bin Rashid City (MBR City) (799)', 'Dubai South (757)']) as $chip)
    <span class="bg-white border border-[#E8ECE9] text-neutral-700 px-4 py-2 rounded-[8px] cursor-pointer hover:border-[#0E3B2C] transition-colors shadow-2xs">
      {{ $chip }}
    </span>
    @endforeach
    <button type="button" class="bg-[#0E3B2C] text-white px-5 py-2 rounded-full font-medium text-xs hover:bg-[#154a38] transition-colors cursor-pointer shadow-xs">
      View More
    </button>
  </div>

  {{-- Main Filter Panel (Outer rounded white card) --}}
  <div class="bg-white border border-[#EBECEB] rounded-[14px] p-3.5 shadow-[0_2px_12px_rgba(0,0,0,0.03)] mb-4 font-inter">
    <div class="flex flex-wrap items-center gap-2.5">
      
      {{-- All Categories dropdown --}}
      <div class="relative">
        <select class="bg-transparent border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-3.5 py-2.5 pr-7 appearance-none cursor-pointer hover:border-neutral-300 focus:outline-none">
          <option>All Categories</option>
          <option>Villas</option>
          <option>Townhouses</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center text-neutral-400 text-[10px]">▼</span>
      </div>

      {{-- Property Type --}}
      <div class="border border-[#E8ECE9] text-neutral-600 text-xs font-medium rounded-[8px] px-3.5 py-2.5 cursor-pointer hover:border-neutral-300">
        Property Type
      </div>

      {{-- Beds --}}
      <div class="relative">
        <select class="bg-transparent border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-3.5 py-2.5 pr-7 appearance-none cursor-pointer hover:border-neutral-300 focus:outline-none">
          <option>Beds</option>
          <option>3 Beds</option>
          <option>4 Beds</option>
          <option>5+ Beds</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center text-neutral-400 text-[10px]">▼</span>
      </div>

      {{-- Price --}}
      <div class="relative">
        <select class="bg-transparent border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-3.5 py-2.5 pr-7 appearance-none cursor-pointer hover:border-neutral-300 focus:outline-none">
          <option>Price</option>
          <option>Under AED 3M</option>
          <option>AED 3M - 6M</option>
          <option>AED 6M+</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center text-neutral-400 text-[10px]">▼</span>
      </div>

      {{-- Payment Plan --}}
      <div class="relative">
        <select class="bg-transparent border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-3.5 py-2.5 pr-7 appearance-none cursor-pointer hover:border-neutral-300 focus:outline-none">
          <option>Payment Plan</option>
          <option>Cash</option>
          <option>Post Handover</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center text-neutral-400 text-[10px]">▼</span>
      </div>

      {{-- Filters Button --}}
      <button type="button" class="inline-flex items-center gap-1.5 border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-3.5 py-2.5 hover:border-neutral-300 cursor-pointer">
        <span>Filters</span>
        <svg class="w-3.5 h-3.5 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
      </button>

      {{-- Sort/Swap Icon Button --}}
      <button type="button" class="w-9 h-9 border border-[#E8ECE9] rounded-[8px] flex items-center justify-center text-neutral-600 hover:border-neutral-300 cursor-pointer">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
      </button>

      {{-- Map Toggle Button --}}
      <button type="button" class="ml-auto inline-flex items-center gap-2 border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-4 py-2 hover:border-neutral-300 cursor-pointer">
        <span>Map</span>
        <svg class="w-3.5 h-3.5 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
      </button>

    </div>
  </div>

  {{-- Keyword Search Row --}}
  <div class="flex items-center gap-3 mb-6 font-inter">
    <div class="flex-1 relative">
      <span class="absolute inset-y-0 left-4 flex items-center text-neutral-400">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      </span>
      <input type="text" placeholder="Search by community project or developer" class="w-full bg-white border border-[#EBECEB] rounded-[8px] pl-11 pr-4 py-3 text-xs md:text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#0E3B2C] shadow-2xs">
    </div>
    <button type="button" class="bg-[#0E3B2C] hover:bg-[#154a38] text-white px-8 py-3 rounded-[8px] text-sm font-medium transition-colors cursor-pointer shadow-xs">
      Search
    </button>
  </div>

  {{-- Status Tabs Row (ALL, READY, OFF-PLAN, RE-SALE) & Show Verified Toggle --}}
  <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-neutral-200 font-inter text-xs">
    <div class="flex items-center gap-6 font-semibold">
      <button type="button" class="bg-[#0E3B2C] text-white px-5 py-2 rounded-full cursor-pointer">
        ALL
      </button>
      <button type="button" class="text-neutral-600 hover:text-black cursor-pointer">
        READY
      </button>
      <button type="button" class="text-neutral-600 hover:text-black cursor-pointer">
        OFF-PLAN
      </button>
      <button type="button" class="text-neutral-600 hover:text-black cursor-pointer">
        RE-SALE
      </button>
    </div>

    {{-- Show Verified First Switch --}}
    <div class="flex items-center gap-2.5 text-xs text-neutral-600">
      <span>Show Verified First</span>
      <label class="relative inline-flex items-center cursor-pointer">
        <input type="checkbox" class="sr-only peer">
        <div class="w-9 h-5 bg-neutral-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#0E3B2C]"></div>
      </label>
    </div>
  </div>
</section>

{{-- ======================================================== --}}
{{-- BLOCK 1: Listings 1-5 + Top Sidebar (Faraz Shafi + Mortgage + The Wilds Banner) --}}
{{-- ======================================================== --}}
<section class="max-w-[1280px] mx-auto px-6 py-8 grid lg:grid-cols-12 gap-8 font-inter">
  
  {{-- Left 8 Cols: Listings 1 to 4, then "What's your property worth today?" banner, then Listing 5 --}}
  <div class="lg:col-span-8 space-y-6">

    @php
      $topListings = [
        [
          'image' => 'images/listing-pool-villa.jpg',
          'tag' => 'OFF-PLAN | Initial Sale',
          'price' => 'AED 4,000,000',
          'beds_baths' => 'Villa 🛏 5 🛁 6 | Built-up: 1,991 sqft Plot: 1,705 sqft',
          'title' => '5BR Villa | R. Hills | Pool & Garden Community',
          'location' => 'R. Hills, Dubai',
          'authenticity' => 'Property authenticity was validated on 23rd of September',
          'handover' => 'Q4 2028',
          'payment_plan' => '30/70',
          'link' => '/buy-listing'
        ],
        [
          'image' => 'images/house-white.jpg',
          'tag' => 'OFF-PLAN | Initial Sale',
          'price' => 'AED 4,000,000',
          'beds_baths' => 'Villa 🛏 5 🛁 6 | Built-up: 1,991 sqft Plot: 1,705 sqft',
          'title' => '5BR Villa | R. Hills | Pool & Garden Community',
          'location' => 'R. Hills, Dubai',
          'authenticity' => 'Property authenticity was validated on 23rd of September',
          'handover' => 'Q4 2028',
          'payment_plan' => '30/70',
          'link' => '/buy-listing'
        ],
        [
          'image' => 'images/listing-villa-pool-3.jpg',
          'tag' => 'OFF-PLAN | Initial Sale',
          'price' => 'AED 4,000,000',
          'beds_baths' => 'Villa 🛏 5 🛁 6 | Built-up: 1,991 sqft Plot: 1,705 sqft',
          'title' => '5BR Villa | R. Hills | Pool & Garden Community',
          'location' => 'R. Hills, Dubai',
          'authenticity' => 'Property authenticity was validated on 23rd of September',
          'handover' => 'Q4 2028',
          'payment_plan' => '30/70',
          'link' => '/buy-listing'
        ],
        [
          'image' => 'images/listing-villa-pool-4.jpg',
          'tag' => 'OFF-PLAN | Initial Sale',
          'price' => 'AED 4,000,000',
          'beds_baths' => 'Villa 🛏 5 🛁 6 | Built-up: 1,991 sqft Plot: 1,705 sqft',
          'title' => '5BR Villa | R. Hills | Pool & Garden Community',
          'location' => 'R. Hills, Dubai',
          'authenticity' => 'Property authenticity was validated on 23rd of September',
          'handover' => 'Q4 2028',
          'payment_plan' => '30/70',
          'link' => '/buy-listing'
        ]
      ];

      $listing5 = [
        'image' => 'images/listing-villa-sea-5.jpg',
        'tag' => 'OFF-PLAN | Initial Sale',
        'price' => 'AED 4,000,000',
        'beds_baths' => 'Villa 🛏 5 🛁 6 | Built-up: 1,991 sqft Plot: 1,705 sqft',
        'title' => '5BR Villa | R. Hills | Pool & Garden Community',
        'location' => 'R. Hills, Dubai',
        'authenticity' => 'Property authenticity was validated on 23rd of September',
        'handover' => 'Q4 2028',
        'payment_plan' => '30/70',
        'link' => '/buy-listing'
      ];
    @endphp

    {{-- Render Listings 1-4 --}}
    @foreach($topListings as $l)
    <div class="bg-white border border-[#EBECEB] rounded-[14px] overflow-hidden shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow flex flex-col md:flex-row">
      
      {{-- Image Box with Carousel Dots & Favorite Heart --}}
      <div class="relative md:w-[320px] lg:w-[340px] h-[240px] md:h-auto shrink-0 overflow-hidden bg-neutral-100">
        <img src="{{ asset($l['image']) }}" alt="{{ $l['title'] }}" class="w-full h-full object-cover">
        
        @if(!empty($l['tag']))
        <span class="absolute top-3.5 left-3.5 bg-black/60 backdrop-blur-xs text-white text-[10px] font-semibold tracking-wider px-2.5 py-1 rounded-[4px]">
          {{ $l['tag'] }}
        </span>
        @endif

        <button type="button" class="absolute top-3.5 right-3.5 w-7 h-7 bg-white/90 hover:bg-white text-neutral-600 rounded-full flex items-center justify-center text-xs shadow-xs cursor-pointer">
          ♡
        </button>

        <div class="absolute inset-y-0 inset-x-2 flex items-center justify-between pointer-events-none">
          <button class="w-5 h-5 bg-white/80 rounded-full flex items-center justify-center text-[10px] text-neutral-800 pointer-events-auto">‹</button>
          <button class="w-5 h-5 bg-white/80 rounded-full flex items-center justify-center text-[10px] text-neutral-800 pointer-events-auto">›</button>
        </div>
        <div class="absolute bottom-2.5 inset-x-0 flex items-center justify-center gap-1.5">
          <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
          <span class="w-1.5 h-1.5 rounded-full bg-white/60"></span>
          <span class="w-1.5 h-1.5 rounded-full bg-white/60"></span>
          <span class="w-1.5 h-1.5 rounded-full bg-white/60"></span>
        </div>
      </div>

      {{-- Card Info & Actions --}}
      <div class="p-6 flex-1 flex flex-col justify-between font-inter">
        <div>
          <div class="flex items-center justify-between">
            <p class="font-inter font-bold text-2xl text-[#10221C] tracking-tight">
              {{ $l['price'] }}
            </p>
          </div>

          <p class="text-xs text-neutral-600 font-medium mt-1">
            {{ $l['beds_baths'] }}
          </p>

          <h3 class="font-inter font-semibold text-sm text-[#10221C] mt-1.5">
            {{ $l['title'] }}
          </h3>

          <p class="flex items-center gap-1 text-xs text-neutral-500 mt-1">
            <span>📍</span>
            <span>{{ $l['location'] }}</span>
          </p>

          <p class="text-[11px] text-neutral-400 mt-2 flex items-center gap-1">
            <span>✦</span>
            <span>{{ $l['authenticity'] }}</span>
          </p>

          <div class="grid grid-cols-2 gap-2 mt-4 max-w-[240px]">
            <div class="bg-[#F8F9F8] border border-[#EBECEB] rounded-[6px] p-2">
              <span class="block text-[9px] uppercase tracking-wider text-neutral-400 font-semibold">HANDOVER</span>
              <span class="block text-xs font-bold text-[#10221C] mt-0.5">{{ $l['handover'] }}</span>
            </div>
            <div class="bg-[#F8F9F8] border border-[#EBECEB] rounded-[6px] p-2">
              <span class="block text-[9px] uppercase tracking-wider text-neutral-400 font-semibold">PAYMENT PLAN</span>
              <span class="block text-xs font-bold text-[#10221C] mt-0.5">{{ $l['payment_plan'] }}</span>
            </div>
          </div>
        </div>

        <div class="flex items-center gap-2 mt-5">
          <a href="{{ $l['link'] }}" class="flex-1 bg-[#122A21] hover:bg-[#1b3d30] text-white text-xs font-medium py-2.5 px-3 rounded-[6px] flex items-center justify-center gap-1.5 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span>Email</span>
          </a>
          <a href="tel:+971500000000" class="flex-1 bg-white hover:bg-neutral-50 text-neutral-700 border border-neutral-200 text-xs font-medium py-2.5 px-3 rounded-[6px] flex items-center justify-center gap-1.5 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span>Call</span>
          </a>
          <a href="https://wa.me/971500000000" target="_blank" class="w-10 h-9 bg-[#25D366] hover:bg-[#20ba5a] text-white rounded-[6px] flex items-center justify-center transition-colors">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.586 1.761.882 2.791.882h.001c3.181 0 5.767-2.587 5.768-5.766.001-3.181-2.585-5.768-5.769-5.768zm7.545 5.766c-.002 4.153-3.38 7.531-7.536 7.531-1.309 0-2.548-.342-3.649-.997l-4.041 1.06 1.079-3.933c-.73-1.157-1.114-2.502-1.115-3.661.002-4.153 3.38-7.531 7.536-7.531 4.154 0 7.528 3.377 7.526 7.531z"/></svg>
          </a>
        </div>
      </div>

    </div>
    @endforeach

    {{-- Banner in continuity: "What's your property worth today?" --}}
    <div class="bg-[#FAF8F5] border border-[#EBE8E2] rounded-[16px] p-5 sm:p-6 flex flex-col sm:flex-row items-center justify-between gap-5 shadow-2xs font-inter">
      <div class="flex items-center gap-5">
        <div class="w-20 sm:w-24 shrink-0">
          <img src="{{ asset('images/property-worth-illustration.png') }}" alt="Property Worth" class="w-full h-auto object-contain">
        </div>
        <div>
          <h3 class="font-heading font-medium text-lg sm:text-xl text-[#0E3B2C] leading-snug">
            What's your property worth today?
          </h3>
          <p class="text-xs text-neutral-500 font-inter mt-1">
            Get an instant valuation report and compare recent transactions.
          </p>
        </div>
      </div>
      <a href="/valuation" class="shrink-0 bg-[#0E3B2C] hover:bg-[#154a38] text-white text-xs font-semibold px-5 py-2.5 rounded-[6px] transition-colors shadow-xs">
        Get started now
      </a>
    </div>

    {{-- Render Listing 5 --}}
    <div class="bg-white border border-[#EBECEB] rounded-[14px] overflow-hidden shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow flex flex-col md:flex-row">
      <div class="relative md:w-[320px] lg:w-[340px] h-[240px] md:h-auto shrink-0 overflow-hidden bg-neutral-100">
        <img src="{{ asset($listing5['image']) }}" alt="{{ $listing5['title'] }}" class="w-full h-full object-cover">
        @if(!empty($listing5['tag']))
        <span class="absolute top-3.5 left-3.5 bg-black/60 backdrop-blur-xs text-white text-[10px] font-semibold tracking-wider px-2.5 py-1 rounded-[4px]">
          {{ $listing5['tag'] }}
        </span>
        @endif
        <button type="button" class="absolute top-3.5 right-3.5 w-7 h-7 bg-white/90 hover:bg-white text-neutral-600 rounded-full flex items-center justify-center text-xs shadow-xs cursor-pointer">
          ♡
        </button>
        <div class="absolute inset-y-0 inset-x-2 flex items-center justify-between pointer-events-none">
          <button class="w-5 h-5 bg-white/80 rounded-full flex items-center justify-center text-[10px] text-neutral-800 pointer-events-auto">‹</button>
          <button class="w-5 h-5 bg-white/80 rounded-full flex items-center justify-center text-[10px] text-neutral-800 pointer-events-auto">›</button>
        </div>
      </div>
      <div class="p-6 flex-1 flex flex-col justify-between font-inter">
        <div>
          <p class="font-inter font-bold text-2xl text-[#10221C] tracking-tight">
            {{ $listing5['price'] }}
          </p>
          <p class="text-xs text-neutral-600 font-medium mt-1">
            {{ $listing5['beds_baths'] }}
          </p>
          <h3 class="font-inter font-semibold text-sm text-[#10221C] mt-1.5">
            {{ $listing5['title'] }}
          </h3>
          <p class="flex items-center gap-1 text-xs text-neutral-500 mt-1">
            <span>📍</span>
            <span>{{ $listing5['location'] }}</span>
          </p>
          <p class="text-[11px] text-neutral-400 mt-2 flex items-center gap-1">
            <span>✦</span>
            <span>{{ $listing5['authenticity'] }}</span>
          </p>
          <div class="grid grid-cols-2 gap-2 mt-4 max-w-[240px]">
            <div class="bg-[#F8F9F8] border border-[#EBECEB] rounded-[6px] p-2">
              <span class="block text-[9px] uppercase tracking-wider text-neutral-400 font-semibold">HANDOVER</span>
              <span class="block text-xs font-bold text-[#10221C] mt-0.5">{{ $listing5['handover'] }}</span>
            </div>
            <div class="bg-[#F8F9F8] border border-[#EBECEB] rounded-[6px] p-2">
              <span class="block text-[9px] uppercase tracking-wider text-neutral-400 font-semibold">PAYMENT PLAN</span>
              <span class="block text-xs font-bold text-[#10221C] mt-0.5">{{ $listing5['payment_plan'] }}</span>
            </div>
          </div>
        </div>
        <div class="flex items-center gap-2 mt-5">
          <a href="{{ $listing5['link'] }}" class="flex-1 bg-[#122A21] hover:bg-[#1b3d30] text-white text-xs font-medium py-2.5 px-3 rounded-[6px] flex items-center justify-center gap-1.5 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span>Email</span>
          </a>
          <a href="tel:+971500000000" class="flex-1 bg-white hover:bg-neutral-50 text-neutral-700 border border-neutral-200 text-xs font-medium py-2.5 px-3 rounded-[6px] flex items-center justify-center gap-1.5 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span>Call</span>
          </a>
          <a href="https://wa.me/971500000000" target="_blank" class="w-10 h-9 bg-[#25D366] hover:bg-[#20ba5a] text-white rounded-[6px] flex items-center justify-center transition-colors">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.586 1.761.882 2.791.882h.001c3.181 0 5.767-2.587 5.768-5.766.001-3.181-2.585-5.768-5.769-5.768zm7.545 5.766c-.002 4.153-3.38 7.531-7.536 7.531-1.309 0-2.548-.342-3.649-.997l-4.041 1.06 1.079-3.933c-.73-1.157-1.114-2.502-1.115-3.661.002-4.153 3.38-7.531 7.536-7.531 4.154 0 7.528 3.377 7.526 7.531z"/></svg>
          </a>
        </div>
      </div>
    </div>

  </div>

  {{-- Right 4 Cols: Top Sidebar Widgets (Faraz Shafi + Need a Mortgage + The Wilds Ad) --}}
  <aside class="lg:col-span-4 space-y-6">
    
    {{-- Widget 1: Faraz Shafi Sales Consultant Card --}}
    <div class="bg-white border-2 border-[#1E88E5] rounded-[16px] p-5 shadow-xs">
      <div class="grid grid-cols-3 gap-2 mb-5 font-inter text-xs">
        <a href="tel:+971500000000" class="bg-[#C5A47E] hover:bg-[#b8956e] text-white py-2 px-2 rounded-full flex items-center justify-center gap-1 font-medium transition-colors">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          <span>Call</span>
        </a>
        <a href="mailto:faraz@luxvilla.ae" class="bg-[#C5A47E] hover:bg-[#b8956e] text-white py-2 px-2 rounded-full flex items-center justify-center gap-1 font-medium transition-colors">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          <span>Email</span>
        </a>
        <a href="https://wa.me/971500000000" target="_blank" class="bg-[#C5A47E] hover:bg-[#b8956e] text-white py-2 px-2 rounded-full flex items-center justify-center gap-1 font-medium transition-colors">
          <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.586 1.761.882 2.791.882h.001c3.181 0 5.767-2.587 5.768-5.766.001-3.181-2.585-5.768-5.769-5.768zm7.545 5.766c-.002 4.153-3.38 7.531-7.536 7.531-1.309 0-2.548-.342-3.649-.997l-4.041 1.06 1.079-3.933c-.73-1.157-1.114-2.502-1.115-3.661.002-4.153 3.38-7.531 7.536-7.531 4.154 0 7.528 3.377 7.526 7.531z"/></svg>
          <span>Whatsapp</span>
        </a>
      </div>
      <div class="flex items-center gap-3.5">
        <div class="w-14 h-14 rounded-lg overflow-hidden bg-neutral-200 shrink-0">
          <img src="{{ asset('images/agent.jpg') }}" alt="Faraz Shafi" class="w-full h-full object-cover">
        </div>
        <div>
          <h4 class="font-heading font-semibold text-lg text-[#0E3B2C] leading-snug">Faraz Shafi</h4>
          <p class="text-xs text-neutral-500 font-inter">Sales Consultant</p>
        </div>
      </div>
    </div>

    {{-- Widget 2: Need a Mortgage Card --}}
    <div class="relative bg-[#C5A47E] text-white rounded-[16px] p-7 overflow-hidden shadow-xs">
      <div class="relative z-10">
        <h4 class="font-heading font-medium text-2xl text-white leading-tight">Need a mortgage?</h4>
        <p class="text-xs text-white/90 font-inter mt-2">Est. mortgage is AED 11,896 a month</p>
        <a href="/ai-villa-assessment" class="inline-block mt-5 bg-white text-[#C5A47E] text-xs font-semibold font-inter px-5 py-2.5 rounded-[6px] shadow-xs hover:bg-neutral-50 transition-colors">
          Try our calculator
        </a>
      </div>
      <div class="absolute right-3 bottom-2 text-white/25 pointer-events-none font-serif text-7xl font-bold leading-none select-none">
        LV
      </div>
    </div>

    {{-- Widget 3: The Wilds by Aldar Banner --}}
    <div class="rounded-[16px] overflow-hidden shadow-sm border border-neutral-200">
      <a href="/projects" class="block group">
        <img src="{{ asset('images/the-wilds-aldar.jpg') }}" alt="The Wilds by Aldar" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-[1.01]">
      </a>
    </div>

  </aside>

</section>

{{-- ======================================================== --}}
{{-- BLOCK 2: Full-Width Carousel "View New Projects in Dubai" --}}
{{-- ======================================================== --}}
<section class="max-w-[1280px] mx-auto px-6 py-10 font-inter border-t border-b border-neutral-200 my-6">
  <div class="flex items-center justify-between mb-6">
    <h2 class="font-heading font-medium text-2xl sm:text-3xl md:text-[34px] text-[#0E3B2C] leading-tight">
      View New Projects in Dubai
    </h2>
    <a href="/projects" class="inline-flex items-center justify-center bg-[#0E3B2C] hover:bg-[#154a38] text-white text-xs font-semibold px-5 py-2.5 rounded-[6px] transition-colors shadow-xs">
      View All
    </a>
  </div>

  <div class="relative group/carousel">
    <button type="button" aria-label="Previous" class="absolute -left-3.5 sm:-left-4 top-[38%] -translate-y-1/2 w-8 h-8 rounded-full bg-white shadow-md border border-neutral-200 text-neutral-600 hover:text-black hover:bg-neutral-50 flex items-center justify-center z-10 transition-all cursor-pointer">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button type="button" aria-label="Next" class="absolute -right-3.5 sm:-right-4 top-[38%] -translate-y-1/2 w-8 h-8 rounded-full bg-white shadow-md border border-neutral-200 text-neutral-600 hover:text-black hover:bg-neutral-50 flex items-center justify-center z-10 transition-all cursor-pointer">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"/></svg>
    </button>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
      @php
        $newProjects = [
          [
            'title' => 'One by Binghatti',
            'subtitle' => 'One by Binghatti, Busines...',
            'image' => 'images/project-binghatti-1.jpg',
            'badge' => 'Under Construction',
            'price' => 'Launch Price AED 1.7M',
            'link' => '/buy-listing'
          ],
          [
            'title' => 'One by Binghatti',
            'subtitle' => 'One by Binghatti, Busines...',
            'image' => 'images/project-binghatti-2.jpg',
            'badge' => 'Under Construction',
            'price' => 'Launch Price AED 1.7M',
            'link' => '/buy-listing'
          ],
          [
            'title' => 'One by Binghatti',
            'subtitle' => 'One by Binghatti, Busines...',
            'image' => 'images/project-binghatti-3.jpg',
            'badge' => 'Under Construction',
            'price' => 'Launch Price AED 1.7M',
            'link' => '/buy-listing'
          ],
          [
            'title' => 'One by Binghatti',
            'subtitle' => 'One by Binghatti, Busines...',
            'image' => 'images/project-binghatti-4.jpg',
            'badge' => 'Under Construction',
            'price' => 'Launch Price AED 1.7M',
            'link' => '/buy-listing'
          ],
        ];
      @endphp

      @foreach($newProjects as $proj)
      <div class="bg-transparent flex flex-col group/card cursor-pointer">
        <div class="relative w-full aspect-square rounded-[14px] overflow-hidden bg-neutral-100 shadow-2xs">
          <img src="{{ asset($proj['image']) }}" alt="{{ $proj['title'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover/card:scale-105">
          <div class="absolute top-3 left-3 bg-white/95 backdrop-blur-xs text-[#222222] text-[11px] font-medium font-inter px-3 py-1 rounded-full shadow-xs">
            {{ $proj['badge'] }}
          </div>
          <div class="absolute bottom-3 left-3 bg-white/95 backdrop-blur-xs text-[#222222] text-[11px] font-semibold font-inter px-3 py-1 rounded-full shadow-xs">
            {{ $proj['price'] }}
          </div>
        </div>
        <div class="flex items-center justify-between pt-3 px-1">
          <div class="min-w-0 pr-2">
            <h3 class="font-heading font-bold text-[17px] text-[#10221C] leading-snug truncate">
              {{ $proj['title'] }}
            </h3>
            <p class="text-xs text-neutral-400 font-inter truncate mt-0.5">
              {{ $proj['subtitle'] }}
            </p>
          </div>
          <a href="https://wa.me/971500000000" target="_blank" aria-label="WhatsApp" class="w-9 h-9 rounded-[10px] bg-[#5BB56F] hover:bg-[#4ea261] text-white flex items-center justify-center shrink-0 shadow-xs transition-colors">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
              <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.586 1.761.882 2.791.882h.001c3.181 0 5.767-2.587 5.768-5.766.001-3.181-2.585-5.768-5.769-5.768zm7.545 5.766c-.002 4.153-3.38 7.531-7.536 7.531-1.309 0-2.548-.342-3.649-.997l-4.041 1.06 1.079-3.933c-.73-1.157-1.114-2.502-1.115-3.661.002-4.153 3.38-7.531 7.536-7.531 4.154 0 7.528 3.377 7.526 7.531z"/>
            </svg>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ======================================================== --}}
{{-- BLOCK 3: Listings 6-8 + Bottom Sidebar (Recent Transactions + Alert Box) --}}
{{-- ======================================================== --}}
<section class="max-w-[1280px] mx-auto px-6 py-8 grid lg:grid-cols-12 gap-8 font-inter">
  
  {{-- Left 8 Cols: Listings 6, 7, 8 --}}
  <div class="lg:col-span-8 space-y-6">

    @php
      $bottomListings = [
        [
          'image' => 'images/listing-pool-villa.jpg',
          'tag' => 'OFF-PLAN | Initial Sale',
          'price' => 'AED 4,000,000',
          'beds_baths' => 'Villa 🛏 5 🛁 6 | Built-up: 1,991 sqft Plot: 1,705 sqft',
          'title' => '5BR Villa | R. Hills | Pool & Garden Community',
          'location' => 'R. Hills, Dubai',
          'authenticity' => 'Property authenticity was validated on 23rd of September',
          'handover' => 'Q4 2028',
          'payment_plan' => '30/70',
          'link' => '/buy-listing'
        ],
        [
          'image' => 'images/listing-white-co.jpg',
          'tag' => 'OFF-PLAN | Initial Sale',
          'price' => 'AED 4,000,000',
          'beds_baths' => 'Villa 🛏 5 🛁 6 | Built-up: 1,991 sqft Plot: 1,705 sqft',
          'title' => '5BR Villa | R. Hills | Pool & Garden Community',
          'location' => 'R. Hills, Dubai',
          'authenticity' => 'Property authenticity was validated on 23rd of September',
          'handover' => 'Q4 2028',
          'payment_plan' => '30/70',
          'link' => '/buy-listing'
        ],
        [
          'image' => 'images/listing-modern-villa.jpg',
          'tag' => 'OFF-PLAN | Initial Sale',
          'price' => 'AED 4,000,000',
          'beds_baths' => 'Villa 🛏 5 🛁 6 | Built-up: 1,991 sqft Plot: 1,705 sqft',
          'title' => '5BR Villa | R. Hills | Pool & Garden Community',
          'location' => 'R. Hills, Dubai',
          'authenticity' => 'Property authenticity was validated on 23rd of September',
          'handover' => 'Q4 2028',
          'payment_plan' => '30/70',
          'link' => '/buy-listing'
        ]
      ];
    @endphp

    @foreach($bottomListings as $l)
    <div class="bg-white border border-[#EBECEB] rounded-[14px] overflow-hidden shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow flex flex-col md:flex-row">
      
      <div class="relative md:w-[320px] lg:w-[340px] h-[240px] md:h-auto shrink-0 overflow-hidden bg-neutral-100">
        <img src="{{ asset($l['image']) }}" alt="{{ $l['title'] }}" class="w-full h-full object-cover">
        
        @if(!empty($l['tag']))
        <span class="absolute top-3.5 left-3.5 bg-black/60 backdrop-blur-xs text-white text-[10px] font-semibold tracking-wider px-2.5 py-1 rounded-[4px]">
          {{ $l['tag'] }}
        </span>
        @endif

        <button type="button" class="absolute top-3.5 right-3.5 w-7 h-7 bg-white/90 hover:bg-white text-neutral-600 rounded-full flex items-center justify-center text-xs shadow-xs cursor-pointer">
          ♡
        </button>

        <div class="absolute inset-y-0 inset-x-2 flex items-center justify-between pointer-events-none">
          <button class="w-5 h-5 bg-white/80 rounded-full flex items-center justify-center text-[10px] text-neutral-800 pointer-events-auto">‹</button>
          <button class="w-5 h-5 bg-white/80 rounded-full flex items-center justify-center text-[10px] text-neutral-800 pointer-events-auto">›</button>
        </div>
        <div class="absolute bottom-2.5 inset-x-0 flex items-center justify-center gap-1.5">
          <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
          <span class="w-1.5 h-1.5 rounded-full bg-white/60"></span>
          <span class="w-1.5 h-1.5 rounded-full bg-white/60"></span>
          <span class="w-1.5 h-1.5 rounded-full bg-white/60"></span>
        </div>
      </div>

      <div class="p-6 flex-1 flex flex-col justify-between font-inter">
        <div>
          <p class="font-inter font-bold text-2xl text-[#10221C] tracking-tight">
            {{ $l['price'] }}
          </p>

          <p class="text-xs text-neutral-600 font-medium mt-1">
            {{ $l['beds_baths'] }}
          </p>

          <h3 class="font-inter font-semibold text-sm text-[#10221C] mt-1.5">
            {{ $l['title'] }}
          </h3>

          <p class="flex items-center gap-1 text-xs text-neutral-500 mt-1">
            <span>📍</span>
            <span>{{ $l['location'] }}</span>
          </p>

          <p class="text-[11px] text-neutral-400 mt-2 flex items-center gap-1">
            <span>✦</span>
            <span>{{ $l['authenticity'] }}</span>
          </p>

          <div class="grid grid-cols-2 gap-2 mt-4 max-w-[240px]">
            <div class="bg-[#F8F9F8] border border-[#EBECEB] rounded-[6px] p-2">
              <span class="block text-[9px] uppercase tracking-wider text-neutral-400 font-semibold">HANDOVER</span>
              <span class="block text-xs font-bold text-[#10221C] mt-0.5">{{ $l['handover'] }}</span>
            </div>
            <div class="bg-[#F8F9F8] border border-[#EBECEB] rounded-[6px] p-2">
              <span class="block text-[9px] uppercase tracking-wider text-neutral-400 font-semibold">PAYMENT PLAN</span>
              <span class="block text-xs font-bold text-[#10221C] mt-0.5">{{ $l['payment_plan'] }}</span>
            </div>
          </div>
        </div>

        <div class="flex items-center gap-2 mt-5">
          <a href="{{ $l['link'] }}" class="flex-1 bg-[#122A21] hover:bg-[#1b3d30] text-white text-xs font-medium py-2.5 px-3 rounded-[6px] flex items-center justify-center gap-1.5 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span>Email</span>
          </a>
          <a href="tel:+971500000000" class="flex-1 bg-white hover:bg-neutral-50 text-neutral-700 border border-neutral-200 text-xs font-medium py-2.5 px-3 rounded-[6px] flex items-center justify-center gap-1.5 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span>Call</span>
          </a>
          <a href="https://wa.me/971500000000" target="_blank" class="w-10 h-9 bg-[#25D366] hover:bg-[#20ba5a] text-white rounded-[6px] flex items-center justify-center transition-colors">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.586 1.761.882 2.791.882h.001c3.181 0 5.767-2.587 5.768-5.766.001-3.181-2.585-5.768-5.769-5.768zm7.545 5.766c-.002 4.153-3.38 7.531-7.536 7.531-1.309 0-2.548-.342-3.649-.997l-4.041 1.06 1.079-3.933c-.73-1.157-1.114-2.502-1.115-3.661.002-4.153 3.38-7.531 7.536-7.531 4.154 0 7.528 3.377 7.526 7.531z"/></svg>
          </a>
        </div>
      </div>

    </div>
    @endforeach

  </div>

  {{-- Right 4 Cols: Bottom Sidebar (Recent Sale Transactions + Alert / Links Widget) --}}
  <aside class="lg:col-span-4 space-y-6">
    
    {{-- Widget: Recent Sale Transactions --}}
    <div class="bg-white border border-[#E5E7EB] rounded-[14px] p-5 shadow-xs font-inter">
      <h3 class="font-heading font-medium text-xl text-[#10221C] leading-snug">
        Recent Sale Transactions
      </h3>
      <p class="text-xs text-neutral-400 mt-0.5 mb-4">R. Hills</p>

      <div class="bg-[#0E3B2C] text-white rounded-[6px] px-3.5 py-2 flex items-center justify-between text-xs font-semibold mb-2.5">
        <span>Price</span>
        <span>Location</span>
      </div>

      <div class="space-y-2.5 text-xs">
        <div class="border-b border-neutral-100 pb-2.5">
          <div class="flex items-center justify-between font-semibold text-[#10221C]">
            <span>AED 2.6M</span>
            <span class="text-neutral-500 font-normal">R. Hills</span>
          </div>
          <div class="flex items-center gap-2 mt-1.5">
            <span class="bg-[#F4F5F4] text-neutral-600 text-[11px] px-2.5 py-0.5 rounded-[4px] flex-1 text-center">Villa</span>
            <span class="bg-[#F4F5F4] text-neutral-600 text-[11px] px-2.5 py-0.5 rounded-[4px] flex-1 text-center">5 Beds</span>
            <span class="bg-[#F4F5F4] text-neutral-600 text-[11px] px-2.5 py-0.5 rounded-[4px] flex-1 text-center">1,997 Sqft</span>
          </div>
        </div>

        <div class="border-b border-neutral-100 pb-2.5">
          <div class="flex items-center justify-between font-semibold text-[#10221C]">
            <span>AED 1.6M</span>
            <span class="text-neutral-500 font-normal">R. Hills</span>
          </div>
          <div class="flex items-center gap-2 mt-1.5">
            <span class="bg-[#F4F5F4] text-neutral-600 text-[11px] px-2.5 py-0.5 rounded-[4px] flex-1 text-center">Villa</span>
            <span class="bg-[#F4F5F4] text-neutral-600 text-[11px] px-2.5 py-0.5 rounded-[4px] flex-1 text-center">3 Beds</span>
            <span class="bg-[#F4F5F4] text-neutral-600 text-[11px] px-2.5 py-0.5 rounded-[4px] flex-1 text-center">1,614 Sqft</span>
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between font-semibold text-[#10221C]">
            <span>AED 1.6M</span>
            <span class="text-neutral-500 font-normal">R. Hills</span>
          </div>
          <div class="flex items-center gap-2 mt-1.5">
            <span class="bg-[#F4F5F4] text-neutral-600 text-[11px] px-2.5 py-0.5 rounded-[4px] flex-1 text-center">Villa</span>
            <span class="bg-[#F4F5F4] text-neutral-600 text-[11px] px-2.5 py-0.5 rounded-[4px] flex-1 text-center">3 Beds</span>
            <span class="bg-[#F4F5F4] text-neutral-600 text-[11px] px-2.5 py-0.5 rounded-[4px] flex-1 text-center">1,614 Sqft</span>
          </div>
        </div>
      </div>

      <button type="button" class="w-full mt-4 border border-[#0E3B2C] text-[#0E3B2C] hover:bg-[#0E3B2C] hover:text-white transition-colors text-xs font-semibold py-2.5 rounded-[6px] text-center cursor-pointer">
        View 283 More Transactions
      </button>
    </div>

    {{-- Widget: Alert Box + Recommended Searches --}}
    <div class="border border-[#E5E7EB] rounded-[14px] overflow-hidden bg-white shadow-xs font-inter">
      <div class="py-2.5 px-4 text-center text-[11px] text-neutral-500 border-b border-neutral-100">
        Be The First To Hear About New Properties
      </div>

      <div class="p-3 bg-[#0E3B2C]">
        <button type="button" class="w-full flex items-center justify-center gap-2 text-white text-xs font-bold uppercase tracking-wider py-1 cursor-pointer hover:opacity-90">
          <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/></svg>
          <span>GET NEW LISTING ALERTS</span>
        </button>
      </div>

      <div class="border-b border-neutral-200">
        <div class="bg-[#F9FAF9] px-4 py-2 text-xs font-semibold text-neutral-700">
          Recommended searches
        </div>
        <div class="p-4 space-y-2 text-xs text-neutral-500">
          <a href="#" class="block hover:text-[#0E3B2C] hover:underline">3 Bedroom Properties For Sale In R. Hills</a>
          <a href="#" class="block hover:text-[#0E3B2C] hover:underline">4 Bedroom Properties For Sale In R. Hills</a>
          <a href="#" class="block hover:text-[#0E3B2C] hover:underline">5 Bedroom Properties For Sale In R. Hills</a>
          <a href="#" class="block hover:text-[#0E3B2C] hover:underline">Villas For Sale In R. Hills</a>
          <a href="#" class="block hover:text-[#0E3B2C] hover:underline">Townhouses For Sale In R. Hills</a>
          <a href="#" class="block font-semibold text-neutral-700 hover:text-[#0E3B2C] pt-1">View More...</a>
        </div>
      </div>

      <div class="border-b border-neutral-200">
        <div class="bg-[#F9FAF9] px-4 py-2 text-xs font-semibold text-neutral-700 uppercase tracking-wider">
          NEAR R. HILLS
        </div>
        <div class="p-4 space-y-2 text-xs text-neutral-500">
          <a href="#" class="block hover:text-[#0E3B2C] hover:underline">DAMAC Lagoons Properties</a>
          <a href="#" class="block hover:text-[#0E3B2C] hover:underline">Paradise Hills Properties</a>
          <a href="#" class="block hover:text-[#0E3B2C] hover:underline">Tilal Al Ghaf Properties</a>
          <a href="#" class="block hover:text-[#0E3B2C] hover:underline">Dubai Sports City Properties</a>
          <a href="#" class="block hover:text-[#0E3B2C] hover:underline">Dubai Studio City Properties</a>
          <a href="#" class="block font-semibold text-neutral-700 hover:text-[#0E3B2C] pt-1">View More...</a>
        </div>
      </div>

      <div>
        <div class="bg-[#F9FAF9] px-4 py-2 text-xs font-semibold text-neutral-700 uppercase tracking-wider">
          INVEST IN OFF PLAN
        </div>
        <div class="p-4 space-y-2 text-xs text-neutral-500">
          <a href="#" class="block hover:text-[#0E3B2C] hover:underline">Off Plan Properties In Dubai</a>
          <a href="#" class="block hover:text-[#0E3B2C] hover:underline">New Projects In Dubai</a>
        </div>
      </div>

    </div>

  </aside>

</section>

{{-- ======================================================== --}}
{{-- BLOCK 4: Bottom Banner + 9th Listing Card --}}
{{-- ======================================================== --}}
<section class="max-w-[1280px] mx-auto px-6 pb-12 font-inter">
  
  {{-- Looking to sell or rent your home? Banner --}}
  <div class="mb-8">
    <div class="relative bg-[#FAF8F5] border border-[#EBE8E2] rounded-[18px] p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6 overflow-hidden shadow-xs">
      
      <div class="flex flex-col sm:flex-row items-center gap-6 md:gap-8 z-10 text-center sm:text-left">
        <div class="w-48 sm:w-56 shrink-0 -my-4 drop-shadow-sm">
          <img src="{{ asset('images/sell-rent-villa-exact.png') }}" alt="Looking to sell or rent" class="w-full h-auto object-contain">
        </div>
        <div>
          <h2 class="font-heading font-medium text-2xl sm:text-3xl md:text-[34px] text-[#0E3B2C] leading-snug">
            Looking to sell or rent your home?
          </h2>
          <p class="text-xs sm:text-sm text-neutral-500 font-inter mt-1.5">
            Reach more buyers or renters through an expert agent.
          </p>
        </div>
      </div>

      <div class="shrink-0 z-10 w-full sm:w-auto">
        <a href="/valuation" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto bg-[#0E3B2C] hover:bg-[#154a38] text-white text-xs sm:text-sm font-semibold font-inter px-6 py-3 rounded-[8px] transition-colors shadow-xs">
          <span>Get started now</span>
          <span class="text-xs">›</span>
        </a>
      </div>

    </div>
  </div>

  {{-- Listing 9 (Full 8-cols width or grid aligned) --}}
  <div class="grid lg:grid-cols-12 gap-8">
    <div class="lg:col-span-8">
      <div class="bg-white border border-[#EBECEB] rounded-[14px] overflow-hidden shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow flex flex-col md:flex-row">
        <div class="relative md:w-[320px] lg:w-[340px] h-[240px] md:h-auto shrink-0 overflow-hidden bg-neutral-100">
          <img src="{{ asset('images/listing-villa-garden-9.jpg') }}" alt="Garden Villa" class="w-full h-full object-cover">
          <span class="absolute top-3.5 left-3.5 bg-black/60 backdrop-blur-xs text-white text-[10px] font-semibold tracking-wider px-2.5 py-1 rounded-[4px]">
            OFF-PLAN | Initial Sale
          </span>
          <button type="button" class="absolute top-3.5 right-3.5 w-7 h-7 bg-white/90 hover:bg-white text-neutral-600 rounded-full flex items-center justify-center text-xs shadow-xs cursor-pointer">
            ♡
          </button>
        </div>
        <div class="p-6 flex-1 flex flex-col justify-between font-inter">
          <div>
            <p class="font-inter font-bold text-2xl text-[#10221C] tracking-tight">
              AED 4,000,000
            </p>
            <p class="text-xs text-neutral-600 font-medium mt-1">
              Villa 🛏 5 🛁 6 | Built-up: 1,991 sqft Plot: 1,705 sqft
            </p>
            <h3 class="font-inter font-semibold text-sm text-[#10221C] mt-1.5">
              5BR Villa | R. Hills | Pool & Garden Community
            </h3>
            <p class="flex items-center gap-1 text-xs text-neutral-500 mt-1">
              <span>📍</span>
              <span>R. Hills, Dubai</span>
            </p>
            <p class="text-[11px] text-neutral-400 mt-2 flex items-center gap-1">
              <span>✦</span>
              <span>Property authenticity was validated on 23rd of September</span>
            </p>
            <div class="grid grid-cols-2 gap-2 mt-4 max-w-[240px]">
              <div class="bg-[#F8F9F8] border border-[#EBECEB] rounded-[6px] p-2">
                <span class="block text-[9px] uppercase tracking-wider text-neutral-400 font-semibold">HANDOVER</span>
                <span class="block text-xs font-bold text-[#10221C] mt-0.5">Q4 2028</span>
              </div>
              <div class="bg-[#F8F9F8] border border-[#EBECEB] rounded-[6px] p-2">
                <span class="block text-[9px] uppercase tracking-wider text-neutral-400 font-semibold">PAYMENT PLAN</span>
                <span class="block text-xs font-bold text-[#10221C] mt-0.5">30/70</span>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-2 mt-5">
            <a href="/buy-listing" class="flex-1 bg-[#122A21] hover:bg-[#1b3d30] text-white text-xs font-medium py-2.5 px-3 rounded-[6px] flex items-center justify-center gap-1.5 transition-colors">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              <span>Email</span>
            </a>
            <a href="tel:+971500000000" class="flex-1 bg-white hover:bg-neutral-50 text-neutral-700 border border-neutral-200 text-xs font-medium py-2.5 px-3 rounded-[6px] flex items-center justify-center gap-1.5 transition-colors">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
              <span>Call</span>
            </a>
            <a href="https://wa.me/971500000000" target="_blank" class="w-10 h-9 bg-[#25D366] hover:bg-[#20ba5a] text-white rounded-[6px] flex items-center justify-center transition-colors">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.586 1.761.882 2.791.882h.001c3.181 0 5.767-2.587 5.768-5.766.001-3.181-2.585-5.768-5.769-5.768zm7.545 5.766c-.002 4.153-3.38 7.531-7.536 7.531-1.309 0-2.548-.342-3.649-.997l-4.041 1.06 1.079-3.933c-.73-1.157-1.114-2.502-1.115-3.661.002-4.153 3.38-7.531 7.536-7.531 4.154 0 7.528 3.377 7.526 7.531z"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
