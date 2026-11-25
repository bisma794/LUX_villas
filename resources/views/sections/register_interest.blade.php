{{-- Disclaimer Section: Height 124px, Inter, Color #A7A7A7 --}}
@if(!empty($c['disclaimer']))
<section class="bg-white border-t border-neutral-100 flex items-center min-h-[124px] py-6 font-inter">
  <div class="max-w-[1280px] mx-auto px-6 w-full">
    <p class="font-inter text-[11px] md:text-xs text-[#A7A7A7] leading-relaxed max-w-5xl">
      {{ $c['disclaimer'] }}
    </p>
  </div>
</section>
@endif

{{-- Register Interest Section: Height 269px, Background #DADADA, Abhaya Libre Medium #0E1A14, Content #777777 --}}
<section class="bg-[#DADADA] min-h-[269px] flex items-center py-12 md:py-16 font-inter">
  <div class="max-w-[1280px] mx-auto px-6 w-full flex flex-col md:flex-row md:items-center md:justify-between gap-8">
    
    {{-- Left: Heading and Subtext --}}
    <div class="max-w-2xl">
      <h2 class="font-heading font-medium text-4xl md:text-[44px] text-[#0E1A14] leading-tight tracking-tight">
        {!! $c['heading_html'] ?? 'Register Your Interest' !!}
      </h2>
      @if(!empty($c['subtext']))
      <p class="mt-3 text-xs md:text-sm text-[#777777] font-inter leading-relaxed max-w-xl">
        {{ $c['subtext'] }}
      </p>
      @endif
    </div>

    {{-- Right: Buttons matching screenshot --}}
    <div class="flex flex-wrap items-center gap-3.5 shrink-0 font-inter">
      @if(!empty($c['button_text']))
      <a href="{{ $c['button_link'] ?? '/enquiry' }}" class="inline-flex items-center justify-center gap-2 bg-[#0E1A14] hover:bg-[#1b2f25] text-white text-xs md:text-sm font-semibold font-inter px-7 py-3.5 rounded-full shadow-sm transition-colors">
        <span>{{ $c['button_text'] }}</span>
      </a>
      @endif

      @if(!empty($c['phone_text']))
      <a href="{{ $c['phone_link'] ?? 'tel:+971500000000' }}" class="inline-flex items-center justify-center gap-2 bg-white hover:bg-neutral-50 text-[#0E1A14] text-xs md:text-sm font-semibold font-inter px-7 py-3.5 rounded-full shadow-xs transition-colors">
        {{-- Phone Icon --}}
        <svg class="w-3.5 h-3.5 text-[#0E1A14]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        <span>{{ $c['phone_text'] }}</span>
      </a>
      @endif
    </div>

  </div>
</section>
