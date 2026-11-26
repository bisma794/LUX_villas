{{-- Dedicated 5-Step Enquiry Questionnaire (/enquiry) --}}
<style>
  .enquiry-stepper-scope,
  .enquiry-stepper-scope button,
  .enquiry-stepper-scope input,
  .enquiry-stepper-scope select,
  .enquiry-stepper-scope textarea,
  .enquiry-stepper-scope h3,
  .enquiry-stepper-scope p,
  .enquiry-stepper-scope label,
  .enquiry-stepper-scope span {
    font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
  }
  .enquiry-stepper-scope h2 {
    font-family: 'Abhaya Libre', Georgia, serif !important;
  }
  .enquiry-stepper-scope .enquiry-tagline {
    font-family: 'Source Sans 3', ui-sans-serif, system-ui, sans-serif !important;
  }
  /* Explicit styles so custom colors render reliably without Vite rebuild */
  .eq-topbar {
    background-color: #0E3B2C;
    border-radius: 12px;
    padding: 8px 12px;
    margin-bottom: 20px;
  }
  .eq-nav-tab {
    background-color: transparent;
    color: rgba(255, 255, 255, 0.9);
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.15s ease;
  }
  .eq-nav-tab:hover {
    background-color: rgba(255, 255, 255, 0.12);
    color: #ffffff;
  }
  .eq-nav-tab.eq-tab-active {
    background-color: #2D5D4B !important;
    color: #ffffff !important;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
  }
  .eq-main-card {
    background-color: #ffffff;
    border: 1px solid #D4DCD7;
    border-radius: 14px;
  }
  .eq-select {
    background-color: #163427;
    color: #ffffff;
    border-radius: 8px;
    padding: 10px 40px 10px 16px;
    font-size: 14px;
    font-weight: 500;
  }
  .eq-opt-card {
    background-color: #EAECEC;
    color: #10221C;
    border-radius: 10px;
    padding: 16px 20px;
    transition: all 0.15s ease;
  }
  .eq-opt-card:hover {
    background-color: #e0e3e3;
  }
  .eq-opt-card.eq-selected {
    background-color: #163427 !important;
    color: #ffffff !important;
  }
  .eq-opt-card .eq-card-sub {
    color: #737373;
  }
  .eq-opt-card.eq-selected .eq-card-sub {
    color: rgba(255, 255, 255, 0.78) !important;
  }
  .eq-pill-btn {
    background-color: #EAECEC;
    color: #0E3B2C;
    border-radius: 8px;
    padding: 12px 24px;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.15s ease;
  }
  .eq-pill-btn:hover {
    background-color: #e0e3e3;
  }
  .eq-pill-btn.eq-selected {
    background-color: #163427 !important;
    color: #ffffff !important;
  }
  .eq-input-box {
    background-color: #EAECEC;
    color: #10221C;
    border-radius: 10px;
    padding: 16px 20px;
  }
  .eq-summary-box {
    background-color: #EAECEC;
    border: 1px solid #D4D6D6;
    border-radius: 12px;
  }
  .eq-summary-row + .eq-summary-row {
    border-top: 1px solid #D4D6D6;
  }
  .eq-submit-btn {
    background-color: #D8BA8E;
    color: #ffffff;
    border-radius: 8px;
    padding: 12px 24px;
    font-size: 14px;
    font-weight: 600;
  }
  .eq-submit-btn:hover {
    background-color: #c8a87a;
  }
</style>

<section class="max-w-[1080px] mx-auto px-6 py-12 md:py-16 enquiry-stepper-scope" id="enquiry-questionnaire">
  {{-- Top Dark Green Pill Navigation Bar --}}
  @php
    $enquiryTabs = [
      1 => !empty($c['tab_1']) ? $c['tab_1'] : 'Purpose & Goals',
      2 => !empty($c['tab_2']) ? $c['tab_2'] : 'Preferences',
      3 => !empty($c['tab_3']) ? $c['tab_3'] : 'Budget & Financing',
      4 => !empty($c['tab_4']) ? $c['tab_4'] : 'Timeline & Requirements',
      5 => !empty($c['tab_5']) ? $c['tab_5'] : 'Review & Submit',
    ];
    $waNumberRaw = !empty($c['whatsapp_number']) ? $c['whatsapp_number'] : '+92 332 2495575';
    $waDigits = preg_replace('/\D+/', '', $waNumberRaw) ?: '923322495575';
    $submitLabel = !empty($c['submit_button_text']) ? $c['submit_button_text'] : 'Submit Enquiry';
  @endphp

  <div class="w-full eq-topbar">
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-1.5 sm:gap-2 text-center">
      @foreach($enquiryTabs as $stepNum => $label)
        <button
          type="button"
          data-eq-tab="{{ $stepNum }}"
          class="eq-nav-tab cursor-pointer truncate {{ $stepNum === 1 ? 'eq-tab-active' : '' }}"
        >
          {{ $label }}
        </button>
      @endforeach
    </div>
  </div>

  {{-- Main Card --}}
  <div class="eq-main-card p-6 sm:p-10 md:p-12 shadow-xs">

    {{-- STEP 1: Purpose & Goals --}}
    <div data-eq-panel="1" class="eq-panel">
      <h2 class="text-[28px] sm:text-[32px] font-semibold text-[#0E3B2C] tracking-tight leading-tight">
        {{ !empty($c['step1_title']) ? $c['step1_title'] : '1. Purpose & Goals' }}
      </h2>
      <p class="enquiry-tagline text-sm sm:text-base text-neutral-500 mt-1.5 mb-6">
        {{ !empty($c['step1_subtitle']) ? $c['step1_subtitle'] : 'What Is Your Main Purpose For Buying A Villa?' }}
      </p>

      <div class="mb-4">
        <label for="eq-purpose-select" class="block text-sm font-bold text-[#0E3B2C] mb-2">Main Purpose</label>
        <div class="relative inline-block w-full sm:w-[380px]">
          <select
            id="eq-purpose-select"
            class="eq-select w-full appearance-none focus:outline-none cursor-pointer"
          >
            <option value="Investment">Investment</option>
            <option value="Family Home" selected>Family Home</option>
            <option value="Relocation">Relocation</option>
            <option value="Second Home">Second Home</option>
          </select>
          <svg class="w-4 h-4 text-white pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
          </svg>
        </div>
      </div>

      @php
        $purposeOptions = [
          ['value' => 'Investment', 'sub' => 'Rental Income & Capital Growth'],
          ['value' => 'Family Home', 'sub' => 'For Own Use'],
          ['value' => 'Relocation', 'sub' => 'Moving To Dubai Or Abu Dhabi'],
          ['value' => 'Second Home', 'sub' => 'Holiday Or Part-Time Use'],
        ];
      @endphp

      <div class="space-y-3" id="eq-purpose-cards">
        @foreach($purposeOptions as $opt)
          @php $isDefault = $opt['value'] === 'Family Home'; @endphp
          <button
            type="button"
            data-eq-purpose="{{ $opt['value'] }}"
            class="eq-purpose-card eq-opt-card w-full text-left cursor-pointer {{ $isDefault ? 'eq-selected' : '' }}"
          >
            <div class="text-[15px] font-bold leading-snug">{{ $opt['value'] }}</div>
            <div class="eq-card-sub text-xs sm:text-[13px] mt-0.5">{{ $opt['sub'] }}</div>
          </button>
        @endforeach
      </div>

      <div class="flex justify-end mt-8">
        <button type="button" data-eq-next="2" class="text-sm font-semibold text-[#0E3B2C] hover:opacity-75 inline-flex items-center gap-1.5 cursor-pointer">
          <span>Next</span>
          <span>&rarr;</span>
        </button>
      </div>
    </div>

    {{-- STEP 2: Property Preferences --}}
    <div data-eq-panel="2" class="eq-panel hidden">
      <h2 class="text-[28px] sm:text-[32px] font-semibold text-[#0E3B2C] tracking-tight leading-tight">
        {{ !empty($c['step2_title']) ? $c['step2_title'] : '2. Property Preferences' }}
      </h2>
      <p class="enquiry-tagline text-sm sm:text-base text-neutral-500 mt-1.5 mb-6">
        {{ !empty($c['step2_subtitle']) ? $c['step2_subtitle'] : 'What Type Of Property Are You Looking For?' }}
      </p>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-7" id="eq-type-cards">
        <button
          type="button"
          data-eq-type="Villa"
          class="eq-type-card eq-opt-card eq-selected text-left cursor-pointer"
        >
          <div class="text-[15px] font-bold leading-snug">Villa</div>
          <div class="eq-card-sub text-xs sm:text-[13px] mt-0.5">Standalone, More Space &amp; Privacy</div>
        </button>
        <button
          type="button"
          data-eq-type="Townhouse"
          class="eq-type-card eq-opt-card text-left cursor-pointer"
        >
          <div class="text-[15px] font-bold leading-snug">Townhouse</div>
          <div class="eq-card-sub text-xs sm:text-[13px] mt-0.5">Lower Price, Strong Rental Demand</div>
        </button>
      </div>

      <div class="mb-7">
        <div class="text-sm font-bold text-[#0E3B2C] mb-3">Preferred Location(S)</div>
        @php
          $locations = [
            ['name' => 'Dubai Hills Estate', 'city' => 'Dubai'],
            ['name' => 'Arabian Ranches 3', 'city' => 'Dubai'],
            ['name' => 'The Valley', 'city' => 'Dubai'],
            ['name' => 'Yas Island', 'city' => 'Abu Dhabi'],
            ['name' => 'DAMAC Hills 2', 'city' => 'Dubai'],
            ['name' => 'Saadiyat Island', 'city' => 'Abu Dhabi'],
          ];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-3">
          @foreach($locations as $loc)
            <label class="flex items-center justify-between cursor-pointer select-none py-1">
              <span class="flex items-center gap-3">
                <input
                  type="checkbox"
                  name="eq_locations[]"
                  value="{{ $loc['name'] }}"
                  class="eq-loc-check w-4 h-4 rounded-[4px] border-neutral-300 text-[#163427] focus:ring-[#163427] accent-[#163427] cursor-pointer"
                >
                <span class="text-sm font-medium text-[#0E3B2C]">{{ $loc['name'] }}</span>
              </span>
              <span class="text-xs sm:text-sm text-[#0E3B2C]/75">{{ $loc['city'] }}</span>
            </label>
          @endforeach
        </div>
      </div>

      <div>
        <div class="text-sm font-bold text-[#0E3B2C] mb-3">Minimum Bedrooms</div>
        <div class="flex flex-wrap gap-2.5" id="eq-bedroom-btns">
          @foreach(['Any', '3+', '4+', '5+', '6+'] as $bed)
            <button
              type="button"
              data-eq-bed="{{ $bed }}"
              class="eq-bed-btn eq-pill-btn cursor-pointer {{ $bed === 'Any' ? 'eq-selected' : '' }}"
            >
              {{ $bed }}
            </button>
          @endforeach
        </div>
      </div>

      <div class="flex items-center justify-between mt-9">
        <button type="button" data-eq-prev="1" class="text-sm font-semibold text-[#0E3B2C] hover:opacity-75 inline-flex items-center gap-1.5 cursor-pointer">
          <span>&larr;</span>
          <span>Back</span>
        </button>
        <button type="button" data-eq-next="3" class="text-sm font-semibold text-[#0E3B2C] hover:opacity-75 inline-flex items-center gap-1.5 cursor-pointer">
          <span>Next</span>
          <span>&rarr;</span>
        </button>
      </div>
    </div>

    {{-- STEP 3: Budget & Financing --}}
    <div data-eq-panel="3" class="eq-panel hidden">
      <h2 class="text-[28px] sm:text-[32px] font-semibold text-[#0E3B2C] tracking-tight leading-tight">
        {{ !empty($c['step3_title']) ? $c['step3_title'] : '3. Budget & Financing' }}
      </h2>
      <p class="enquiry-tagline text-sm sm:text-base text-neutral-500 mt-1.5 mb-6">
        {{ !empty($c['step3_subtitle']) ? $c['step3_subtitle'] : 'What Is Your Budget Range?' }}
      </p>

      @php
        $budgets = ['Under AED 2M', 'AED 2M – 3M', 'AED 3M – 5M', 'AED 5M+'];
      @endphp
      <div class="space-y-3 mb-7" id="eq-budget-cards">
        @foreach($budgets as $idx => $b)
          <button
            type="button"
            data-eq-budget="{{ $b }}"
            class="eq-budget-card eq-opt-card w-full text-left text-[15px] font-semibold cursor-pointer {{ $idx === 0 ? 'eq-selected' : '' }}"
          >
            {{ $b }}
          </button>
        @endforeach
      </div>

      <div>
        <div class="text-sm font-bold text-[#0E3B2C] mb-3">How Will You Finance The Purchase?</div>
        <div class="flex flex-wrap gap-3" id="eq-finance-btns">
          @foreach(['Cash', 'Mortgage', 'Payment Plan'] as $idx => $fin)
            <button
              type="button"
              data-eq-finance="{{ $fin }}"
              class="eq-fin-btn eq-pill-btn cursor-pointer {{ $idx === 0 ? 'eq-selected' : '' }}"
            >
              {{ $fin }}
            </button>
          @endforeach
        </div>
      </div>

      <div class="flex items-center justify-between mt-9">
        <button type="button" data-eq-prev="2" class="text-sm font-semibold text-[#0E3B2C] hover:opacity-75 inline-flex items-center gap-1.5 cursor-pointer">
          <span>&larr;</span>
          <span>Back</span>
        </button>
        <button type="button" data-eq-next="4" class="text-sm font-semibold text-[#0E3B2C] hover:opacity-75 inline-flex items-center gap-1.5 cursor-pointer">
          <span>Next</span>
          <span>&rarr;</span>
        </button>
      </div>
    </div>

    {{-- STEP 4: Timeline & Additional Requirements --}}
    <div data-eq-panel="4" class="eq-panel hidden">
      <h2 class="text-[28px] sm:text-[32px] font-semibold text-[#0E3B2C] tracking-tight leading-tight">
        {{ !empty($c['step4_title']) ? $c['step4_title'] : '4. Timeline & Additional Requirements' }}
      </h2>
      <p class="enquiry-tagline text-sm sm:text-base text-neutral-500 mt-1.5 mb-6">
        {{ !empty($c['step4_subtitle']) ? $c['step4_subtitle'] : 'When Do You Plan To Purchase?' }}
      </p>

      @php
        $timelines = ['Immediately', 'Within 3 Months', '3 – 6 Months', 'Exploring Options'];
      @endphp
      <div class="space-y-3 mb-7" id="eq-timeline-cards">
        @foreach($timelines as $idx => $tl)
          <button
            type="button"
            data-eq-timeline="{{ $tl }}"
            class="eq-timeline-card eq-opt-card w-full text-left text-[15px] font-semibold cursor-pointer {{ $idx === 0 ? 'eq-selected' : '' }}"
          >
            {{ $tl }}
          </button>
        @endforeach
      </div>

      <div>
        <label for="eq-requirements-input" class="block text-sm font-bold text-[#0E3B2C] mb-2.5">Any Specific Requirements?</label>
        <input
          id="eq-requirements-input"
          type="text"
          placeholder="e.g, near school, single row, pool, large plot..."
          class="eq-input-box w-full placeholder-neutral-400 text-sm focus:outline-none"
        >
      </div>

      <div class="flex items-center justify-between mt-9">
        <button type="button" data-eq-prev="3" class="text-sm font-semibold text-[#0E3B2C] hover:opacity-75 inline-flex items-center gap-1.5 cursor-pointer">
          <span>&larr;</span>
          <span>Back</span>
        </button>
        <button type="button" data-eq-next="5" class="text-sm font-semibold text-[#0E3B2C] hover:opacity-75 inline-flex items-center gap-1.5 cursor-pointer">
          <span>Next</span>
          <span>&rarr;</span>
        </button>
      </div>
    </div>

    {{-- STEP 5: Your Personalised Shortlist --}}
    <div data-eq-panel="5" class="eq-panel hidden">
      <h2 class="text-[28px] sm:text-[32px] font-semibold text-[#0E3B2C] tracking-tight leading-tight mb-6">
        {{ !empty($c['step5_title']) ? $c['step5_title'] : '5. Your Personalised Shortlist' }}
      </h2>

      <div class="eq-summary-box overflow-hidden text-sm">
        <div class="eq-summary-row flex items-center justify-between px-5 py-3.5">
          <span class="text-[#10221C] font-medium">Purpose</span>
          <span id="eq-sum-purpose" class="text-[#10221C] font-medium">Family Home</span>
        </div>
        <div class="eq-summary-row flex items-center justify-between px-5 py-3.5">
          <span class="text-[#10221C] font-medium">Property Type</span>
          <span id="eq-sum-type" class="text-[#10221C] font-medium">Villa</span>
        </div>
        <div class="eq-summary-row flex items-center justify-between px-5 py-3.5 gap-4">
          <span class="text-[#10221C] font-medium shrink-0">Preferred Locations</span>
          <span id="eq-sum-locations" class="text-[#10221C] font-medium text-right">Any</span>
        </div>
        <div class="eq-summary-row flex items-center justify-between px-5 py-3.5">
          <span class="text-[#10221C] font-medium">Minimum Bedrooms</span>
          <span id="eq-sum-bedrooms" class="text-[#10221C] font-medium">Any</span>
        </div>
        <div class="eq-summary-row flex items-center justify-between px-5 py-3.5">
          <span class="text-[#10221C] font-medium">Budget</span>
          <span id="eq-sum-budget" class="text-[#10221C] font-medium">Under AED 2M</span>
        </div>
        <div class="eq-summary-row flex items-center justify-between px-5 py-3.5">
          <span class="text-[#10221C] font-medium">Financing</span>
          <span id="eq-sum-financing" class="text-[#10221C] font-medium">Cash</span>
        </div>
        <div class="eq-summary-row flex items-center justify-between px-5 py-3.5">
          <span class="text-[#10221C] font-medium">Timeline</span>
          <span id="eq-sum-timeline" class="text-[#10221C] font-medium">Immediately</span>
        </div>
        <div class="eq-summary-row flex items-center justify-between px-5 py-3.5 gap-4">
          <span class="text-[#10221C] font-medium shrink-0">Specific Requirements</span>
          <span id="eq-sum-requirements" class="text-[#10221C] font-medium text-right">----</span>
        </div>
      </div>

      <p class="enquiry-tagline text-xs sm:text-sm text-neutral-500 mt-5">
        {{ !empty($c['step5_subtitle']) ? $c['step5_subtitle'] : 'Submitting Opens WhatsApp With These Answers Prefilled, Ready To Send To Our Advisory Team On ' . $waNumberRaw . '.' }}
      </p>

      <div class="flex items-center justify-between mt-7">
        <button type="button" data-eq-prev="4" class="text-sm font-semibold text-[#0E3B2C] hover:opacity-75 inline-flex items-center gap-1.5 cursor-pointer">
          <span>&larr;</span>
          <span>Back</span>
        </button>
        <button
          type="button"
          id="eq-submit-whatsapp"
          data-wa-digits="{{ $waDigits }}"
          class="eq-submit-btn inline-flex items-center gap-2 transition-colors cursor-pointer shadow-xs"
        >
          <span>{{ $submitLabel }}</span>
          <span>&rarr;</span>
        </button>
      </div>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const root = document.getElementById('enquiry-questionnaire');
  if (!root) return;

  const state = {
    purpose: 'Family Home',
    propertyType: 'Villa',
    locations: [],
    bedrooms: 'Any',
    budget: 'Under AED 2M',
    financing: 'Cash',
    timeline: 'Immediately',
    requirements: ''
  };

  const tabs = root.querySelectorAll('.eq-nav-tab');
  const panels = root.querySelectorAll('.eq-panel');

  function goToStep(step) {
    tabs.forEach(t => {
      const active = parseInt(t.dataset.eqTab, 10) === step;
      t.classList.toggle('eq-tab-active', active);
    });
    panels.forEach(p => {
      p.classList.toggle('hidden', parseInt(p.dataset.eqPanel, 10) !== step);
    });
    if (step === 5) renderSummary();
  }

  function renderSummary() {
    root.querySelector('#eq-sum-purpose').textContent = state.purpose;
    root.querySelector('#eq-sum-type').textContent = state.propertyType;
    root.querySelector('#eq-sum-locations').textContent = state.locations.length ? state.locations.join(', ') : 'Any';
    root.querySelector('#eq-sum-bedrooms').textContent = state.bedrooms;
    root.querySelector('#eq-sum-budget').textContent = state.budget;
    root.querySelector('#eq-sum-financing').textContent = state.financing;
    root.querySelector('#eq-sum-timeline').textContent = state.timeline;
    const req = (root.querySelector('#eq-requirements-input')?.value || '').trim();
    state.requirements = req;
    root.querySelector('#eq-sum-requirements').textContent = req || '----';
  }

  tabs.forEach(t => t.addEventListener('click', () => goToStep(parseInt(t.dataset.eqTab, 10))));
  root.querySelectorAll('[data-eq-next]').forEach(btn => {
    btn.addEventListener('click', () => goToStep(parseInt(btn.dataset.eqNext, 10)));
  });
  root.querySelectorAll('[data-eq-prev]').forEach(btn => {
    btn.addEventListener('click', () => goToStep(parseInt(btn.dataset.eqPrev, 10)));
  });

  // Step 1: Purpose select + cards sync
  const purposeSelect = root.querySelector('#eq-purpose-select');
  const purposeCards = root.querySelectorAll('.eq-purpose-card');

  function setPurpose(val) {
    state.purpose = val;
    if (purposeSelect) purposeSelect.value = val;
    purposeCards.forEach(card => {
      card.classList.toggle('eq-selected', card.dataset.eqPurpose === val);
    });
  }

  if (purposeSelect) {
    purposeSelect.addEventListener('change', () => setPurpose(purposeSelect.value));
  }
  purposeCards.forEach(card => {
    card.addEventListener('click', () => setPurpose(card.dataset.eqPurpose));
  });

  // Step 2: Property Type
  const typeCards = root.querySelectorAll('.eq-type-card');
  typeCards.forEach(card => {
    card.addEventListener('click', () => {
      state.propertyType = card.dataset.eqType;
      typeCards.forEach(c => c.classList.toggle('eq-selected', c === card));
    });
  });

  // Step 2: Locations
  const locChecks = root.querySelectorAll('.eq-loc-check');
  locChecks.forEach(chk => {
    chk.addEventListener('change', () => {
      state.locations = Array.from(locChecks).filter(c => c.checked).map(c => c.value);
    });
  });

  // Step 2: Bedrooms
  const bedBtns = root.querySelectorAll('.eq-bed-btn');
  bedBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      state.bedrooms = btn.dataset.eqBed;
      bedBtns.forEach(b => b.classList.toggle('eq-selected', b === btn));
    });
  });

  // Step 3: Budget
  const budgetCards = root.querySelectorAll('.eq-budget-card');
  budgetCards.forEach(card => {
    card.addEventListener('click', () => {
      state.budget = card.dataset.eqBudget;
      budgetCards.forEach(c => c.classList.toggle('eq-selected', c === card));
    });
  });

  // Step 3: Financing
  const finBtns = root.querySelectorAll('.eq-fin-btn');
  finBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      state.financing = btn.dataset.eqFinance;
      finBtns.forEach(b => b.classList.toggle('eq-selected', b === btn));
    });
  });

  // Step 4: Timeline
  const timelineCards = root.querySelectorAll('.eq-timeline-card');
  timelineCards.forEach(card => {
    card.addEventListener('click', () => {
      state.timeline = card.dataset.eqTimeline;
      timelineCards.forEach(c => c.classList.toggle('eq-selected', c === card));
    });
  });

  // Step 5: Submit to WhatsApp
  const submitBtn = root.querySelector('#eq-submit-whatsapp');
  if (submitBtn) {
    submitBtn.addEventListener('click', () => {
      renderSummary();
      const lines = [
        'Hello Lux Villa Dubai Advisory Team,',
        'Here is my Villa Enquiry Questionnaire:',
        `• Purpose: ${state.purpose}`,
        `• Property Type: ${state.propertyType}`,
        `• Preferred Locations: ${state.locations.length ? state.locations.join(', ') : 'Any'}`,
        `• Minimum Bedrooms: ${state.bedrooms}`,
        `• Budget: ${state.budget}`,
        `• Financing: ${state.financing}`,
        `• Timeline: ${state.timeline}`,
        `• Specific Requirements: ${state.requirements || 'None'}`
      ];
      const waDigits = submitBtn.dataset.waDigits || '923322495575';
      const url = 'https://wa.me/' + waDigits + '?text=' + encodeURIComponent(lines.join('\n'));
      window.open(url, '_blank', 'noopener,noreferrer');
    });
  }
});
</script>
