@extends('layouts.admin')

@section('content')
<div class="space-y-6 font-inter">

  {{-- Minimal Header: Manage > Pages only --}}
  <div>
    <h1 class="font-heading font-medium text-3xl sm:text-[34px] text-[#10221C] tracking-tight leading-snug">
      Manage &gt; Pages
    </h1>
    <p class="text-xs text-neutral-400 font-medium mt-1">
      Home &nbsp;–&nbsp; Manage &nbsp;–&nbsp; Pages
    </p>
  </div>

  {{-- White Card Container --}}
  <div class="bg-white rounded-[20px] border border-[#EBE7DF] shadow-xs p-6 sm:p-8">
    
    {{-- Search Input Bar & Add Page Button --}}
    <div class="mb-8 flex items-center justify-between gap-4">
      <form method="GET" class="relative max-w-sm w-full">
        <div class="relative flex items-center bg-[#FAF8F5] border border-[#EBE7DF] rounded-xl px-4 py-2.5 transition-colors focus-within:border-[#C5A47E] focus-within:bg-white">
          <svg class="w-4 h-4 text-neutral-400 shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
          <input 
            type="text" 
            name="q" 
            value="{{ $q }}" 
            placeholder="Search..." 
            class="w-full text-xs sm:text-[13px] text-neutral-800 placeholder-neutral-400 bg-transparent focus:outline-none"
          >
        </div>
      </form>

      <a 
        href="{{ route('admin.pages.create') }}" 
        class="inline-flex items-center gap-1.5 px-4.5 py-2.5 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs transition-colors shrink-0"
      >
        <span>+ Add Page</span>
      </a>
    </div>

    {{-- Clean Minimal Table: Only # ^, NAME, ACTIONS --}}
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs sm:text-[13px]">
        
        {{-- Table Head: # ^, NAME, ACTIONS --}}
        <thead>
          <tr class="text-[11px] font-bold text-neutral-400 uppercase tracking-wider border-b border-neutral-100">
            <th class="py-3.5 pr-4 w-16">
              <span class="inline-flex items-center gap-1 cursor-pointer hover:text-neutral-600">
                #
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
              </span>
            </th>
            <th class="py-3.5 px-6">
              NAME
            </th>
            <th class="py-3.5 pl-6 text-right w-28">
              ACTIONS
            </th>
          </tr>
        </thead>

        {{-- Table Body: Clean without subtext or extra labels --}}
        <tbody class="divide-y divide-dashed divide-neutral-200 text-neutral-700">
          @forelse($pages as $index => $p)
          <tr class="hover:bg-[#FAF8F5] transition-colors group">
            
            {{-- Index Number (#) --}}
            <td class="py-4 pr-4 font-semibold text-neutral-400">
              {{ $index + 1 }}
            </td>

            {{-- Page Name Only --}}
            <td class="py-4 px-6 font-semibold text-neutral-800 group-hover:text-[#C5A47E] transition-colors">
              <a href="{{ route('admin.pages.edit', $p) }}">
                {{ $p->title }}
              </a>
            </td>

            {{-- Actions: Edit Pencil and View Eye icons --}}
            <td class="py-4 pl-6 text-right whitespace-nowrap">
              <div class="flex items-center justify-end gap-2 text-neutral-400">
                {{-- Edit Button --}}
                <a 
                  href="{{ route('admin.pages.edit', $p) }}" 
                  class="p-1.5 hover:text-[#0E3B2C] hover:bg-[#F2ECE3] rounded-lg transition-colors"
                  title="Edit"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                  </svg>
                </a>

                {{-- View / Eye Button --}}
                <a 
                  href="{{ $p->url() }}" 
                  target="_blank" 
                  class="p-1.5 hover:text-[#C5A47E] hover:bg-[#F2ECE3] rounded-lg transition-colors"
                  title="View"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                </a>
              </div>
            </td>

          </tr>
          @empty
          <tr>
            <td colspan="3" class="py-8 text-center text-neutral-400">
              No pages found.
            </td>
          </tr>
          @endforelse
        </tbody>

      </table>
    </div>

    {{-- Pagination --}}
    @if($pages->hasPages())
      <div class="mt-6 pt-4 border-t border-neutral-100">
        {{ $pages->links() }}
      </div>
    @endif

  </div>

</div>
@endsection
