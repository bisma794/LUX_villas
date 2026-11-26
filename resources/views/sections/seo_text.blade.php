@php
  $isHomeSeo = request()->is('/') || request()->routeIs('home');
@endphp
<section class="{{ $isHomeSeo ? 'bg-[#FAF8F5]' : '' }} py-20 md:py-24 font-inter" @if(!$isHomeSeo) style="background-color: #F8F8F8;" @endif>
  <div class="max-w-[1280px] mx-auto px-6">
    <div class="w-full space-y-12">
      @if(!empty($c['full_content']))
        @php
          $cleanSeoContent = preg_replace('/(<(?:p|h[1-6])\b[^>]*?)\sstyle="[^"]*"/i', '$1', $c['full_content']);
        @endphp
        <div class="lux-rich-content {{ $isHomeSeo ? 'text-[#4A5550]' : 'lux-rich-content-inner' }} max-w-none leading-relaxed" @if(!$isHomeSeo) style="color: #000000;" @endif>
          {!! $cleanSeoContent !!}
        </div>
      @else
        @foreach(($c['blocks'] ?? []) as $b)
        <div class="space-y-5">
          {{-- Headings --}}
          <h3 class="font-inter font-bold text-2xl md:text-[28px] {{ $isHomeSeo ? 'text-[#C5A47E]' : '' }} leading-tight tracking-tight" @if(!$isHomeSeo) style="color: #0E3B2C;" @endif>
            {!! $b['heading'] ?? '' !!}
          </h3>

          {{-- Paragraphs --}}
          @if(!empty($b['paragraphs']) && is_array($b['paragraphs']))
            @foreach($b['paragraphs'] as $p)
            <p class="font-inter text-base md:text-[17px] {{ $isHomeSeo ? 'text-[#4A5550]' : '' }} leading-relaxed w-full" @if(!$isHomeSeo) style="color: #000000;" @endif>
              {{ $p }}
            </p>
            @endforeach
          @elseif(!empty($b['text']))
            <p class="font-inter text-base md:text-[17px] {{ $isHomeSeo ? 'text-[#4A5550]' : '' }} leading-relaxed w-full" @if(!$isHomeSeo) style="color: #000000;" @endif>
              {{ $b['text'] }}
            </p>
          @endif
        </div>
        @endforeach
      @endif
    </div>
  </div>
</section>
