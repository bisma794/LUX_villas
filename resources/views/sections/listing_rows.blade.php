<section class="max-w-[1280px] mx-auto px-6 pt-10 font-inter" id="vfs-filter-section">
  {{-- Breadcrumb: New > Villas for Sale in Dubai --}}
  <div class="flex items-center gap-2 text-xs text-neutral-500 font-inter mb-4">
    <a href="/" class="hover:text-black">New</a>
    <span>&gt;</span>
    <span class="text-neutral-800 font-medium">Villas for Sale in Dubai</span>
  </div>

  {{-- Title Bar: Heading + Live Count + Right Controls (Clear Filters, Sort: Popular, Save Search) --}}
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div class="flex items-baseline flex-wrap gap-3">
      <h1 class="font-heading font-medium text-3xl md:text-[40px] text-[#0E3B2C] leading-none tracking-tight">
        {!! array_key_exists('heading_html', $c) ? $c['heading_html'] : 'Villas for Sale in Dubai' !!}
      </h1>
      <span id="vfs-ads-count" class="font-inter text-lg md:text-xl text-[#777777] font-normal">
        {{ array_key_exists('count_text', $c) ? $c['count_text'] : '' }}
      </span>
    </div>

    {{-- Top Right Buttons --}}
    <div class="flex items-center gap-3 shrink-0 font-inter text-xs">
      <button type="button" id="vfs-clear-filters" class="text-[#D35B47] hover:underline font-medium cursor-pointer">
        Clear Filters
      </button>

      <div class="relative">
        <button type="button" id="vfs-sort-btn" class="inline-flex items-center gap-1.5 bg-[#0E3B2C] hover:bg-[#154a38] text-white px-4 py-2 rounded-full font-medium shadow-xs cursor-pointer transition-colors">
          <span id="vfs-sort-label">Sort: Popular</span>
          <span class="text-[10px]">▼</span>
        </button>
        <div id="vfs-sort-menu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-neutral-200 rounded-xl shadow-lg py-1.5 z-40 text-xs text-neutral-700">
          <button type="button" data-sort="popular" class="vfs-sort-option w-full text-left px-4 py-2 hover:bg-[#FAF8F5] font-semibold text-[#0E3B2C] cursor-pointer">Popular (Default)</button>
          <button type="button" data-sort="newest" class="vfs-sort-option w-full text-left px-4 py-2 hover:bg-[#FAF8F5] cursor-pointer">Newest Added First</button>
          <button type="button" data-sort="price_asc" class="vfs-sort-option w-full text-left px-4 py-2 hover:bg-[#FAF8F5] cursor-pointer">Price: Low to High</button>
          <button type="button" data-sort="price_desc" class="vfs-sort-option w-full text-left px-4 py-2 hover:bg-[#FAF8F5] cursor-pointer">Price: High to Low</button>
        </div>
      </div>

      <button type="button" id="vfs-save-search" class="inline-flex items-center gap-1.5 bg-[#E5CFB3] text-[#0E3B2C] px-4 py-2 rounded-full font-medium shadow-xs cursor-pointer hover:bg-[#d8bf9f] transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
        <span id="vfs-save-search-label">Save Search</span>
      </button>
    </div>
  </div>

  {{-- Location Quick Pills --}}
  @php
    $defaultChips = $c['chips'] ?? [
      'The Valley (3)',
      'Dubai Hills Estate (2)',
      'Emaar South (2)',
      'Dubai South (1)',
    ];
    $extraChips = [
      'Jumeirah Golf Estates',
      'Dubailand',
      'R. Hills, Dubai',
    ];
  @endphp
  <div class="flex flex-wrap items-center gap-2.5 mb-6 font-inter text-xs" id="vfs-location-pills">
    @foreach($defaultChips as $chip)
      @php $chipClean = trim(preg_replace('/\s*\(\d+\)\s*$/', '', $chip)); @endphp
      <button type="button" data-chip="{{ strtolower($chipClean) }}" class="vfs-chip bg-white border border-[#E8ECE9] text-neutral-700 px-4 py-2 rounded-[8px] cursor-pointer hover:border-[#0E3B2C] transition-colors shadow-2xs">
        {{ $chip }}
      </button>
    @endforeach
    @foreach($extraChips as $echip)
      @php $echipClean = trim(preg_replace('/\s*\(\d+\)\s*$/', '', $echip)); @endphp
      <button type="button" data-chip="{{ strtolower($echipClean) }}" class="vfs-chip vfs-extra-chip hidden bg-white border border-[#E8ECE9] text-neutral-700 px-4 py-2 rounded-[8px] cursor-pointer hover:border-[#0E3B2C] transition-colors shadow-2xs">
        {{ $echip }}
      </button>
    @endforeach
    <button type="button" id="vfs-view-more-chips" class="bg-[#0E3B2C] text-white px-5 py-2 rounded-full font-medium text-xs hover:bg-[#154a38] transition-colors cursor-pointer shadow-xs">
      View More
    </button>
  </div>

  {{-- Main Filter Panel --}}
  <div class="bg-white border border-[#EBECEB] rounded-[14px] p-3.5 shadow-[0_2px_12px_rgba(0,0,0,0.03)] mb-4 font-inter">
    <div class="flex flex-wrap items-center gap-2.5">
      
      {{-- All Categories dropdown --}}
      <div class="relative">
        <select id="vfs-category" class="bg-transparent border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-3.5 py-2.5 pr-7 appearance-none cursor-pointer hover:border-neutral-300 focus:outline-none">
          <option value="">All Categories</option>
          <option value="villa">Villas</option>
          <option value="townhouse">Townhouses</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center text-neutral-400 text-[10px]">▼</span>
      </div>

      {{-- Property Type dropdown --}}
      <div class="relative">
        <select id="vfs-prop-type" class="bg-transparent border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-3.5 py-2.5 pr-7 appearance-none cursor-pointer hover:border-neutral-300 focus:outline-none">
          <option value="">Property Type</option>
          <option value="villa">Luxury Villa</option>
          <option value="townhouse">Townhouse</option>
          <option value="golf">Golf Estate</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center text-neutral-400 text-[10px]">▼</span>
      </div>

      {{-- Beds dropdown --}}
      <div class="relative">
        <select id="vfs-beds" class="bg-transparent border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-3.5 py-2.5 pr-7 appearance-none cursor-pointer hover:border-neutral-300 focus:outline-none">
          <option value="">Beds</option>
          <option value="3">3 Beds</option>
          <option value="4">4 Beds</option>
          <option value="5">5+ Beds</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center text-neutral-400 text-[10px]">▼</span>
      </div>

      {{-- Price dropdown --}}
      <div class="relative">
        <select id="vfs-price" class="bg-transparent border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-3.5 py-2.5 pr-7 appearance-none cursor-pointer hover:border-neutral-300 focus:outline-none">
          <option value="">Price</option>
          <option value="under3">Under AED 3M</option>
          <option value="3to8">AED 3M - 8M</option>
          <option value="8plus">AED 8M+</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center text-neutral-400 text-[10px]">▼</span>
      </div>

      {{-- Payment Plan dropdown --}}
      <div class="relative">
        <select id="vfs-payment" class="bg-transparent border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-3.5 py-2.5 pr-7 appearance-none cursor-pointer hover:border-neutral-300 focus:outline-none">
          <option value="">Payment Plan</option>
          <option value="cash">Cash / Mortgage (Ready)</option>
          <option value="plan">Off-Plan / Post Handover</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center text-neutral-400 text-[10px]">▼</span>
      </div>

      {{-- Filters Button --}}
      <button type="button" id="vfs-more-filters-btn" class="inline-flex items-center gap-1.5 border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-3.5 py-2.5 hover:border-[#0E3B2C] cursor-pointer transition-colors">
        <span>Filters</span>
        <svg class="w-3.5 h-3.5 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
      </button>

      {{-- Quick Price Swap/Sort Icon Button --}}
      <button type="button" id="vfs-quick-sort-btn" title="Toggle Price Low/High" class="w-9 h-9 border border-[#E8ECE9] rounded-[8px] flex items-center justify-center text-neutral-600 hover:border-[#0E3B2C] cursor-pointer transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
      </button>

      {{-- Map Toggle Button --}}
      <button type="button" id="vfs-map-toggle-btn" class="ml-auto inline-flex items-center gap-2 border border-[#E8ECE9] text-neutral-700 text-xs font-medium rounded-[8px] px-4 py-2 hover:border-[#0E3B2C] cursor-pointer transition-colors">
        <span>Map</span>
        <svg class="w-3.5 h-3.5 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
      </button>

    </div>
  </div>

  {{-- Collapsible Interactive Map Panel --}}
  <div id="vfs-map-panel" class="hidden mb-4 rounded-[14px] overflow-hidden border border-[#EBECEB] shadow-xs bg-[#E5F2F8] relative h-[280px]">
    <iframe
      src="https://maps.google.com/maps?q=Dubai+Villa+Communities&z=11&output=embed"
      class="w-full h-full border-0"
      loading="lazy"
      title="Dubai Villa Communities Map"
    ></iframe>
    <button type="button" onclick="document.getElementById('vfs-map-panel').classList.add('hidden')" class="absolute top-3 right-3 bg-white/95 text-neutral-700 text-xs font-semibold px-3 py-1.5 rounded-lg shadow-sm border border-neutral-200 cursor-pointer hover:bg-white">
      Close Map ✕
    </button>
  </div>

  {{-- Keyword Search Row --}}
  <div class="flex items-center gap-3 mb-6 font-inter">
    <div class="flex-1 relative">
      <span class="absolute inset-y-0 left-4 flex items-center text-neutral-400">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      </span>
      <input type="text" id="vfs-search-input" placeholder="Search by community project or developer" class="w-full bg-white border border-[#EBECEB] rounded-[8px] pl-11 pr-4 py-3 text-xs md:text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#0E3B2C] shadow-2xs">
    </div>
    <button type="button" id="vfs-search-btn" class="bg-[#0E3B2C] hover:bg-[#154a38] text-white px-8 py-3 rounded-[8px] text-sm font-medium transition-colors cursor-pointer shadow-xs">
      Search
    </button>
  </div>

  {{-- Status Tabs Row (ALL, READY, OFF-PLAN, RE-SALE) & Show Verified Toggle --}}
  <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-neutral-200 font-inter text-xs">
    <div class="flex items-center gap-3 sm:gap-6 font-semibold" id="vfs-status-tabs">
      <button type="button" data-vfs-status="all" class="vfs-status-tab bg-[#0E3B2C] text-white px-5 py-2 rounded-full cursor-pointer transition-colors">
        ALL
      </button>
      <button type="button" data-vfs-status="ready" class="vfs-status-tab text-neutral-600 hover:text-black px-3 py-2 rounded-full cursor-pointer transition-colors">
        READY
      </button>
      <button type="button" data-vfs-status="offplan" class="vfs-status-tab text-neutral-600 hover:text-black px-3 py-2 rounded-full cursor-pointer transition-colors">
        OFF-PLAN
      </button>
      <button type="button" data-vfs-status="resale" class="vfs-status-tab text-neutral-600 hover:text-black px-3 py-2 rounded-full cursor-pointer transition-colors">
        RE-SALE
      </button>
    </div>

    {{-- Show Verified First Switch --}}
    <div class="flex items-center gap-2.5 text-xs text-neutral-600">
      <span>Show Verified First</span>
      <label class="relative inline-flex items-center cursor-pointer">
        <input type="checkbox" id="vfs-verified-toggle" class="sr-only peer">
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
      $parseMillions = function (string $priceStr): float {
        if (preg_match('/([\d,.]+)\s*M/i', $priceStr, $m)) {
          return (float) str_replace(',', '', $m[1]);
        }
        if (preg_match('/([\d,]+)/', $priceStr, $m)) {
          $raw = (float) str_replace(',', '', $m[1]);
          return $raw > 1000 ? round($raw / 1000000, 2) : $raw;
        }
        return 0.0;
      };
      $parseMaxBeds = function (string $str): int {
        if (preg_match_all('/\d+/', $str, $m) && !empty($m[0])) {
          return (int) max($m[0]);
        }
        return 4;
      };

      $cleanCardImages = ['images/arabian ranch.png', 'images/apartment.jpg'];
      $pickCardImage = function (?string $current, int $idx) use ($cleanCardImages): string {
        if (!empty($current) && (str_contains($current, '_offplan_') || str_contains($current, '_listing_'))) {
          return $current;
        }
        return $cleanCardImages[$idx % 2];
      };

      $offplanStore = \App\Http\Controllers\Admin\EntityController::getOffplanProjectStore();
      $listingStore = \App\Http\Controllers\Admin\EntityController::getListingProjectStore();

      $dynamicListings = [];
      $cardIdx = 0;
      foreach ($offplanStore as $oSlug => $proj) {
        $dev = $proj['stats'][0]['lower'] ?? ($proj['stats'][0]['upper'] ?? 'Emaar');
        $price = $proj['stats'][1]['upper'] ?? 'AED 1,099,888';
        $units = $proj['stats'][2]['upper'] ?? '1-4br';
        $handover = $proj['stats'][3]['upper'] ?? '2030 Q1';
        $isTown = (($proj['property_category'] ?? '') === 'townhouse' || str_contains(strtolower(($proj['name'] ?? '') . ' ' . $oSlug), 'townhouse'));
        $catLabel = $isTown ? 'Townhouse' : 'Villa';
        $loc = !empty($proj['usps'][2]) ? $proj['usps'][2] : ($proj['location_text'] ?? ($proj['city'] ?? 'Dubai'));
        $isGolf = str_contains(strtolower(($proj['name'] ?? '') . ' ' . $loc), 'golf') || str_contains(strtolower(($proj['name'] ?? '') . ' ' . $loc), 'fairway');
        $cImg = $pickCardImage($proj['gallery_main'] ?? null, $cardIdx);
        $dynamicListings[] = [
          'idx' => $cardIdx++,
          'image' => $cImg,
          'tag' => 'OFF-PLAN | Initial Sale',
          'status' => 'offplan',
          'category' => $isTown ? 'townhouse' : 'villa',
          'prop_type' => $isTown ? 'townhouse' : ($isGolf ? 'golf' : 'villa'),
          'beds_num' => $parseMaxBeds($units),
          'price_m' => $parseMillions($price),
          'payment_mode' => 'plan',
          'verified' => '1',
          'developer' => $dev,
          'price' => $price,
          'beds_baths' => $catLabel . ' | Units: ' . $units . ' | Developer: ' . $dev,
          'title' => $proj['name'] ?? ucwords(str_replace('-', ' ', $oSlug)),
          'location' => $loc,
          'authenticity' => 'Off-plan DLD registered development',
          'handover' => $handover,
          'payment_plan' => ($proj['payment_step1_pct'] ?? '20') . '/' . ((int)($proj['payment_step2_pct'] ?? 40) + (int)($proj['payment_step3_pct'] ?? 40)),
          'link' => $proj['url'] ?? ('/projects/' . $oSlug),
        ];
      }

      foreach ($listingStore as $lSlug => $lItem) {
        $loc = $lItem['location_text'] ?? (($lItem['community'] ?? 'The Valley') . ', ' . ($lItem['city'] ?? 'Dubai'));
        $isTown = strtolower($lItem['property_type'] ?? 'villa') === 'townhouse';
        $isGolf = str_contains(strtolower(($lItem['name'] ?? '') . ' ' . $loc), 'golf') || str_contains(strtolower(($lItem['name'] ?? '') . ' ' . $loc), 'fairway');
        $price = $lItem['price'] ?? 'AED 2,740,000';
        $bedsStr = (string) ($lItem['beds'] ?? '4');
        $cImg = $pickCardImage($lItem['gallery_main'] ?? null, $cardIdx);
        $dynamicListings[] = [
          'idx' => $cardIdx++,
          'image' => $cImg,
          'tag' => $lItem['tag'] ?? 'READY TO MOVE',
          'status' => 'ready',
          'category' => $isTown ? 'townhouse' : 'villa',
          'prop_type' => $isTown ? 'townhouse' : ($isGolf ? 'golf' : 'villa'),
          'beds_num' => $parseMaxBeds($bedsStr),
          'price_m' => $parseMillions($price),
          'payment_mode' => 'cash',
          'verified' => '1',
          'developer' => $lItem['developer'] ?? 'Emaar',
          'price' => $price,
          'beds_baths' => ($lItem['property_type'] ?? 'Villa') . ' 🛏 ' . $bedsStr . ' 🛁 ' . ($lItem['baths'] ?? '4') . ' | Built-up: ' . ($lItem['sqft'] ?? '2,462 sq.ft'),
          'title' => $lItem['name'] ?? ucwords(str_replace('-', ' ', $lSlug)),
          'location' => $loc,
          'authenticity' => $lItem['authenticity'] ?? 'Property authenticity validated by DLD Trakheesi',
          'handover' => $lItem['handover'] ?? 'Ready to Move',
          'payment_plan' => $lItem['payment_plan'] ?? 'Cash / Mortgage',
          'link' => $lItem['url'] ?? ('/listing/' . $lSlug),
        ];
      }

      $topListings = $dynamicListings;

      $listing5 = [
        'image' => 'images/arabian ranch.png',
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

    <style>
      .vfs-listing-card-img { height: 220px; width: 100%; }
      @media (min-width: 768px) {
        .vfs-listing-card { height: 280px; }
        .vfs-listing-card-img { width: 320px; height: 280px; }
      }
      .vfs-promo-banner {
        width: 100%;
        max-width: 899px;
        min-height: 137px;
      }
      @media (min-width: 640px) {
        .vfs-promo-banner {
          width: 899px;
          max-width: 100%;
          height: 137px;
        }
      }
    </style>

    <div id="vfs-listings-container" class="space-y-6">
    @foreach($topListings as $l)
    <div
      class="vfs-listing-card bg-white border border-[#EBECEB] rounded-[14px] overflow-hidden shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow flex flex-col md:flex-row"
      data-index="{{ $l['idx'] }}"
      data-title="{{ strtolower($l['title']) }}"
      data-location="{{ strtolower($l['location']) }}"
      data-developer="{{ strtolower($l['developer'] ?? '') }}"
      data-category="{{ $l['category'] }}"
      data-prop-type="{{ $l['prop_type'] }}"
      data-status="{{ $l['status'] }}"
      data-beds="{{ $l['beds_num'] }}"
      data-price-m="{{ $l['price_m'] }}"
      data-payment="{{ $l['payment_mode'] }}"
      data-verified="{{ $l['verified'] }}"
    >
      
      {{-- Clean Image Box (uniform size, no dots or side arrows) --}}
      <div class="vfs-listing-card-img relative shrink-0 overflow-hidden bg-neutral-100">
        <img src="{{ asset($l['image']) }}" alt="{{ $l['title'] }}" class="w-full h-full object-cover">
        
        @if(!empty($l['tag']))
        <span class="absolute top-3.5 left-3.5 bg-black/60 backdrop-blur-xs text-white text-[10px] font-semibold tracking-wider px-2.5 py-1 rounded-[4px]">
          {{ $l['tag'] }}
        </span>
        @endif

        <button type="button" class="absolute top-3.5 right-3.5 w-7 h-7 bg-white/90 hover:bg-white text-neutral-600 rounded-full flex items-center justify-center text-xs shadow-xs cursor-pointer">
          ♡
        </button>
      </div>

      {{-- Card Info & Actions --}}
      <div class="p-5 flex-1 flex flex-col justify-between font-inter">
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
            <a href="{{ $l['link'] }}" class="hover:underline">{{ $l['title'] }}</a>
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

    <div id="vfs-no-results" class="hidden bg-white border border-[#EBECEB] rounded-[14px] p-10 text-center space-y-3">
      <p class="font-heading text-2xl text-[#10221C]">No matching properties found</p>
      <p class="text-xs text-neutral-500">Try adjusting your filters or clearing your search query.</p>
      <button type="button" onclick="document.getElementById('vfs-clear-filters').click()" class="inline-flex items-center px-5 py-2.5 rounded-[8px] bg-[#0E3B2C] text-white text-xs font-semibold cursor-pointer">
        Reset All Filters
      </button>
    </div>

    {{-- Banner in continuity: "What's your property worth today?" --}}
    <div class="vfs-promo-banner bg-[#FAF8F5] border border-[#EBE8E2] rounded-[16px] px-6 py-3 flex flex-col sm:flex-row items-center justify-between gap-5 overflow-hidden shadow-2xs font-inter">
      <div class="flex items-center gap-5">
        <div class="w-28 sm:w-32 h-[105px] shrink-0 flex items-center justify-center">
          <img src="{{ asset('images/property-worth-illustration.png') }}" alt="Property Worth" class="max-h-full w-auto object-contain">
        </div>
        <div>
          <h3 class="font-heading font-medium text-xl sm:text-[22px] text-[#0E3B2C] leading-snug">
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
    <div
      class="vfs-listing-card bg-white border border-[#EBECEB] rounded-[14px] overflow-hidden shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow flex flex-col md:flex-row"
      data-index="99"
      data-title="{{ strtolower($listing5['title']) }}"
      data-location="{{ strtolower($listing5['location']) }}"
      data-developer="emaar"
      data-category="villa"
      data-prop-type="villa"
      data-status="offplan"
      data-beds="5"
      data-price-m="4"
      data-payment="plan"
      data-verified="1"
    >
      <div class="vfs-listing-card-img relative shrink-0 overflow-hidden bg-neutral-100">
        <img src="{{ asset($listing5['image']) }}" alt="{{ $listing5['title'] }}" class="w-full h-full object-cover">
        @if(!empty($listing5['tag']))
        <span class="absolute top-3.5 left-3.5 bg-black/60 backdrop-blur-xs text-white text-[10px] font-semibold tracking-wider px-2.5 py-1 rounded-[4px]">
          {{ $listing5['tag'] }}
        </span>
        @endif
        <button type="button" class="absolute top-3.5 right-3.5 w-7 h-7 bg-white/90 hover:bg-white text-neutral-600 rounded-full flex items-center justify-center text-xs shadow-xs cursor-pointer">
          ♡
        </button>
      </div>
      <div class="p-5 flex-1 flex flex-col justify-between font-inter">
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
          'image' => 'images/apartment.jpg',
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
          'image' => 'images/arabian ranch.png',
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
          'image' => 'images/apartment.jpg',
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
    <div
      class="vfs-listing-card bg-white border border-[#EBECEB] rounded-[14px] overflow-hidden shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow flex flex-col md:flex-row"
      data-index="10{{ $loop->index }}"
      data-title="{{ strtolower($l['title']) }}"
      data-location="{{ strtolower($l['location']) }}"
      data-developer="emaar"
      data-category="villa"
      data-prop-type="villa"
      data-status="offplan"
      data-beds="5"
      data-price-m="4"
      data-payment="plan"
      data-verified="1"
    >
      
      <div class="vfs-listing-card-img relative shrink-0 overflow-hidden bg-neutral-100">
        <img src="{{ asset($l['image']) }}" alt="{{ $l['title'] }}" class="w-full h-full object-cover">
        
        @if(!empty($l['tag']))
        <span class="absolute top-3.5 left-3.5 bg-black/60 backdrop-blur-xs text-white text-[10px] font-semibold tracking-wider px-2.5 py-1 rounded-[4px]">
          {{ $l['tag'] }}
        </span>
        @endif

        <button type="button" class="absolute top-3.5 right-3.5 w-7 h-7 bg-white/90 hover:bg-white text-neutral-600 rounded-full flex items-center justify-center text-xs shadow-xs cursor-pointer">
          ♡
        </button>
      </div>

      <div class="p-5 flex-1 flex flex-col justify-between font-inter">
        <div>
          <p class="font-inter font-bold text-2xl text-[#10221C] tracking-tight">
            {{ $l['price'] }}
          </p>

          <p class="text-xs text-neutral-600 font-medium mt-1">
            {{ $l['beds_baths'] }}
          </p>

          <h3 class="font-inter font-semibold text-sm text-[#10221C] mt-1.5">
            <a href="{{ $l['link'] }}" class="hover:underline">{{ $l['title'] }}</a>
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
  
  {{-- Bottom Banner + Listing 9 aligned inside 8-cols column --}}
  <div class="grid lg:grid-cols-12 gap-8">
    <div class="lg:col-span-8 space-y-6">
      {{-- Looking to sell or rent your home? Banner --}}
      <div class="vfs-promo-banner bg-[#FAF8F5] border border-[#EBE8E2] rounded-[16px] px-6 py-3 flex flex-col sm:flex-row items-center justify-between gap-5 overflow-hidden shadow-2xs font-inter">
        <div class="flex items-center gap-5">
          <div class="w-28 sm:w-32 h-[105px] shrink-0 flex items-center justify-center">
            <img src="{{ asset('images/sell-rent-villa-exact.png') }}" alt="Looking to sell or rent" class="max-h-full w-auto object-contain">
          </div>
          <div>
            <h2 class="font-heading font-medium text-xl sm:text-[22px] text-[#0E3B2C] leading-snug">
              Looking to sell or rent your home?
            </h2>
            <p class="text-xs text-neutral-500 font-inter mt-1">
              Reach more buyers or renters through an expert agent.
            </p>
          </div>
        </div>

        <a href="/valuation" class="shrink-0 bg-[#0E3B2C] hover:bg-[#154a38] text-white text-xs font-semibold px-5 py-2.5 rounded-[6px] transition-colors shadow-xs">
          Get started now ›
        </a>
      </div>

      <div
        class="vfs-listing-card bg-white border border-[#EBECEB] rounded-[14px] overflow-hidden shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow flex flex-col md:flex-row"
        data-index="110"
        data-title="5br villa | r. hills | pool & garden community"
        data-location="r. hills, dubai"
        data-developer="emaar"
        data-category="villa"
        data-prop-type="villa"
        data-status="offplan"
        data-beds="5"
        data-price-m="4"
        data-payment="plan"
        data-verified="1"
      >
        <div class="vfs-listing-card-img relative shrink-0 overflow-hidden bg-neutral-100">
          <img src="{{ asset('images/arabian ranch.png') }}" alt="Garden Villa" class="w-full h-full object-cover">
          <span class="absolute top-3.5 left-3.5 bg-black/60 backdrop-blur-xs text-white text-[10px] font-semibold tracking-wider px-2.5 py-1 rounded-[4px]">
            OFF-PLAN | Initial Sale
          </span>
          <button type="button" class="absolute top-3.5 right-3.5 w-7 h-7 bg-white/90 hover:bg-white text-neutral-600 rounded-full flex items-center justify-center text-xs shadow-xs cursor-pointer">
            ♡
          </button>
        </div>
        <div class="p-5 flex-1 flex flex-col justify-between font-inter">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
  const container = document.getElementById('vfs-listings-container');
  const cards = Array.from(document.querySelectorAll('.vfs-listing-card'));
  const adsCountEl = document.getElementById('vfs-ads-count');
  const noResultsEl = document.getElementById('vfs-no-results');

  const searchInput = document.getElementById('vfs-search-input');
  const searchBtn = document.getElementById('vfs-search-btn');
  const categorySelect = document.getElementById('vfs-category');
  const propTypeSelect = document.getElementById('vfs-prop-type');
  const bedsSelect = document.getElementById('vfs-beds');
  const priceSelect = document.getElementById('vfs-price');
  const paymentSelect = document.getElementById('vfs-payment');
  const verifiedToggle = document.getElementById('vfs-verified-toggle');
  const clearBtn = document.getElementById('vfs-clear-filters');
  const sortBtn = document.getElementById('vfs-sort-btn');
  const sortMenu = document.getElementById('vfs-sort-menu');
  const sortLabel = document.getElementById('vfs-sort-label');
  const quickSortBtn = document.getElementById('vfs-quick-sort-btn');
  const moreFiltersBtn = document.getElementById('vfs-more-filters-btn');
  const mapToggleBtn = document.getElementById('vfs-map-toggle-btn');
  const mapPanel = document.getElementById('vfs-map-panel');
  const saveSearchBtn = document.getElementById('vfs-save-search');
  const saveSearchLabel = document.getElementById('vfs-save-search-label');
  const viewMoreChipsBtn = document.getElementById('vfs-view-more-chips');

  let activeStatus = 'all';
  let activeChip = '';
  let currentSort = 'popular';

  function applyFiltersAndSort() {
    const q = (searchInput.value || '').trim().toLowerCase();
    const cat = categorySelect.value;
    const propType = propTypeSelect.value;
    const beds = bedsSelect.value;
    const priceRange = priceSelect.value;
    const payment = paymentSelect.value;
    const verifiedOnly = verifiedToggle.checked;

    let visibleCount = 0;

    cards.forEach(card => {
      const title = card.dataset.title || '';
      const loc = card.dataset.location || '';
      const dev = card.dataset.developer || '';
      const cCat = card.dataset.category || '';
      const cType = card.dataset.propType || '';
      const cStatus = card.dataset.status || 'offplan';
      const cBeds = parseInt(card.dataset.beds || '4', 10);
      const cPriceM = parseFloat(card.dataset.priceM || '0');
      const cPay = card.dataset.payment || '';
      const cVerified = card.dataset.verified === '1';

      let ok = true;
      if (q && !(title.includes(q) || loc.includes(q) || dev.includes(q))) ok = false;
      if (activeChip && !(loc.includes(activeChip) || title.includes(activeChip))) ok = false;
      if (cat && cCat !== cat) ok = false;
      if (propType && cType !== propType) ok = false;
      if (beds === '3' && cBeds < 3) ok = false;
      if (beds === '4' && cBeds < 4) ok = false;
      if (beds === '5' && cBeds < 5) ok = false;
      if (priceRange === 'under3' && !(cPriceM > 0 && cPriceM < 3)) ok = false;
      if (priceRange === '3to8' && !(cPriceM >= 3 && cPriceM <= 8)) ok = false;
      if (priceRange === '8plus' && !(cPriceM >= 8)) ok = false;
      if (payment && cPay !== payment) ok = false;
      if (activeStatus !== 'all' && cStatus !== activeStatus) ok = false;
      if (verifiedOnly && !cVerified) ok = false;

      card.classList.toggle('hidden', !ok);
      if (ok) visibleCount++;
    });

    if (container) {
      const topCards = Array.from(container.querySelectorAll('.vfs-listing-card'));
      topCards.sort((a, b) => {
        if (currentSort === 'price_asc') {
          return parseFloat(a.dataset.priceM || 0) - parseFloat(b.dataset.priceM || 0);
        }
        if (currentSort === 'price_desc') {
          return parseFloat(b.dataset.priceM || 0) - parseFloat(a.dataset.priceM || 0);
        }
        if (verifiedToggle.checked) {
          const vDiff = (b.dataset.verified === '1' ? 1 : 0) - (a.dataset.verified === '1' ? 1 : 0);
          if (vDiff !== 0) return vDiff;
        }
        return parseInt(a.dataset.index || 0, 10) - parseInt(b.dataset.index || 0, 10);
      });
      topCards.forEach(c => container.appendChild(c));
    }

    if (adsCountEl) {
      adsCountEl.textContent = '• ' + visibleCount + (visibleCount === 1 ? ' Property' : ' Properties');
    }
    if (noResultsEl) {
      noResultsEl.classList.toggle('hidden', visibleCount > 0);
    }
  }

  // Status tabs (ALL, READY, OFF-PLAN, RE-SALE)
  document.querySelectorAll('.vfs-status-tab').forEach(btn => {
    btn.addEventListener('click', function() {
      activeStatus = this.getAttribute('data-vfs-status') || 'all';
      document.querySelectorAll('.vfs-status-tab').forEach(b => {
        b.classList.remove('bg-[#0E3B2C]', 'text-white', 'px-5');
        b.classList.add('text-neutral-600', 'px-3');
      });
      this.classList.add('bg-[#0E3B2C]', 'text-white', 'px-5');
      this.classList.remove('text-neutral-600', 'px-3');
      applyFiltersAndSort();
    });
  });

  // Location quick pills
  document.querySelectorAll('.vfs-chip').forEach(chip => {
    chip.addEventListener('click', function() {
      const val = this.getAttribute('data-chip') || '';
      activeChip = activeChip === val ? '' : val;
      document.querySelectorAll('.vfs-chip').forEach(c => {
        const isSel = c.getAttribute('data-chip') === activeChip && activeChip !== '';
        c.classList.toggle('bg-[#0E3B2C]', isSel);
        c.classList.toggle('text-white', isSel);
        c.classList.toggle('border-[#0E3B2C]', isSel);
        c.classList.toggle('bg-white', !isSel);
        c.classList.toggle('text-neutral-700', !isSel);
      });
      applyFiltersAndSort();
    });
  });

  // View More chips toggle
  if (viewMoreChipsBtn) {
    viewMoreChipsBtn.addEventListener('click', function() {
      const extras = document.querySelectorAll('.vfs-extra-chip');
      const showing = extras.length && !extras[0].classList.contains('hidden');
      extras.forEach(el => el.classList.toggle('hidden', showing));
      this.textContent = showing ? 'View More' : 'View Less';
    });
  }

  // Sort dropdown & quick swap button
  if (sortBtn && sortMenu) {
    sortBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      sortMenu.classList.toggle('hidden');
    });
    document.addEventListener('click', () => sortMenu.classList.add('hidden'));
    document.querySelectorAll('.vfs-sort-option').forEach(opt => {
      opt.addEventListener('click', function() {
        currentSort = this.getAttribute('data-sort') || 'popular';
        sortLabel.textContent = 'Sort: ' + this.textContent.replace(' (Default)', '');
        sortMenu.classList.add('hidden');
        applyFiltersAndSort();
      });
    });
  }

  if (quickSortBtn) {
    quickSortBtn.addEventListener('click', function() {
      currentSort = currentSort === 'price_asc' ? 'price_desc' : 'price_asc';
      sortLabel.textContent = currentSort === 'price_asc' ? 'Sort: Price Low-High' : 'Sort: Price High-Low';
      this.classList.toggle('bg-[#0E3B2C]', true);
      this.classList.toggle('text-white', true);
      applyFiltersAndSort();
    });
  }

  // Map toggle button
  if (mapToggleBtn && mapPanel) {
    mapToggleBtn.addEventListener('click', function() {
      const isHidden = mapPanel.classList.contains('hidden');
      mapPanel.classList.toggle('hidden', !isHidden);
      this.classList.toggle('bg-[#0E3B2C]', isHidden);
      this.classList.toggle('text-white', isHidden);
    });
  }

  // Filters button highlights search bar & resets focus
  if (moreFiltersBtn && searchInput) {
    moreFiltersBtn.addEventListener('click', function() {
      searchInput.focus();
      document.getElementById('vfs-filter-section')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  }

  // Save Search button
  if (saveSearchBtn && saveSearchLabel) {
    saveSearchBtn.addEventListener('click', function() {
      try {
        localStorage.setItem('lux_vfs_saved_search', JSON.stringify({
          q: searchInput.value,
          category: categorySelect.value,
          beds: bedsSelect.value,
          price: priceSelect.value,
          status: activeStatus,
          chip: activeChip,
        }));
      } catch (e) {}
      saveSearchLabel.textContent = '✓ Search Saved';
      setTimeout(() => { saveSearchLabel.textContent = 'Save Search'; }, 2200);
    });
  }

  // Clear Filters
  if (clearBtn) {
    clearBtn.addEventListener('click', function() {
      searchInput.value = '';
      categorySelect.value = '';
      propTypeSelect.value = '';
      bedsSelect.value = '';
      priceSelect.value = '';
      paymentSelect.value = '';
      verifiedToggle.checked = false;
      activeStatus = 'all';
      activeChip = '';
      currentSort = 'popular';
      if (sortLabel) sortLabel.textContent = 'Sort: Popular';
      if (quickSortBtn) {
        quickSortBtn.classList.remove('bg-[#0E3B2C]', 'text-white');
      }
      document.querySelectorAll('.vfs-chip').forEach(c => {
        c.classList.remove('bg-[#0E3B2C]', 'text-white', 'border-[#0E3B2C]');
        c.classList.add('bg-white', 'text-neutral-700');
      });
      document.querySelectorAll('.vfs-status-tab').forEach(b => {
        const isAll = b.getAttribute('data-vfs-status') === 'all';
        b.classList.toggle('bg-[#0E3B2C]', isAll);
        b.classList.toggle('text-white', isAll);
        b.classList.toggle('px-5', isAll);
        b.classList.toggle('text-neutral-600', !isAll);
        b.classList.toggle('px-3', !isAll);
      });
      applyFiltersAndSort();
    });
  }

  // Bind dropdowns & search inputs
  [categorySelect, propTypeSelect, bedsSelect, priceSelect, paymentSelect, verifiedToggle].forEach(el => {
    if (el) el.addEventListener('change', applyFiltersAndSort);
  });
  if (searchInput) {
    searchInput.addEventListener('input', applyFiltersAndSort);
    searchInput.addEventListener('keydown', e => {
      if (e.key === 'Enter') { e.preventDefault(); applyFiltersAndSort(); }
    });
  }
  if (searchBtn) {
    searchBtn.addEventListener('click', applyFiltersAndSort);
  }

  // Handle ?status=ready|offplan or ?q= from navbar links
  const params = new URLSearchParams(window.location.search);
  const urlStatus = (params.get('status') || '').toLowerCase();
  const urlQ = params.get('q') || '';
  if (urlQ && searchInput) searchInput.value = urlQ;
  if (urlStatus) {
    const tabBtn = document.querySelector(`.vfs-status-tab[data-vfs-status="${urlStatus}"]`);
    if (tabBtn) tabBtn.click();
    else applyFiltersAndSort();
  } else {
    applyFiltersAndSort();
  }
});
</script>
