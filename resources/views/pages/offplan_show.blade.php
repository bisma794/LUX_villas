@extends('layouts.app')

@section('content')
@php
  $projectSlug = $slug ?? 'golf-vale-emaar-south';
  $p = \App\Http\Controllers\Admin\EntityController::getOffplanProjectData($projectSlug);
@endphp

@include('sections.project_header', ['c' => $p, 'project' => $p])
@include('sections.project_detail', ['c' => $p, 'project' => $p])

{{-- Dynamic Full Content (SEO Text Block from Summernote) --}}
@if(!empty($p['full_content']))
@php
  $cleanFullContent = preg_replace('/(<(?:p|h[1-6])\b[^>]*?)\sstyle="[^"]*"/i', '$1', $p['full_content']);
@endphp
<section style="background-color: #F8F8F8;" class="py-20 md:py-24 font-inter border-t border-neutral-100">
  <div class="max-w-[1280px] mx-auto px-6">
    <div class="lux-rich-content lux-rich-content-inner max-w-none leading-relaxed" style="color: #000000;">
      {!! $cleanFullContent !!}
    </div>
  </div>
</section>
@endif

{{-- Dynamic Project FAQs --}}
@include('sections.faq', ['c' => ['eyebrow' => 'FAQS', 'heading_html' => 'Frequently asked questions', 'faqs' => $p['faqs'] ?? []]])

{{-- Global Register Interest Section --}}
@php
  $regSec = \App\Models\Section::where('key', 'global_register')->first();
  $regC = $regSec ? $regSec->c() : [];
@endphp
@include('sections.register_interest', ['c' => $regC])
@endsection
