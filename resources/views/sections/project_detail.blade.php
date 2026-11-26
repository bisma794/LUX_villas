{{-- Project Detail Section: About this development + Expert Advice Form + Additional Project Info --}}
@php
  $proj = $project ?? (\App\Http\Controllers\Admin\EntityController::getOffplanProjectData('golf-vale-emaar-south'));
  $aboutEyebrow = array_key_exists('about_eyebrow', $proj) ? $proj['about_eyebrow'] : '1, 2 and 3-bedroom apartments';
  $aboutHeading = array_key_exists('about_heading', $proj) ? $proj['about_heading'] : 'About this development';
  $aboutDescription = array_key_exists('about_description', $proj) ? $proj['about_description'] : '<p><strong>Golf Vale by Emaar</strong> is a residential development in Emaar South, offering 1, 2 and 3-bedroom apartments alongside a limited collection of 3-bedroom townhouses. Set within the green surroundings of the community\'s championship golf course, the development combines contemporary architecture with open fairway views and landscaped outdoor spaces.</p><p>The development comprises 262 residences, including 117 one-bedroom apartments, 117 two-bedroom apartments, 22 three-bedroom apartments and six three-bedroom townhouses. Homes range from 672 sq ft to 2,816 sq ft, giving buyers a choice from compact one-bedroom layouts through to larger family homes.</p><p>Inside, Golf Vale takes a clean and understated approach. Warm wood, textured stone, metal and glass are paired with minimalist architecture and open layouts, creating bright living spaces with a strong connection to the surrounding greenery. Large windows bring natural light into the homes and frame views across the golf course.</p><p>Residents have access to an infinity-edge swimming pool, kids\' pool, indoor and outdoor gyms, indoor and outdoor yoga areas, padel court, BBQ area and kids\' play area. The wider Emaar South community is centred around an 18-hole championship golf course and includes retail, education, healthcare, hotels and recreational facilities.</p><p>Golf Vale is located in Emaar South, approximately 5 minutes from Al Maktoum International Airport, 10 minutes from Expo City Dubai, 30 minutes from Dubai Marina, 35 minutes from Downtown Dubai and Burj Khalifa, and 45 minutes from Dubai International Airport.</p>';

  $showExpertForm = isset($proj['show_form']) ? (bool)$proj['show_form'] : true;
  $formTitle = array_key_exists('form_title', $proj) ? $proj['form_title'] : ('Get expert advice about ' . ($proj['name'] ?? 'Golf Vale Emaar South'));
  $formSubtitle = array_key_exists('form_subtitle', $proj) ? $proj['form_subtitle'] : ('Connect with our experts to learn more about ' . ($proj['name'] ?? 'Golf Vale Emaar South') . '.');
@endphp
<section class="max-w-[1280px] mx-auto px-6 py-12 font-inter">
  
  {{-- 2-Column Layout: Left (About this development) + Right (Get Expert Advice Form) --}}
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
    
    {{-- Left Column: About this development (Span 8) --}}
    <div class="{{ $showExpertForm ? 'lg:col-span-8' : 'lg:col-span-12' }}">
      
      {{-- Eyebrow --}}
      <p class="font-inter font-normal text-sm sm:text-base text-neutral-800 tracking-tight mb-2">
        {{ $aboutEyebrow }}
      </p>

      {{-- Heading --}}
      <h2 class="font-heading font-semibold text-3xl sm:text-4xl md:text-[42px] text-[#10221C] tracking-tight leading-tight mb-6">
        {{ $aboutHeading }}
      </h2>

      {{-- Description Paragraphs (Summernote HTML) --}}
      <div class="space-y-5 text-sm sm:text-[15px] text-neutral-700 leading-relaxed font-inter [&_p]:mb-4">
        {!! $aboutDescription !!}
      </div>

    </div>

    {{-- Right Column: Expert Consultation Form Card (Span 4) --}}
    @if($showExpertForm)
    <aside class="lg:col-span-4 sticky top-6">
      
      {{-- Outer Card --}}
      <div class="bg-white border border-[#E5E7EB] rounded-[20px] p-6 sm:p-7 shadow-sm">
        
        {{-- Card Header --}}
        <div>
          <h3 class="font-inter font-semibold text-lg sm:text-[19px] text-[#10221C] leading-snug">
            {{ $formTitle }}
          </h3>
          <p class="font-inter font-normal text-xs text-neutral-500 mt-1.5 leading-normal">
            {{ $formSubtitle }}
          </p>
        </div>

        {{-- Inner Form Box: border rounded-[16px] --}}
        <div class="border border-[#E5E7EB] rounded-[16px] p-5 mt-5 bg-white">
          <h4 class="font-inter font-semibold text-sm sm:text-[15px] text-[#10221C] leading-snug">
            Talk to our off-plan expert
          </h4>
          <p class="font-inter font-normal text-[11px] sm:text-xs text-neutral-400 mt-1 leading-tight">
            Specialist guidance on layouts, value, and payment plans.
          </p>

          {{-- Contact Form --}}
          <form action="/enquiry" method="POST" class="mt-4 space-y-3">
            @csrf
            <input type="hidden" name="project" value="Golf Vale Emaar South">

            {{-- Name Input --}}
            <div>
              <input 
                type="text" 
                name="name" 
                placeholder="Name" 
                required
                class="w-full border border-[#E5E7EB] rounded-[8px] px-3.5 py-2.5 text-xs text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#C5A47E] transition-colors"
              >
            </div>

            {{-- Email Input --}}
            <div>
              <input 
                type="email" 
                name="email" 
                placeholder="Email address" 
                required
                class="w-full border border-[#E5E7EB] rounded-[8px] px-3.5 py-2.5 text-xs text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#C5A47E] transition-colors"
              >
            </div>

            {{-- Phone Number Input with UAE Flag prefix --}}
            <div class="flex items-center border border-[#E5E7EB] rounded-[8px] overflow-hidden focus-within:border-[#C5A47E] transition-colors">
              <div class="flex items-center gap-1.5 px-3 py-2.5 bg-neutral-50 border-r border-[#E5E7EB] text-xs font-medium text-neutral-700 shrink-0 select-none">
                {{-- UAE Flag SVG --}}
                <svg class="w-4 h-3 rounded-[1px] overflow-hidden" viewBox="0 0 640 480">
                  <path fill="#00732f" d="M0 0h640v160H0z"/>
                  <path fill="#fff" d="M0 160h640v160H0z"/>
                  <path fill="#000" d="M0 320h640v160H0z"/>
                  <path fill="red" d="M0 0h160v480H0z"/>
                </svg>
                <span>+971</span>
                <span class="text-neutral-400">·</span>
              </div>
              <input 
                type="tel" 
                name="phone" 
                placeholder="Your contact number" 
                required
                class="w-full px-3 py-2.5 text-xs text-neutral-800 placeholder-neutral-400 focus:outline-none"
              >
            </div>

            {{-- Register Now Button: Tan / Golden bg-[#C5A47E] --}}
            <button 
              type="submit" 
              class="w-full mt-1 bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-[13px] font-semibold py-3 px-4 rounded-[8px] transition-colors shadow-sm cursor-pointer text-center"
            >
              Register now
            </button>
          </form>
        </div>

        {{-- Lower Info Box: Why choose our experts? --}}
        <div class="bg-[#F8F9FA] rounded-[14px] p-4.5 mt-5">
          <h5 class="font-inter font-semibold text-xs text-neutral-800 mb-2.5">
            Why choose our experts?
          </h5>
          <ul class="space-y-1.5 font-inter text-[11px] sm:text-xs text-neutral-500 leading-normal">
            <li class="flex items-center gap-2">
              <span class="w-1 h-1 rounded-full bg-neutral-400"></span>
              <span>Off-plan property specialists</span>
            </li>
            <li class="flex items-center gap-2">
              <span class="w-1 h-1 rounded-full bg-neutral-400"></span>
              <span>Market insights &amp; analysis</span>
            </li>
            <li class="flex items-center gap-2">
              <span class="w-1 h-1 rounded-full bg-neutral-400"></span>
              <span>Free consultation</span>
            </li>
            <li class="flex items-center gap-2">
              <span class="w-1 h-1 rounded-full bg-neutral-400"></span>
              <span>Investment guidance</span>
            </li>
          </ul>
        </div>

      </div>

    </aside>
    @endif

  </div>

  {{-- Next Section: Property types (Left, Span 8) & Similar Project (Right, Span 4) --}}
  {{-- Property Types & Similar Projects Grid --}}
  <div class="mt-16 pt-10 border-t border-neutral-200">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
      
      {{-- Left Column: Property types (Span 8) --}}
      <div class="lg:col-span-8">
        <h2 class="font-heading font-semibold text-3xl sm:text-4xl text-[#10221C] tracking-tight leading-tight mb-7">
          {{ $proj['property_types_heading'] ?? 'Property types' }}
        </h2>

        {{-- Property Type Cards --}}
        <div class="space-y-4">
          @php
            $propertyRows = (isset($proj['property_types']) && is_array($proj['property_types']))
              ? $proj['property_types']
              : [
                  ['title' => '4 Bedroom Townhouse', 'type' => 'Townhouse', 'beds' => '4 Bedroom', 'size' => '2,789 sq ft', 'price' => 'AED 5,060,000'],
                ];
          @endphp

          @foreach($propertyRows as $row)
          <div class="bg-[#F8F9FA]/60 border border-[#E5E7EB] hover:border-[#C5A47E] rounded-[18px] p-5 sm:p-6 transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-2">
              <h3 class="font-inter font-bold text-base sm:text-lg text-[#10221C]">
                {{ $row['title'] ?? '' }}
              </h3>
              
              <div class="flex items-center flex-wrap gap-x-3 gap-y-1 font-inter text-xs sm:text-[13px] text-neutral-500">
                <span>{{ $row['type'] ?? '' }}</span>
                <span class="text-neutral-300">|</span>
                <span>{{ $row['beds'] ?? '' }}</span>
                <span class="text-neutral-300">|</span>
                <span>{{ $row['size'] ?? '' }}</span>
                <span class="text-neutral-300">|</span>
                <span class="text-neutral-600 font-medium">{{ $row['price'] ?? '' }}</span>
                <span class="text-neutral-300">|</span>
                <button type="button" class="text-neutral-500 hover:text-[#C5A47E] hover:underline transition-colors cursor-pointer">
                  View Floorplan
                </button>
              </div>
            </div>

            <div class="shrink-0">
              <a 
                href="/enquiry" 
                class="inline-flex items-center justify-center px-6 sm:px-7 py-2.5 rounded-[10px] bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-[13px] font-medium transition-all shadow-sm"
              >
                Enquire Now
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      {{-- Right Column: Similar Project (Span 4) --}}
      <aside class="lg:col-span-4">
        <h2 class="font-heading font-semibold text-2xl sm:text-[28px] text-[#10221C] tracking-tight leading-tight mb-7">
          {{ $proj['similar_heading'] ?? 'Similar Project' }}
        </h2>

        {{-- Horizontal Cards Stack (Dynamic from CMS Drag & Drop Column S) --}}
        <div class="space-y-4">
          @php
            $assignedSimSlugs = !empty($proj['assigned_similar_projects']) && is_array($proj['assigned_similar_projects'])
              ? $proj['assigned_similar_projects']
              : ['the-fairway-villa', 'maple-row-villa', 'nara-townhouse', 'the-oasis-by-emaar'];

            $allSimOffplan = \App\Http\Controllers\Admin\EntityController::getAvailableOffplanProjects();
            $allSimReady = \App\Http\Controllers\Admin\EntityController::getAvailableReadyProjects();

            $simMap = [];
            foreach ($allSimOffplan as $op) {
              $simMap[$op['slug']] = [
                'image' => $op['image'] ?? 'images/listing-pool-villa.jpg',
                'price' => $op['price'] ?? 'AED 4,000,000',
                'title' => $op['specs'] ?? 'Villa · 4B · Built-up: 1,991 sqft',
                'subtitle' => $op['name'],
                'location' => $op['location'] ?? 'Dubai',
                'handover' => 'Q4 2026',
                'payment' => '20/70',
              ];
            }
            foreach ($allSimReady as $rp) {
              if (!isset($simMap[$rp['slug']])) {
                $simMap[$rp['slug']] = [
                  'image' => $rp['image'] ?? 'images/listing-modern-villa.jpg',
                  'price' => $rp['price'] ?? 'AED 4,000,000',
                  'title' => $rp['specs'] ?? 'Villa · 4B · Built-up: 1,991 sqft',
                  'subtitle' => $rp['name'],
                  'location' => $rp['location'] ?? 'Dubai',
                  'handover' => 'Ready',
                  'payment' => 'Cash / Mortgage',
                ];
              }
            }

            $similarCards = [];
            foreach ($assignedSimSlugs as $sSlug) {
              if (isset($simMap[$sSlug])) {
                $similarCards[] = $simMap[$sSlug];
              }
            }
          @endphp

          @foreach($similarCards as $card)
          <div class="bg-white border border-[#E5E7EB] rounded-[16px] overflow-hidden p-2.5 sm:p-3 hover:border-[#C5A47E] transition-all shadow-xs flex flex-row gap-3 items-stretch">
            
            {{-- Left Side Image Thumbnail with Badge & Pagination Dots --}}
            <div class="relative w-[130px] sm:w-[145px] shrink-0 rounded-[12px] overflow-hidden bg-neutral-100">
              <img 
                src="{{ asset($card['image']) }}" 
                alt="Similar Villa" 
                class="w-full h-full object-cover min-h-[110px]"
              >
              {{-- Top Right Verified Icon --}}
              <div class="absolute top-1.5 right-1.5 w-4 h-4 rounded-full bg-blue-500 text-white flex items-center justify-center text-[9px] shadow-xs">
                ✓
              </div>
              {{-- Bottom Dots Indicator --}}
              <div class="absolute bottom-1.5 inset-x-0 flex items-center justify-center gap-1">
                <span class="w-1 h-1 rounded-full bg-white"></span>
                <span class="w-1 h-1 rounded-full bg-white/60"></span>
                <span class="w-1 h-1 rounded-full bg-white/60"></span>
                <span class="w-1 h-1 rounded-full bg-white/60"></span>
              </div>
            </div>

            {{-- Right Side Info Details --}}
            <div class="flex-1 flex flex-col justify-between py-0.5 min-w-0">
              <div>
                {{-- Price --}}
                <p class="font-inter font-bold text-xs sm:text-[13px] text-[#10221C]">
                  {{ $card['price'] }}
                </p>
                {{-- Property specs subtitle --}}
                <p class="font-inter text-[10px] sm:text-[11px] text-neutral-500 truncate leading-tight mt-0.5">
                  {{ $card['title'] }}
                </p>
                <p class="font-inter text-[10px] text-neutral-400 truncate leading-tight">
                  {{ $card['subtitle'] }}
                </p>
                <p class="font-inter text-[10px] text-neutral-400 truncate leading-tight">
                  {{ $card['location'] }}
                </p>
              </div>

              {{-- Specs Bar: Handover & Payment Plan --}}
              <div class="mt-1 pt-1 border-t border-neutral-100 flex items-center justify-between text-[9px] text-neutral-500 font-inter">
                <div>
                  <span class="block text-[8px] text-neutral-400 uppercase font-semibold">Handover</span>
                  <span class="font-bold text-neutral-700">{{ $card['handover'] }}</span>
                </div>
                <div>
                  <span class="block text-[8px] text-neutral-400 uppercase font-semibold">Payment Plan</span>
                  <span class="font-bold text-neutral-700">{{ $card['payment'] }}</span>
                </div>
              </div>

              {{-- Action Buttons: Email, Call, WhatsApp --}}
              <div class="flex items-center gap-1.5 mt-1.5">
                <a href="mailto:info@luxvilla.ae" class="flex-1 bg-[#10221C] hover:bg-[#1a382e] text-white py-1 rounded-[5px] text-[10px] text-center font-medium transition-colors">
                  Email
                </a>
                <a href="tel:+971500000000" class="flex-1 bg-[#10221C] hover:bg-[#1a382e] text-white py-1 rounded-[5px] text-[10px] text-center font-medium transition-colors">
                  Call
                </a>
                <a href="https://wa.me/971500000000" target="_blank" class="px-2 bg-[#25D366] hover:bg-[#20ba5a] text-white py-1 rounded-[5px] text-[10px] flex items-center justify-center transition-colors">
                  <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                </a>
              </div>

            </div>

          </div>
          @endforeach
        </div>
      </aside>

    </div>
  </div>

  {{-- Amenities & Facilities Section --}}
  <div class="mt-16 pt-10 border-t border-neutral-200">
    @php
      $allAmenitiesStore = \App\Http\Controllers\Admin\EntityController::getAmenitiesStore();
      $assignedAmenityKeys = !empty($proj['assigned_amenities']) && is_array($proj['assigned_amenities'])
        ? $proj['assigned_amenities']
        : ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'];

      $amenityList = array_values(array_filter($allAmenitiesStore, function ($am) use ($assignedAmenityKeys) {
        return in_array($am['key'], $assignedAmenityKeys);
      }));
    @endphp

    <div class="mb-8">
      <h2 class="font-heading font-medium text-3xl sm:text-4xl text-[#0E3B2C] leading-tight">
        {{ $proj['amenities_heading'] ?? 'Amenities & Facilities' }}
      </h2>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6">
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

  {{-- Map View Section (Driven by Latitude & Longitude from CMS) --}}
  @php
    $locHeading = $proj['location_heading'] ?? 'Map View';
    $locText = $proj['location_text'] ?? 'Fairways Vistas, Dubai Hills Estate, Dubai, UAE';
    $latVal = trim((string) ($proj['latitude'] ?? '24.8962'));
    $lngVal = trim((string) ($proj['longitude'] ?? '55.1614'));
    $mapEmbedUrl = ($latVal !== '' && $lngVal !== '') ? "https://maps.google.com/maps?q={$latVal},{$lngVal}&z=13&output=embed" : '';
  @endphp
  @if($mapEmbedUrl !== '' || $locHeading !== '' || $locText !== '')
  <div class="mt-16 pt-10 border-t border-neutral-200">
    <div class="mb-6">
      <h2 class="font-heading font-medium text-3xl sm:text-4xl text-[#0E3B2C] leading-snug">
        {{ $locHeading }}
      </h2>
      <p class="text-sm sm:text-base text-neutral-400 font-inter mt-1">
        {{ $locText }}
      </p>
    </div>

    @if($mapEmbedUrl !== '')
    <div class="relative w-full rounded-[20px] overflow-hidden border border-[#E5E7EB] shadow-xs bg-[#EBF1F6] h-[380px] sm:h-[460px] md:h-[520px]">
      <iframe 
        src="{{ $mapEmbedUrl }}" 
        class="w-full h-full border-0" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade"
        title="{{ $locText }}"
      ></iframe>
    </div>
    @endif
  </div>
  @endif

  {{-- Payment Plan Section (Dynamic from CMS Payment Plan Tab) --}}
  @php
    $payHeading = $proj['payment_heading'] ?? 'Payment Plan';
    $paySubtitle = $proj['payment_subtitle'] ?? 'For 1 Bedroom · AED 1,250,000';
    $payOptions = $proj['payment_options_label'] ?? '3 Options';
    $p1Pct = (int)($proj['payment_step1_pct'] ?? 20);
    $p1Title = $proj['payment_step1_title'] ?? 'On Booking';
    $p1Sub = $proj['payment_step1_sub'] ?? 'Step 1 · 20% paid';
    $p2Pct = (int)($proj['payment_step2_pct'] ?? 40);
    $p2Title = $proj['payment_step2_title'] ?? 'During Construction';
    $p2Sub = $proj['payment_step2_sub'] ?? 'Step 2 · 60% paid';
    $p3Pct = (int)($proj['payment_step3_pct'] ?? 40);
    $p3Title = $proj['payment_step3_title'] ?? 'On Handover';
    $p3Sub = $proj['payment_step3_sub'] ?? 'Step 3 · 100% paid';
    $payDisclaimer = $proj['payment_disclaimer'] ?? 'Emaar offers a buyer-friendly payment structure designed to make luxury home ownership more accessible. 20% down payment on booking, 40% during construction, 40% payable upon handover. Transparent pricing with no hidden charges. Suitable for both investors and end-users. Professional assistance throughout the purchasing process.';
  @endphp
  <div class="mt-16 pt-10 border-t border-neutral-200" style="font-family: 'Poppins', sans-serif;">
    
    {{-- Top Golden/Tan Header Bar --}}
    <div class="w-full bg-[#C5A47E] text-white rounded-[10px] px-6 py-4.5 sm:px-8 sm:py-5 flex items-center justify-between shadow-xs">
      <div class="flex items-center gap-3.5">
        <div class="w-8 h-8 rounded-[8px] bg-white/20 flex items-center justify-center shrink-0">
          <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <rect x="2" y="5" width="20" height="14" rx="2" stroke-width="2"/>
            <path d="M2 10h20" stroke-width="2"/>
          </svg>
        </div>
        <div>
          <h2 class="text-lg sm:text-[21px] font-semibold tracking-normal text-white leading-tight" style="font-family: 'Poppins', sans-serif;">
            {{ $payHeading }}
          </h2>
          <p class="text-[11px] sm:text-xs text-white/85 font-normal mt-0.5" style="font-family: 'Poppins', sans-serif;">
            {{ $paySubtitle }}
          </p>
        </div>
      </div>

      <div class="text-sm sm:text-base font-medium text-white/95" style="font-family: 'Poppins', sans-serif;">
        {{ $payOptions }}
      </div>
    </div>

    {{-- Segmented Multi-Color Progress Line Bar --}}
    <div class="mt-6 w-full h-2.5 rounded-full overflow-hidden flex items-center bg-[#D1D5DB]">
      <div class="h-full bg-[#C5A47E]" style="width: {{ $p1Pct }}%;"></div>
      <div class="h-full bg-[#0E3B2C]" style="width: {{ $p2Pct }}%;"></div>
      <div class="h-full bg-[#9CA3AF]" style="width: {{ $p3Pct }}%;"></div>
    </div>

    {{-- 3 Payment Steps Timeline --}}
    <div class="mt-8 relative space-y-7 sm:space-y-8 pl-1">
      <div class="absolute left-[19px] sm:left-[21px] top-4 bottom-4 w-[2px] bg-neutral-200 -z-0"></div>

      {{-- Step 1 --}}
      <div class="relative z-10 flex items-center justify-between">
        <div class="flex items-center gap-4 sm:gap-5">
          <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#C5A47E] text-white flex items-center justify-center shrink-0 shadow-xs">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
          </div>
          <div>
            <h4 class="text-sm sm:text-base font-semibold text-[#10221C] leading-snug" style="font-family: 'Poppins', sans-serif;">
              {{ $p1Title }}
            </h4>
            <p class="text-xs text-neutral-400 font-normal mt-0.5" style="font-family: 'Poppins', sans-serif;">
              {{ $p1Sub }}
            </p>
          </div>
        </div>
        <div class="text-base sm:text-lg font-semibold text-[#10221C]" style="font-family: 'Poppins', sans-serif;">
          {{ $p1Pct }}%
        </div>
      </div>

      {{-- Step 2 --}}
      <div class="relative z-10 flex items-center justify-between">
        <div class="flex items-center gap-4 sm:gap-5">
          <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#0E3B2C] text-white flex items-center justify-center shrink-0 shadow-xs">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
          </div>
          <div>
            <h4 class="text-sm sm:text-base font-semibold text-[#10221C] leading-snug" style="font-family: 'Poppins', sans-serif;">
              {{ $p2Title }}
            </h4>
            <p class="text-xs text-neutral-400 font-normal mt-0.5" style="font-family: 'Poppins', sans-serif;">
              {{ $p2Sub }}
            </p>
          </div>
        </div>
        <div class="text-base sm:text-lg font-semibold text-[#10221C]" style="font-family: 'Poppins', sans-serif;">
          {{ $p2Pct }}%
        </div>
      </div>

      {{-- Step 3 --}}
      <div class="relative z-10 flex items-center justify-between">
        <div class="flex items-center gap-4 sm:gap-5">
          <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#9CA3AF] text-white flex items-center justify-center shrink-0 shadow-xs">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
          <div>
            <h4 class="text-sm sm:text-base font-semibold text-[#10221C] leading-snug" style="font-family: 'Poppins', sans-serif;">
              {{ $p3Title }}
            </h4>
            <p class="text-xs text-neutral-400 font-normal mt-0.5" style="font-family: 'Poppins', sans-serif;">
              {{ $p3Sub }}
            </p>
          </div>
        </div>
        <div class="text-base sm:text-lg font-semibold text-[#10221C]" style="font-family: 'Poppins', sans-serif;">
          {{ $p3Pct }}%
        </div>
      </div>

    </div>

    {{-- Disclaimer Note Box --}}
    <div class="mt-10 rounded-[14px] p-5 sm:p-6" style="background-color: #E5E2DC;">
      <p class="text-xs sm:text-[13px] text-neutral-700 leading-relaxed font-normal" style="font-family: 'Poppins', sans-serif;">
        {{ $payDisclaimer }}
      </p>
    </div>

  </div>

  {{-- Mortgage Calculator Section --}}
  <div class="mt-16 pt-10 border-t border-neutral-200" style="font-family: 'Lato', sans-serif;">
    
    {{-- Main Heading: Abhaya Libre SemiBold, Subtitle: Lato --}}
    <div class="mb-8">
      <h2 class="font-heading font-semibold text-3xl sm:text-4xl text-[#0E3B2C] leading-tight">
        Mortgage Calculator
      </h2>
      <p class="text-sm sm:text-base text-neutral-500 font-normal mt-1.5" style="font-family: 'Lato', sans-serif;">
        Estimate your monthly payment in a few seconds.
      </p>
    </div>

    {{-- Calculator Container: 2 Columns (Inputs Left, Results Card Right) --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch" data-mortgage-calc>
      
      {{-- Left Column: Input Form Box (Span 7) --}}
      <div class="lg:col-span-7 bg-white border border-[#E5E7EB] rounded-[20px] p-6 sm:p-8 flex flex-col justify-between shadow-2xs">
        
        <div class="space-y-6">
          {{-- UAE Residency Status Segmented Pill Buttons --}}
          <div>
            <label class="block text-xs sm:text-sm font-bold text-[#10221C] mb-2.5" style="font-family: 'Lato', sans-serif;">
              UAE Residency Status
            </label>
            <div class="grid grid-cols-3 bg-[#F8F9FA] p-1 rounded-[12px] border border-[#E5E7EB]">
              <button 
                type="button" 
                data-residency="National"
                class="py-2.5 rounded-[10px] text-xs font-semibold text-neutral-600 transition-all cursor-pointer hover:text-[#10221C]"
                style="font-family: 'Lato', sans-serif;"
              >
                National
              </button>
              <button 
                type="button" 
                data-residency="Resident"
                class="py-2.5 rounded-[10px] text-xs font-bold text-[#10221C] bg-white shadow-xs transition-all cursor-pointer"
                style="font-family: 'Lato', sans-serif;"
              >
                Resident
              </button>
              <button 
                type="button" 
                data-residency="Non-Resident"
                class="py-2.5 rounded-[10px] text-xs font-semibold text-neutral-600 transition-all cursor-pointer hover:text-[#10221C]"
                style="font-family: 'Lato', sans-serif;"
              >
                Non-Resident
              </button>
            </div>
          </div>

          {{-- Property Price / Type Input --}}
          <div>
            <label class="block text-xs sm:text-sm font-bold text-[#10221C] mb-2" style="font-family: 'Lato', sans-serif;">
              Property Type
            </label>
            <div class="relative flex items-center border border-[#E5E7EB] rounded-[10px] bg-white focus-within:border-[#C5A47E] transition-colors">
              <span class="pl-4 pr-1 text-xs font-semibold text-neutral-800 shrink-0">AED</span>
              <input 
                type="text" 
                id="mc-price"
                value="45,999,999" 
                class="w-full px-2 py-3 text-xs sm:text-sm font-medium text-neutral-800 bg-transparent focus:outline-none"
                style="font-family: 'Lato', sans-serif;"
              >
            </div>
          </div>

          {{-- Down Payment Input & Percentage --}}
          <div>
            <label class="block text-xs sm:text-sm font-bold text-[#10221C] mb-2" style="font-family: 'Lato', sans-serif;">
              Down Payment
            </label>
            <div class="flex items-center border border-[#E5E7EB] rounded-[10px] bg-white overflow-hidden focus-within:border-[#C5A47E] transition-colors">
              <div class="flex-1 flex items-center pl-4">
                <span class="pr-1 text-xs font-semibold text-neutral-800 shrink-0">AED</span>
                <input 
                  type="text" 
                  id="mc-down-amount"
                  value="13,800,000" 
                  class="w-full px-2 py-3 text-xs sm:text-sm font-medium text-neutral-800 bg-transparent focus:outline-none"
                  style="font-family: 'Lato', sans-serif;"
                >
              </div>
              <div class="px-5 py-3 border-l border-[#E5E7EB] text-xs sm:text-sm font-bold text-neutral-800 bg-neutral-50/50 shrink-0">
                <span id="mc-down-pct-label">30</span> %
              </div>
            </div>

            {{-- Slider Bar with custom dark-green handle --}}
            <div class="mt-4 relative flex items-center">
              <input 
                type="range" 
                id="mc-down-slider"
                min="20" 
                max="80" 
                value="30" 
                step="1"
                class="w-full h-2 rounded-lg appearance-none cursor-pointer accent-[#0E3B2C] bg-gradient-to-r from-[#0E3B2C] via-[#0E3B2C] to-[#E5A869]"
              >
            </div>
          </div>

          {{-- Typical minimum for this profile : 30% --}}
          <div>
            <p class="text-xs text-neutral-400 font-normal" style="font-family: 'Lato', sans-serif;">
              Typical minimum for this profile : 30%
            </p>
          </div>

          {{-- Loan Term & Interest rate 2-Column Inputs --}}
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            {{-- Loan Term --}}
            <div>
              <label class="block text-xs font-bold text-neutral-700 mb-1.5" style="font-family: 'Lato', sans-serif;">
                Loan Term
              </label>
              <div class="flex items-center border border-[#E5E7EB] rounded-[10px] bg-white px-3.5 py-2.5 focus-within:border-[#C5A47E] transition-colors">
                <input 
                  type="number" 
                  id="mc-years"
                  value="25" 
                  min="1" 
                  max="30"
                  class="w-full text-xs sm:text-sm font-semibold text-neutral-800 bg-transparent focus:outline-none"
                  style="font-family: 'Lato', sans-serif;"
                >
                <span class="text-xs text-neutral-400 shrink-0 ml-1">Years</span>
              </div>
            </div>

            {{-- Interest rate --}}
            <div>
              <label class="block text-xs font-bold text-neutral-700 mb-1.5" style="font-family: 'Lato', sans-serif;">
                Interest rate
              </label>
              <div class="flex items-center border border-[#E5E7EB] rounded-[10px] bg-white px-3.5 py-2.5 focus-within:border-[#C5A47E] transition-colors">
                <input 
                  type="number" 
                  id="mc-rate"
                  value="3.75" 
                  step="0.05" 
                  min="0.1" 
                  max="15"
                  class="w-full text-xs sm:text-sm font-semibold text-neutral-800 bg-transparent focus:outline-none"
                  style="font-family: 'Lato', sans-serif;"
                >
                <span class="text-xs text-neutral-400 shrink-0 ml-1">%</span>
              </div>
            </div>
          </div>

        </div>

      </div>

      {{-- Right Column: Output Summary Box (Span 5) --}}
      <div class="lg:col-span-5 bg-white border border-[#E5E7EB] rounded-[20px] p-6 sm:p-8 flex flex-col justify-between shadow-2xs">
        
        <div>
          {{-- Estimated monthly payment Heading --}}
          <h3 class="text-base sm:text-lg font-bold text-[#0E3B2C] leading-snug" style="font-family: 'Lato', sans-serif;">
            Estimated monthly payment
          </h3>

          {{-- Main Monthly Payment Output: AED 165,550 --}}
          <div class="mt-4 flex items-baseline gap-2">
            <span class="text-xs sm:text-sm font-bold text-neutral-700">AED</span>
            <span id="mc-monthly-output" class="text-3xl sm:text-[38px] md:text-[42px] font-black text-[#0E3B2C] tracking-tight leading-none">
              165,550
            </span>
          </div>

          {{-- Subtitle: Based on a loan of AED ... --}}
          <p class="text-xs text-neutral-400 font-normal mt-4" style="font-family: 'Lato', sans-serif;">
            Based on a loan of <span class="font-medium text-neutral-600">AED <span id="mc-loan-output">32,199,999</span></span>
          </p>

          {{-- Proportion Bar (Principal dark green, Interest tan/golden) --}}
          <div class="mt-4 w-full h-2 rounded-full overflow-hidden flex bg-neutral-200">
            <div id="mc-bar-principal" class="h-full bg-[#0E3B2C]" style="width: 65%;"></div>
            <div id="mc-bar-interest" class="h-full bg-[#C5A47E]" style="width: 35%;"></div>
          </div>

          {{-- Legend Dots: Principal vs Interest --}}
          <div class="mt-2.5 flex items-center justify-between text-[11px] text-neutral-400 font-medium" style="font-family: 'Lato', sans-serif;">
            <div class="flex items-center gap-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-[#0E3B2C]"></span>
              <span>Principal</span>
            </div>
            <div class="flex items-center gap-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-[#C5A47E]"></span>
              <span>Interest</span>
            </div>
          </div>

          {{-- Principal & Interest AED Totals --}}
          <div class="mt-6 pt-5 border-t border-neutral-100 flex items-center justify-between">
            <div>
              <p class="text-xs sm:text-sm font-bold text-neutral-800" style="font-family: 'Lato', sans-serif;">
                AED <span id="mc-loan-principal">32,199,999</span>
              </p>
            </div>
            <div class="text-right">
              <p class="text-xs sm:text-sm font-bold text-neutral-800" style="font-family: 'Lato', sans-serif;">
                AED <span id="mc-loan-interest">17,465,073</span>
              </p>
            </div>
          </div>

          {{-- Accordion toggle: Monthly payment breakdown + --}}
          <div class="mt-8 pt-4 border-t border-neutral-100 flex items-center justify-between cursor-pointer group">
            <span class="text-xs sm:text-sm font-bold text-neutral-800 group-hover:text-[#0E3B2C] transition-colors" style="font-family: 'Lato', sans-serif;">
              Monthly payment breakdown
            </span>
            <span class="text-sm font-bold text-neutral-500 group-hover:text-[#0E3B2C] transition-colors">+</span>
          </div>
        </div>

        {{-- Bottom CTA Button & Powered by note --}}
        <div class="mt-8 pt-4">
          <a 
            href="/enquiry" 
            class="block w-full text-center py-3.5 px-4 rounded-[12px] bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-bold transition-all shadow-sm"
            style="font-family: 'Lato', sans-serif;"
          >
            Get pre-approved
          </a>
          <p class="text-center text-[11px] text-neutral-400 font-normal mt-3" style="font-family: 'Lato', sans-serif;">
            Powered by <span class="font-semibold text-neutral-600">Lux Dubai</span>
          </p>
        </div>

      </div>

    </div>

  </div>

  {{-- Interactive Mortgage Calculator Script --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const priceInput = document.getElementById('mc-price');
      const downAmountInput = document.getElementById('mc-down-amount');
      const downSlider = document.getElementById('mc-down-slider');
      const downPctLabel = document.getElementById('mc-down-pct-label');
      const yearsInput = document.getElementById('mc-years');
      const rateInput = document.getElementById('mc-rate');
      
      const monthlyOut = document.getElementById('mc-monthly-output');
      const loanOut = document.getElementById('mc-loan-output');
      const loanPrincipal = document.getElementById('mc-loan-principal');
      const loanInterest = document.getElementById('mc-loan-interest');
      const barPrincipal = document.getElementById('mc-bar-principal');
      const barInterest = document.getElementById('mc-bar-interest');

      function parseNum(val) {
        if (!val) return 0;
        return parseFloat(String(val).replace(/,/g, '')) || 0;
      }

      function formatNum(num) {
        return Math.round(num).toLocaleString('en-US');
      }

      function calculate() {
        const price = parseNum(priceInput.value) || 45999999;
        const pct = parseFloat(downSlider.value) || 30;
        const years = parseFloat(yearsInput.value) || 25;
        const rate = (parseFloat(rateInput.value) || 3.75) / 100 / 12;

        const downAmount = (price * pct) / 100;
        const loan = Math.max(0, price - downAmount);
        const months = years * 12;

        let monthly = 0;
        if (rate > 0 && months > 0) {
          monthly = (loan * (rate * Math.pow(1 + rate, months))) / (Math.pow(1 + rate, months) - 1);
        } else if (months > 0) {
          monthly = loan / months;
        }

        const totalPayment = monthly * months;
        const totalInterest = Math.max(0, totalPayment - loan);

        if (downPctLabel) downPctLabel.textContent = pct;
        if (downAmountInput && document.activeElement !== downAmountInput) {
          downAmountInput.value = formatNum(downAmount);
        }
        if (monthlyOut) monthlyOut.textContent = formatNum(monthly);
        if (loanOut) loanOut.textContent = formatNum(loan);
        if (loanPrincipal) loanPrincipal.textContent = formatNum(loan);
        if (loanInterest) loanInterest.textContent = formatNum(totalInterest);

        if (barPrincipal && barInterest && totalPayment > 0) {
          const principalPct = Math.round((loan / totalPayment) * 100);
          const interestPct = 100 - principalPct;
          barPrincipal.style.width = principalPct + '%';
          barInterest.style.width = interestPct + '%';
        }
      }

      if (downSlider) {
        downSlider.addEventListener('input', function() {
          calculate();
        });
      }

      if (priceInput) {
        priceInput.addEventListener('input', function() {
          calculate();
        });
      }

      if (downAmountInput) {
        downAmountInput.addEventListener('input', function() {
          const price = parseNum(priceInput.value) || 45999999;
          const downVal = parseNum(downAmountInput.value) || 0;
          if (price > 0) {
            const calculatedPct = Math.min(80, Math.max(20, Math.round((downVal / price) * 100)));
            downSlider.value = calculatedPct;
            if (downPctLabel) downPctLabel.textContent = calculatedPct;
          }
          calculate();
        });
      }

      if (yearsInput) yearsInput.addEventListener('input', calculate);
      if (rateInput) rateInput.addEventListener('input', calculate);

      // Residency Buttons
      const residencyBtns = document.querySelectorAll('[data-residency]');
      residencyBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          residencyBtns.forEach(b => {
            b.classList.remove('bg-white', 'text-[#10221C]', 'shadow-xs', 'font-bold');
            b.classList.add('text-neutral-600', 'font-semibold');
          });
          btn.classList.add('bg-white', 'text-[#10221C]', 'shadow-xs', 'font-bold');
          btn.classList.remove('text-neutral-600', 'font-semibold');
        });
      });

      calculate();
    });
  </script>

</section>
