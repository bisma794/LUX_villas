<section class="max-w-[1280px] mx-auto px-6 py-20 font-source" data-tabs>
  {{-- Main Section Heading: Abhaya Libre Medium --}}
  @if(!empty($c['heading_html']))
  <h2 class="font-heading font-medium text-4xl md:text-[46px] text-[#10221C] leading-tight mb-8">
    {!! $c['heading_html'] !!}
  </h2>
  @endif

  {{-- Tabs: Villas / Town Houses (Buttons in Inter) --}}
  @if(!empty($c['tabs']))
  <style>
    .lux-listing-tab {
      background-color: transparent;
      color: #525252;
      border: 1px solid #e5e5e5;
      transition: all 0.15s ease;
    }
    .lux-listing-tab:hover,
    .lux-listing-tab.active-tab {
      background-color: #B38855 !important;
      color: #ffffff !important;
      border-color: #B38855 !important;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    }
  </style>
  <div class="flex gap-3 mb-10 font-inter">
    @foreach($c['tabs'] as $i => $t)
    <button
      type="button"
      data-tab="{{ $t['key'] }}"
      class="lux-listing-tab px-7 py-2.5 rounded-[8px] text-sm font-medium font-inter cursor-pointer {{ $i === 0 ? 'active-tab' : '' }}"
    >
      {{ $t['label'] }}
    </button>
    @endforeach
  </div>

  @php
    $assignedListings = $c['assigned_listings'] ?? null;
    $allOffplan = \App\Http\Controllers\Admin\EntityController::getAvailableOffplanProjects();
    $allReady = \App\Http\Controllers\Admin\EntityController::getAvailableReadyProjects();

    $mergedProps = [];
    foreach ($allReady as $p) {
      $mergedProps[$p['slug']] = [
        'tag' => 'READY',
        'image' => $p['image'],
        'title' => $p['name'],
        'location' => $p['location'],
        'beds' => '4-5 Beds',
        'baths' => '5 Baths',
        'sqft' => '4,100 sq ft',
        'price' => $p['price'],
        'gross_yield' => '5.6%',
        'link' => $p['url'],
      ];
    }
    foreach ($allOffplan as $p) {
      if (!isset($mergedProps[$p['slug']])) {
        $mergedProps[$p['slug']] = [
          'tag' => 'OFF-PLAN',
          'image' => $p['image'],
          'title' => $p['name'],
          'location' => $p['location'],
          'beds' => '3-4 Beds',
          'baths' => '4 Baths',
          'sqft' => '2,400 sq ft',
          'price' => $p['price'],
          'gross_yield' => '6.8%',
          'link' => $p['url'],
        ];
      }
    }

    $customAssignedItems = [];
    if (!empty($assignedListings) && is_array($assignedListings)) {
      foreach ($assignedListings as $aslug) {
        if (isset($mergedProps[$aslug])) {
          $customAssignedItems[] = $mergedProps[$aslug];
        }
      }
    }
  @endphp

  @foreach($c['tabs'] as $i => $t)
  @php 
    if (!empty($customAssignedItems)) {
      $isTownhouseTab = str_contains(strtolower($t['key'] . ' ' . $t['label']), 'town');
      $filtered = array_values(array_filter($customAssignedItems, function ($it) use ($isTownhouseTab) {
        $isTown = str_contains(strtolower(($it['title'] ?? '') . ' ' . ($it['link'] ?? '')), 'townhouse');
        return $isTownhouseTab ? $isTown : !$isTown;
      }));
      $panel = !empty($filtered) ? $filtered : (($c['panels'] ?? [])[$t['key']] ?? $customAssignedItems);
    } else {
      $panel = ($c['panels'] ?? [])[$t['key']] ?? [];
    }
  @endphp
  <div data-panel="{{ $t['key'] }}" class="{{ $i === 0 ? '' : 'hidden' }}">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
      @foreach($panel as $item)
      {{-- Property Card: Corner Radius 14 --}}
      <div class="bg-white border border-[#E8ECE9] rounded-[14px] overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_6px_25px_rgba(0,0,0,0.08)] transition-all flex flex-col font-source">
        {{-- Card Image with Tag --}}
        <div class="relative h-[220px] w-full overflow-hidden bg-neutral-100">
          <img src="{{ asset($item['image'] ?? '') }}" alt="{{ $item['title'] ?? '' }}" class="w-full h-full object-cover">
          @if(!empty($item['tag']))
          <span class="absolute top-3.5 left-3.5 bg-[#1B2A24]/90 text-white text-[10px] font-semibold tracking-wider uppercase px-2.5 py-1 rounded-[4px] font-inter">
            {{ $item['tag'] }}
          </span>
          @endif
        </div>

        {{-- Card Details --}}
        <div class="p-5 flex flex-col flex-1 justify-between">
          <div>
            {{-- Card Heading: Abhaya Libre Medium --}}
            <h3 class="font-heading font-medium text-2xl text-[#10221C] leading-snug">
              {{ $item['title'] ?? '' }}
            </h3>
            {{-- Location --}}
            <p class="font-source text-xs text-[#64736B] mt-1">
              {{ $item['location'] ?? '' }}
            </p>

            {{-- Specs: Beds, Baths, Sqft with SVG icons --}}
            <div class="flex items-center gap-4 py-3.5 my-3 border-y border-[#F0F2F1] text-xs text-[#64736B] font-source">
              <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-[#8C9B93]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                {{ $item['beds'] ?? '4 Beds' }}
              </span>
              <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-[#8C9B93]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                {{ $item['baths'] ?? '5 Baths' }}
              </span>
              <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-[#8C9B93]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                {{ $item['sqft'] ?? '4,100 sq ft' }}
              </span>
            </div>

            {{-- Price & Gross Yield --}}
            <div class="flex items-baseline justify-between mb-4">
              <div>
                {{-- Price: Fraunces --}}
                <span class="font-fraunces font-medium text-2xl text-[#10221C]">
                  {{ $item['price'] ?? '' }}
                </span>
              </div>
              <div class="text-right">
                <span class="block text-[10px] uppercase font-source text-neutral-400">Gross yield</span>
                <span class="font-source font-semibold text-xs text-[#B38855]">{{ $item['gross_yield'] ?? '5.4%' }}</span>
              </div>
            </div>
          </div>

          {{-- Buttons: View Details (Source Sans 3) & Compare --}}
          <div class="grid grid-cols-2 gap-2.5 pt-1">
            <a href="{{ $item['link'] ?? '#' }}" class="inline-flex items-center justify-center bg-[#B38855] hover:bg-[#a17846] text-white text-xs font-semibold font-source py-2.5 px-3 rounded-[6px] shadow-sm transition-colors text-center">
              View Details
            </a>
            <button type="button" class="inline-flex items-center justify-center bg-white hover:bg-neutral-50 text-neutral-600 text-xs font-source py-2.5 px-3 rounded-[6px] border border-neutral-200 transition-colors text-center">
              + Compare
            </button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endforeach
  @endif
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('[data-tabs]').forEach(function(section) {
    const tabBtns = section.querySelectorAll('.lux-listing-tab[data-tab]');
    const panels = section.querySelectorAll('[data-panel]');
    tabBtns.forEach(function(btn) {
      btn.addEventListener('click', function() {
        const key = btn.getAttribute('data-tab');
        tabBtns.forEach(function(b) { b.classList.remove('active-tab'); });
        btn.classList.add('active-tab');
        panels.forEach(function(p) {
          p.classList.toggle('hidden', p.getAttribute('data-panel') !== key);
        });
      });
    });
  });
});
</script>
