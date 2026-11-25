<section class="relative">
  <img src="{{ asset($c['image'] ?? '') }}" alt="{{ $c['image_alt'] ?? '' }}" class="w-full h-[420px] object-cover">
  <div class="absolute inset-0 bg-black/45"></div>
  <div class="absolute inset-0 flex items-center"><div class="max-w-[1280px] mx-auto px-6 w-full text-white text-center">
    @if(!empty($c['eyebrow']))<p class="eyebrow text-white/80">{{ $c['eyebrow'] }}</p>@endif
    <h2 class="text-4xl md:text-6xl mt-4">{!! $c['heading_html'] ?? '' !!}</h2>
    @if(!empty($c['subtext']))<p class="mt-4 text-xl">{{ $c['subtext'] }}</p>@endif
    @if(!empty($c['button_text']))<a href="{{ $c['button_link'] ?? '#' }}" class="btn-tan mt-8">{{ $c['button_text'] }}</a>@endif
  </div></div>
</section>
