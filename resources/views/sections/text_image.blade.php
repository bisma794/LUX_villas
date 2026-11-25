@if(($c['variant'] ?? '') === 'report_banner')
<section class="bg-[#FAF8F5] py-20 font-inter">
  <div class="max-w-[1280px] mx-auto px-6 grid md:grid-cols-2 gap-12 lg:gap-16 items-center">
    {{-- Left Image with Corner Radius 21 --}}
    <div class="overflow-hidden rounded-[21px] shadow-sm flex items-center justify-center">
      <img src="{{ asset($c['image'] ?? 'images/1st banner.png') }}" alt="{{ $c['image_alt'] ?? '' }}" class="w-full h-auto max-h-[460px] object-contain rounded-[21px]">
    </div>

    {{-- Right Content --}}
    <div class="flex flex-col items-start font-inter">
      {{-- Heading: Faustina --}}
      <h2 class="font-faustina font-medium text-4xl md:text-[46px] lg:text-[50px] leading-[1.15] text-[#151515] tracking-tight">
        {!! $c['heading_html'] ?? '' !!}
      </h2>

      {{-- Content / Description: Inter --}}
      @if(!empty($c['subtext']))
      <p class="mt-6 text-sm md:text-[15px] text-[#64736B] font-inter leading-relaxed max-w-xl">
        {{ $c['subtext'] }}
      </p>
      @endif

      {{-- Button: Corner Radius 10 --}}
      @if(!empty($c['button_text']))
      <div class="mt-8">
        <a href="{{ $c['button_link'] ?? '#' }}" class="inline-flex items-center justify-center bg-[#B38855] hover:bg-[#a17846] text-white text-sm font-medium font-inter px-7 py-3.5 rounded-[10px] shadow-sm transition-colors">
          {{ $c['button_text'] }}
        </a>
      </div>
      @endif
    </div>
  </div>
</section>
@elseif(($c['variant'] ?? '') === 'quiz_section')
<section class="max-w-[1280px] mx-auto px-6 py-20 font-inter">
  <div class="grid md:grid-cols-2 gap-12 lg:gap-16 items-center">
    {{-- Left Image (as-is, untouched) --}}
    <div class="overflow-hidden rounded-[16px] shadow-sm flex items-center justify-center">
      <img src="{{ asset($c['image'] ?? 'images/dubai-skyline.jpg') }}" alt="{{ $c['image_alt'] ?? '' }}" class="w-full h-auto max-h-[560px] object-cover rounded-[16px]">
    </div>

    {{-- Right Content --}}
    <div class="flex flex-col items-start font-inter">
      @if(!empty($c['quiz_rich_content']))
        <div class="rich-quiz-content text-slate-800 leading-relaxed font-inter">
          {!! $c['quiz_rich_content'] !!}
        </div>
      @else
        {{-- Heading: Abhaya Libre, #22302A --}}
        <h2 class="font-heading font-medium text-4xl md:text-[46px] leading-[1.18] text-[#22302A]">
          {!! $c['heading_html'] ?? 'Confused About Where to Buy or<br>Invest in Dubai?' !!}
        </h2>

        {{-- Content paragraph: Inter, #828282 --}}
        @if(!empty($c['subtext']))
        <p class="mt-5 text-sm md:text-[15px] text-[#828282] font-inter leading-relaxed">
          {{ $c['subtext'] }}
        </p>
        @endif

        {{-- Bullets: Inter, #828282 --}}
        @if(!empty($c['bullets']))
        <ul class="mt-5 space-y-2.5 text-xs md:text-sm text-[#828282] font-inter">
          @foreach($c['bullets'] as $b)
          <li class="flex items-start gap-2">
            <span class="text-neutral-400 mt-1">•</span>
            <span><strong class="font-semibold text-neutral-700">{{ $b['label'] ?? '' }}</strong> {{ $b['text'] ?? '' }}</span>
          </li>
          @endforeach
        </ul>
        @endif
      @endif

      {{-- Buttons: Source Sans 3 --}}
      <div class="mt-7 flex flex-wrap gap-3.5 items-center font-source">
        @if(!empty($c['button_text']))
        <a href="{{ $c['button_link'] ?? '/ai-villa-assessment' }}" class="inline-flex items-center justify-center bg-[#C4A06B] hover:bg-[#B38F5B] text-white text-xs md:text-sm font-semibold font-source px-6 py-3 rounded-[8px] shadow-sm transition-colors">
          {{ $c['button_text'] }}
        </a>
        @endif

        @if(!empty($c['button2_text']))
        <a href="{{ $c['button2_link'] ?? '/ai-villa-assessment' }}" class="inline-flex items-center justify-center bg-[#22302A] hover:bg-[#192420] text-white text-xs md:text-sm font-semibold font-source px-6 py-3 rounded-[8px] shadow-sm transition-colors">
          {{ $c['button2_text'] }}
        </a>
        @endif
      </div>

      {{-- Bottom Note --}}
      @if(!empty($c['note_title']))
      <h4 class="mt-8 font-source font-semibold text-sm text-[#22302A]">
        {{ $c['note_title'] }}
      </h4>
      @endif
      @if(!empty($c['note']))
      <p class="mt-1.5 text-xs md:text-sm text-[#828282] font-inter leading-relaxed">
        {{ $c['note'] }}
      </p>
      @endif
    </div>
  </div>
</section>
@else
<section class="max-w-[1280px] mx-auto px-6 py-20 font-source">
  <div class="grid md:grid-cols-2 gap-12 lg:gap-16 items-center">
    @if(($c['image_side'] ?? 'right') === 'left')
    <div class="overflow-hidden rounded-[12px] shadow-sm">
      <img src="{{ asset($c['image'] ?? '') }}" alt="{{ $c['image_alt'] ?? '' }}" class="w-full h-[440px] lg:h-[480px] object-cover rounded-[12px]">
    </div>
    @endif
    <div>
      @if(!empty($c['eyebrow']))
      <p class="font-source text-xs font-semibold tracking-[0.22em] text-[#64736B] uppercase mb-3">{{ $c['eyebrow'] }}</p>
      @endif
      <h2 class="font-heading font-medium text-4xl md:text-[44px] lg:text-[48px] leading-[1.15] text-[#10221C]">{!! $c['heading_html'] ?? '' !!}</h2>
      @if(!empty($c['subtext']))
      <p class="mt-5 text-base md:text-lg text-[#64736B] font-source leading-relaxed max-w-xl">{{ $c['subtext'] }}</p>
      @endif
      @if(!empty($c['bullets']))
      <ul class="mt-6 space-y-3 text-base text-neutral-700 font-source">
        @foreach($c['bullets'] as $b)<li><strong>{{ $b['label'] ?? '' }}</strong> {{ $b['text'] ?? '' }}</li>@endforeach
      </ul>
      @endif
      <div class="mt-8 flex flex-wrap gap-4 items-center">
        @if(!empty($c['button_text']))
        <a href="{{ $c['button_link'] ?? '#' }}" class="inline-flex items-center justify-center bg-[#22302A] hover:bg-[#192420] text-white text-sm font-semibold font-source px-7 py-3.5 rounded-[23px] shadow-sm transition-colors">
          {{ $c['button_text'] }}
        </a>
        @endif
        @if(!empty($c['button2_text']))
        <a href="{{ $c['button2_link'] ?? '#' }}" class="inline-flex items-center justify-center bg-[#C5A47E] hover:bg-[#b5946e] text-white text-sm font-semibold font-source px-7 py-3.5 rounded-[23px] shadow-sm transition-colors">
          {{ $c['button2_text'] }}
        </a>
        @endif
      </div>
      @if(!empty($c['note']))
      <p class="mt-5 text-sm text-neutral-500 font-source">{{ $c['note'] }}</p>
      @endif
    </div>
    @if(($c['image_side'] ?? 'right') === 'right')
    <div class="overflow-hidden rounded-[12px] shadow-sm">
      <img src="{{ asset($c['image'] ?? '') }}" alt="{{ $c['image_alt'] ?? '' }}" class="w-full h-[440px] lg:h-[480px] object-cover rounded-[12px]">
    </div>
    @endif
  </div>
</section>
@endif
