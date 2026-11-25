@php
  $faqItems = !empty($c['faqs']) && is_array($c['faqs']) ? $c['faqs'] : [
    ['q' => 'What Is Lux Villa Dubai?', 'a' => 'LUX Villa Dubai is a luxury real estate advisory and portfolio showcasing curated villas, townhouses, and premier off-plan opportunities across Dubai\'s most prestigious neighborhoods.'],
    ['q' => 'Who Is The Developer Behind Lux Villa Dubai?', 'a' => 'We partner directly with leading developers including Emaar, Nakheel, Meraas, Sobha, and Damac to bring you verified, tier-one properties with developer-direct pricing.'],
    ['q' => 'Where Is Lux Villa Dubai Located?', 'a' => 'Our flagship properties span prime Dubai locations including Palm Jumeirah, Dubai Hills Estate, Emirates Hills, The Valley, and Emaar South.'],
    ['q' => 'What Types Of Properties Are Available In Lux Villa Dubai?', 'a' => 'We specialize exclusively in luxury standalone villas, modern semi-detached homes, waterfront townhouses, and signature branded estates.'],
    ['q' => 'Is Lux Villa Dubai A Good Investment Opportunity?', 'a' => 'Yes, our properties are curated for strong capital appreciation and attractive rental yields (typically 6% - 8%+ gross yields) in zero capital gains tax jurisdictions.'],
    ['q' => 'Does Lux Villa Dubai Have Government Or Authority Backing?', 'a' => 'All advertised projects are 100% compliant and registered with the Dubai Land Department (DLD) and the Real Estate Regulatory Agency (RERA), with secure escrow accounts.'],
  ];
@endphp
<section class="bg-[#0E1A14] text-white py-24 font-inter">
  <div class="max-w-[960px] mx-auto px-6">
    
    {{-- Eyebrow & Heading: Inria Serif, Center-aligned --}}
    <div class="text-center mb-14">
      @if(!empty($c['eyebrow']))
      <p class="font-inter text-xs font-semibold tracking-[0.25em] text-[#C5A47E] uppercase mb-3">
        {{ $c['eyebrow'] }}
      </p>
      @endif
      <h2 class="font-inria text-4xl md:text-[50px] font-normal leading-tight text-white tracking-tight">
        {!! $c['heading_html'] ?? 'Frequently asked questions' !!}
      </h2>
    </div>

    {{-- FAQ Pill Accordion Items (Matching screenshot exact rounded white cards) --}}
    <div class="space-y-3.5 font-inter">
      @foreach($faqItems as $f)
      <div class="faq-item bg-white text-[#151515] rounded-[10px] shadow-sm overflow-hidden transition-all duration-200">
        <button type="button" class="faq-q w-full flex justify-between items-center px-6 py-4.5 text-left text-sm md:text-[15px] font-semibold text-[#151515] cursor-pointer select-none hover:bg-neutral-50/80 transition-colors">
          <span>{{ $f['q'] ?? '' }}</span>
          <span class="faq-plus text-xl font-light text-neutral-500 shrink-0 ml-4 transition-transform duration-200">+</span>
        </button>
        <div class="faq-a px-6 pb-5 pt-1 text-xs md:text-sm text-[#64736B] leading-relaxed border-t border-neutral-100 hidden">
          {{ $f['a'] ?? '' }}
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>
