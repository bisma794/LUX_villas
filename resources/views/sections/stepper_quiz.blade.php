{{-- AI Villa Assessment Interactive Stepper Section --}}
<section class="max-w-[1080px] mx-auto px-6 py-12 md:py-16 font-inter" style="font-family: 'Lato', sans-serif;">
  
  {{-- Outer Frame Container: Rounded Top Header Bar + White Box --}}
  <div class="relative w-full">
    
    {{-- Top Dark Green Bar with 5 Interactive Clickable Tabs --}}
    <div class="w-full bg-[#0E3B2C] rounded-t-[16px] px-3 sm:px-6 py-2.5 flex items-center justify-between overflow-x-auto no-scrollbar">
      @php
        $navTabs = ['Purpose', 'Preferences', 'Budget', 'Timeline', 'Results'];
      @endphp
      
      <div class="w-full grid grid-cols-5 gap-1.5 sm:gap-3 text-center">
        @foreach($navTabs as $idx => $tab)
          <button 
            type="button" 
            data-quiz-tab="{{ $idx + 1 }}"
            class="quiz-nav-tab py-2 sm:py-2.5 px-2 sm:px-4 rounded-[8px] text-xs sm:text-sm font-semibold transition-all cursor-pointer truncate {{ $idx === 0 ? 'bg-[#1C513E] text-white shadow-xs' : 'text-white/80 hover:text-white hover:bg-white/10' }}"
            style="font-family: 'Lato', sans-serif;"
          >
            {{ $tab }}
          </button>
        @endforeach
      </div>
    </div>

    {{-- Main Quiz Body Card: White background, subtle border, rounded bottom --}}
    <div class="bg-white border border-t-0 border-[#E5E7EB] rounded-b-[20px] p-6 sm:p-10 md:p-12 shadow-sm min-h-[460px] flex flex-col justify-between">
      
      {{-- STEP 1: What Is Your Main Purpose For Buying? --}}
      <div data-quiz-step="1" class="quiz-step-panel">
        {{-- Heading in Fraunces --}}
        <h2 class="text-2xl sm:text-3xl md:text-[34px] font-semibold text-[#0E3B2C] tracking-tight leading-tight mb-8" style="font-family: 'Fraunces', serif;">
          1. What Is Your Main Purpose For Buying?
        </h2>

        {{-- 4 Grid Options --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
          
          {{-- Option 1: Investment (Selected by default) --}}
          <button 
            type="button" 
            data-opt-btn
            class="quiz-card-btn selected w-full text-left p-5 sm:p-6 rounded-[14px] border border-transparent bg-[#1C3A2F] text-white flex items-center gap-4.5 sm:gap-5 transition-all shadow-xs cursor-pointer group"
          >
            {{-- Graph Icon --}}
            <div class="w-10 h-10 shrink-0 flex items-center justify-center text-white/90">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l4-4 4 4 6-6 4 4M3 21h18"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17v-4m5 4v-8m5 8v-6"/>
              </svg>
            </div>
            <div>
              <h3 class="text-base sm:text-lg font-bold leading-snug" style="font-family: 'Lato', sans-serif;">Investment</h3>
              <p class="text-xs sm:text-[13px] text-white/80 font-normal mt-0.5" style="font-family: 'Lato', sans-serif;">Rental Income &amp; Capital Growth</p>
            </div>
          </button>

          {{-- Option 2: Family Home --}}
          <button 
            type="button" 
            data-opt-btn
            class="quiz-card-btn w-full text-left p-5 sm:p-6 rounded-[14px] border border-transparent bg-[#EBECEE] text-[#10221C] flex items-center gap-4.5 sm:gap-5 transition-all cursor-pointer hover:bg-[#e2e4e7]"
          >
            {{-- Family Icon --}}
            <div class="w-10 h-10 shrink-0 flex items-center justify-center text-neutral-600">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
              </svg>
            </div>
            <div>
              <h3 class="text-base sm:text-lg font-bold leading-snug" style="font-family: 'Lato', sans-serif;">Family Home</h3>
              <p class="text-xs sm:text-[13px] text-neutral-500 font-normal mt-0.5" style="font-family: 'Lato', sans-serif;">For Own Use</p>
            </div>
          </button>

          {{-- Option 3: Relocation --}}
          <button 
            type="button" 
            data-opt-btn
            class="quiz-card-btn w-full text-left p-5 sm:p-6 rounded-[14px] border border-transparent bg-[#EBECEE] text-[#10221C] flex items-center gap-4.5 sm:gap-5 transition-all cursor-pointer hover:bg-[#e2e4e7]"
          >
            {{-- Relocation / Pin Icon --}}
            <div class="w-10 h-10 shrink-0 flex items-center justify-center text-neutral-600">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
            <div>
              <h3 class="text-base sm:text-lg font-bold leading-snug" style="font-family: 'Lato', sans-serif;">Relocation</h3>
              <p class="text-xs sm:text-[13px] text-neutral-500 font-normal mt-0.5" style="font-family: 'Lato', sans-serif;">Moving To Dubai Or Abu Dhabi</p>
            </div>
          </button>

          {{-- Option 4: Second Home --}}
          <button 
            type="button" 
            data-opt-btn
            class="quiz-card-btn w-full text-left p-5 sm:p-6 rounded-[14px] border border-transparent bg-[#EBECEE] text-[#10221C] flex items-center gap-4.5 sm:gap-5 transition-all cursor-pointer hover:bg-[#e2e4e7]"
          >
            {{-- Home Icon --}}
            <div class="w-10 h-10 shrink-0 flex items-center justify-center text-neutral-600">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
              </svg>
            </div>
            <div>
              <h3 class="text-base sm:text-lg font-bold leading-snug" style="font-family: 'Lato', sans-serif;">Second Home</h3>
              <p class="text-xs sm:text-[13px] text-neutral-500 font-normal mt-0.5" style="font-family: 'Lato', sans-serif;">Holiday Or Part-Time Use</p>
            </div>
          </button>

        </div>
      </div>

      {{-- STEP 2: Property Preferences --}}
      <div data-quiz-step="2" class="quiz-step-panel hidden">
        {{-- Heading in Fraunces --}}
        <h2 class="text-2xl sm:text-3xl md:text-[34px] font-semibold text-[#0E3B2C] tracking-tight leading-tight mb-8" style="font-family: 'Fraunces', serif;">
          2. Property Preferences
        </h2>

        {{-- Villa vs Townhouse --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
          {{-- Villa (Selected) --}}
          <button 
            type="button" 
            data-type-btn
            class="quiz-type-btn selected w-full text-left p-5 sm:p-6 rounded-[14px] bg-[#1C3A2F] text-white flex flex-col justify-center transition-all shadow-xs cursor-pointer"
          >
            <h3 class="text-base sm:text-lg font-bold leading-snug" style="font-family: 'Lato', sans-serif;">Villa</h3>
            <p class="text-xs sm:text-[13px] text-white/80 font-normal mt-1" style="font-family: 'Lato', sans-serif;">Standalone, More Space &amp; Privacy</p>
          </button>

          {{-- Townhouse --}}
          <button 
            type="button" 
            data-type-btn
            class="quiz-type-btn w-full text-left p-5 sm:p-6 rounded-[14px] bg-[#EBECEE] text-[#10221C] flex flex-col justify-center transition-all cursor-pointer hover:bg-[#e2e4e7]"
          >
            <h3 class="text-base sm:text-lg font-bold leading-snug" style="font-family: 'Lato', sans-serif;">Townhouse</h3>
            <p class="text-xs sm:text-[13px] text-neutral-500 font-normal mt-1" style="font-family: 'Lato', sans-serif;">Lower Price, Strong Rental Demand</p>
          </button>
        </div>

        {{-- Dropdown + Bedrooms --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
          {{-- Preferred Location --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-[#0E3B2C] mb-2.5" style="font-family: 'Lato', sans-serif;">
              PREFERRED LOCATION
            </label>
            <div class="relative">
              <select 
                class="w-full appearance-none bg-[#EBECEE] border-none rounded-[12px] px-5 py-3.5 text-xs sm:text-sm font-semibold text-[#10221C] focus:outline-none cursor-pointer"
                style="font-family: 'Lato', sans-serif;"
              >
                <option>Any Where In Dubai, Abu Dhabi</option>
                <option>The Valley</option>
                <option>Dubai Hills Estate</option>
                <option>Palm Jumeirah</option>
                <option>Emaar South</option>
              </select>
              <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-neutral-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
              </div>
            </div>
          </div>

          {{-- Minimum Bedrooms --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-[#0E3B2C] mb-2.5" style="font-family: 'Lato', sans-serif;">
              MINIMUM BEDROOMS
            </label>
            <div class="grid grid-cols-5 gap-2 sm:gap-2.5">
              @foreach(['Any', '3+', '4+', '5+', '6+'] as $bIdx => $bed)
                <button 
                  type="button" 
                  data-bed-btn
                  class="quiz-bed-btn py-3 rounded-[10px] text-xs sm:text-sm font-bold text-center transition-all cursor-pointer {{ $bed === 'Any' ? 'bg-[#EBECEE] text-neutral-800' : 'bg-[#EBECEE] text-neutral-700 hover:bg-[#e2e4e7]' }}"
                  style="font-family: 'Lato', sans-serif;"
                >
                  {{ $bed }}
                </button>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      {{-- STEP 3: Budget & Financing --}}
      <div data-quiz-step="3" class="quiz-step-panel hidden">
        {{-- Heading in Fraunces --}}
        <h2 class="text-2xl sm:text-3xl md:text-[34px] font-semibold text-[#0E3B2C] tracking-tight leading-tight mb-8" style="font-family: 'Fraunces', serif;">
          3. Budget &amp; Financing
        </h2>

        {{-- Budget Ranges (Stacked Horizontal Rectangles) --}}
        <div class="space-y-3.5">
          @foreach(['Under AED 2M', 'AED 2M – 3M', 'AED 3M – 5M', 'AED 5M+'] as $bIdx => $budget)
            <button 
              type="button" 
              data-budget-btn
              class="quiz-budget-btn w-full text-left px-6 py-4.5 rounded-[12px] text-sm sm:text-base font-bold transition-all cursor-pointer {{ $bIdx === 0 ? 'bg-[#1C3A2F] text-white shadow-xs' : 'bg-[#EBECEE] text-neutral-800 hover:bg-[#e2e4e7]' }}"
              style="font-family: 'Lato', sans-serif;"
            >
              {{ $budget }}
            </button>
          @endforeach
        </div>

        {{-- How Will You Finance The Purchase? --}}
        <div class="mt-8">
          <label class="block text-xs font-bold text-[#0E3B2C] mb-2.5" style="font-family: 'Lato', sans-serif;">
            How Will You Finance The Purchase?
          </label>
          <div class="flex flex-wrap gap-3">
            @foreach(['Cash', 'Mortgage', 'Payment Plan'] as $fIdx => $fin)
              <button 
                type="button" 
                data-fin-btn
                class="quiz-fin-btn px-6 py-3 rounded-[10px] text-xs sm:text-sm font-bold transition-all cursor-pointer {{ $fIdx === 0 ? 'bg-[#EBECEE] text-neutral-800' : 'bg-[#EBECEE] text-neutral-700 hover:bg-[#e2e4e7]' }}"
                style="font-family: 'Lato', sans-serif;"
              >
                {{ $fin }}
              </button>
            @endforeach
          </div>
        </div>
      </div>

      {{-- STEP 4: Timeline & Additional Requirements --}}
      <div data-quiz-step="4" class="quiz-step-panel hidden">
        {{-- Heading in Fraunces --}}
        <h2 class="text-2xl sm:text-3xl md:text-[34px] font-semibold text-[#0E3B2C] tracking-tight leading-tight mb-8" style="font-family: 'Fraunces', serif;">
          4. Timeline &amp; Additional Requirements
        </h2>

        {{-- Timeline Options (Stacked Horizontal Rectangles) --}}
        <div class="space-y-3.5">
          @foreach(['Immediately', 'Within 3 Months', '3 – 6 Months', 'Exploring Options'] as $tIdx => $timeline)
            <button 
              type="button" 
              data-timeline-btn
              class="quiz-timeline-btn w-full text-left px-6 py-4.5 rounded-[12px] text-sm sm:text-base font-bold transition-all cursor-pointer {{ $tIdx === 0 ? 'bg-[#1C3A2F] text-white shadow-xs' : 'bg-[#EBECEE] text-neutral-800 hover:bg-[#e2e4e7]' }}"
              style="font-family: 'Lato', sans-serif;"
            >
              {{ $timeline }}
            </button>
          @endforeach
        </div>

        {{-- Any Specific Requirements? --}}
        <div class="mt-8">
          <label class="block text-xs font-bold text-[#0E3B2C] mb-2.5" style="font-family: 'Lato', sans-serif;">
            Any Specific Requirements?
          </label>
          <input 
            type="text" 
            placeholder="e.g. near school, single row, pool, large plot..."
            class="w-full bg-[#EBECEE] border-none rounded-[12px] px-5 py-4 text-xs sm:text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none"
            style="font-family: 'Lato', sans-serif;"
          >
        </div>
      </div>

      {{-- STEP 5: Your Personalised Shortlist --}}
      <div data-quiz-step="5" class="quiz-step-panel hidden">
        {{-- Heading in Fraunces --}}
        <h2 class="text-2xl sm:text-3xl md:text-[34px] font-semibold text-[#0E3B2C] tracking-tight leading-tight mb-8" style="font-family: 'Fraunces', serif;">
          5. Your Personalised Shortlist
        </h2>

        {{-- Summary Table with light grey zebra/rounded styling --}}
        <div class="bg-[#EBECEE] rounded-[14px] overflow-hidden p-4 sm:p-5 text-xs sm:text-sm">
          <table class="w-full" style="font-family: 'Lato', sans-serif;">
            <tbody class="divide-y divide-neutral-300/60 font-semibold text-neutral-800">
              <tr>
                <td class="py-2.5 text-neutral-600 font-normal">Purpose</td>
                <td class="py-2.5 text-right font-bold">Investment</td>
              </tr>
              <tr>
                <td class="py-2.5 text-neutral-600 font-normal">Property Type</td>
                <td class="py-2.5 text-right font-bold">Villa</td>
              </tr>
              <tr>
                <td class="py-2.5 text-neutral-600 font-normal">Location</td>
                <td class="py-2.5 text-right font-bold">The Valley</td>
              </tr>
              <tr>
                <td class="py-2.5 text-neutral-600 font-normal">Bedrooms</td>
                <td class="py-2.5 text-right font-bold">5+</td>
              </tr>
              <tr>
                <td class="py-2.5 text-neutral-600 font-normal">Budget</td>
                <td class="py-2.5 text-right font-bold">AED 3M-5M</td>
              </tr>
              <tr>
                <td class="py-2.5 text-neutral-600 font-normal">Financing</td>
                <td class="py-2.5 text-right font-bold">-----</td>
              </tr>
              <tr>
                <td class="py-2.5 text-neutral-600 font-normal">Timeline</td>
                <td class="py-2.5 text-right font-bold">3-6 Months</td>
              </tr>
            </tbody>
          </table>
        </div>

        {{-- No Exact Matches Note Box --}}
        <div class="mt-6 bg-[#D8D8D8]/70 rounded-[14px] p-6 text-center">
          <h3 class="text-lg sm:text-xl font-bold text-[#10221C]" style="font-family: 'Fraunces', serif;">
            No Exact Matches In The Current List
          </h3>
          <p class="text-xs sm:text-[13px] text-neutral-600 font-normal mt-1.5 max-w-md mx-auto leading-relaxed" style="font-family: 'Lato', sans-serif;">
            An Advisor Can Source Off-Market Options<br>
            For This Brief Send It To Us And We Will Come Back With Alternatives.
          </p>
        </div>

        {{-- Powered By note banner --}}
        <div class="mt-4 bg-[#C2C2C2]/60 rounded-[12px] p-4 flex items-center gap-3.5 text-[11px] sm:text-xs text-neutral-700 leading-normal" style="font-family: 'Lato', sans-serif;">
          <svg class="w-6 h-6 text-neutral-700 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <rect x="2" y="3" width="20" height="14" rx="2" stroke-width="2"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21h8m-4-4v4"/>
          </svg>
          <p>
            <strong class="font-bold text-neutral-800">Powered By Lux Villa Dubai's Market Intelligence.</strong> Matches Are Ranked From The Current Listings On This Site Using Your Answers, Each Community's Rental Yields And The Full Buying Costs — So The Order Reflects The Numbers, Not Advertising.
          </p>
        </div>
      </div>

      {{-- Bottom Navigation Controls: Back on Left, Next / Action Buttons on Right --}}
      <div class="mt-10 pt-6 border-t border-neutral-100 flex items-center justify-between">
        
        {{-- Back Button --}}
        <button 
          type="button" 
          id="quiz-back-btn"
          class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#0E3B2C] hover:text-[#1C513E] transition-colors cursor-pointer"
          style="font-family: 'Lato', sans-serif;"
        >
          <span>← Back</span>
        </button>

        {{-- Next Button (Steps 1 to 4) --}}
        <button 
          type="button" 
          id="quiz-next-btn"
          class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#0E3B2C] hover:text-[#1C513E] transition-colors cursor-pointer"
          style="font-family: 'Lato', sans-serif;"
        >
          <span>Next →</span>
        </button>

        {{-- Final Step Action Buttons (Only visible on step 5) --}}
        <div id="quiz-final-actions" class="hidden flex items-center gap-3">
          <a 
            href="/enquiry" 
            class="px-5 sm:px-6 py-2.5 rounded-[8px] bg-[#0E3B2C] hover:bg-[#16503c] text-white text-xs sm:text-[13px] font-bold transition-all shadow-xs"
            style="font-family: 'Lato', sans-serif;"
          >
            Full Enquiry Questionnaire
          </a>
          <a 
            href="https://wa.me/971500000000" 
            target="_blank"
            class="inline-flex items-center gap-1.5 px-5 sm:px-6 py-2.5 rounded-[8px] bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-[13px] font-bold transition-all shadow-xs"
            style="font-family: 'Lato', sans-serif;"
          >
            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
            <span>Send My Brief On WhatsApp →</span>
          </a>
        </div>

      </div>

    </div>

  </div>

  {{-- Quiz State Management JavaScript --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let currentStep = 1;
      const totalSteps = 5;

      const tabs = document.querySelectorAll('[data-quiz-tab]');
      const stepPanels = document.querySelectorAll('[data-quiz-step]');
      const nextBtn = document.getElementById('quiz-next-btn');
      const backBtn = document.getElementById('quiz-back-btn');
      const finalActions = document.getElementById('quiz-final-actions');

      function showStep(step) {
        currentStep = Math.max(1, Math.min(totalSteps, step));

        // Switch Tab UI
        tabs.forEach(tab => {
          const tabNum = parseInt(tab.getAttribute('data-quiz-tab'));
          if (tabNum === currentStep) {
            tab.classList.add('bg-[#1C513E]', 'text-white', 'shadow-xs');
            tab.classList.remove('text-white/80', 'hover:bg-white/10');
          } else {
            tab.classList.remove('bg-[#1C513E]', 'text-white', 'shadow-xs');
            tab.classList.add('text-white/80', 'hover:bg-white/10');
          }
        });

        // Switch Step Panels
        stepPanels.forEach(panel => {
          const panelNum = parseInt(panel.getAttribute('data-quiz-step'));
          if (panelNum === currentStep) {
            panel.classList.remove('hidden');
          } else {
            panel.classList.add('hidden');
          }
        });

        // Back button visibility
        if (currentStep === 1) {
          backBtn.classList.add('invisible');
        } else {
          backBtn.classList.remove('invisible');
        }

        // Next button / Final actions
        if (currentStep === totalSteps) {
          nextBtn.classList.add('hidden');
          finalActions.classList.remove('hidden');
        } else {
          nextBtn.classList.remove('hidden');
          finalActions.classList.add('hidden');
        }
      }

      // Tab Clicks
      tabs.forEach(tab => {
        tab.addEventListener('click', function() {
          const targetStep = parseInt(this.getAttribute('data-quiz-tab'));
          showStep(targetStep);
        });
      });

      // Next & Back Clicks
      if (nextBtn) {
        nextBtn.addEventListener('click', function() {
          showStep(currentStep + 1);
        });
      }

      if (backBtn) {
        backBtn.addEventListener('click', function() {
          showStep(currentStep - 1);
        });
      }

      // Step 1 Option selection toggle
      const step1Btns = document.querySelectorAll('[data-opt-btn]');
      step1Btns.forEach(btn => {
        btn.addEventListener('click', function() {
          step1Btns.forEach(b => {
            b.classList.remove('bg-[#1C3A2F]', 'text-white', 'shadow-xs');
            b.classList.add('bg-[#EBECEE]', 'text-[#10221C]');
            const h = b.querySelector('h3');
            const p = b.querySelector('p');
            const icon = b.querySelector('div');
            if (p) p.classList.replace('text-white/80', 'text-neutral-500');
            if (icon) icon.classList.replace('text-white/90', 'text-neutral-600');
          });
          btn.classList.add('bg-[#1C3A2F]', 'text-white', 'shadow-xs');
          btn.classList.remove('bg-[#EBECEE]', 'text-[#10221C]');
          const h = btn.querySelector('h3');
          const p = btn.querySelector('p');
          const icon = btn.querySelector('div');
          if (p) p.classList.replace('text-neutral-500', 'text-white/80');
          if (icon) icon.classList.replace('text-neutral-600', 'text-white/90');
        });
      });

      // Step 2 Property Type Toggle
      const typeBtns = document.querySelectorAll('[data-type-btn]');
      typeBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          typeBtns.forEach(b => {
            b.classList.remove('bg-[#1C3A2F]', 'text-white', 'shadow-xs');
            b.classList.add('bg-[#EBECEE]', 'text-[#10221C]');
            const p = b.querySelector('p');
            if (p) p.classList.replace('text-white/80', 'text-neutral-500');
          });
          btn.classList.add('bg-[#1C3A2F]', 'text-white', 'shadow-xs');
          btn.classList.remove('bg-[#EBECEE]', 'text-[#10221C]');
          const p = btn.querySelector('p');
          if (p) p.classList.replace('text-neutral-500', 'text-white/80');
        });
      });

      // Step 2 Bedrooms Toggle
      const bedBtns = document.querySelectorAll('[data-bed-btn]');
      bedBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          bedBtns.forEach(b => {
            b.classList.remove('bg-[#1C3A2F]', 'text-white');
            b.classList.add('bg-[#EBECEE]', 'text-neutral-700');
          });
          btn.classList.add('bg-[#1C3A2F]', 'text-white');
          btn.classList.remove('bg-[#EBECEE]', 'text-neutral-700');
        });
      });

      // Step 3 Budget Toggle
      const budgetBtns = document.querySelectorAll('[data-budget-btn]');
      budgetBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          budgetBtns.forEach(b => {
            b.classList.remove('bg-[#1C3A2F]', 'text-white', 'shadow-xs');
            b.classList.add('bg-[#EBECEE]', 'text-neutral-800');
          });
          btn.classList.add('bg-[#1C3A2F]', 'text-white', 'shadow-xs');
          btn.classList.remove('bg-[#EBECEE]', 'text-neutral-800');
        });
      });

      // Step 3 Financing Toggle
      const finBtns = document.querySelectorAll('[data-fin-btn]');
      finBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          finBtns.forEach(b => {
            b.classList.remove('bg-[#1C3A2F]', 'text-white');
            b.classList.add('bg-[#EBECEE]', 'text-neutral-700');
          });
          btn.classList.add('bg-[#1C3A2F]', 'text-white');
          btn.classList.remove('bg-[#EBECEE]', 'text-neutral-700');
        });
      });

      // Step 4 Timeline Toggle
      const timelineBtns = document.querySelectorAll('[data-timeline-btn]');
      timelineBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          timelineBtns.forEach(b => {
            b.classList.remove('bg-[#1C3A2F]', 'text-white', 'shadow-xs');
            b.classList.add('bg-[#EBECEE]', 'text-neutral-800');
          });
          btn.classList.add('bg-[#1C3A2F]', 'text-white', 'shadow-xs');
          btn.classList.remove('bg-[#EBECEE]', 'text-neutral-800');
        });
      });

      showStep(1);
    });
  </script>

</section>
