@php
  $globalReviews = \App\Http\Controllers\Admin\EntityController::getReviewsStore();
  $heading = !empty($c['heading_html']) ? $c['heading_html'] : ($globalReviews['heading'] ?? 'Why Our Clients Trust Us');
  $subtext = !empty($c['subtext']) ? $c['subtext'] : ($globalReviews['subtext'] ?? 'Discover what our customers are saying about their experiences.');
  $buttonText = !empty($c['button_text']) ? $c['button_text'] : ($globalReviews['button_text'] ?? 'See all reviews');
  $buttonLink = !empty($c['button_link']) ? $c['button_link'] : ($globalReviews['button_link'] ?? '#');
  $reviewsList = !empty($globalReviews['items']) ? $globalReviews['items'] : ($c['items'] ?? []);
@endphp

<section class="max-w-[1280px] mx-auto px-6 py-20 font-source">
  {{-- Header: Heading in Abhaya Libre Medium, Button "See all reviews" in Inter --}}
  <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6 mb-16">
    <div>
      <h2 class="font-heading font-medium text-4xl md:text-[46px] text-[#10221C] leading-tight">
        {!! $heading !!}
      </h2>
      @if(!empty($subtext))
      <p class="mt-3 text-sm md:text-base text-[#8C9B93] font-source">
        {{ $subtext }}
      </p>
      @endif
    </div>

    @if(!empty($buttonText))
    <div class="shrink-0">
      <a href="{{ $buttonLink }}" class="inline-flex items-center justify-center bg-[#1B2A24] hover:bg-[#121c18] text-white text-xs font-medium font-inter px-5 py-2.5 rounded-[6px] shadow-xs transition-colors">
        {{ $buttonText }}
      </a>
    </div>
    @endif
  </div>

  {{-- 3 Testimonial Columns --}}
  <div class="grid grid-cols-1 md:grid-cols-3 gap-10 lg:gap-14 font-source">
    @foreach($reviewsList as $t)
    <div class="flex flex-col items-start font-source">
      
      {{-- User Profile Row --}}
      <div class="flex items-center gap-3.5 mb-5">
        <div class="w-12 h-12 rounded-full overflow-hidden shrink-0 bg-neutral-200">
          <img src="{{ asset($t['avatar'] ?? ($t['image'] ?? 'images/avatar-man.jpg')) }}" alt="{{ $t['name'] ?? '' }}" class="w-full h-full object-cover">
        </div>
        <div>
          <h4 class="font-source font-bold text-sm text-[#10221C] leading-snug">
            {{ $t['name'] ?? 'Bashar Masalha' }}
          </h4>
          <p class="font-source text-xs text-[#8C9B93] mt-0.5">
            {{ $t['meta'] ?? '3 months ago' }}
          </p>
          {{-- 5 Star Rating --}}
          <div class="flex items-center text-[#B9975B] text-xs gap-0.5 mt-0.5">
            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
          </div>
        </div>
      </div>

      {{-- Testimonial Heading --}}
      <h3 class="font-source font-bold text-base text-[#10221C] leading-snug mb-2">
        {{ $t['title'] ?? 'An Honest Approach to Real Estate' }}
      </h3>

      {{-- Testimonial Text --}}
      <p class="font-source text-xs md:text-sm text-[#8C9B93] leading-relaxed mb-2">
        {{ $t['text'] ?? '' }}
      </p>

      {{-- "more" link --}}
      <a href="{{ $t['more_link'] ?? '#' }}" class="font-source text-xs text-[#8C9B93] hover:text-[#10221C] underline transition-colors">
        more
      </a>

    </div>
    @endforeach
  </div>
</section>
