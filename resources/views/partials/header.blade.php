<header class="sticky top-0 z-50 bg-white border-b border-neutral-200">
  <div class="max-w-[1280px] mx-auto px-6 h-[84px] flex items-center justify-between gap-6">
    {{-- Brand Logo matching screenshot: LV monogram icon + LUX VILLA DUBAI --}}
    <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
      <span class="font-serif font-bold text-3xl text-[#10221C] tracking-tighter">LV</span>
      <span class="leading-tight">
        <span class="block font-serif font-bold text-[18px] tracking-[0.12em] text-[#10221C]">LUX VILLA</span>
        <span class="block text-[9px] tracking-[0.38em] text-[#10221C]/80 -mt-0.5 font-medium">DUBAI</span>
      </span>
    </a>
    
    {{-- Navigation links matching screenshot --}}
    @php
      $navList = $site['nav_items'] ?? [];
      $hasProjectsLink = false;
      foreach ($navList as $ni) {
        if (str_contains(strtolower($ni['url'] ?? ''), '/projects') || strtoupper(trim($ni['label'] ?? '')) === 'PROJECTS') {
          $hasProjectsLink = true;
          break;
        }
      }
      if (!$hasProjectsLink && !empty($navList)) {
        $navList[] = ['label' => 'PROJECTS', 'url' => '/projects'];
      }
    @endphp
    <nav class="hidden lg:flex items-center gap-6 text-[12px] font-semibold tracking-wider text-[#10221C] uppercase whitespace-nowrap">
      @foreach($navList as $item)
      @php
        $lbl = strtoupper(trim($item['label'] ?? ''));
        $rawUrl = trim($item['url'] ?? '#');
        $resolvedUrl = match ($lbl) {
          'HOME' => '/',
          'VILLAS' => '/villas-for-sale',
          'BUY' => '/villas-for-sale?status=ready',
          'SELL' => '/enquiry',
          'PROJECTS', 'COMPANIES' => '/projects',
          'COMMUNITIES' => '/communities',
          'COMPARE' => '/ai-villa-assessment',
          'INSIGHTS' => '/blog',
          'MAINTENANCE', 'ABOUT US' => '/about',
          default => ($rawUrl && $rawUrl !== '#' ? $rawUrl : '/'),
        };
        if ($rawUrl && $rawUrl !== '#' && !in_array($rawUrl, ['/villas-for-sale', '#'], true) && !in_array($lbl, ['BUY', 'SELL', 'COMPARE', 'INSIGHTS'], true)) {
          $resolvedUrl = $rawUrl;
        }
        $checkPath = trim(parse_url($resolvedUrl, PHP_URL_PATH) ?: '', '/');
        $isActiveNav = $checkPath === '' ? request()->is('/') : request()->is($checkPath);
      @endphp
      <a href="{{ $resolvedUrl }}" class="hover:text-[#B9975B] transition-colors {{ $isActiveNav ? 'text-[#0E3B2C] font-bold' : '' }}">
        {{ $item['label'] ?? '' }}
      </a>
      @endforeach
    </nav>

    {{-- Consultation Button matching screenshot: rounded beige button --}}
    <a href="{{ $site['header_button_link'] ?? '/enquiry' }}" class="bg-[#C5A47E] hover:bg-[#b8956e] text-white text-[12px] font-semibold tracking-wider uppercase px-5 py-2.5 rounded-[6px] transition-colors shadow-xs shrink-0 whitespace-nowrap">
      BOOK CONSULTATION
    </a>
  </div>
</header>
