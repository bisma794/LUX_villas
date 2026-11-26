@php
  $galleryMain = !empty($c['gallery_main']) ? $c['gallery_main'] : (!empty($c['gallery'][0]) && $c['gallery'][0] !== 'images/buy-gallery-main.jpg' ? $c['gallery'][0] : 'images/dubai-marina.jpg');
  $galleryTopRight = !empty($c['gallery_top_right']) ? $c['gallery_top_right'] : (!empty($c['gallery'][1]) && $c['gallery'][1] !== 'images/buy-gallery-top-right.jpg' ? $c['gallery'][1] : 'images/house-white.jpg');
  $galleryBottomRight = !empty($c['gallery_bottom_right']) ? $c['gallery_bottom_right'] : (!empty($c['gallery'][2]) && $c['gallery'][2] !== 'images/buy-gallery-bottom-right.jpg' ? $c['gallery'][2] : 'images/family-park.jpg');

  $priceText = array_key_exists('price', $c) ? $c['price'] : 'AED 2,740,000';
  $bedsCount = array_key_exists('beds', $c) ? $c['beds'] : '4';
  $bathsCount = array_key_exists('baths', $c) ? $c['baths'] : '2';
  $sqftText = array_key_exists('sqft', $c) ? $c['sqft'] : '1,004 sq.ft';

  if (array_key_exists('usps', $c) && is_array($c['usps'])) {
    $uspsDisplay = implode(' | ', array_filter($c['usps']));
  } elseif (array_key_exists('heading_html', $c)) {
    $uspsDisplay = strip_tags(html_entity_decode($c['heading_html'], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
  } else {
    $uspsDisplay = 'The Valley | Prime Location | District Deal';
  }

  $subtextDisplay = array_key_exists('subtext', $c) ? $c['subtext'] : '4 Bedroom Villa for Sale in The Valley.';
  $overviewHeading = array_key_exists('overview_heading', $c) ? $c['overview_heading'] : 'Overview';
  $overviewBody = array_key_exists('overview_text', $c) ? $c['overview_text'] : "Engel & Voelkers is proud to present a rare opportunity to acquire a Garden Hall Villa in the prestigious Jumeirah Islands community.\n\nThis vacant property is situated on a 10,643 plot, offering enhanced privacy and stunning views of the lake. The villa features four generously sized bedrooms, a separate study room, a maid's room with private access, and three spacious living areas, providing ample space for family living and entertaining.\n\n- Garden Hall\n- 4 Bedrooms + Maid's";
  $btnLabel = array_key_exists('button_text', $c) ? $c['button_text'] : 'See full description';
@endphp

<div class="max-w-[1280px] mx-auto px-6 pt-6 pb-16 font-inter">

  {{-- Breadcrumb + Right Action Controls (Save, Share, Report) matching Screenshot --}}
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs text-neutral-500 mb-4 font-inter">
    
    {{-- Breadcrumb line --}}
    <div class="flex items-center gap-1.5 flex-wrap">
      <a href="/" class="hover:text-black">
        <svg class="w-3.5 h-3.5 fill-current inline-block" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
      </a>
      <span>&gt;</span>
      <a href="/villas-for-sale" class="hover:text-black">Villas</a>
      <span>&gt;</span>
      <a href="/communities" class="hover:text-black">Jumeirah</a>
      <span>&gt;</span>
      <a href="/communities" class="hover:text-black">Medli</a>
      <span>&gt;</span>
      <span class="text-neutral-400">Cluster</span>
      <span>&gt;</span>
      <span class="text-neutral-700 font-medium">{{ $uspsDisplay }}</span>
    </div>

    {{-- Right controls: Save, Share, Report --}}
    <div class="flex items-center gap-4 shrink-0 text-xs text-neutral-600">
      <button type="button" class="inline-flex items-center gap-1.5 hover:text-black cursor-pointer">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        <span>Save</span>
      </button>
      <button type="button" class="inline-flex items-center gap-1.5 hover:text-black cursor-pointer">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
        <span>Share</span>
      </button>
      <button type="button" class="inline-flex items-center gap-1.5 hover:text-black cursor-pointer">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>
        <span>Report</span>
      </button>
    </div>
  </div>

  {{-- Top Image Gallery Grid (1 Large Left + 2 Stacked Right) High-Res --}}
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-3 mb-10">
    
    {{-- Left Large Main Image (Col 8) --}}
    <div class="lg:col-span-8 relative aspect-[16/11] rounded-[16px] overflow-hidden bg-neutral-100 shadow-xs">
      <img src="{{ asset($galleryMain) }}" alt="Waterfront Skyline" class="w-full h-full object-cover">
    </div>

    {{-- Right 2 Stacked Images (Col 4) --}}
    <div class="lg:col-span-4 grid grid-rows-2 gap-3">
      <div class="relative rounded-[16px] overflow-hidden bg-neutral-100 shadow-xs">
        <img src="{{ asset($galleryTopRight) }}" alt="Villa Exterior Pool" class="w-full h-full object-cover">
      </div>
      <div class="relative rounded-[16px] overflow-hidden bg-neutral-100 shadow-xs">
        <img src="{{ asset($galleryBottomRight) }}" alt="Community Park & Buildings" class="w-full h-full object-cover">
      </div>
    </div>

  </div>

  {{-- Main Content + Sidebar Layout matching Screenshot 2 --}}
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
    
    {{-- Left Column: 8 Cols (Details & Overview) --}}
    <div class="lg:col-span-8 font-inter">
      
      {{-- Price --}}
      <h1 class="font-heading font-bold text-3xl sm:text-4xl md:text-[42px] text-[#0E3B2C] leading-none tracking-tight">
        {{ $priceText }}
      </h1>

      {{-- Specs Row: Beds, Baths, Sqft with icons --}}
      <div class="flex items-center gap-6 text-xs sm:text-sm text-neutral-600 font-medium mt-3 pb-6 border-b border-neutral-100">
        <span class="inline-flex items-center gap-1.5">
          <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
          <span>{{ $bedsCount }}</span>
        </span>
        <span class="inline-flex items-center gap-1.5">
          <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          <span>{{ $bathsCount }}</span>
        </span>
        <span class="inline-flex items-center gap-1.5">
          <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
          <span>{{ $sqftText }}</span>
        </span>
      </div>

      {{-- Project Title (USPs) & Subtitle --}}
      <div class="mt-6">
        <h2 class="font-heading font-medium text-2xl sm:text-3xl text-[#0E3B2C] leading-snug">
          {{ $uspsDisplay }}
        </h2>
        <p class="text-sm sm:text-base text-neutral-500 font-inter mt-1">
          {{ $subtextDisplay }}
        </p>
      </div>

      {{-- Overview Section --}}
      <div class="mt-10">
        <h3 class="font-heading font-semibold text-2xl text-[#0E3B2C] mb-4">
          {{ $overviewHeading }}
        </h3>
        
        <div class="text-neutral-600 text-xs sm:text-sm leading-relaxed space-y-3 font-inter whitespace-pre-line">{{ $overviewBody }}</div>

        {{-- See full description button --}}
        <div class="mt-6">
          <button type="button" class="border border-[#0E3B2C] text-[#0E3B2C] hover:bg-[#0E3B2C] hover:text-white transition-colors text-xs font-semibold px-5 py-2.5 rounded-[6px] cursor-pointer">
            {{ $btnLabel }}
          </button>
        </div>
      </div>

    </div>

    {{-- Right Sidebar: 4 Cols matching Screenshot 2 --}}
    <aside class="lg:col-span-4 space-y-6">
      
      {{-- Widget 1: Faraz Shafi Sales Consultant --}}
      <div class="bg-white border border-[#E5E7EB] rounded-[16px] p-5 shadow-xs font-inter">
        {{-- 3 Rounded Action Buttons at Top --}}
        <div class="grid grid-cols-3 gap-2.5 mb-5 font-inter text-xs">
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

        {{-- Agent Info --}}
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
        {{-- LV watermark logo background --}}
        <div class="absolute right-3 bottom-2 text-white/25 pointer-events-none font-serif text-7xl font-bold leading-none select-none">
          LV
        </div>
      </div>

    </aside>

  </div>

  {{-- ======================================================== --}}
  {{-- FULL WIDTH SECTIONS BELOW TOP GRID & SIDEBAR WIDGETS     --}}
  {{-- ======================================================== --}}

  {{-- 1. Amenities & Facilities Section --}}
  <div class="border-t border-neutral-200 pt-12 mt-12 font-inter">
    <h3 class="font-heading font-medium text-2xl sm:text-[30px] text-[#0E3B2C] mb-6">
      {!! $c['amenities_heading'] ?? 'Amenities &amp; Facilities' !!}
    </h3>

    {{-- Rounded Amenities Cards Grid --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6">
      @php
        $allAmenitiesStore = \App\Http\Controllers\Admin\EntityController::getAmenitiesStore();
        $assignedAmenityKeys = !empty($c['assigned_amenities']) && is_array($c['assigned_amenities'])
          ? $c['assigned_amenities']
          : ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'];

        $amenityList = array_values(array_filter($allAmenitiesStore, function ($am) use ($assignedAmenityKeys) {
          return in_array($am['key'], $assignedAmenityKeys);
        }));
      @endphp

      @foreach($amenityList as $am)
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
  </div>

  {{-- 2. Property Location Section --}}
  @php
    $locHeading = array_key_exists('location_heading', $c) ? $c['location_heading'] : 'Property Location';
    $locText = array_key_exists('location_text', $c) ? $c['location_text'] : 'Nice, Damac Lagoons.';
    $latVal = !empty($c['latitude']) ? trim($c['latitude']) : '25.0245';
    $lngVal = !empty($c['longitude']) ? trim($c['longitude']) : '55.2286';
    $googleMapEmbedUrl = "https://maps.google.com/maps?q={$latVal},{$lngVal}&z=14&output=embed";
    $googleMapExternalUrl = "https://www.google.com/maps/search/?api=1&query={$latVal},{$lngVal}";
  @endphp
  <div class="border-t border-neutral-200 pt-12 mt-12 font-inter">
    <h3 class="font-heading font-medium text-2xl sm:text-[30px] text-[#0E3B2C] mb-6">
      {{ $locHeading }}
    </h3>

    {{-- Map Banner Container dynamically driven by Latitude & Longitude --}}
    <div class="relative w-full rounded-[20px] overflow-hidden shadow-xs border border-neutral-200 bg-[#E5F2F8] h-[190px] sm:h-[220px]">
      <iframe 
        src="{{ $googleMapEmbedUrl }}" 
        class="w-full h-full border-0 pointer-events-none select-none" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade"
        title="{{ $locText }}"
      ></iframe>
      
      {{-- Overlay Location Box --}}
      <div class="absolute inset-x-4 sm:inset-x-8 top-1/2 -translate-y-1/2 bg-white/95 backdrop-blur-xs rounded-[16px] py-4 px-6 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-md border border-neutral-100">
        <div class="flex items-center gap-3">
          <span class="text-[#B9975B] text-2xl">📍</span>
          <div>
            <span class="font-inter font-medium text-base sm:text-lg text-[#10221C] block">
              {{ $locText }}
            </span>
            <span class="text-[11px] text-neutral-400 font-mono block">
              Lat: {{ $latVal }} &bull; Lng: {{ $lngVal }}
            </span>
          </div>
        </div>
        <a href="{{ $googleMapExternalUrl }}" target="_blank" class="bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold font-inter px-6 py-2.5 rounded-[8px] transition-colors shadow-xs shrink-0">
          View on Map
        </a>
      </div>
    </div>
  </div>

  {{-- 3. Price Trend & Unit Volume Section --}}
  <div class="border-t border-neutral-200 pt-12 mt-12 font-inter">
    {{-- Section Heading & Subtext --}}
    <h3 class="font-heading font-medium text-2xl sm:text-[28px] text-[#0E3B2C] leading-snug">
      4 bedroom townhouse price trend in Nice (Dubai, DAMAC Lagoons)
    </h3>
    <p class="text-sm sm:text-base text-neutral-500 font-inter mt-1.5 mb-6">
      Prices have gone down by -1.42% (MOM)
    </p>

    {{-- Dual Chart Containers with Center "VS" Badge --}}
    <div class="relative flex flex-col md:flex-row items-stretch gap-4 sm:gap-6">
      
      {{-- Center Floating "VS" Badge --}}
      <div class="hidden md:flex absolute left-1/2 top-8 -translate-x-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-[#10221C] text-white font-inter font-bold text-xs items-center justify-center shadow-md z-20 border-2 border-white">
        VS
      </div>

      {{-- Left Card: Price Trend --}}
      <div class="flex-1 bg-[#FAF9F5] border border-[#EBE8E0] rounded-[20px] p-5 sm:p-6 shadow-2xs flex flex-col justify-between">
        {{-- Header Pill --}}
        <div class="bg-white rounded-full py-2.5 px-6 shadow-xs border border-neutral-100 text-center mb-6">
          <span class="font-heading font-medium text-lg text-[#10221C]">Price Trend</span>
        </div>

        {{-- Line Chart SVG --}}
        <div class="relative w-full">
          <div class="flex">
            {{-- Y-Axis Labels --}}
            <div class="flex flex-col justify-between text-[10px] text-neutral-400 font-inter text-right pr-2 select-none h-48 py-1">
              <span>3M</span>
              <span>2.5M</span>
              <span>2M</span>
              <span>1.5M</span>
              <span>1M</span>
              <span>0.5M</span>
              <span>0M</span>
            </div>

            {{-- Chart Area with Gridlines --}}
            <div class="flex-1 relative h-48">
              {{-- Y-axis Title rotated --}}
              <span class="absolute -left-12 top-1/2 -translate-y-1/2 -rotate-90 text-[8px] uppercase tracking-wider text-neutral-400 font-semibold pointer-events-none">
                AVERAGE PRICE IN AED
              </span>

              {{-- Horizontal Grid Lines --}}
              <svg viewBox="0 0 340 180" class="w-full h-full overflow-visible" preserveAspectRatio="none">
                <line x1="0" y1="10" x2="340" y2="10" stroke="#E5E7EB" stroke-width="0.8" />
                <line x1="0" y1="38" x2="340" y2="38" stroke="#E5E7EB" stroke-width="0.8" />
                <line x1="0" y1="66" x2="340" y2="66" stroke="#E5E7EB" stroke-width="0.8" />
                <line x1="0" y1="94" x2="340" y2="94" stroke="#E5E7EB" stroke-width="0.8" />
                <line x1="0" y1="122" x2="340" y2="122" stroke="#E5E7EB" stroke-width="0.8" />
                <line x1="0" y1="150" x2="340" y2="150" stroke="#E5E7EB" stroke-width="0.8" />
                <line x1="0" y1="178" x2="340" y2="178" stroke="#E5E7EB" stroke-width="0.8" />

                {{-- Trend Line --}}
                <polyline 
                  points="15,49 75,44 140,40 205,35 270,32 325,35" 
                  fill="none" 
                  stroke="#1B382B" 
                  stroke-width="2.5" 
                  stroke-linecap="round" 
                  stroke-linejoin="round"
                />

                {{-- Data Point Dots --}}
                <circle cx="15" cy="49" r="3.5" fill="#1B382B" />
                <circle cx="75" cy="44" r="3.5" fill="#1B382B" />
                <circle cx="140" cy="40" r="3.5" fill="#1B382B" />
                <circle cx="205" cy="35" r="3.5" fill="#1B382B" />
                <circle cx="270" cy="32" r="3.5" fill="#1B382B" />
                <circle cx="325" cy="35" r="3.5" fill="#1B382B" />
              </svg>
            </div>
          </div>

          {{-- X-Axis Labels --}}
          <div class="flex justify-between text-[10px] text-neutral-400 font-inter pl-10 pr-2 pt-2 select-none">
            <span class="-rotate-30 sm:rotate-0">June</span>
            <span class="-rotate-30 sm:rotate-0">July</span>
            <span class="-rotate-30 sm:rotate-0">August</span>
            <span class="-rotate-30 sm:rotate-0">September</span>
            <span class="-rotate-30 sm:rotate-0">October</span>
            <span class="-rotate-30 sm:rotate-0">November</span>
          </div>
        </div>
      </div>

      {{-- Right Card: Unit Volume --}}
      <div class="flex-1 bg-[#FAF9F5] border border-[#EBE8E0] rounded-[20px] p-5 sm:p-6 shadow-2xs flex flex-col justify-between">
        {{-- Header Pill --}}
        <div class="bg-white rounded-full py-2.5 px-6 shadow-xs border border-neutral-100 text-center mb-6">
          <span class="font-heading font-medium text-lg text-[#10221C]">Unit Volume</span>
        </div>

        {{-- Bar Chart SVG --}}
        <div class="relative w-full">
          <div class="flex">
            {{-- Y-Axis Labels --}}
            <div class="flex flex-col justify-between text-[10px] text-neutral-400 font-inter text-right pr-2 select-none h-48 py-1">
              <span>14</span>
              <span>12</span>
              <span>10</span>
              <span>8</span>
              <span>6</span>
              <span>4</span>
              <span>2</span>
              <span>0</span>
            </div>

            {{-- Chart Area with Gridlines --}}
            <div class="flex-1 relative h-48">
              {{-- Y-axis Title rotated --}}
              <span class="absolute -left-12 top-1/2 -translate-y-1/2 -rotate-90 text-[8px] uppercase tracking-wider text-neutral-400 font-semibold pointer-events-none">
                NO. OF PROPERTIES SOLD
              </span>

              {{-- Horizontal Grid Lines --}}
              <svg viewBox="0 0 340 180" class="w-full h-full overflow-visible" preserveAspectRatio="none">
                <line x1="0" y1="10" x2="340" y2="10" stroke="#E5E7EB" stroke-width="0.8" />
                <line x1="0" y1="38" x2="340" y2="38" stroke="#E5E7EB" stroke-width="0.8" />
                <line x1="0" y1="66" x2="340" y2="66" stroke="#E5E7EB" stroke-width="0.8" />
                <line x1="0" y1="94" x2="340" y2="94" stroke="#E5E7EB" stroke-width="0.8" />
                <line x1="0" y1="122" x2="340" y2="122" stroke="#E5E7EB" stroke-width="0.8" />
                <line x1="0" y1="150" x2="340" y2="150" stroke="#E5E7EB" stroke-width="0.8" />
                <line x1="0" y1="178" x2="340" y2="178" stroke="#E5E7EB" stroke-width="0.8" />

                {{-- Bars --}}
                <rect x="18" y="70" width="26" height="108" fill="#1E3E31" rx="2" />
                <rect x="74" y="118" width="26" height="60" fill="#1E3E31" rx="2" />
                <rect x="130" y="58" width="26" height="120" fill="#1E3E31" rx="2" />
                <rect x="186" y="106" width="26" height="72" fill="#1E3E31" rx="2" />
                <rect x="242" y="34" width="26" height="144" fill="#C5A47E" rx="2" />
                <rect x="298" y="154" width="26" height="24" fill="#1E3E31" rx="2" />
              </svg>
            </div>
          </div>

          {{-- X-Axis Labels --}}
          <div class="flex justify-between text-[10px] text-neutral-400 font-inter pl-8 pr-1 pt-2 select-none">
            <span class="-rotate-30 sm:rotate-0">June</span>
            <span class="-rotate-30 sm:rotate-0">July</span>
            <span class="-rotate-30 sm:rotate-0">August</span>
            <span class="-rotate-30 sm:rotate-0">September</span>
            <span class="-rotate-30 sm:rotate-0">October</span>
            <span class="-rotate-30 sm:rotate-0">November</span>
          </div>
        </div>
      </div>

    </div>

    {{-- 3 Summary Metric Cards Below Charts --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6 font-inter">
      <div class="bg-white border border-[#EBECEB] rounded-[16px] p-5 shadow-2xs">
        <span class="font-heading font-medium text-2xl text-[#10221C] block">
          +10%
        </span>
        <span class="text-xs text-neutral-500 mt-1 block">
          Average price, June to November
        </span>
      </div>

      <div class="bg-white border border-[#EBECEB] rounded-[16px] p-5 shadow-2xs">
        <span class="font-heading font-medium text-2xl text-[#10221C] block">
          AED 2.6M
        </span>
        <span class="text-xs text-neutral-500 mt-1 block">
          Peak average price (October)
        </span>
      </div>

      <div class="bg-white border border-[#EBECEB] rounded-[16px] p-5 shadow-2xs">
        <span class="font-heading font-medium text-2xl text-[#10221C] block">
          44
        </span>
        <span class="text-xs text-neutral-500 mt-1 block">
          Properties sold across six months
        </span>
      </div>
    </div>

    <p class="text-[11px] text-neutral-400 font-inter mt-4">
      Figures are read approximately from the source chart and are for illustration. Replace with your verified transaction data.
    </p>
  </div>

  {{-- 4. Mortgage Calculator Section: "How much can I borrow?" --}}
  <div class="border-t border-neutral-200 pt-12 mt-12 font-inter" x-data="{
    purchasePrice: 24750000,
    residency: 'uae_resident',
    downPaymentPercent: 30,
    loanPeriodYears: 25,
    interestRatePercent: 3.75,
    name: '',
    email: '',
    phone: '',

    get downPaymentAmount() {
      return Math.round(this.purchasePrice * (this.downPaymentPercent / 100));
    },
    get loanAmount() {
      return this.purchasePrice - this.downPaymentAmount;
    },
    get loanAmountPercent() {
      return 100 - this.downPaymentPercent;
    },
    get monthlyPayment() {
      let principal = this.loanAmount;
      let monthlyRate = (this.interestRatePercent / 100) / 12;
      let numberOfPayments = this.loanPeriodYears * 12;
      if (monthlyRate === 0) return Math.round(principal / numberOfPayments);
      let pmt = (principal * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) / (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
      return Math.round(pmt);
    },
    formatNumber(num) {
      return Number(num).toLocaleString('en-US');
    }
  }">
    
    {{-- Header --}}
    <h3 class="font-heading font-medium text-2xl sm:text-[32px] text-[#0E3B2C] leading-snug">
      How much can I borrow?
    </h3>
    <p class="text-sm sm:text-base text-neutral-500 font-inter mt-1.5 mb-8">
      Estimate whether you can get a mortgage to buy this property.
    </p>

    {{-- Main Calculator Two-Column Box --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
      
      {{-- Left Side: Calculator Sliders & Monthly Output (8 cols) --}}
      <div class="lg:col-span-7 xl:col-span-8 bg-white border border-[#E5E7EB] rounded-[20px] p-6 sm:p-8 shadow-xs space-y-6">
        
        <h4 class="font-heading font-semibold text-xl sm:text-2xl text-[#0E3B2C]">
          Get the right mortgage for you
        </h4>

        {{-- Row 1: Purchase Price, Residency status, Down Payment --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
          
          {{-- Purchase Price --}}
          <div>
            <label class="block text-xs font-medium text-neutral-700 mb-1.5">Purchase price</label>
            <div class="border border-[#E5E7EB] rounded-[8px] px-3.5 py-2.5 flex items-center justify-between bg-white focus-within:border-[#0E3B2C]">
              <input type="text" :value="formatNumber(purchasePrice)" @input="purchasePrice = Math.max(300000, Number($event.target.value.replace(/,/g, '')) || 0)" class="w-full text-xs font-semibold text-neutral-800 focus:outline-none">
            </div>
            <div class="flex justify-between text-[10px] text-neutral-400 mt-1">
              <span>300,000 AED</span>
              <span>200,000,000 AED</span>
            </div>
          </div>

          {{-- Residency status --}}
          <div>
            <label class="block text-xs font-medium text-neutral-700 mb-1.5">Residency status</label>
            <div class="border border-[#E5E7EB] rounded-[8px] p-0.5 flex bg-neutral-50 text-[11px] font-medium text-neutral-600">
              <button type="button" @click="residency = 'uae_national'" :class="residency === 'uae_national' ? 'bg-white text-neutral-900 shadow-2xs font-semibold' : 'text-neutral-500'" class="flex-1 py-2 text-center rounded-[6px] transition-all">
                UAE national
              </button>
              <button type="button" @click="residency = 'uae_resident'" :class="residency === 'uae_resident' ? 'bg-white text-neutral-900 shadow-2xs font-semibold' : 'text-neutral-500'" class="flex-1 py-2 text-center rounded-[6px] transition-all">
                UAE resident
              </button>
              <button type="button" @click="residency = 'non_resident'" :class="residency === 'non_resident' ? 'bg-white text-neutral-900 shadow-2xs font-semibold' : 'text-neutral-500'" class="flex-1 py-2 text-center rounded-[6px] transition-all">
                Non-resident
              </button>
            </div>
          </div>

          {{-- Down payment --}}
          <div>
            <label class="block text-xs font-medium text-neutral-700 mb-1.5">Down payment</label>
            <div class="border border-[#E5E7EB] rounded-[8px] px-3 py-2 flex items-center justify-between bg-white">
              <span class="text-xs font-semibold text-neutral-800" x-text="formatNumber(downPaymentAmount)"></span>
              <span class="text-xs font-bold text-neutral-700" x-text="downPaymentPercent + '%'"></span>
            </div>
            <input type="range" min="20" max="80" step="1" x-model.number="downPaymentPercent" class="w-full mt-2 accent-[#0E3B2C] h-1 bg-neutral-200 rounded-lg cursor-pointer">
            <div class="flex justify-between text-[10px] text-neutral-400 mt-0.5">
              <span x-text="formatNumber(Math.round(purchasePrice * 0.2)) + ' AED'"></span>
              <span x-text="formatNumber(Math.round(purchasePrice * 0.8)) + ' AED'"></span>
            </div>
          </div>

        </div>

        {{-- Row 2: Loan amount, Loan period, Interest rate --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 pt-2">
          
          {{-- Loan amount --}}
          <div>
            <label class="block text-xs font-medium text-neutral-700 mb-1.5">Loan amount</label>
            <div class="border border-[#E5E7EB] rounded-[8px] px-3 py-2 flex items-center justify-between bg-neutral-50">
              <span class="text-xs font-semibold text-neutral-800" x-text="formatNumber(loanAmount)"></span>
              <span class="text-xs font-bold text-neutral-700" x-text="loanAmountPercent + '%'"></span>
            </div>
            <input type="range" min="20" max="80" step="1" :value="loanAmountPercent" @input="downPaymentPercent = 100 - Number($event.target.value)" class="w-full mt-2 accent-[#0E3B2C] h-1 bg-neutral-200 rounded-lg cursor-pointer">
            <div class="flex justify-between text-[10px] text-neutral-400 mt-0.5">
              <span x-text="formatNumber(Math.round(purchasePrice * 0.2)) + ' AED'"></span>
              <span x-text="formatNumber(Math.round(purchasePrice * 0.8)) + ' AED'"></span>
            </div>
          </div>

          {{-- Loan period --}}
          <div>
            <label class="block text-xs font-medium text-neutral-700 mb-1.5">Loan period</label>
            <div class="border border-[#E5E7EB] rounded-[8px] px-3.5 py-2 flex items-center justify-between bg-white">
              <span class="text-xs font-semibold text-neutral-800" x-text="loanPeriodYears"></span>
            </div>
            <input type="range" min="1" max="25" step="1" x-model.number="loanPeriodYears" class="w-full mt-2 accent-[#0E3B2C] h-1 bg-neutral-200 rounded-lg cursor-pointer">
            <div class="flex justify-between text-[10px] text-neutral-400 mt-0.5">
              <span>1 year</span>
              <span>25 years</span>
            </div>
          </div>

          {{-- Interest rate --}}
          <div>
            <label class="block text-xs font-medium text-neutral-700 mb-1.5">Interest rate</label>
            <div class="border border-[#E5E7EB] rounded-[8px] px-3.5 py-2 flex items-center justify-between bg-white">
              <span class="text-xs font-semibold text-neutral-800" x-text="interestRatePercent"></span>
              <span class="text-xs text-neutral-500 font-semibold">%</span>
            </div>
            <input type="range" min="1" max="15" step="0.05" x-model.number="interestRatePercent" class="w-full mt-2 accent-[#0E3B2C] h-1 bg-neutral-200 rounded-lg cursor-pointer">
            <div class="flex justify-between text-[10px] text-neutral-400 mt-0.5">
              <span>1%</span>
              <span>15%</span>
            </div>
          </div>

        </div>

        {{-- Bottom Result Card: Estimate your monthly mortgage payment --}}
        <div class="border-t border-neutral-100 pt-6">
          <h5 class="font-heading font-medium text-lg text-[#10221C] mb-2">
            Estimate your monthly mortgage payment
          </h5>
          
          <div class="flex items-baseline justify-between text-xs text-neutral-500 font-inter mb-1">
            <span>monthly payment</span>
            <span>with interest rate of</span>
          </div>

          <div class="flex items-baseline justify-between mb-5">
            <span class="font-heading font-bold text-2xl sm:text-3xl text-[#10221C]">
              <span x-text="formatNumber(monthlyPayment)"></span> AED
            </span>
            <span class="font-inter font-semibold text-base sm:text-lg text-[#10221C]" x-text="interestRatePercent + '%'">
            </span>
          </div>

          <button type="button" class="w-full sm:w-auto border border-[#0E3B2C] text-[#0E3B2C] hover:bg-[#0E3B2C] hover:text-white transition-colors text-xs font-semibold py-2.5 px-6 rounded-[6px] text-center cursor-pointer">
            View upfront costs
          </button>
        </div>

      </div>

      {{-- Right Side: Consultation Lead Form (5 cols) matching Screenshot --}}
      <div class="lg:col-span-5 xl:col-span-4 bg-white border border-[#E5E7EB] rounded-[20px] p-6 sm:p-8 shadow-xs">
        
        <h4 class="font-heading font-medium text-2xl text-[#10221C] text-center mb-1">
          Get a free consultation
        </h4>
        <p class="text-xs text-neutral-400 font-inter text-center mb-6">
          Our Mortgage Advisors will be more than happy to help!
        </p>

        <form class="space-y-4 font-inter" @submit.prevent="alert('Thank you! Our mortgage advisor will contact you shortly.')">
          {{-- Name Input --}}
          <div>
            <input type="text" x-model="name" placeholder="Enter your name" required class="w-full border border-[#E5E7EB] rounded-[10px] px-4 py-3 text-xs sm:text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#0E3B2C] transition-colors">
          </div>

          {{-- Email Input --}}
          <div>
            <input type="email" x-model="email" placeholder="Enter your email address" required class="w-full border border-[#E5E7EB] rounded-[10px] px-4 py-3 text-xs sm:text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#0E3B2C] transition-colors">
          </div>

          {{-- Phone Input with UAE Flag --}}
          <div class="border border-[#E5E7EB] rounded-[10px] px-3.5 py-2.5 flex items-center gap-2.5 focus-within:border-[#0E3B2C] transition-colors">
            <span class="inline-flex items-center gap-1.5 shrink-0 text-xs text-neutral-600 font-medium border-r border-neutral-200 pr-2.5">
              <span>🇦🇪</span>
              <span>+971</span>
            </span>
            <input type="tel" x-model="phone" placeholder="50 123 4567" required class="w-full text-xs sm:text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none">
          </div>

          {{-- Submit Action Button --}}
          <button type="submit" class="w-full mt-2 bg-[#0E3B2C] hover:bg-[#154a38] text-white font-inter font-semibold text-xs sm:text-sm py-3.5 rounded-[10px] transition-colors shadow-xs cursor-pointer">
            Talk to an Expert — Free
          </button>
        </form>

      </div>

    </div>

  </div>

  {{-- 5. Similar Project Section (4 Cards matching Reference Design) --}}
  @php
    $similarHeading = !empty($c['similar_heading']) ? $c['similar_heading'] : 'Similar Project';
    $selectedSimSlugs = !empty($c['assigned_similar_projects']) && is_array($c['assigned_similar_projects'])
      ? $c['assigned_similar_projects']
      : [
          'golf-fields-by-emaar',
          'terra-heights-by-emaar',
          'greenville-2-at-emaar-south',
          'golf-edge-at-emaar-south',
        ];

    $simDefaultImages = [
      'images/similar-golf-fields.png',
      'images/similar-terra-heights.png',
      'images/similar-greenville-2.png',
      'images/similar-golf-edge.png',
    ];

    $allSimOffplan = \App\Http\Controllers\Admin\EntityController::getAvailableOffplanProjects();
    $allSimReady = \App\Http\Controllers\Admin\EntityController::getAvailableReadyProjects();

    $simLookup = [];
    foreach ($allSimOffplan as $op) {
      $simLookup[$op['slug']] = [
        'slug' => $op['slug'],
        'name' => $op['name'],
        'location' => strtoupper($op['location'] ?? 'EMAAR SOUTH, DUBAI'),
        'price' => $op['price'] ?? 'AED 100,000',
        'badge' => $op['badge'] ?? 'OFF-PLAN',
        'image' => $op['image'] ?? '',
        'url' => $op['url'] ?? '/projects/golf-vale-emaar-south',
      ];
    }
    foreach ($allSimReady as $rp) {
      if (!isset($simLookup[$rp['slug']])) {
        $simLookup[$rp['slug']] = [
          'slug' => $rp['slug'],
          'name' => $rp['name'],
          'location' => strtoupper($rp['location'] ?? 'EMAAR SOUTH, DUBAI'),
          'price' => $rp['price'] ?? 'AED 100,000',
          'badge' => $rp['tag'] ?? 'READY',
          'image' => $rp['image'] ?? '',
          'url' => $rp['url'] ?? '/listing/the-valley-prime-location',
        ];
      }
    }

    $similarCards = [];
    foreach ($selectedSimSlugs as $idx => $sSlug) {
      if (isset($simLookup[$sSlug])) {
        $cardItem = $simLookup[$sSlug];
        if (empty($cardItem['image']) || !str_contains($cardItem['image'], 'similar-')) {
          $cardItem['image'] = $simDefaultImages[$idx % count($simDefaultImages)];
        }
        $similarCards[] = $cardItem;
      }
    }
  @endphp

  @if(count($similarCards) > 0)
  <div class="border-t border-neutral-200 pt-14 mt-14 font-inter">
    <h3 class="font-heading font-bold text-2xl sm:text-[32px] text-[#0E3B2C] mb-8">
      {{ $similarHeading }}
    </h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
      @foreach($similarCards as $sIdx => $sim)
      <div class="relative rounded-[18px] overflow-hidden aspect-[3/4.2] group shadow-sm bg-neutral-900 flex flex-col justify-between p-4">
        {{-- Card Background Image --}}
        <img 
          src="{{ asset($sim['image']) }}" 
          alt="{{ $sim['name'] }}" 
          class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
        >

        {{-- Dark Gradient Overlay at Bottom --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1F17]/95 via-[#0B1F17]/40 to-transparent pointer-events-none"></div>

        {{-- Top Row: Badge + Heart Favorite Button --}}
        <div class="relative z-10 flex items-center justify-between">
          <span class="bg-white text-[#10221C] text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full shadow-xs">
            {{ $sim['badge'] }}
          </span>
          <button type="button" aria-label="Save project" class="w-7 h-7 rounded-full bg-white text-neutral-700 hover:text-rose-500 flex items-center justify-center shadow-xs transition-colors cursor-pointer">
            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
          </button>
        </div>

        {{-- Bottom Content: Location, Title, Price & Call/WhatsApp Buttons --}}
        <div class="relative z-10 text-white space-y-3 pt-12">
          <div>
            <p class="text-[10px] uppercase tracking-wider text-white/80 font-medium">
              {{ $sim['location'] }}
            </p>
            <h4 class="font-inter font-bold text-base sm:text-[17px] text-white leading-snug mt-0.5 line-clamp-2">
              <a href="{{ $sim['url'] }}" class="hover:underline">{{ $sim['name'] }}</a>
            </h4>
          </div>

          <div>
            <p class="text-[10px] text-white/75">Starting From</p>
            <p class="font-inter font-bold text-base sm:text-lg text-white leading-tight">
              {{ $sim['price'] }}
            </p>
          </div>

          <div class="grid grid-cols-2 gap-2.5 pt-1">
            <a 
              href="tel:+971500000000" 
              class="bg-white hover:bg-neutral-100 text-[#10221C] text-xs font-semibold py-2.5 rounded-[8px] flex items-center justify-center transition-colors shadow-xs"
            >
              Call
            </a>
            <a 
              href="https://wa.me/971500000000" 
              target="_blank" 
              aria-label="WhatsApp" 
              class="bg-[#56B847] hover:bg-[#49a33b] text-white py-2.5 rounded-[8px] flex items-center justify-center transition-colors shadow-xs"
            >
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.586 1.761.882 2.791.882h.001c3.181 0 5.767-2.587 5.768-5.766.001-3.181-2.585-5.768-5.769-5.768zm7.545 5.766c-.002 4.153-3.38 7.531-7.536 7.531-1.309 0-2.548-.342-3.649-.997l-4.041 1.06 1.079-3.933c-.73-1.157-1.114-2.502-1.115-3.661.002-4.153 3.38-7.531 7.536-7.531 4.154 0 7.528 3.377 7.526 7.531z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endif

</div>
