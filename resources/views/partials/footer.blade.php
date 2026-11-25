<footer class="bg-[#0E1A14] text-white pt-20 pb-12 font-inter">
  <div class="max-w-[1280px] mx-auto px-6">
    
    {{-- Main 4-Column Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 pb-16">
      
      {{-- Column 1 (Brand, Disclaimer, Social Icons) --}}
      <div class="lg:col-span-5 pr-0 lg:pr-10">
        {{-- Custom Stylized LV Logo matching screenshot --}}
        <div class="flex items-center gap-3">
          <div class="flex items-baseline gap-1 text-white">
            <span class="font-heading font-normal text-4xl tracking-tighter leading-none">LV</span>
            <span class="leading-tight ml-2">
              <span class="block font-heading tracking-[0.2em] text-xl font-medium">LUX VILLA</span>
              <span class="block text-[10px] tracking-[0.45em] text-[#C5A47E]">DUBAI</span>
            </span>
          </div>
        </div>

        {{-- Disclaimer Paragraph --}}
        <p class="mt-8 text-xs text-[#8C9B93] leading-relaxed max-w-md font-inter">
          {{ $site['footer_disclaimer'] ?? '© 2026 Lux Villa Dubai. All rights reserved. Property information is provided for general informational purposes only. Prices, availability, payment plans, specifications, and other details are subject to change without prior notice. Images are for illustrative purposes only. Please contact Lux Villa Dubai for the latest information.' }}
        </p>

        {{-- Social Icons in Warm Beige/Tan Buttons --}}
        <div class="flex items-center gap-2.5 mt-8">
          {{-- Facebook --}}
          <a href="{{ $site['social_facebook'] ?? '#' }}" aria-label="Facebook" class="w-8 h-8 rounded-[4px] bg-[#E5CFB3] hover:bg-[#d8bf9f] text-[#0E1A14] flex items-center justify-center transition-colors">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.595 0 9 1.583 9 4.615V8z"/></svg>
          </a>
          {{-- YouTube --}}
          <a href="#" aria-label="YouTube" class="w-8 h-8 rounded-[4px] bg-[#E5CFB3] hover:bg-[#d8bf9f] text-[#0E1A14] flex items-center justify-center transition-colors">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
          </a>
          {{-- Instagram --}}
          <a href="{{ $site['social_instagram'] ?? '#' }}" aria-label="Instagram" class="w-8 h-8 rounded-[4px] bg-[#E5CFB3] hover:bg-[#d8bf9f] text-[#0E1A14] flex items-center justify-center transition-colors">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
        </div>
      </div>

      {{-- Column 2 (Explore Links) --}}
      <div class="lg:col-span-2">
        <h4 class="font-heading font-medium text-lg text-[#C5A47E] mb-6">Explore</h4>
        <ul class="space-y-3.5 text-xs text-white/90 font-inter tracking-wider uppercase">
          <li><a href="/" class="hover:text-[#C5A47E] transition-colors">HOME</a></li>
          <li><a href="/villas-for-sale" class="hover:text-[#C5A47E] transition-colors">VILLAS</a></li>
          <li><a href="/villas-for-sale" class="hover:text-[#C5A47E] transition-colors">BUY / SELL</a></li>
          <li><a href="/about" class="hover:text-[#C5A47E] transition-colors">MAINTENANCE</a></li>
          <li><a href="/communities" class="hover:text-[#C5A47E] transition-colors">COMMUNITIES</a></li>
          <li><a href="/villas-for-sale" class="hover:text-[#C5A47E] transition-colors">COMPARE</a></li>
          <li><a href="/blog" class="hover:text-[#C5A47E] transition-colors">INSIGHTS</a></li>
          <li><a href="/about" class="hover:text-[#C5A47E] transition-colors">ABOUT US</a></li>
        </ul>
      </div>

      {{-- Column 3 (Contact Info) --}}
      <div class="lg:col-span-3">
        <h4 class="font-heading font-medium text-lg text-[#C5A47E] mb-6">Contact</h4>
        <ul class="space-y-4 text-xs text-white/90 font-inter">
          <li>
            <a href="tel:+971500000000" class="hover:text-[#C5A47E] transition-colors">
              {{ $site['contact_phone'] ?? '+971 50 000 0000' }}
            </a>
          </li>
          <li>
            <a href="https://wa.me/971500000000" target="_blank" rel="noopener noreferrer" class="hover:text-[#C5A47E] transition-colors">
              {{ $site['contact_whatsapp_label'] ?? 'WhatsApp Us' }}
            </a>
          </li>
          <li class="leading-relaxed">
            Dubai, United Arab<br>Emirates
          </li>
        </ul>
      </div>

      {{-- Column 4 (Get Started & Register Interest Button) --}}
      <div class="lg:col-span-2">
        <h4 class="font-heading font-medium text-lg text-[#C5A47E] mb-6">Get Started</h4>
        <div class="space-y-5">
          <a href="#" class="block text-xs text-white/90 font-inter hover:text-[#C5A47E] transition-colors">
            Download Brochure
          </a>
          <a href="/enquiry" class="inline-flex items-center justify-center bg-[#E5CFB3] hover:bg-[#d8bf9f] text-[#0E1A14] text-xs font-semibold font-inter px-6 py-2.5 rounded-full shadow-sm transition-colors">
            Register Interest
          </a>
        </div>
      </div>

    </div>

    {{-- Bottom Sub-Footer Bar --}}
    <div class="border-t border-white/10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-[#8C9B93] font-inter">
      <div>
        {{ $site['footer_copyright'] ?? '© 2026 The Lux Villa Dubai. All rights reserved.' }}
      </div>
      <div class="flex items-center gap-4">
        <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
        <span>·</span>
        <a href="#" class="hover:text-white transition-colors">Terms</a>
      </div>
    </div>

  </div>
</footer>
