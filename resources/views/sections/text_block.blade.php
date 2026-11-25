<section class="max-w-[1280px] mx-auto px-6 py-10">
  @if(!empty($c['breadcrumb']))<p class="text-sm tracking-widest text-neutral-500">{{ $c['breadcrumb'] }}</p>@endif
  @if(!empty($c['eyebrow']))<p class="eyebrow text-[#B9975B]">{{ $c['eyebrow'] }}</p>@endif
  <h2 class="text-4xl md:text-5xl mt-4">{!! $c['heading_html'] ?? '' !!}</h2>
  @if(!empty($c['subtext']))<p class="mt-4 text-xl text-neutral-600 max-w-3xl leading-relaxed">{{ $c['subtext'] }}</p>@endif
  @if(!empty($c['button_text']))<a href="{{ $c['button_link'] ?? '#' }}" class="btn-tan mt-8">{{ $c['button_text'] }}</a>@endif
</section>
