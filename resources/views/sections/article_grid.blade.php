<style>
  .blog-card-item {
    width: 100%;
    max-width: 381px;
    height: 401px;
    background-color: #ffffff;
    border: 1px solid #EBEBEB;
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 1px 3px rgba(16, 34, 28, 0.04);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .blog-card-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(16, 34, 28, 0.08);
  }
  .blog-card-img-wrap {
    width: 100%;
    height: 176px;
    overflow: hidden;
    flex-shrink: 0;
    background-color: #f3f4f6;
  }
  .blog-card-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }
  .blog-card-item:hover .blog-card-img-wrap img {
    transform: scale(1.04);
  }
  .blog-card-body {
    padding: 16px 18px 18px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }
  .blog-card-date {
    font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
    font-size: 11px;
    color: #7D8580;
    line-height: 1.2;
  }
  .blog-card-badge {
    display: inline-block;
    width: fit-content;
    margin-top: 8px;
    padding: 5px 14px;
    border-radius: 6px;
    background-color: #C4A47C;
    color: #ffffff;
    font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
    font-size: 11px;
    font-weight: 600;
    line-height: 1.2;
  }
  .blog-card-title {
    font-family: 'Source Sans 3', ui-sans-serif, system-ui, sans-serif !important;
    font-size: 18px;
    font-weight: 600;
    line-height: 1.32;
    color: #16231D;
    margin-top: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .blog-card-btn {
    margin-top: auto;
    width: 100%;
    background-color: #101C16;
    color: #ffffff;
    border-radius: 7px;
    padding: 10px 16px;
    font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
    font-size: 12px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: background-color 0.15s ease;
  }
  .blog-card-btn:hover {
    background-color: #0E3B2C;
  }
</style>

@php
  $blogStore = \App\Http\Controllers\Admin\EntityController::getBlogStore();
  $blogCards = [];
  foreach ($blogStore as $slug => $post) {
    if (($post['status'] ?? 'PUBLISHED') !== 'PUBLISHED') continue;
    $blogCards[] = [
      'image' => $post['image'] ?? 'images/dubai-skyline.jpg',
      'title' => $post['name'] ?? '',
      'badge' => $post['badge'] ?? 'Buying Advice & Investment',
      'meta' => $post['meta'] ?? '23rd March 2026',
      'link' => $post['link'] ?? '#',
    ];
  }
  $readMoreLabel = !empty($c['link_text']) ? trim(str_replace('→', '', $c['link_text'])) : 'Read More';
@endphp

<section class="max-w-[1280px] mx-auto px-6 py-16" style="font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 justify-items-center">
    @foreach($blogCards as $b)
    <article class="blog-card-item">
      <div class="blog-card-img-wrap">
        <img src="{{ asset($b['image'] ?? 'images/dubai-skyline.jpg') }}" alt="{{ $b['title'] ?? '' }}">
      </div>
      <div class="blog-card-body">
        <div>
          <p class="blog-card-date">{{ $b['meta'] ?? '23rd March 2026' }}</p>
          <span class="blog-card-badge">{{ $b['badge'] ?? 'Buying Advice & Investment' }}</span>
          <h3 class="blog-card-title">{{ $b['title'] ?? '' }}</h3>
        </div>
        <a href="{{ $b['link'] ?? '#' }}" class="blog-card-btn">
          <span>{{ $readMoreLabel }}</span>
          <span>&rsaquo;</span>
        </a>
      </div>
    </article>
    @endforeach
  </div>
</section>

@php
  $hasHomeCommSection = isset($page) && $page->sections->contains('key', 'home_communities');
  $homeCommSec = !$hasHomeCommSection ? \App\Models\Section::where('key', 'home_communities')->first() : null;
@endphp
@if(!$hasHomeCommSection)
  @include('sections.communities_grid', [
    'c' => $homeCommSec ? $homeCommSec->c() : [],
    'section' => $homeCommSec,
    'forceHomeCarousel' => true,
  ])
@endif
