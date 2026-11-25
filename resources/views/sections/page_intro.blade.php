<section class="max-w-[1280px] mx-auto px-6 pt-12 pb-6">
  @if(!empty($c['breadcrumb']))<p class="text-sm tracking-widest text-neutral-500">{{ $c['breadcrumb'] }}</p>@endif
  <h1 class="text-5xl md:text-6xl mt-4">{!! $c['heading_html'] ?? '' !!}</h1>
  @if(!empty($c['subtext']))<p class="mt-5 text-xl text-neutral-600 max-w-2xl">{{ $c['subtext'] }}</p>@endif
</section>
