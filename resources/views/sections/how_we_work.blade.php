<section class="bg-[#FAF8F5] py-20 md:py-24 font-source">
  <div class="max-w-[1280px] mx-auto px-6">
    
    {{-- Header: Tagline in Source Sans 3, Heading in Fraunces, Subtext in Source Sans 3 --}}
    <div class="max-w-3xl mb-14">
      @if(!empty($c['eyebrow']))
      <p class="font-source text-xs font-semibold tracking-wider text-[#64736B] mb-3">
        {{ $c['eyebrow'] }}
      </p>
      @endif
      <h2 class="font-fraunces font-medium text-4xl md:text-[52px] lg:text-[56px] text-[#10221C] leading-[1.12] tracking-tight">
        {!! $c['heading_html'] ?? 'One partner, from first<br>viewing to every year after' !!}
      </h2>
      @if(!empty($c['subtext']))
      <p class="mt-5 text-sm md:text-base text-[#64736B] font-source leading-relaxed max-w-2xl">
        {{ $c['subtext'] }}
      </p>
      @endif
    </div>

    {{-- 3 White Cards Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-7 items-stretch">
      @foreach(($c['items'] ?? []) as $it)
      <div class="bg-white border border-[#EBECEB] rounded-[16px] p-8 md:p-9 shadow-[0_4px_25px_rgba(0,0,0,0.03)] flex flex-col justify-between">
        <div>
          {{-- Number Box: Fraunces --}}
          <div class="w-11 h-11 rounded-[8px] bg-[#F2F5F3] flex items-center justify-center mb-6">
            <span class="font-fraunces font-medium text-lg text-[#10221C]">
              {{ $it['number'] ?? '01' }}
            </span>
          </div>

          {{-- Title: Fraunces or Heading Serif in deep dark green tone --}}
          <h3 class="font-fraunces font-semibold text-3xl md:text-[34px] text-[#0E3B2C] leading-snug">
            {{ $it['title'] ?? '' }}
          </h3>

          {{-- Badge Pill --}}
          @if(!empty($it['badge']))
          <div class="mt-4 mb-6">
            <span class="inline-block bg-[#C4A06B] text-white text-[11px] font-inter font-medium px-3.5 py-1.5 rounded-full">
              {{ $it['badge'] }}
            </span>
          </div>
          @endif

          {{-- Card Bullet Content: Inter font --}}
          @if(!empty($it['bullets']) && is_array($it['bullets']))
          <ul class="space-y-3.5 text-xs md:text-[13px] text-[#555555] font-inter leading-relaxed">
            @foreach($it['bullets'] as $bullet)
            <li class="flex items-start gap-2">
              <span class="text-neutral-400 mt-1">•</span>
              <span>{{ $bullet }}</span>
            </li>
            @endforeach
          </ul>
          @elseif(!empty($it['text']))
          <p class="mt-4 text-xs md:text-[13px] text-[#555555] font-inter leading-relaxed">
            {{ $it['text'] }}
          </p>
          @endif
        </div>

        {{-- Action Link at Bottom --}}
        @if(!empty($it['link_text']))
        <div class="pt-8 mt-6 border-t border-neutral-100 font-source">
          <a href="{{ $it['link'] ?? '#' }}" class="font-source font-semibold text-xs md:text-sm text-[#0E3B2C] hover:text-[#B9975B] inline-flex items-center gap-1.5 transition-colors">
            {{ $it['link_text'] }}
          </a>
        </div>
        @endif
      </div>
      @endforeach
    </div>

  </div>
</section>
