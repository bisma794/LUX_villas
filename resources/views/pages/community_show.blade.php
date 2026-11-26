@extends('layouts.app')

@section('content')
@php
  // Retrieve saved data from CMS store if present, fallback to defaults
  $cmsCommunity = \App\Http\Controllers\Admin\EntityController::getCommunityData($slug);

  $communityMap = [
    'the-valley' => [
      'name' => 'The Valley Dubai',
      'subtext' => 'Green open spaces, real amenities and the numbers behind each villa community.',
      'hero_img' => 'images/communities-hero-villa.jpg',
      'location' => 'Dubai–Al Ain Road, Dubai',
    ],
    'dubai-hills-estate' => [
      'name' => 'Dubai Hills Estate',
      'subtext' => 'The green heart of Dubai, centered around an 18-hole championship golf course.',
      'hero_img' => 'images/community-dubai-hills.jpg',
      'location' => 'Al Khail Road, Dubai',
    ],
    'emaar-south' => [
      'name' => 'Emaar South',
      'subtext' => 'Smart living in Dubai South near Al Maktoum Airport and Expo City.',
      'hero_img' => 'images/golf-vale-main.jpg',
      'location' => 'Dubai South, Dubai',
    ],
    'jvc' => [
      'name' => 'Jumeirah Village Circle',
      'subtext' => 'Family-friendly master development with landscaped parks, schools and apartments.',
      'hero_img' => 'images/community-jvc.jpg',
      'location' => 'Al Khail Road, Dubai',
    ],
    'dubailand' => [
      'name' => 'Dubailand',
      'subtext' => 'Expansive residential, sports, and entertainment hub designed for family living.',
      'hero_img' => 'images/community-dubailand.jpg',
      'location' => 'Sheikh Mohammed Bin Zayed Rd, Dubai',
    ],
  ];

  $baseInfo = $communityMap[$slug] ?? [
    'name' => ucwords(str_replace('-', ' ', $slug)),
    'subtext' => 'Luxury living and modern residential master development in Dubai.',
    'hero_img' => 'images/communities-hero-villa.jpg',
    'location' => 'Dubai, UAE',
  ];

  $breadcrumbs = array_key_exists('breadcrumbs', $cmsCommunity) ? $cmsCommunity['breadcrumbs'] : 'HOME > COMMUNITIES';
  $heading = array_key_exists('hero_heading', $cmsCommunity) ? $cmsCommunity['hero_heading'] : $baseInfo['name'];
  $description = array_key_exists('hero_subtext', $cmsCommunity) ? $cmsCommunity['hero_subtext'] : $baseInfo['subtext'];
  $showForm = isset($cmsCommunity['show_form']) ? (bool)$cmsCommunity['show_form'] : true;
  $formTitle = array_key_exists('form_title', $cmsCommunity) ? $cmsCommunity['form_title'] : ('Enquire about ' . $heading);
  $heroImg = !empty($cmsCommunity['hero_img']) ? $cmsCommunity['hero_img'] : $baseInfo['hero_img'];

  // Content Section (Community Guide) from CMS
  $guideHeading = array_key_exists('guide_heading', $cmsCommunity) ? $cmsCommunity['guide_heading'] : ($baseInfo['name'] . ' Community Guide');
  $guideDescription = array_key_exists('guide_description', $cmsCommunity) ? $cmsCommunity['guide_description'] : $baseInfo['subtext'];
  $mediaType = $cmsCommunity['media_type'] ?? 'video'; // 'video', 'image', or 'hidden'
  $mediaImage = !empty($cmsCommunity['media_image']) ? $cmsCommunity['media_image'] : 'images/family-park.jpg';
  $videoUrl = $cmsCommunity['video_url'] ?? '';

  // Feature stats bar (4 pairs of upper & lower text)
  $defaultFeatures = [
    ['upper' => '7,000+', 'lower' => 'Acres planned'],
    ['upper' => 'Residential', 'lower' => 'Villas, townhouses.'],
    ['upper' => 'Green Spaces', 'lower' => 'Parks, lakes and trails'],
    ['upper' => 'Integrated', 'lower' => 'Live, work, shop and relax'],
  ];
  $features = $cmsCommunity['features'] ?? $defaultFeatures;
@endphp

{{-- Community Hero Section matching reference --}}
<section class="relative font-inter">
  <img src="{{ asset($heroImg) }}" alt="{{ $heading }}" class="w-full h-[580px] lg:h-[620px] object-cover">
  <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-black/20"></div>
  <div class="absolute inset-0">
    <div class="max-w-[1280px] mx-auto px-6 w-full h-full flex items-end pb-12 gap-8">
      <div class="text-white flex-1 pb-2">
        <div class="flex items-center gap-2 text-xs uppercase tracking-widest text-white/80 font-medium mb-3">
          @php
            $parts = array_map('trim', explode('>', $breadcrumbs));
          @endphp
          @foreach($parts as $idx => $part)
            @if($idx > 0)
              <span>&gt;</span>
            @endif
            @if(strcasecmp($part, 'HOME') === 0)
              <a href="/" class="hover:underline">{{ $part }}</a>
            @elseif(strcasecmp($part, 'COMMUNITIES') === 0)
              <a href="/communities" class="hover:underline">{{ $part }}</a>
            @else
              <span>{{ $part }}</span>
            @endif
          @endforeach
        </div>
        <h1 class="font-heading font-medium text-4xl sm:text-5xl md:text-6xl text-white leading-tight">
          {{ $heading }}
        </h1>
        <p class="mt-4 text-base sm:text-lg text-white/90 max-w-xl font-inter leading-relaxed">
          {{ $description }}
        </p>
      </div>

      {{-- Enquiry Card Form (Controlled via CMS Hero Tab) --}}
      @if($showForm)
      <div class="bg-white rounded-[20px] shadow-2xl p-6 sm:p-7 w-[360px] shrink-0 hidden md:block border border-white/20">
        <h3 class="font-heading font-semibold text-2xl text-[#0E3B2C] leading-snug">
          {{ $formTitle }}
        </h3>
        <input 
          type="text" 
          placeholder="Full Name" 
          class="border border-[#E5E7EB] rounded-lg px-4 py-3 w-full mt-4 text-xs font-inter focus:outline-none focus:border-[#C5A47E]"
        >
        <input 
          type="tel" 
          placeholder="Phone / Whatsapp (+971…)" 
          class="border border-[#E5E7EB] rounded-lg px-4 py-3 w-full mt-3 text-xs font-inter focus:outline-none focus:border-[#C5A47E]"
        >
        <div class="relative mt-3">
          <select class="appearance-none border border-[#E5E7EB] rounded-lg px-4 py-3 w-full text-xs font-inter text-[#4A5568] bg-white focus:outline-none focus:border-[#C5A47E]">
            <option>Interested In (Villa)</option>
            <option>Townhouse</option>
            <option>Mansion</option>
            <option>Plot</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-[#9CA3AF]">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </div>
        </div>
        <button 
          type="button" 
          class="w-full bg-[#C5A47E] hover:bg-[#b8956e] text-white py-3.5 rounded-lg text-xs font-semibold mt-4 transition duration-200 shadow-sm cursor-pointer"
        >
          Request a Call Back
        </button>
      </div>
      @endif

    </div>
  </div>
</section>

{{-- Second Content Section (Community Guide & Video / Image) --}}
<section class="max-w-[1280px] mx-auto px-6 py-16 lg:py-20 font-inter">
  <div class="grid md:grid-cols-2 gap-10 lg:gap-14 items-center">
    
    {{-- Left: Text Content --}}
    <div class="{{ $mediaType === 'hidden' ? 'md:col-span-2 max-w-3xl' : '' }} font-inter">
      @php
        // Style script text in heading if present or auto-style last word
        $headingParts = explode(' ', $guideHeading);
        $lastWord = array_pop($headingParts);
        $firstWords = implode(' ', $headingParts);
      @endphp
      <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[42px] text-[#0E3B2C] leading-tight">
        {{ $firstWords }} <span class="italic font-normal">{{ $lastWord }}</span>
      </h2>
      <p class="mt-5 text-sm sm:text-base text-neutral-600 font-inter leading-relaxed max-w-xl">
        {{ $guideDescription }}
      </p>
    </div>

    {{-- Right: Media Card (Video / Image / Hidden) --}}
    @if($mediaType !== 'hidden')
    <div class="relative rounded-[20px] overflow-hidden shadow-md group">
      <img src="{{ asset($mediaImage) }}" alt="{{ $guideHeading }}" class="w-full h-[360px] sm:h-[400px] object-cover">
      
      @if($mediaType === 'video')
      <a 
        href="{{ !empty($videoUrl) ? $videoUrl : 'javascript:void(0)' }}" 
        target="{{ !empty($videoUrl) ? '_blank' : '_self' }}"
        class="absolute inset-0 flex items-center justify-center bg-black/15 group-hover:bg-black/25 transition-colors"
        title="Play Community Video"
      >
        <span class="w-16 h-16 rounded-full bg-white/95 shadow-xl flex items-center justify-center text-[#0E3B2C] text-lg pl-1 group-hover:scale-110 transition-transform cursor-pointer">
          <svg class="w-6 h-6 fill-current translate-x-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
        </span>
      </a>
      @endif
    </div>
    @endif

  </div>
</section>

{{-- Feature Stats Bar (4 Pairs) --}}
<section class="w-full bg-[#C2A37D] py-8 sm:py-10 text-white font-inter">
  <div class="max-w-[1280px] mx-auto px-6">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 items-start">
      @foreach($features as $feat)
        <div>
          <h3 class="font-heading font-medium text-2xl sm:text-3xl text-white tracking-tight">
            {{ $feat['upper'] }}
          </h3>
          <p class="font-inter text-xs sm:text-sm text-white/90 mt-1 font-normal">
            {{ $feat['lower'] }}
          </p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Offplan Projects for this Community (Selected in CMS Column S) --}}
@php
  $assignedProjectSlugs = $cmsCommunity['assigned_offplan_projects'] ?? ['nara-townhouse', 'the-fairway-villa'];
  $allAvailableProjects = \App\Http\Controllers\Admin\EntityController::getAvailableOffplanProjects();
  $communityProjects = array_filter($allAvailableProjects, function($p) use ($assignedProjectSlugs) {
    return in_array($p['slug'], $assignedProjectSlugs);
  });
@endphp

@if(!empty($communityProjects))
<section class="max-w-[1280px] mx-auto px-6 py-16 font-inter">
  <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
      <h2 class="font-heading font-medium text-3xl sm:text-4xl text-[#0E3B2C] leading-tight">
        Offplan Projects in <span class="italic">{{ $heading }}</span>
      </h2>
      <p class="text-xs sm:text-sm text-neutral-500 mt-2 font-inter">
        Explore premier off-plan developments and newly released master villas.
      </p>
    </div>
    <a href="/projects" class="text-xs font-semibold text-[#C5A47E] hover:underline flex items-center gap-1">
      View All Offplan Projects <span>→</span>
    </a>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($communityProjects as $proj)
      <div class="bg-white rounded-[20px] overflow-hidden border border-neutral-200/70 shadow-xs hover:shadow-lg transition-all duration-300 group flex flex-col">
        {{-- Image with Tag --}}
        <div class="relative h-[230px] overflow-hidden bg-neutral-100">
          <img src="{{ asset($proj['image']) }}" alt="{{ $proj['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <span class="absolute top-3 left-3 bg-[#C5A47E] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
            OFF-PLAN
          </span>
          <span class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-xs text-white text-xs font-semibold px-2.5 py-1 rounded-md">
            {{ $proj['price'] }}
          </span>
        </div>

        {{-- Details --}}
        <div class="p-5 flex-1 flex flex-col justify-between">
          <div>
            <div class="text-[11px] font-semibold text-[#0E3B2C] uppercase tracking-wider mb-1">
              {{ $proj['developer'] ?? 'Emaar Properties' }}
            </div>
            <h3 class="font-heading font-semibold text-lg text-neutral-900 group-hover:text-[#0E3B2C] transition-colors leading-snug">
              {{ $proj['name'] }}
            </h3>
            <p class="text-xs text-neutral-500 mt-1 flex items-center gap-1">
              <svg class="w-3.5 h-3.5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              <span>{{ $proj['location'] }}</span>
            </p>
            <div class="mt-3 pt-3 border-t border-neutral-100 text-[11px] text-neutral-600 font-medium">
              {{ $proj['specs'] }}
            </div>
          </div>

          <div class="mt-4 pt-4 border-t border-neutral-100 flex items-center justify-between">
            <a href="{{ $proj['url'] }}" class="text-xs font-semibold text-[#0E3B2C] hover:text-[#C5A47E] transition-colors">
              View Project Details →
            </a>
            <a href="/enquiry" class="px-3 py-1.5 rounded-lg bg-[#FAF8F5] hover:bg-[#F2ECE3] text-[#0E3B2C] text-[11px] font-semibold border border-[#C5A47E]/30 transition-colors">
              Enquire
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>
@endif

{{-- Ready Projects for this Community (Listing Projects selected in CMS Column S) --}}
@php
  $assignedReadyProjectSlugs = $cmsCommunity['assigned_ready_projects'] ?? ['the-fairway-villa', 'maple-row-villa'];
  $allAvailableReadyProjects = \App\Http\Controllers\Admin\EntityController::getAvailableReadyProjects();
  $communityReadyProjects = array_filter($allAvailableReadyProjects, function($p) use ($assignedReadyProjectSlugs) {
    return in_array($p['slug'], $assignedReadyProjectSlugs);
  });
@endphp

@if(!empty($communityReadyProjects))
<section class="max-w-[1280px] mx-auto px-6 py-16 bg-[#FAF8F5]/60 border-t border-neutral-100 font-inter">
  <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
      <h2 class="font-heading font-medium text-3xl sm:text-4xl text-[#0E3B2C] leading-tight">
        Ready Projects in <span class="italic">{{ $heading }}</span>
      </h2>
      <p class="text-xs sm:text-sm text-neutral-500 mt-2 font-inter">
        Explore move-in ready villas and established luxury residences available now.
      </p>
    </div>
    <a href="/villas-for-sale" class="text-xs font-semibold text-[#C5A47E] hover:underline flex items-center gap-1">
      View All Ready Properties <span>→</span>
    </a>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($communityReadyProjects as $proj)
      <div class="bg-white rounded-[20px] overflow-hidden border border-neutral-200/70 shadow-xs hover:shadow-lg transition-all duration-300 group flex flex-col">
        {{-- Image with Tag --}}
        <div class="relative h-[230px] overflow-hidden bg-neutral-100">
          <img src="{{ asset($proj['image']) }}" alt="{{ $proj['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <span class="absolute top-3 left-3 bg-[#18392B] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
            READY TO MOVE
          </span>
          <span class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-xs text-white text-xs font-semibold px-2.5 py-1 rounded-md">
            {{ $proj['price'] }}
          </span>
        </div>

        {{-- Details --}}
        <div class="p-5 flex-1 flex flex-col justify-between">
          <div>
            <div class="text-[11px] font-semibold text-[#0E3B2C] uppercase tracking-wider mb-1">
              {{ $proj['developer'] ?? 'Luxury Residential' }}
            </div>
            <h3 class="font-heading font-semibold text-lg text-neutral-900 group-hover:text-[#0E3B2C] transition-colors leading-snug">
              {{ $proj['name'] }}
            </h3>
            <p class="text-xs text-neutral-500 mt-1 flex items-center gap-1">
              <svg class="w-3.5 h-3.5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              <span>{{ $proj['location'] }}</span>
            </p>
            <div class="mt-3 pt-3 border-t border-neutral-100 text-[11px] text-neutral-600 font-medium">
              {{ $proj['specs'] }}
            </div>
          </div>

          <div class="mt-4 pt-4 border-t border-neutral-100 flex items-center justify-between">
            <a href="{{ $proj['url'] }}" class="text-xs font-semibold text-[#0E3B2C] hover:text-[#C5A47E] transition-colors">
              View Details →
            </a>
            <a href="/enquiry" class="px-3 py-1.5 rounded-lg bg-[#FAF8F5] hover:bg-[#F2ECE3] text-[#0E3B2C] text-[11px] font-semibold border border-[#C5A47E]/30 transition-colors">
              Schedule Tour
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>
@endif

{{-- Dynamic Amenities & Facilities Section (Matching Screenshot) --}}
@php
  $assignedAmenityKeys = $cmsCommunity['assigned_amenities'] ?? ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'];
  $allAmenitiesStore = \App\Http\Controllers\Admin\EntityController::getAmenitiesStore();
  
  $displayAmenities = array_filter($allAmenitiesStore, function($am) use ($assignedAmenityKeys) {
    return in_array($am['key'], $assignedAmenityKeys);
  });
@endphp

@if(!empty($displayAmenities))
<section class="max-w-[1280px] mx-auto px-6 py-16 sm:py-20 font-inter">
  <div class="mb-8 sm:mb-10">
    <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[42px] text-[#0E3B2C] tracking-tight">
      Amenities &amp; Facilities
    </h2>
  </div>

  <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6">
    @foreach($displayAmenities as $am)
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
@endif

{{-- Full Content Section (Summernote Rich Content matching reference typography) --}}
@php
  $fullContentHtml = preg_replace('/(<(?:p|h[1-6])\b[^>]*?)\sstyle="[^"]*"/i', '$1', $cmsCommunity['full_content'] ?? '');
@endphp
@if(!empty($fullContentHtml))
<section style="background-color: #F8F8F8;" class="py-20 md:py-24 font-inter border-t border-neutral-100">
  <div class="max-w-[1280px] mx-auto px-6">
    <div class="lux-rich-content lux-rich-content-inner max-w-none leading-relaxed" style="color: #000000;">
      {!! $fullContentHtml !!}
    </div>
  </div>
</section>
@endif

{{-- Dynamic Community Specific FAQs (Matching Screenshot: Dark background, centered heading, rounded white pills) --}}
@php
  $defaultCommunityFaqs = [
    ['q' => 'What Is ' . $heading . '?', 'a' => $heading . ' is a premier master-planned luxury development in Dubai designed with exceptional architecture, landscaped parks, and world-class amenities.'],
    ['q' => 'Who Is The Developer Behind ' . $heading . '?', 'a' => 'Developed by leading master developers in the UAE, renowned for delivering landmark luxury estates and master communities.'],
    ['q' => 'Where Is ' . $heading . ' Located?', 'a' => $heading . ' enjoys a prime strategic location in Dubai with rapid connectivity to Downtown Dubai, DXB International Airport, and major business hubs.'],
    ['q' => 'What Types Of Properties Are Available In ' . $heading . '?', 'a' => 'The development features an exclusive portfolio of contemporary townhouses, semi-detached residences, and sprawling golf and luxury villas.'],
    ['q' => 'Is ' . $heading . ' A Good Investment Opportunity?', 'a' => 'Yes, sustained capital appreciation, exceptional rental demand, and high ROI make it a top choice for global investors and high-net-worth homeowners.'],
    ['q' => 'Does ' . $heading . ' Offer A Flexible Payment Plan?', 'a' => 'Yes, off-plan and new releases offer attractive investor-friendly payment schedules linked directly to construction milestones.'],
  ];
  $displayFaqs = !empty($cmsCommunity['faqs']) ? $cmsCommunity['faqs'] : $defaultCommunityFaqs;
@endphp

@if(!empty($displayFaqs))
<section class="bg-[#0E1A14] text-white py-20 sm:py-24 font-inter">
  <div class="max-w-[960px] mx-auto px-6">
    
    {{-- Eyebrow & Heading: Centered matching screenshot --}}
    <div class="text-center mb-12 sm:mb-14">
      <p class="font-inter text-xs font-semibold tracking-[0.28em] text-[#C5A47E] uppercase mb-3">
        FAQS
      </p>
      <h2 class="font-heading text-4xl sm:text-5xl text-white font-medium tracking-tight">
        Frequently asked questions
      </h2>
    </div>

    {{-- FAQ Pill Accordion Items (Rounded white cards matching screenshot) --}}
    <div class="space-y-3.5 font-inter">
      @foreach($displayFaqs as $f)
        <div class="faq-item bg-white text-[#151515] rounded-[10px] shadow-sm overflow-hidden transition-all duration-200">
          <button 
            type="button" 
            onclick="toggleCommunityFaq(this)"
            class="faq-q w-full flex justify-between items-center px-6 py-4.5 text-left text-sm sm:text-[15px] font-semibold text-[#151515] cursor-pointer select-none hover:bg-neutral-50/80 transition-colors"
          >
            <span>{{ $f['q'] }}</span>
            <span class="faq-icon text-xl font-light text-neutral-400 shrink-0 ml-4 transition-transform duration-200">+</span>
          </button>
          <div class="faq-a px-6 pb-5 pt-1 text-xs sm:text-sm text-[#64736B] leading-relaxed border-t border-neutral-100 hidden">
            {{ $f['a'] }}
          </div>
        </div>
      @endforeach
    </div>

  </div>
</section>

<script>
  function toggleCommunityFaq(btn) {
    const item = btn.closest('.faq-item');
    const answer = item.querySelector('.faq-a');
    const icon = item.querySelector('.faq-icon');
    if (!answer) return;

    if (answer.classList.contains('hidden')) {
      answer.classList.remove('hidden');
      if (icon) {
        icon.innerText = '−';
        icon.classList.add('text-[#0E3B2C]', 'font-bold');
      }
    } else {
      answer.classList.add('hidden');
      if (icon) {
        icon.innerText = '+';
        icon.classList.remove('text-[#0E3B2C]', 'font-bold');
      }
    }
  }
</script>
@endif

@endsection
