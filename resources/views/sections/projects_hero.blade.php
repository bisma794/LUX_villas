@php
  use App\Http\Controllers\Admin\EntityController;
  $heroImg = !empty($c['image']) ? $c['image'] : 'images/house-white.jpg';
  $heroBreadcrumb = array_key_exists('breadcrumb', $c) ? $c['breadcrumb'] : 'HOME > PROJECT';
  $heroCrumbParts = $heroBreadcrumb !== '' ? array_values(array_filter(array_map('trim', explode('>', $heroBreadcrumb)))) : [];
  $heroHeading = array_key_exists('heading_html', $c)
    ? $c['heading_html']
    : 'Buy your villa <br> with <span class="font-script font-normal text-[52px] sm:text-[64px] md:text-[80px] lowercase tracking-normal -ml-1 text-[#0E3B2C]">confidence.</span>';

  $communityStore = EntityController::getCommunityStore();
  $offplanStore = EntityController::getOffplanProjectStore();
  $readyProjects = EntityController::getAvailableReadyProjects();

  $locationSuggestions = [];
  foreach ($communityStore as $cm) {
    if (!empty($cm['name'])) $locationSuggestions[] = $cm['name'];
  }
  foreach ($offplanStore as $op) {
    if (!empty($op['name'])) $locationSuggestions[] = $op['name'];
    if (!empty($op['city'])) $locationSuggestions[] = $op['city'];
  }
  foreach ($readyProjects as $rp) {
    if (!empty($rp['name'])) $locationSuggestions[] = $rp['name'];
    if (!empty($rp['location'])) $locationSuggestions[] = $rp['location'];
  }
  $locationSuggestions = array_values(array_unique(array_filter($locationSuggestions)));

  $locPlaceholder = array_key_exists('location_placeholder', $c) && $c['location_placeholder'] !== ''
    ? $c['location_placeholder']
    : 'Community, project or developer';
  $typesRaw = !empty($c['search_types']) ? $c['search_types'] : 'Villa, Townhouse, Apartment, Penthouse';
  $typeOptions = array_values(array_filter(array_map('trim', explode(',', $typesRaw))));

  $budgetsRaw = !empty($c['search_budgets']) ? $c['search_budgets'] : 'Under AED 2M, AED 2M - 5M, AED 5M - 10M, AED 10M+';
  $budgetOptions = array_values(array_filter(array_map('trim', explode(',', $budgetsRaw))));

  $handoversRaw = !empty($c['search_handovers']) ? $c['search_handovers'] : 'Ready, 2026, 2027, 2028, 2029, 2030';
  $handoverOptions = array_values(array_filter(array_map('trim', explode(',', $handoversRaw))));

  $searchBtnLabel = array_key_exists('button_text', $c) && $c['button_text'] !== '' ? $c['button_text'] : 'Search';
@endphp

<style>
  .proj-mode-tab {
    background-color: rgba(255, 255, 255, 0.92);
    color: #404040;
    transition: all 0.15s ease;
  }
  .proj-mode-tab:hover {
    background-color: #ffffff;
    color: #10221C;
  }
  .proj-mode-tab.active {
    background-color: #C5A47E !important;
    color: #ffffff !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
  }
</style>

<section class="relative min-h-[480px] md:min-h-[540px] flex items-center overflow-hidden bg-neutral-100 font-inter" id="projects-hero-section">
  {{-- Hero Background Image --}}
  <img src="{{ asset($heroImg) }}" alt="{{ $c['image_alt'] ?? 'Buy your villa with confidence' }}" class="absolute inset-0 w-full h-full object-cover object-right md:object-center">
  
  {{-- Soft white gradient on the left for text legibility --}}
  <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/80 to-transparent"></div>

  {{-- Hero Content Container --}}
  <div class="relative z-10 max-w-[1280px] mx-auto px-6 w-full pt-12 pb-24">
    <div class="max-w-2xl">
      {{-- Breadcrumb --}}
      @if(!empty($heroCrumbParts))
      <div class="flex items-center gap-1.5 text-xs text-neutral-600 font-medium font-inter mb-4">
        <span>•</span>
        @foreach($heroCrumbParts as $idx => $part)
          @if($idx > 0)<span>&rsaquo;</span>@endif
          @if($idx === 0)
            <a href="/" class="hover:text-black">{{ $part }}</a>
          @elseif($loop->last)
            <span class="text-neutral-800">{{ $part }}</span>
          @else
            <span>{{ $part }}</span>
          @endif
        @endforeach
      </div>
      @endif

      {{-- Main Heading --}}
      @if($heroHeading !== '')
      <h1 class="font-heading font-medium text-4xl sm:text-5xl md:text-[64px] text-[#0E3B2C] leading-[1.1] tracking-tight">
        {!! $heroHeading !!}
      </h1>
      @endif

      {{-- Tab Buttons: Buy, Rent, Offplan --}}
      <div class="flex items-center gap-2.5 mt-8" id="proj-mode-tabs">
        <button type="button" data-proj-mode="buy" class="proj-mode-tab active w-24 sm:w-28 py-2.5 rounded-[8px] text-xs font-semibold font-inter cursor-pointer text-center">
          Buy
        </button>
        <button type="button" data-proj-mode="rent" class="proj-mode-tab w-24 sm:w-28 py-2.5 rounded-[8px] text-xs font-semibold font-inter cursor-pointer text-center">
          Rent
        </button>
        <button type="button" data-proj-mode="offplan" class="proj-mode-tab w-24 sm:w-28 py-2.5 rounded-[8px] text-xs font-semibold font-inter cursor-pointer text-center">
          Offplan
        </button>
      </div>
    </div>
  </div>

  {{-- Floating Search Bar at Bottom connected directly to Database --}}
  <div class="absolute bottom-4 inset-x-0 z-20 max-w-[1280px] mx-auto px-6">
    <form onsubmit="event.preventDefault(); runProjectsFilter(true);" class="bg-white rounded-[14px] shadow-lg border border-neutral-200 p-2 sm:p-2.5 flex flex-col md:flex-row items-center justify-between gap-3 font-inter">
      
      {{-- 1. Location --}}
      <div class="flex-1 w-full md:w-auto flex items-center gap-3 px-3 py-1.5 md:border-r border-neutral-200">
        <svg class="w-4 h-4 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <div class="min-w-0 flex-1">
          <label for="proj-search-location" class="block text-xs font-semibold text-[#10221C]">Location</label>
          <input
            id="proj-search-location"
            type="text"
            list="proj-locations-datalist"
            placeholder="{{ $locPlaceholder }}"
            oninput="runProjectsFilter(false)"
            class="w-full text-[11px] text-neutral-700 placeholder-neutral-400 bg-transparent focus:outline-none truncate"
          >
          <datalist id="proj-locations-datalist">
            @foreach($locationSuggestions as $locName)
              <option value="{{ $locName }}"></option>
            @endforeach
          </datalist>
        </div>
      </div>

      {{-- 2. Property type --}}
      <div class="flex-1 w-full md:w-auto flex items-center gap-3 px-3 py-1.5 md:border-r border-neutral-200">
        <svg class="w-4 h-4 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        <div class="min-w-0 flex-1">
          <label for="proj-search-type" class="block text-xs font-semibold text-[#10221C]">Property type</label>
          <select id="proj-search-type" onchange="runProjectsFilter(false)" class="w-full text-[11px] text-neutral-600 bg-transparent focus:outline-none cursor-pointer">
            <option value="">Any type</option>
            @foreach($typeOptions as $tOpt)
              <option value="{{ strtolower($tOpt) }}">{{ $tOpt }}</option>
            @endforeach
          </select>
        </div>
      </div>

      {{-- 3. Budget --}}
      <div class="flex-1 w-full md:w-auto flex items-center gap-3 px-3 py-1.5 md:border-r border-neutral-200">
        <span class="text-sm font-bold text-neutral-400 shrink-0">$</span>
        <div class="min-w-0 flex-1">
          <label for="proj-search-budget" class="block text-xs font-semibold text-[#10221C]">Budget</label>
          <select id="proj-search-budget" onchange="runProjectsFilter(false)" class="w-full text-[11px] text-neutral-600 bg-transparent focus:outline-none cursor-pointer">
            <option value="">Any price</option>
            @foreach($budgetOptions as $bOpt)
              <option value="{{ strtolower($bOpt) }}">{{ $bOpt }}</option>
            @endforeach
          </select>
        </div>
      </div>

      {{-- 4. Handover --}}
      <div class="flex-1 w-full md:w-auto flex items-center gap-3 px-3 py-1.5">
        <svg class="w-4 h-4 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        <div class="min-w-0 flex-1">
          <label for="proj-search-handover" class="block text-xs font-semibold text-[#10221C]">Handover</label>
          <select id="proj-search-handover" onchange="runProjectsFilter(false)" class="w-full text-[11px] text-neutral-600 bg-transparent focus:outline-none cursor-pointer">
            <option value="">Any date</option>
            @foreach($handoverOptions as $hOpt)
              <option value="{{ strtolower($hOpt) }}">{{ $hOpt }}</option>
            @endforeach
          </select>
        </div>
      </div>

      {{-- Search Button --}}
      <div class="w-full md:w-auto shrink-0">
        <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center gap-2 bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold font-inter px-8 py-3.5 rounded-[10px] transition-colors shadow-xs cursor-pointer">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          <span>{{ $searchBtnLabel }}</span>
        </button>
      </div>

    </form>
  </div>
</section>

{{-- Filter Status Banner (shown when filter active or empty) --}}
<div id="proj-filter-status" class="hidden max-w-[1280px] mx-auto px-6 pt-6 font-inter">
  <div class="bg-[#FAF8F5] border border-[#EBE7DF] rounded-xl px-5 py-3 flex items-center justify-between gap-4 text-xs">
    <span id="proj-filter-status-text" class="text-[#10221C] font-medium"></span>
    <button type="button" onclick="resetProjectsFilter()" class="text-[#C5A47E] hover:underline font-bold cursor-pointer">Reset Filters</button>
  </div>
</div>

<script>
(function() {
  window.__projActiveMode = 'all';

  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.proj-mode-tab[data-proj-mode]').forEach(function(btn) {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.proj-mode-tab[data-proj-mode]').forEach(function(b) {
          b.classList.remove('active');
        });
        btn.classList.add('active');
        window.__projActiveMode = btn.getAttribute('data-proj-mode') || 'all';
        runProjectsFilter(false);
      });
    });
  });

  function matchesBudget(priceM, budgetStr) {
    if (!budgetStr) return true;
    const nums = budgetStr.match(/\d+(\.\d+)?/g);
    if (!nums || nums.length === 0) return true;
    if (budgetStr.includes('under') || budgetStr.includes('<')) {
      return priceM <= parseFloat(nums[0]);
    }
    if (budgetStr.includes('+') || budgetStr.includes('above')) {
      return priceM >= parseFloat(nums[0]);
    }
    if (nums.length >= 2) {
      return priceM >= parseFloat(nums[0]) && priceM <= parseFloat(nums[1]);
    }
    return priceM <= parseFloat(nums[0]);
  }

  window.runProjectsFilter = function(shouldScroll) {
    const loc = (document.getElementById('proj-search-location')?.value || '').trim().toLowerCase();
    const type = (document.getElementById('proj-search-type')?.value || '').trim().toLowerCase();
    const budget = (document.getElementById('proj-search-budget')?.value || '').trim().toLowerCase();
    const handover = (document.getElementById('proj-search-handover')?.value || '').trim().toLowerCase();
    const mode = window.__projActiveMode || 'all';

    const cards = document.querySelectorAll('.project-filter-card');
    let visibleCount = 0;

    cards.forEach(function(card) {
      const hay = ((card.dataset.title || '') + ' ' + (card.dataset.location || '')).toLowerCase();
      const cardType = (card.dataset.type || '').toLowerCase();
      const cardHandover = (card.dataset.handover || '').toLowerCase();
      const cardMode = (card.dataset.mode || '').toLowerCase();
      const priceM = parseFloat(card.dataset.price || '0') || 0;

      const okLoc = !loc || hay.includes(loc);
      const okType = !type || cardType.includes(type) || hay.includes(type);
      const okBudget = !budget || matchesBudget(priceM, budget);
      const okHandover = !handover || cardHandover.includes(handover);
      let okMode = true;
      if (mode === 'offplan') {
        okMode = cardMode.includes('off') || cardHandover !== 'ready';
      } else if (mode === 'rent') {
        okMode = cardMode.includes('rent');
      } else if (mode === 'buy') {
        okMode = true;
      }

      const show = okLoc && okType && okBudget && okHandover && okMode;
      card.style.display = show ? '' : 'none';
      if (show) visibleCount++;
    });

    const hasAnyFilter = !!(loc || type || budget || handover || mode === 'offplan' || mode === 'rent');
    const statusBox = document.getElementById('proj-filter-status');
    const statusText = document.getElementById('proj-filter-status-text');
    if (statusBox && statusText) {
      statusBox.classList.toggle('hidden', !hasAnyFilter);
      statusText.textContent = visibleCount > 0
        ? ('Showing ' + visibleCount + ' matching project(s)')
        : 'No matching projects found for your selected filters.';
    }

    if (shouldScroll) {
      const firstGrid = document.querySelector('.project-filter-card')?.closest('section');
      if (firstGrid) firstGrid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  };

  window.resetProjectsFilter = function() {
    if (document.getElementById('proj-search-location')) document.getElementById('proj-search-location').value = '';
    if (document.getElementById('proj-search-type')) document.getElementById('proj-search-type').value = '';
    if (document.getElementById('proj-search-budget')) document.getElementById('proj-search-budget').value = '';
    if (document.getElementById('proj-search-handover')) document.getElementById('proj-search-handover').value = '';
    window.__projActiveMode = 'all';
    document.querySelectorAll('.proj-mode-tab[data-proj-mode]').forEach(function(b) {
      b.classList.toggle('active', b.getAttribute('data-proj-mode') === 'buy');
    });
    runProjectsFilter(false);
  };
})();
</script>
