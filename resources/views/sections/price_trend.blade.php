<section class="max-w-[1280px] mx-auto px-6 py-10">
  <h2 class="text-3xl">{!! $c['heading_html'] ?? '' !!}</h2>
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
</section>
