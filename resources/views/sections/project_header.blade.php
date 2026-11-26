@php
  $proj = $project ?? (\App\Http\Controllers\Admin\EntityController::getOffplanProjectData('golf-vale-emaar-south'));
  $breadcrumbs = array_key_exists('breadcrumbs', $proj) ? $proj['breadcrumbs'] : (!empty($c['breadcrumb']) ? $c['breadcrumb'] : '1. Home > Off-plan > EMAAR Properties > Golf Vale Emaar South');

  if (array_key_exists('usps', $proj) && is_array($proj['usps'])) {
    $heroHeading = implode(' | ', array_filter($proj['usps']));
  } elseif (!empty($c['heading_html'])) {
    $heroHeading = strip_tags($c['heading_html']);
  } else {
    $heroHeading = ($proj['name'] ?? 'Golf Vale Emaar South') . ' | EMAAR Properties | Dubai South, Dubai';
  }

  $gMain = !empty($proj['gallery_main']) ? $proj['gallery_main'] : 'images/golf-vale-main.jpg';
  $gTopRight = !empty($proj['gallery_top_right']) ? $proj['gallery_top_right'] : 'images/golf-vale-pool.png';
  $gBottomRight = !empty($proj['gallery_bottom_right']) ? $proj['gallery_bottom_right'] : 'images/golf-vale-bedroom.png';

  $defaultStats = [
    ['upper' => 'Developer', 'lower' => 'Emaar'],
    ['upper' => 'AED 1,099,888', 'lower' => 'Starting Price from'],
    ['upper' => '1-4br', 'lower' => 'Available Units'],
    ['upper' => '2030 Q1', 'lower' => 'Handover'],
  ];
  $statsList = isset($proj['stats']) && is_array($proj['stats']) ? $proj['stats'] : $defaultStats;
@endphp

{{-- Golf Vale Emaar South Hero Section matching reference --}}
<section class="w-full bg-[#C5A47E] text-white pt-8 pb-14 font-inter">
  <div class="max-w-[1280px] mx-auto px-6">
    
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-xs sm:text-[13px] text-white/90 font-inter mb-4 flex-wrap">
      @php
        $bcParts = array_map('trim', explode('>', $breadcrumbs));
      @endphp
      @foreach($bcParts as $bIdx => $bPart)
        @if($bIdx > 0)
          <span>&gt;</span>
        @endif
        @if($bIdx === 0)
          <a href="/" class="hover:underline">{{ $bPart }}</a>
        @elseif($bIdx === 1)
          <a href="/projects" class="hover:underline">{{ $bPart }}</a>
        @elseif($loop->last)
          <span class="text-white font-medium">{{ $bPart }}</span>
        @else
          <span>{{ $bPart }}</span>
        @endif
      @endforeach
    </div>

    {{-- Main Heading (USPs separated by |) --}}
    <h1 class="font-heading font-medium text-3xl sm:text-4xl md:text-[44px] lg:text-[46px] text-white leading-tight tracking-tight mb-8">
      {{ $heroHeading }}
    </h1>

    {{-- 3-Image Gallery Layout with Pill Buttons on Big Image --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-stretch">
      
      {{-- Big Left Photo (Span 8) --}}
      <div class="lg:col-span-8 relative rounded-[20px] overflow-hidden shadow-md bg-neutral-200 group min-h-[380px] sm:min-h-[440px] md:min-h-[480px]">
        <img 
          src="{{ asset($gMain) }}" 
          alt="{{ $proj['name'] ?? 'Project Exterior' }}" 
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-102"
        >

        {{-- Floating Action Pill Buttons on bottom left --}}
        <div class="absolute left-5 sm:left-6 bottom-5 sm:bottom-6 z-20 flex items-center gap-2.5 sm:gap-3 flex-wrap">
          <button 
            type="button" 
            class="px-5 sm:px-6 py-2.5 rounded-full text-xs sm:text-sm font-medium transition-all duration-300 shadow-sm cursor-pointer bg-[#C5A47E] text-white hover:bg-[#b8956e]"
          >
            Photos
          </button>

          <button 
            type="button" 
            class="px-5 sm:px-6 py-2.5 rounded-full text-xs sm:text-sm font-medium transition-all duration-300 shadow-sm cursor-pointer bg-white text-[#10221C] hover:bg-[#C5A47E] hover:text-white"
          >
            Brochure
          </button>

          <button 
            type="button" 
            class="px-5 sm:px-6 py-2.5 rounded-full text-xs sm:text-sm font-medium transition-all duration-300 shadow-sm cursor-pointer bg-white text-[#10221C] hover:bg-[#C5A47E] hover:text-white"
          >
            Map
          </button>
        </div>
      </div>

      {{-- 2 Right Side Stacked Photos (Span 4) --}}
      <div class="lg:col-span-4 flex flex-col gap-5 justify-between">
        
        {{-- Top Right Photo --}}
        <div class="relative rounded-[20px] overflow-hidden shadow-md bg-neutral-200 group h-[210px] sm:h-[230px]">
          <img 
            src="{{ asset($gTopRight) }}" 
            alt="Project Pool View" 
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-102"
          >
        </div>

        {{-- Bottom Right Photo --}}
        <div class="relative rounded-[20px] overflow-hidden shadow-md bg-neutral-200 group h-[210px] sm:h-[230px]">
          <img 
            src="{{ asset($gBottomRight) }}" 
            alt="Project Bedroom Interior" 
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-102"
          >

          {{-- More Photos Floating Badge --}}
          <button 
            type="button"
            class="absolute right-4 bottom-4 z-20 flex items-center gap-1.5 bg-white/95 hover:bg-[#C5A47E] hover:text-white text-[#10221C] text-[11px] sm:text-xs font-medium px-3.5 py-1.5 rounded-[8px] shadow-sm transition-all cursor-pointer"
          >
            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M4 4h3l2-2h6l2 2h3a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm8 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6z"/></svg>
            <span>More Photos</span>
          </button>
        </div>

      </div>

    </div>

  </div>
</section>

{{-- Key Project Stats / Tabs Section right below Hero --}}
<section class="w-full bg-white border-b border-[#E5E7EB] py-7 sm:py-8 font-inter">
  <div class="max-w-[1280px] mx-auto px-6">
    <div class="grid grid-cols-2 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-neutral-300">
      @foreach($statsList as $st)
        <div class="py-3 sm:py-2 px-3 sm:px-6 md:first:pl-0 flex flex-col justify-center">
          <h4 class="font-inter font-bold text-base sm:text-lg text-[#10221C] tracking-tight leading-snug">
            {{ $st['upper'] ?? '' }}
          </h4>
          <p class="font-inter font-normal text-xs sm:text-sm text-neutral-500 mt-0.5">
            {{ $st['lower'] ?? '' }}
          </p>
        </div>
      @endforeach
    </div>
  </div>
</section>
