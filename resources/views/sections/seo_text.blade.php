<section class="bg-[#FAF8F5] py-20 md:py-24 font-inter">
  <div class="max-w-[1280px] mx-auto px-6">
    <div class="w-full space-y-12">
      @if(!empty($c['full_content']))
        <div class="prose max-w-none text-[#4A5550] leading-relaxed [&_h2]:text-[#C5A47E] [&_h2]:font-bold [&_h2]:text-2xl md:[&_h2]:text-[28px] [&_h2]:mb-4 [&_h3]:text-[#C5A47E] [&_h3]:font-bold [&_h3]:text-2xl md:[&_h3]:text-[28px] [&_h3]:mb-4 [&_p]:text-base md:[&_p]:text-[17px] [&_p]:leading-relaxed [&_p]:mb-5">
          {!! $c['full_content'] !!}
        </div>
      @else
        @foreach(($c['blocks'] ?? []) as $b)
        <div class="space-y-5">
          {{-- Headings: Inter, Color #C5A47E, larger font --}}
          <h3 class="font-inter font-bold text-2xl md:text-[28px] text-[#C5A47E] leading-tight tracking-tight">
            {!! $b['heading'] ?? '' !!}
          </h3>

          {{-- Paragraphs: Full left-to-right alignment across the container, larger font size (16px - 18px), legible gray --}}
          @if(!empty($b['paragraphs']) && is_array($b['paragraphs']))
            @foreach($b['paragraphs'] as $p)
            <p class="font-inter text-base md:text-[17px] text-[#4A5550] leading-relaxed w-full">
              {{ $p }}
            </p>
            @endforeach
          @elseif(!empty($b['text']))
            <p class="font-inter text-base md:text-[17px] text-[#4A5550] leading-relaxed w-full">
              {{ $b['text'] }}
            </p>
          @endif
        </div>
        @endforeach
      @endif
    </div>
  </div>
</section>
