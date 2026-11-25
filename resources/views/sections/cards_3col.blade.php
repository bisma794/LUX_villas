<section class="max-w-[1280px] mx-auto px-6 py-20 font-source">
  <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
    <div>
      @if(!empty($c['eyebrow']))
      <p class="font-source text-xs font-semibold tracking-[0.22em] text-[#64736B] uppercase mb-3">{{ $c['eyebrow'] }}</p>
      @endif
      <h2 class="font-heading font-medium text-4xl md:text-[46px] leading-tight text-[#10221C]">{!! $c['heading_html'] ?? '' !!}</h2>
      @if(!empty($c['subtext']))
      <p class="mt-4 text-base md:text-lg text-[#64736B] font-source max-w-2xl leading-relaxed">{{ $c['subtext'] }}</p>
      @endif
    </div>
    @if(!empty($c['header_button_text']))
    <div class="shrink-0">
      <a href="{{ $c['header_button_link'] ?? '/villas-for-sale' }}" class="inline-flex items-center gap-2 bg-[#C4A06B] hover:bg-[#B38F5B] text-white text-xs md:text-sm font-semibold font-source px-6 py-3 rounded-md shadow-sm transition-colors">
        {{ $c['header_button_text'] }}
      </a>
    </div>
    @endif
  </div>

  <div class="grid md:grid-cols-3 gap-6">
    @foreach(($c['items'] ?? []) as $it)
    <div class="relative group overflow-hidden rounded-[12px] h-[360px] md:h-[390px] shadow-sm">
      {{-- Card background image with corner radius 12 --}}
      <img src="{{ asset($it['image'] ?? '') }}" alt="{{ $it['title'] ?? '' }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 rounded-[12px]">
      
      {{-- Gradient overlay: pseudo-after.png with dark green fade fallback --}}
      <div class="absolute inset-0 rounded-[12px] pointer-events-none bg-cover bg-bottom opacity-90 transition-opacity" style="background-image: url('{{ asset('images/pseudo-after.png') }}'); background-repeat: no-repeat; background-size: cover;"></div>
      
      {{-- Additional fallback gradient to guarantee text legibility --}}
      <div class="absolute inset-0 rounded-[12px] pointer-events-none bg-gradient-to-t from-[#0e271f]/85 via-[#0e271f]/35 to-transparent"></div>

      {{-- Card content at bottom --}}
      <div class="absolute inset-x-0 bottom-0 p-6 z-10 flex flex-col items-start font-source">
        <h3 class="font-source font-semibold text-xl md:text-[22px] text-white leading-snug drop-shadow-sm mb-3">
          {{ $it['title'] ?? '' }}
        </h3>
        <a href="{{ $it['link'] ?? '#' }}" class="inline-flex items-center justify-center bg-white hover:bg-neutral-100 text-[#10221C] text-xs font-semibold font-source rounded-full px-5 py-2 shadow-sm transition-colors">
          {{ $it['button_text'] ?? ($c['button_text'] ?? 'Explore More') }}
        </a>
      </div>
    </div>
    @endforeach
  </div>
</section>
