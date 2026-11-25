<section class="bg-[#FAF8F5] min-h-[484px] flex flex-col justify-center py-16 px-6 font-source">
  <div class="max-w-[1280px] mx-auto w-full">
    {{-- Header: Center-aligned, Abhaya Libre Medium, #151515 --}}
    <div class="text-center max-w-3xl mx-auto mb-14">
      <h2 class="font-heading font-medium text-4xl md:text-[46px] text-[#151515] leading-tight">
        {!! $c['heading_html'] ?? '' !!}
      </h2>
      @if(!empty($c['subtext']))
      <p class="mt-4 text-base md:text-[17px] text-[#151515] font-source leading-relaxed">
        {{ $c['subtext'] }}
      </p>
      @endif
    </div>

    {{-- 4 Columns with subtle vertical dividers --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y lg:divide-y-0 lg:divide-x divide-neutral-200/80">
      @foreach(($c['items'] ?? []) as $it)
      <div class="px-6 py-6 lg:py-2 flex flex-col items-start font-source">
        {{-- Icon container matching screenshot --}}
        <div class="w-12 h-12 rounded-[10px] bg-[#10221C] text-white flex items-center justify-center mb-6 shadow-sm">
          @if(($it['type'] ?? '') === 'insights' || str_contains(strtolower($it['title'] ?? ''), 'insight'))
            {{-- Database / Coin cylinders icon --}}
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <ellipse cx="12" cy="5" rx="8" ry="2.5" stroke-width="2"/>
              <path d="M4 5v5c0 1.38 3.58 2.5 8 2.5s8-1.12 8-2.5V5" stroke-width="2"/>
              <path d="M4 10v5c0 1.38 3.58 2.5 8 2.5s8-1.12 8-2.5v-5" stroke-width="2"/>
              <path d="M4 15v4c0 1.38 3.58 2.5 8 2.5s8-1.12 8-2.5v-4" stroke-width="2"/>
            </svg>
          @elseif(($it['type'] ?? '') === 'scale' || str_contains(strtolower($it['title'] ?? ''), 'side') || str_contains(strtolower($it['title'] ?? ''), 'comparison'))
            {{-- Balance Scale icon --}}
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18m-7-9l7-3 7 3M5 12l-2 5h4l-2-5zm14 0l-2 5h4l-2-5zM9 21h6"/>
            </svg>
          @elseif(($it['type'] ?? '') === 'shield' || str_contains(strtolower($it['title'] ?? ''), 'curated') || str_contains(strtolower($it['title'] ?? ''), 'listing'))
            {{-- Shield Check icon --}}
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
          @else
            {{-- User / Advisory icon --}}
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          @endif
        </div>

        {{-- Card Title --}}
        <h3 class="font-source font-bold text-lg md:text-[19px] text-[#151515] leading-snug mb-2">
          {{ $it['title'] ?? '' }}
        </h3>

        {{-- Description text --}}
        <p class="font-source text-sm text-[#151515]/80 leading-relaxed mb-4 min-h-[44px]">
          {{ $it['text'] ?? '' }}
        </p>

        {{-- Link with underline --}}
        @if(!empty($it['link_text']))
        <a href="{{ $it['link'] ?? '#' }}" class="font-source text-xs font-semibold text-[#B9975B] hover:text-[#977943] underline underline-offset-4 transition-colors mt-auto">
          {{ $it['link_text'] }}
        </a>
        @endif
      </div>
      @endforeach
    </div>
  </div>
</section>
