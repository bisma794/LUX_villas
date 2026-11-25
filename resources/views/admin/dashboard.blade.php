@extends('layouts.admin')

@section('content')
<div class="space-y-8 font-inter">

  {{-- Page Header: Abhaya Libre Heading --}}
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="font-heading font-medium text-3xl sm:text-[34px] text-[#10221C] tracking-tight leading-snug">
        Overview &gt; Dashboard
      </h1>
      <p class="text-xs sm:text-[13px] text-neutral-500 font-normal mt-1">
        Welcome to LUX Villa Dubai CMS. Manage website pages, global modules, and content settings.
      </p>
    </div>

    <a 
      href="{{ route('admin.pages.create') }}" 
      class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-[13px] font-semibold shadow-xs transition-colors shrink-0"
    >
      + Create Page
    </a>
  </div>

  {{-- Metric Stat Cards with Website Theme Badges --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    
    {{-- Card 1: Total Pages --}}
    <div class="bg-white rounded-[20px] p-6 border border-[#EBE7DF] shadow-xs flex items-center justify-between hover:border-[#C5A47E] transition-all">
      <div>
        <p class="text-[11px] font-bold text-neutral-400 uppercase tracking-wider">TOTAL PAGES</p>
        <p class="font-heading text-3xl font-bold text-[#10221C] mt-2">{{ $pagesCount }}</p>
        <p class="text-[11px] font-medium text-[#0E3B2C] mt-1 flex items-center gap-1.5">
          <span class="w-1.5 h-1.5 rounded-full bg-[#25D366]"></span>
          <span>{{ $publishedPages }} published</span>
        </p>
      </div>
      <div class="w-12 h-12 rounded-2xl bg-[#FAF8F5] text-[#C5A47E] flex items-center justify-center border border-[#EBE7DF]">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
      </div>
    </div>

    {{-- Card 2: Library Sections --}}
    <div class="bg-white rounded-[20px] p-6 border border-[#EBE7DF] shadow-xs flex items-center justify-between hover:border-[#C5A47E] transition-all">
      <div>
        <p class="text-[11px] font-bold text-neutral-400 uppercase tracking-wider">LIBRARY SECTIONS</p>
        <p class="font-heading text-3xl font-bold text-[#10221C] mt-2">{{ $sectionsCount }}</p>
        <p class="text-[11px] font-medium text-[#0E3B2C] mt-1 flex items-center gap-1.5">
          <span class="w-1.5 h-1.5 rounded-full bg-[#C5A47E]"></span>
          <span>{{ $globalSections }} global modules</span>
        </p>
      </div>
      <div class="w-12 h-12 rounded-2xl bg-[#FAF8F5] text-[#0E3B2C] flex items-center justify-center border border-[#EBE7DF]">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
      </div>
    </div>

    {{-- Card 3: Global Sections --}}
    <div class="bg-white rounded-[20px] p-6 border border-[#EBE7DF] shadow-xs flex items-center justify-between hover:border-[#C5A47E] transition-all">
      <div>
        <p class="text-[11px] font-bold text-neutral-400 uppercase tracking-wider">GLOBAL SECTIONS</p>
        <p class="font-heading text-3xl font-bold text-[#10221C] mt-2">{{ $globalSections }}</p>
        <a href="{{ route('admin.sections.index') }}" class="text-[11px] font-semibold text-[#C5A47E] hover:underline mt-1 block">
          Manage Library →
        </a>
      </div>
      <div class="w-12 h-12 rounded-2xl bg-[#FAF8F5] text-[#C5A47E] flex items-center justify-center border border-[#EBE7DF]">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
      </div>
    </div>

    {{-- Card 4: Live Website --}}
    <div class="bg-white rounded-[20px] p-6 border border-[#EBE7DF] shadow-xs flex items-center justify-between hover:border-[#C5A47E] transition-all">
      <div>
        <p class="text-[11px] font-bold text-neutral-400 uppercase tracking-wider">LIVE WEBSITE</p>
        <p class="font-heading text-xl font-bold text-[#10221C] mt-2">Active</p>
        <a href="{{ route('home') }}" target="_blank" class="text-[11px] font-semibold text-[#0E3B2C] hover:underline mt-1 block">
          Visit Homepage ↗
        </a>
      </div>
      <div class="w-12 h-12 rounded-2xl bg-[#FAF8F5] text-[#0E3B2C] flex items-center justify-center border border-[#EBE7DF]">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
      </div>
    </div>

  </div>

  {{-- 2 Tables: LUX Website Pages & Global Sections --}}
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    {{-- Left: Website Pages --}}
    <div class="bg-white rounded-[20px] border border-[#EBE7DF] shadow-xs p-6">
      <div class="flex items-center justify-between mb-5">
        <h2 class="font-heading font-medium text-2xl text-[#10221C]">
          All Website Pages
        </h2>
        <a href="{{ route('admin.pages.index') }}" class="text-xs font-semibold text-[#C5A47E] hover:underline">
          View all →
        </a>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-xs sm:text-[13px] text-neutral-700">
          <tbody class="divide-y divide-dashed divide-neutral-200">
            @foreach($pages->take(8) as $index => $p)
            <tr class="hover:bg-[#FAF8F5] transition-colors group">
              <td class="py-3.5 pr-3 text-neutral-400 font-medium w-8">{{ $index + 1 }}</td>
              <td class="py-3.5 font-semibold text-neutral-800 group-hover:text-[#C5A47E] transition-colors">
                <a href="{{ route('admin.pages.edit', $p) }}">
                  {{ $p->title }}
                </a>
              </td>
              <td class="py-3.5 text-right text-neutral-400">{{ $p->sections_count }} sections</td>
              <td class="py-3.5 pl-4 text-right">
                <a href="{{ route('admin.pages.edit', $p) }}" class="text-[#0E3B2C] hover:text-[#C5A47E] font-semibold transition-colors">
                  Edit
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- Right: Reusable Component Library --}}
    <div class="bg-white rounded-[20px] border border-[#EBE7DF] shadow-xs p-6">
      <div class="flex items-center justify-between mb-5">
        <h2 class="font-heading font-medium text-2xl text-[#10221C]">
          Global Section Library
        </h2>
        <a href="{{ route('admin.sections.index') }}" class="text-xs font-semibold text-[#C5A47E] hover:underline">
          View library →
        </a>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-xs sm:text-[13px] text-neutral-700">
          <tbody class="divide-y divide-dashed divide-neutral-200">
            @foreach($sections->sortByDesc('pages_count')->take(8) as $s)
            <tr class="hover:bg-[#FAF8F5] transition-colors group">
              <td class="py-3.5 font-semibold text-neutral-800 group-hover:text-[#C5A47E] transition-colors">
                <a href="{{ route('admin.sections.edit', $s) }}">
                  {{ $s->name }}
                </a>
                <span class="block text-[11px] text-neutral-400 font-normal">{{ $s->type }}</span>
              </td>
              <td class="py-3.5 text-right text-neutral-400">{{ $s->pages_count }} page(s)</td>
              <td class="py-3.5 pl-4 text-right">
                <a href="{{ route('admin.sections.edit', $s) }}" class="text-[#0E3B2C] hover:text-[#C5A47E] font-semibold transition-colors">
                  Configure
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>

</div>
@endsection
