<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title ?? 'Dashboard' }} — LUX Villa Dubai CMS</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@500;600;700&family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<!-- jQuery & Summernote Lite (CSS & JS) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<style>
  body { font-family: 'Inter', system-ui, -apple-system, sans-serif; background-color: #FAF8F5; color: #10221C; }
  .note-editor.note-frame { border: 1px solid #E2E8F0 !important; border-radius: 14px !important; overflow: hidden !important; background: #FAF8F5 !important; }
  .note-toolbar { background: white !important; border-bottom: 1px solid #E2E8F0 !important; padding: 8px 12px !important; }
  .note-editable { background: white !important; min-height: 280px !important; font-family: 'Inter', sans-serif !important; font-size: 14px !important; color: #1E293B !important; }
  .note-btn { background: white !important; border: 1px solid #E2E8F0 !important; border-radius: 8px !important; padding: 4px 8px !important; font-size: 12px !important; }
</style>
</head>
<body class="bg-[#FAF8F5] text-[#10221C] antialiased min-h-screen flex flex-col font-inter">

  {{-- Top Navigation Header (LUX Villa Dubai Theme) --}}
  <header class="w-full bg-white border-b border-[#EBE7DF] sticky top-0 z-40">
    <div class="px-6 lg:px-8 h-[74px] flex items-center justify-between">
      
      {{-- Left Side: LUX VILLA DUBAI Logo & Top Links --}}
      <div class="flex items-center gap-8 lg:gap-12">
        {{-- Brand Logo matching LUX VILLA DUBAI website --}}
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 shrink-0 group">
          <div class="w-10 h-10 rounded-[10px] bg-[#10221C] text-[#C5A47E] flex items-center justify-center font-serif font-bold text-xl tracking-tight shadow-2xs group-hover:bg-[#0E3B2C] transition-colors">
            LV
          </div>
          <span class="leading-tight">
            <span class="block font-serif font-bold text-[17px] tracking-[0.14em] text-[#10221C]">LUX VILLA</span>
            <span class="block text-[9px] tracking-[0.38em] text-[#C5A47E] -mt-0.5 font-semibold">DUBAI CMS</span>
          </span>
        </a>

        {{-- Collapse Sidebar Icon Button --}}
        <button type="button" class="w-8 h-8 rounded-lg bg-neutral-50 hover:bg-neutral-100 text-neutral-400 hover:text-neutral-700 flex items-center justify-center border border-[#EBE7DF] transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>

        {{-- Top Nav Links in LUX Tan/Forest Palette --}}
        <nav class="hidden md:flex items-center gap-7 text-xs font-semibold text-neutral-600">
          <a href="{{ route('admin.dashboard') }}" class="hover:text-[#C5A47E] transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-[#0E3B2C] font-bold border-b-2 border-[#C5A47E] pb-1' : '' }}">
            Dashboard
          </a>
          <a href="{{ route('home') }}" target="_blank" class="hover:text-[#C5A47E] transition-colors flex items-center gap-1">
            <span>Live Website</span>
            <svg class="w-3 h-3 text-[#C5A47E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
          </a>
          <a href="{{ route('admin.pages.index') }}" class="hover:text-[#C5A47E] transition-colors {{ request()->routeIs('admin.pages.*') ? 'text-[#0E3B2C] font-bold border-b-2 border-[#C5A47E] pb-1' : '' }}">
            Pages Manager
          </a>
          <a href="{{ route('admin.sections.index') }}" class="hover:text-[#C5A47E] transition-colors {{ request()->routeIs('admin.sections.*') ? 'text-[#0E3B2C] font-bold border-b-2 border-[#C5A47E] pb-1' : '' }}">
            Global Modules
          </a>
          <a href="{{ route('admin.settings') }}" class="hover:text-[#C5A47E] transition-colors {{ request()->routeIs('admin.settings') ? 'text-[#0E3B2C] font-bold border-b-2 border-[#C5A47E] pb-1' : '' }}">
            Site Settings
          </a>
        </nav>
      </div>

      {{-- Right Side: Quick Action Icons & Admin Profile --}}
      <div class="flex items-center gap-4 sm:gap-5 text-neutral-400">
        {{-- Search Icon --}}
        <a href="{{ route('admin.pages.index') }}" class="p-2 hover:text-[#10221C] hover:bg-neutral-50 rounded-lg transition-colors" title="Search Pages">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </a>

        {{-- Global Sections Icon --}}
        <a href="{{ route('admin.sections.index') }}" class="p-2 hover:text-[#10221C] hover:bg-neutral-50 rounded-lg transition-colors" title="Global Modules">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        </a>

        {{-- Online Status Indicator --}}
        <div class="relative">
          <a href="{{ route('admin.settings') }}" class="p-2 hover:text-[#10221C] hover:bg-neutral-50 rounded-lg transition-colors" title="System Status">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
          </a>
          <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 rounded-full bg-[#25D366]"></span>
        </div>

        {{-- User Avatar & Logout --}}
        <div class="relative pl-2 flex items-center gap-3">
          <img 
            src="{{ asset('images/avatar-man.jpg') }}" 
            alt="LUX Admin" 
            class="w-9 h-9 rounded-full object-cover border-2 border-[#C5A47E]"
          >
          <form action="{{ route('admin.logout') }}" method="POST" class="inline">
            @csrf
            <button class="text-xs font-semibold text-neutral-400 hover:text-rose-600 transition-colors" title="Logout">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            </button>
          </form>
        </div>

      </div>

    </div>
  </header>

  {{-- Main Layout: Left Sidebar + Content Area --}}
  <div class="flex-1 flex max-w-[1600px] w-full mx-auto">
    
    {{-- Left Sidebar: LUX Villa Dubai Theme & Exact Icons --}}
    <aside class="w-[240px] lg:w-[260px] shrink-0 bg-transparent py-8 px-4 flex flex-col justify-between">
      <div class="space-y-6">
        
        {{-- Overview Item --}}
        <div>
          <a 
            href="{{ route('admin.dashboard') }}" 
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#F2ECE3] text-[#10221C] font-bold border-l-4 border-[#C5A47E]' : 'text-neutral-600 hover:bg-neutral-100 hover:text-[#10221C]' }}"
          >
            <svg class="w-4 h-4 {{ request()->routeIs('admin.dashboard') ? 'text-[#C5A47E]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            <span>Overview</span>
          </a>
        </div>

        {{-- MANAGE Section Group --}}
        <div>
          <p class="px-3.5 text-[10px] font-bold tracking-wider text-neutral-400 uppercase mb-2">
            MANAGE
          </p>

          <nav class="space-y-1">
            {{-- Developer --}}
            <a 
              href="{{ route('admin.developers') }}" 
              class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all {{ request()->routeIs('admin.developers') ? 'bg-[#F2ECE3] text-[#10221C] font-bold border-l-4 border-[#C5A47E]' : 'text-neutral-600 hover:bg-neutral-100 hover:text-[#10221C]' }}"
            >
              <svg class="w-4 h-4 {{ request()->routeIs('admin.developers') ? 'text-[#C5A47E]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
              </svg>
              <span>Developer</span>
            </a>

            {{-- City --}}
            <a 
              href="{{ route('admin.cities') }}" 
              class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all {{ request()->routeIs('admin.cities') ? 'bg-[#F2ECE3] text-[#10221C] font-bold border-l-4 border-[#C5A47E]' : 'text-neutral-600 hover:bg-neutral-100 hover:text-[#10221C]' }}"
            >
              <svg class="w-4 h-4 {{ request()->routeIs('admin.cities') ? 'text-[#C5A47E]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
              </svg>
              <span>City</span>
            </a>

            {{-- Community (Matching reference styling: Tan active highlight) --}}
            <a 
              href="{{ route('admin.communities') }}" 
              class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all {{ request()->routeIs('admin.communities') ? 'bg-[#F2ECE3] text-[#10221C] font-bold border-l-4 border-[#C5A47E]' : 'text-neutral-600 hover:bg-neutral-100 hover:text-[#10221C]' }}"
            >
              <svg class="w-4 h-4 {{ request()->routeIs('admin.communities') ? 'text-[#C5A47E]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
              <span>Community</span>
            </a>

            {{-- Amenities & Facilities --}}
            <a 
              href="{{ route('admin.amenities') }}" 
              class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all {{ request()->routeIs('admin.amenities*') ? 'bg-[#F2ECE3] text-[#10221C] font-bold border-l-4 border-[#C5A47E]' : 'text-neutral-600 hover:bg-neutral-100 hover:text-[#10221C]' }}"
            >
              <svg class="w-4 h-4 {{ request()->routeIs('admin.amenities*') ? 'text-[#C5A47E]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
              </svg>
              <span>Amenities &amp; Facilities</span>
            </a>

            {{-- Blog --}}
            <a 
              href="{{ route('admin.blogs') }}" 
              class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all {{ request()->routeIs('admin.blogs') ? 'bg-[#F2ECE3] text-[#10221C] font-bold border-l-4 border-[#C5A47E]' : 'text-neutral-600 hover:bg-neutral-100 hover:text-[#10221C]' }}"
            >
              <svg class="w-4 h-4 {{ request()->routeIs('admin.blogs') ? 'text-[#C5A47E]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
              <span>Blog</span>
            </a>

            {{-- Off Plan Project --}}
            <a 
              href="{{ route('admin.offplan-projects') }}" 
              class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all {{ request()->routeIs('admin.offplan-projects') ? 'bg-[#F2ECE3] text-[#10221C] font-bold border-l-4 border-[#C5A47E]' : 'text-neutral-600 hover:bg-neutral-100 hover:text-[#10221C]' }}"
            >
              <svg class="w-4 h-4 {{ request()->routeIs('admin.offplan-projects') ? 'text-[#C5A47E]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
              </svg>
              <span>Off Plan Project</span>
            </a>

            {{-- Listing Project --}}
            <a 
              href="{{ route('admin.listing-projects') }}" 
              class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all {{ request()->routeIs('admin.listing-projects') ? 'bg-[#F2ECE3] text-[#10221C] font-bold border-l-4 border-[#C5A47E]' : 'text-neutral-600 hover:bg-neutral-100 hover:text-[#10221C]' }}"
            >
              <svg class="w-4 h-4 {{ request()->routeIs('admin.listing-projects') ? 'text-[#C5A47E]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
              </svg>
              <span>Listing Project</span>
            </a>

            {{-- Pages --}}
            <a 
              href="{{ route('admin.pages.index') }}" 
              class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all {{ request()->routeIs('admin.pages.*') ? 'bg-[#F2ECE3] text-[#10221C] font-bold border-l-4 border-[#C5A47E]' : 'text-neutral-600 hover:bg-neutral-100 hover:text-[#10221C]' }}"
            >
              <svg class="w-4 h-4 {{ request()->routeIs('admin.pages.*') ? 'text-[#C5A47E]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
              <span>Pages</span>
            </a>

            {{-- Global Modules / Menu --}}
            <a 
              href="{{ route('admin.sections.index') }}" 
              class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all {{ request()->routeIs('admin.sections.*') ? 'bg-[#F2ECE3] text-[#10221C] font-bold border-l-4 border-[#C5A47E]' : 'text-neutral-600 hover:bg-neutral-100 hover:text-[#10221C]' }}"
            >
              <svg class="w-4 h-4 {{ request()->routeIs('admin.sections.*') ? 'text-[#C5A47E]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
              </svg>
              <span>Global Modules</span>
            </a>

            {{-- Site Settings --}}
            <a 
              href="{{ route('admin.settings') }}" 
              class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all {{ request()->routeIs('admin.settings') ? 'bg-[#F2ECE3] text-[#10221C] font-bold border-l-4 border-[#C5A47E]' : 'text-neutral-600 hover:bg-neutral-100 hover:text-[#10221C]' }}"
            >
              <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              <span>Site Settings</span>
            </a>

            {{-- Client Reviews (Dedicated Side Panel Menu) --}}
            <a 
              href="{{ route('admin.reviews') }}" 
              class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all {{ request()->routeIs('admin.reviews*') ? 'bg-[#F2ECE3] text-[#10221C] font-bold border-l-4 border-[#C5A47E]' : 'text-neutral-600 hover:bg-neutral-100 hover:text-[#10221C]' }}"
            >
              <svg class="w-4 h-4 {{ request()->routeIs('admin.reviews*') ? 'text-[#C5A47E]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
              </svg>
              <span>Client Reviews</span>
            </a>
          </nav>
        </div>

      </div>
    </aside>

    {{-- Right Content Area --}}
    <main class="flex-1 py-8 px-6 lg:px-10 overflow-y-auto">
      
      {{-- Notification Alerts --}}
      @if(session('ok'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold rounded-xl px-4 py-3 mb-6 shadow-2xs">
          {{ session('ok') }}
        </div>
      @endif

      @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-xl px-4 py-3 mb-6 shadow-2xs">
          <ul class="list-disc ml-5 space-y-1 font-semibold">
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')

    </main>

  </div>

</body>
</html>
