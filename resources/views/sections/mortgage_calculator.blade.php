@php $m = $c['mortgage'] ?? $c; @endphp
<section class="max-w-[1280px] mx-auto px-6 py-10">
  <h2 class="text-3xl">{{ $m['heading'] ?? '' }}</h2>
  @if(!empty($m['subtext']))<p class="mt-2 text-lg text-neutral-600">{{ $m['subtext'] }}</p>@endif
  <div class="border rounded-2xl p-6 mt-5" data-mortgage>
    <div class="grid md:grid-cols-2 gap-5">
      <label class="block"><span class="text-sm font-semibold text-neutral-500">UAE Residency Status</span><select class="mt-2 w-full border rounded-lg px-3 py-3"><option>Resident</option><option>National</option><option>Non-Resident</option></select></label>
      <label class="block"><span class="text-sm font-semibold text-neutral-500">Property Price (AED)</span><input data-price type="text" value="{{ $m['price'] ?? '' }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
      <label class="block"><span class="text-sm font-semibold text-neutral-500">Down Payment %</span><input data-down-pct type="number" value="{{ $m['down_pct'] ?? '' }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
      <label class="block"><span class="text-sm font-semibold text-neutral-500">Loan Term (years)</span><input data-years type="number" value="{{ $m['years'] ?? '' }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
      <label class="block"><span class="text-sm font-semibold text-neutral-500">Interest rate %</span><input data-rate type="number" step="0.01" value="{{ $m['rate'] ?? '' }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    </div>
    <div class="bg-[#10221C] text-white rounded-2xl p-6 mt-6 text-center">
      <p class="text-neutral-300">Estimated monthly payment</p>
      <p class="font-serif text-4xl mt-2" data-out-monthly>{{ $m['monthly'] ?? '' }}</p>
      <p class="text-neutral-300 mt-2">Based on a loan of <span data-out-loan>{{ $m['loan'] ?? '' }}</span> · Down payment <span data-out-down>{{ $m['down'] ?? '' }}</span></p>
      <p class="text-neutral-400 mt-2 text-sm"><span data-out-total>{{ $m['total_line'] ?? '' }}</span></p>
    </div>
    <p class="font-semibold mt-5">Monthly payment breakdown</p>
    <div class="h-4 rounded-full overflow-hidden flex mt-3"><div class="bg-[#10221C]" style="width:72%"></div><div class="bg-[#B9975B]" style="width:28%"></div></div>
    @if(!empty($m['button_text']))<a href="{{ $m['button_link'] ?? '#' }}" class="btn-tan mt-6">{{ $m['button_text'] }}</a>@endif
  </div>
</section>
