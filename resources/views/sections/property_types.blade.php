<section class="max-w-[1280px] mx-auto px-6 py-10">
  <h2 class="text-3xl">{!! $c['heading_html'] ?? '' !!}</h2>
  @foreach(($c['types'] ?? []) as $t)
  <div class="border rounded-2xl p-6 mt-5 flex flex-wrap justify-between items-center gap-4">
    <div><p class="font-bold text-xl">{{ $t['title'] ?? '' }}</p><p class="text-[#B9975B] font-bold text-2xl mt-1">{{ $t['price'] ?? '' }}</p></div>
    <div class="flex gap-3">@if(!empty($t['button_text']))<button class="chip">{{ $t['button_text'] }}</button>@endif @if(!empty($t['button2_text']))<a href="{{ $t['button2_link'] ?? '#' }}" class="btn-tan !py-2.5">{{ $t['button2_text'] }}</a>@endif</div>
  </div>
  @endforeach
</section>
