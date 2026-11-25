<section class="max-w-[1280px] mx-auto px-6 py-10">
  <h2 class="text-3xl">{!! $c['heading_html'] ?? '' !!}</h2>
  @if(!empty($c['subtext']))<p class="mt-4 text-lg text-neutral-600 leading-relaxed">{{ $c['subtext'] }}</p>@endif
  @if(!empty($c['button_text']))<button class="btn-dark mt-5">{{ $c['button_text'] }}</button>@endif
</section>
