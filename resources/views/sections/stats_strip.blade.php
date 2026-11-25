<section class="bg-white py-14 md:py-20 font-inter">
  <div class="max-w-[1280px] mx-auto px-6">
    {{-- 4 Dark Green Rounded Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach(($c['items'] ?? []) as $it)
      <div class="bg-[#0E3B2C] text-white rounded-[14px] p-7 md:p-8 flex flex-col justify-center min-h-[140px] shadow-sm">
        {{-- Stat Number: Fraunces / Serif Medium --}}
        <p class="font-fraunces font-medium text-4xl md:text-[44px] leading-none text-white tracking-tight">
          {{ $it['value'] ?? '' }}
        </p>
        {{-- Stat Label: Inter --}}
        <p class="mt-3.5 text-xs md:text-[13px] text-white/80 font-inter leading-snug">
          {{ $it['label'] ?? '' }}
        </p>
      </div>
      @endforeach
    </div>
  </div>
</section>
