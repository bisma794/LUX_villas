@extends('layouts.app')

@section('content')
@php
  $listingSlug = $slug ?? 'the-valley-prime-location';
  $l = \App\Http\Controllers\Admin\EntityController::getListingProjectData($listingSlug);
@endphp

@include('sections.buy_listing_detail', ['c' => $l])

@if(!empty($l['full_content']))
@php
  $cleanFullContent = preg_replace('/(<(?:p|h[1-6])\b[^>]*?)\sstyle="[^"]*"/i', '$1', $l['full_content']);
@endphp
<section style="background-color: #F8F8F8;" class="py-20 md:py-24 font-inter border-t border-neutral-100">
  <div class="max-w-[1280px] mx-auto px-6">
    <div class="lux-rich-content lux-rich-content-inner max-w-none leading-relaxed" style="color: #000000;">
      {!! $cleanFullContent !!}
    </div>
  </div>
</section>
@endif

@if(!empty($l['faqs']))
  @include('sections.faq', ['c' => ['eyebrow' => 'FAQS', 'heading_html' => 'Frequently asked questions', 'faqs' => $l['faqs']]])
@endif

@php
  $regSec = \App\Models\Section::where('key', 'global_register')->first();
  $regC = $regSec ? $regSec->c() : [];
@endphp
@include('sections.register_interest', ['c' => $regC])
@endsection
