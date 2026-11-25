@php
  $isHomePage = request()->is('/') || request()->routeIs('home') || (($section->key ?? '') === 'home_communities');
@endphp

@if($isHomePage)
  {{-- ========================================== --}}
  {{-- HOME PAGE: POPULAR COMMUNITIES CAROUSEL   --}}
  {{-- ========================================== --}}
  <section class="max-w-[1280px] mx-auto px-6 py-16 font-inter relative">
    {{-- Header Row: Eyebrow + Heading + View All Communities Button --}}
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
      <div>
        <p class="font-inter text-xs font-semibold tracking-wider text-neutral-500 uppercase mb-2">
          {{ $c['eyebrow'] ?? 'VILLAS & TOWNHOUSES' }}
        </p>
        <h2 class="font-heading font-medium text-4xl sm:text-[44px] md:text-[50px] leading-tight text-[#10221C] tracking-tight">
          {!! $c['heading_html'] ?? 'Popular Communities' !!}
        </h2>
      </div>

      <div class="shrink-0">
        <a 
          href="{{ $c['header_button_link'] ?? '/communities' }}" 
          class="inline-flex items-center gap-1.5 bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-[13px] font-semibold px-6 py-3 rounded-xl shadow-xs transition-colors"
        >
          <span>{{ $c['header_button_text'] ?? 'View All Communities →' }}</span>
        </a>
      </div>
    </div>

    @php
      $store = \App\Http\Controllers\Admin\EntityController::getCommunityStore();
      $assignedSlugs = $c['assigned_communities'] ?? null;

      $popularItems = [];
      if (!empty($assignedSlugs) && is_array($assignedSlugs)) {
        foreach ($assignedSlugs as $slug) {
          if (isset($store[$slug])) {
            $comm = $store[$slug];
            $popularItems[] = [
              'title' => $comm['name'],
              'subtitle' => 'Villas & Townhouses',
              'image' => !empty($comm['hero_img']) ? $comm['hero_img'] : (!empty($comm['media_image']) ? $comm['media_image'] : 'images/the valley.png'),
              'link' => url('/communities/' . $slug),
              'button_text' => 'Explore More'
            ];
          }
        }
      }

      // Fallback if none assigned yet
      if (empty($popularItems)) {
        $popularItems = $c['items'] ?? [
          [
            'title' => 'Arabian Ranches',
            'subtitle' => 'Villas & Townhouses',
            'image' => 'images/arabian ranch.png',
            'link' => '/communities/the-valley',
            'button_text' => 'Explore More'
          ],
          [
            'title' => 'Dubai Hills Estate',
            'subtitle' => 'Villas & Townhouses',
            'image' => 'images/dubai hill estate.png',
            'link' => '/communities/the-valley',
            'button_text' => 'Explore More'
          ],
          [
            'title' => 'The Valley',
            'subtitle' => 'Villas & Townhouses',
            'image' => 'images/the valley.png',
            'link' => '/communities/the-valley',
            'button_text' => 'Explore More'
          ],
          [
            'title' => 'DAMAC Hills 2',
            'subtitle' => 'Villas & Townhouses',
            'image' => 'images/damac.png',
            'link' => '/communities/the-valley',
            'button_text' => 'Explore More'
          ],
        ];
      }
    @endphp

    {{-- Carousel Wrapper with Left/Right Arrows --}}
    <div class="relative group/carousel">
      
      {{-- Left Arrow Button --}}
      <button 
        type="button" 
        onclick="scrollPopularCommunities('left')"
        class="absolute -left-4 sm:-left-5 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-white border border-slate-200 shadow-md flex items-center justify-center text-slate-700 hover:text-[#C5A47E] hover:border-[#C5A47E] transition-all cursor-pointer"
        aria-label="Previous"
      >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
      </button>

      {{-- Right Arrow Button --}}
      <button 
        type="button" 
        onclick="scrollPopularCommunities('right')"
        class="absolute -right-4 sm:-right-5 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-white border border-slate-200 shadow-md flex items-center justify-center text-slate-700 hover:text-[#C5A47E] hover:border-[#C5A47E] transition-all cursor-pointer"
        aria-label="Next"
      >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
      </button>

      {{-- Horizontal Scroll / 4 Columns Grid --}}
      <div 
        id="popular-communities-container"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6 overflow-x-auto scroll-smooth no-scrollbar"
      >
        @foreach($popularItems as $item)
          <div class="group bg-white rounded-[20px] border border-slate-200 overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col">
            
            {{-- Image with Rounded Top and subtle scale on hover --}}
            <div class="relative w-full h-[240px] sm:h-[260px] overflow-hidden bg-slate-100">
              <img 
                src="{{ asset($item['image'] ?? 'images/the valley.png') }}" 
                alt="{{ $item['title'] ?? 'Community' }}" 
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              >
            </div>

            {{-- Card Body matching exact reference layout --}}
            <div class="p-5 flex flex-col justify-between flex-1 bg-white">
              <div>
                {{-- Location pin icon + Community Title --}}
                <div class="flex items-center gap-2 mb-1">
                  <span class="text-[#C5A47E] shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-8-6.5-8-12a8 8 0 1116 0c0 5.5-8 12-8 12z"/>
                      <circle cx="12" cy="9" r="2.5"/>
                    </svg>
                  </span>
                  <h3 class="font-heading font-bold text-lg sm:text-[19px] text-[#10221C] leading-snug truncate">
                    {{ $item['title'] ?? '' }}
                  </h3>
                </div>

                {{-- Subtitle (e.g. Villas & Townhouses) --}}
                <p class="text-xs text-slate-500 font-inter pl-6 mb-4">
                  {{ $item['subtitle'] ?? 'Villas & Townhouses' }}
                </p>
              </div>

              {{-- Explore More tan pill button --}}
              <div class="pl-6">
                <a 
                  href="{{ $item['link'] ?? '/communities/the-valley' }}" 
                  class="inline-block px-4 py-1.5 rounded-full bg-[#C5A47E] hover:bg-[#b8956e] text-white text-[11px] font-semibold transition-colors shadow-2xs"
                >
                  {{ $item['button_text'] ?? 'Explore More' }}
                </a>
              </div>
            </div>

          </div>
        @endforeach
      </div>

    </div>

    <script>
      function scrollPopularCommunities(dir) {
        const container = document.getElementById('popular-communities-container');
        if (container) {
          const scrollAmt = 320;
          container.scrollBy({
            left: dir === 'left' ? -scrollAmt : scrollAmt,
            behavior: 'smooth'
          });
        }
      }
    </script>
  </section>

@else
  {{-- ========================================== --}}
  {{-- COMMUNITIES PAGE: FULL DIRECTORY GRID     --}}
  {{-- ========================================== --}}
  <section class="max-w-[1280px] mx-auto px-6 pt-4 pb-20 font-inter">
    @php
      $store = \App\Http\Controllers\Admin\EntityController::getCommunityStore();
      
      $cards = [];
      foreach ($store as $slug => $comm) {
        $cards[] = [
          'title' => $comm['name'],
          'desc' => !empty($comm['hero_subtext']) ? $comm['hero_subtext'] : (!empty($comm['guide_description']) ? $comm['guide_description'] : 'Master-planned luxury community with landscaped parks and prime residences in Dubai.'),
          'projects' => count($comm['assigned_offplan_projects'] ?? [1, 2]) . ' Projects',
          'image' => !empty($comm['hero_img']) ? $comm['hero_img'] : (!empty($comm['media_image']) ? $comm['media_image'] : 'images/communities-hero-villa.jpg'),
          'link' => url('/communities/' . $slug),
        ];
      }
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7">
      @foreach($cards as $card)
        <div class="group bg-white rounded-[16px] border border-[#E5E7EB] overflow-hidden shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between">
          
          <div>
            <a href="{{ $card['link'] }}" class="block relative w-full h-[210px] overflow-hidden bg-neutral-100">
              <img 
                src="{{ asset($card['image']) }}" 
                alt="{{ $card['title'] }}" 
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              >
            </a>

            <div class="p-5 pb-3">
              <h3 class="font-inter font-bold text-[17px] text-[#10221C] tracking-tight leading-snug mb-2 group-hover:text-[#C5A47E] transition-colors">
                <a href="{{ $card['link'] }}">
                  {{ $card['title'] }}
                </a>
              </h3>
              <p class="font-inter text-xs text-neutral-500 leading-relaxed line-clamp-2">
                {{ $card['desc'] }}
              </p>
            </div>
          </div>

          <div class="px-5 pb-5 pt-2 flex items-center justify-between border-t border-transparent text-xs font-inter">
            <a href="{{ $card['link'] }}" class="font-medium text-[#10221C] hover:text-[#C5A47E] transition-colors flex items-center gap-1">
              <span>view community</span>
              <span class="text-neutral-500 group-hover:translate-x-0.5 transition-transform">&gt;</span>
            </a>
            <span class="text-neutral-500 font-medium">
              {{ $card['projects'] }}
            </span>
          </div>

        </div>
      @endforeach
    </div>
  </section>
@endif
