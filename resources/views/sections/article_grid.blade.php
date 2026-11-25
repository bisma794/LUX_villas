<section class="max-w-[1280px] mx-auto px-6 py-16">
  <div class="grid md:grid-cols-3 gap-6">
    @foreach(($c['items'] ?? []) as $b)
    <article class="border rounded-2xl overflow-hidden"><img src="{{ asset($b['image'] ?? '') }}" alt="{{ $b['title'] ?? '' }}" class="w-full h-[220px] object-cover"><div class="p-5"><span class="text-xs font-bold tracking-widest bg-[#10221C] text-white rounded-full px-3 py-1">{{ $b['badge'] ?? '' }}</span><p class="text-sm text-neutral-500 mt-3">{{ $b['meta'] ?? '' }}</p><h3 class="text-2xl mt-2">{{ $b['title'] ?? '' }}</h3><span class="text-[#B9975B] font-semibold mt-3 inline-block">{{ $c['link_text'] ?? '' }}</span></div></article>
    @endforeach
  </div>
  @if(!empty($c['communities_heading_html']))
  <h2 class="text-4xl md:text-5xl mt-20">{!! $c['communities_heading_html'] !!}</h2>
  <div class="grid md:grid-cols-3 gap-6 mt-8">
    @foreach(($c['communities'] ?? []) as $com)
    <a href="{{ $com['link'] ?? '#' }}" class="block"><img src="{{ asset($com['image'] ?? '') }}" alt="{{ $com['title'] ?? '' }}" class="card-img h-[240px]"><h3 class="text-2xl mt-4">{{ $com['title'] ?? '' }}</h3><span class="text-[#B9975B] font-semibold">{{ $c['communities_link_text'] ?? '' }}</span></a>
    @endforeach
  </div>
  @endif
</section>
