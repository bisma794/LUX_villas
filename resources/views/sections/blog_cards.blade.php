<section class="bg-[#FAF8F5] py-20 font-source">
  <div class="max-w-[1280px] mx-auto px-6">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
      
      {{-- Left Card: Compare. Analyse, Decide. --}}
      <div class="lg:col-span-5 bg-white rounded-[20px] p-8 md:p-12 shadow-[0_4px_25px_rgba(0,0,0,0.03)] border border-[#EBECEB] flex flex-col justify-between">
        <div>
          <h2 class="font-heading font-semibold text-4xl md:text-[46px] leading-[1.15] text-[#151515] tracking-tight">
            {!! $c['compare_heading'] ?? ($c['heading_html'] ?? 'Compare.<br>Analyse, Decide.') !!}
          </h2>
          <p class="mt-6 text-sm md:text-base text-[#64736B] font-source leading-relaxed max-w-sm">
            {{ $c['compare_subtext'] ?? ($c['subtext'] ?? 'Use our property comparison tool to evaluate pricing, yields, payment plans and more.') }}
          </p>
        </div>

        <div class="mt-10">
          <a href="{{ $c['compare_button_link'] ?? '/villas-for-sale' }}" class="inline-flex items-center justify-center bg-[#C4A06B] hover:bg-[#B38F5B] text-white text-xs md:text-sm font-semibold font-source px-6 py-3 rounded-[8px] shadow-sm transition-colors">
            {{ $c['compare_button_text'] ?? 'Compare Properties →' }}
          </a>
        </div>
      </div>

      {{-- Right Card: Latest Market Insights Container --}}
      <div class="lg:col-span-7 bg-white rounded-[20px] p-8 md:p-10 shadow-[0_4px_25px_rgba(0,0,0,0.03)] border border-[#EBECEB] flex flex-col justify-between">
        <h3 class="font-heading font-semibold text-2xl md:text-[26px] text-[#151515] mb-6">
          {{ $c['insights_heading'] ?? 'Latest Market Insights' }}
        </h3>

        {{-- 3 Article Cards Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
          @foreach(($c['items'] ?? []) as $b)
          <div class="flex flex-col justify-between group">
            <div>
              <div class="overflow-hidden rounded-[10px] h-[130px] w-full mb-3 shadow-xs">
                <img src="{{ asset($b['image'] ?? '') }}" alt="{{ $b['title'] ?? '' }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 rounded-[10px]">
              </div>
              <h4 class="font-source font-semibold text-xs md:text-[13px] text-[#151515] leading-snug line-clamp-3">
                {{ $b['title'] ?? '' }}
              </h4>
            </div>

            {{-- Date Pill Bar at Bottom --}}
            <a href="{{ $b['link'] ?? '/blog' }}" class="mt-4 flex items-center justify-between bg-[#122A21] hover:bg-[#1b3d30] text-white px-3 py-1.5 rounded-full text-[11px] font-source transition-colors">
              <span>{{ $b['date'] ?? ($b['meta'] ?? '16 Apr 2025') }}</span>
              <span class="text-xs">›</span>
            </a>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>
