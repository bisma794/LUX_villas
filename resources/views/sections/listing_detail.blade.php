<section class="max-w-[1280px] mx-auto px-6 py-10 font-inter">
  <div class="grid lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2">
      <p class="text-[#B9975B] font-bold text-4xl">{{ $c['price'] ?? '' }}</p>
      <h1 class="text-4xl md:text-5xl mt-3">{!! $c['heading_html'] ?? '' !!}</h1>
      <p class="mt-3 text-xl text-neutral-600">{{ $c['subtext'] ?? '' }}</p>
      <h2 class="text-3xl mt-10">{{ $c['overview_heading'] ?? '' }}</h2>
      <p class="mt-4 text-lg text-neutral-600 leading-relaxed">{{ $c['overview_text'] ?? '' }}</p>
      @if(!empty($c['button_text']))<button class="btn-dark mt-5">{{ $c['button_text'] }}</button>@endif
      <h2 class="text-3xl mt-12">{{ $c['amenities_heading'] ?? '' }}</h2>
      <div class="flex flex-wrap gap-3 mt-5">@foreach(($c['amenities'] ?? []) as $a)<span class="chip">{{ $a }}</span>@endforeach</div>
      <h2 class="text-3xl mt-12">{{ $c['location_heading'] ?? '' }}</h2>
      <p class="mt-3 text-lg text-neutral-600">{{ $c['location_text'] ?? '' }}</p>
      @if(!empty($c['location_image']))<img src="{{ asset($c['location_image']) }}" alt="{{ $c['location_image_alt'] ?? '' }}" class="card-img h-[320px] mt-4">@endif
      @if(!empty($c['button2_text']))<a href="{{ $c['button2_link'] ?? '#' }}" class="btn-tan mt-5">{{ $c['button2_text'] }}</a>@endif
      <h2 class="text-3xl mt-12">{{ $c['trend_heading'] ?? '' }}</h2>
      <p class="mt-3 text-lg">{!! $c['trend_text'] ?? '' !!}</p>
      <div class="border rounded-2xl p-6 mt-5">
        <p class="font-semibold">Price Trend</p>
        <svg viewBox="0 0 600 180" class="w-full mt-3"><polyline points="0,140 80,120 160,130 240,90 320,100 400,60 480,70 600,30" fill="none" stroke="#10221C" stroke-width="3"/><line x1="0" y1="160" x2="600" y2="160" stroke="#ddd"/></svg>
        <p class="font-semibold mt-6">Unit Volume</p>
        <div class="flex items-end gap-3 h-32 mt-3">
          @foreach(($c['trend_bars'] ?? []) as $h)<div class="flex-1 bg-[#B9975B] rounded-t" style="height:{{ $h }}%"></div>@endforeach
        </div>
        <div class="grid grid-cols-3 gap-4 mt-6 text-center">
          @foreach(($c['trend_stats'] ?? []) as $st)<div><p class="font-serif text-3xl">{{ $st['value'] ?? '' }}</p><p class="text-sm text-neutral-500">{{ $st['label'] ?? '' }}</p></div>@endforeach
        </div>
      </div>
      <h2 class="text-3xl mt-12">{{ $c['similar_heading'] ?? '' }}</h2>
      <div class="grid sm:grid-cols-2 gap-6 mt-6">
        @foreach(($c['similar'] ?? []) as $s)
        <a href="{{ $s['link'] ?? '#' }}" class="block border rounded-2xl overflow-hidden"><img src="{{ asset($s['image'] ?? '') }}" alt="{{ $s['title'] ?? '' }}" class="w-full h-[200px] object-cover"><div class="p-5"><h3 class="text-2xl">{{ $s['title'] ?? '' }}</h3><p class="text-[#B9975B] font-bold text-xl mt-2">{{ $s['price'] ?? '' }}</p></div></a>
        @endforeach
      </div>
    </div>
    <aside class="space-y-6">
      <div class="border rounded-2xl p-6">
        <div class="flex items-center gap-4"><img src="{{ asset($c['agent_image'] ?? '') }}" alt="{{ $c['agent_name'] ?? '' }}" class="w-16 h-16 rounded-full object-cover"><div><p class="font-bold text-xl">{{ $c['agent_name'] ?? '' }}</p><p class="text-neutral-500">{{ $c['agent_role'] ?? '' }}</p></div></div>
        <div class="grid grid-cols-3 gap-2 mt-5"><button class="btn-dark !px-3 justify-center text-sm">Call</button><button class="btn-tan !px-3 justify-center text-sm">Email</button><button class="btn-wa !px-3 justify-center text-sm">WhatsApp</button></div>
      </div>
      <div class="bg-[#B9975B] text-white rounded-2xl p-6"><p class="font-serif text-2xl">{{ $c['mortgage_title'] ?? '' }}</p><p class="mt-2 text-white/90">{{ $c['mortgage_text'] ?? '' }}</p><a href="{{ $c['mortgage_button_link'] ?? '#' }}" class="inline-block mt-4 bg-white text-[#10221C] rounded-full px-5 py-2.5 font-semibold">{{ $c['mortgage_button_text'] ?? '' }}</a></div>
    </aside>
  </div>
</section>
