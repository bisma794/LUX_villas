@extends('layouts.admin')

@section('content')
<div class="space-y-6 font-inter">

  {{-- Page Header --}}
  <div class="flex items-center justify-between">
    <div>
      <h1 class="font-heading font-medium text-3xl sm:text-[34px] text-[#10221C] tracking-tight leading-snug">
        Manage &gt; {{ $title }}
      </h1>
      <p class="text-xs text-neutral-400 font-medium mt-1">
        Home &nbsp;–&nbsp; Manage &nbsp;–&nbsp; {{ $title }}
      </p>
    </div>

    @if(!empty($create_url))
      <a href="{{ $create_url }}" class="inline-flex items-center gap-1.5 px-4.5 py-2.5 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs transition-colors">
        + Add {{ $title }}
      </a>
    @else
      <button type="button" class="inline-flex items-center gap-1.5 px-4.5 py-2.5 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs transition-colors cursor-pointer">
        + Add {{ $title }}
      </button>
    @endif
  </div>

  {{-- White Card Container matching reference screenshot --}}
  <div class="bg-white rounded-[16px] border border-slate-100 shadow-xs overflow-hidden">
    
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs sm:text-[13px]">
        <thead>
          <tr class="bg-[#F8FAFC] text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
            <th class="py-4 px-6 w-20">S.NO. ↑↓</th>
            <th class="py-4 px-6">{{ $nameLabel }} ↑↓</th>
            <th class="py-4 px-6">SLUG</th>
            <th class="py-4 px-6">CITY NAME ↑↓</th>
            <th class="py-4 px-6">STATUS</th>
            <th class="py-4 px-6">DISAPPROVE COMMENTS</th>
            <th class="py-4 px-6 text-right">ACTIONS</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700">
          @foreach($items as $item)
          <tr class="hover:bg-slate-50/60 transition-colors">
            <td class="py-4 px-6 text-slate-600 font-medium">{{ $item['id'] }}</td>
            <td class="py-4 px-6 font-semibold text-slate-800">{{ $item['name'] }}</td>
            <td class="py-4 px-6 text-slate-500 font-mono text-xs">{{ $item['slug'] }}</td>
            <td class="py-4 px-6 text-slate-600">{{ $item['city'] }}</td>
            <td class="py-4 px-6">
              @if($item['status'] === 'PUBLISHED')
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase bg-[#10B981] text-white shadow-[0_0_10px_rgba(16,185,129,0.45)]">
                  PUBLISHED
                </span>
              @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase bg-[#E2E8F0] text-slate-600">
                  DRAFT
                </span>
              @endif
            </td>
            <td class="py-4 px-6 text-slate-400">{{ $item['disapprove_comments'] }}</td>
            <td class="py-4 px-6 text-right whitespace-nowrap">
              <div class="inline-flex items-center gap-2">
                @if(!empty($item['edit_url']))
                <a href="{{ $item['edit_url'] }}" class="text-emerald-600 hover:text-emerald-700 p-1 transition-colors" title="Edit {{ $title }}">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </a>
                @else
                <button type="button" class="text-emerald-600 hover:text-emerald-700 p-1 transition-colors" title="Edit">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </button>
                @endif
                @if(!empty($item['delete_url']))
                <form action="{{ $item['delete_url'] }}" method="POST" onsubmit="return confirm('Delete {{ addslashes($item['name']) }}?')" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-rose-500 hover:text-rose-600 p-1 transition-colors cursor-pointer" title="Delete">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </form>
                @else
                <button type="button" class="text-rose-500 hover:text-rose-600 p-1 transition-colors" title="Delete">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
                @endif
                @if(!empty($item['url']))
                <a href="{{ $item['url'] }}" target="_blank" class="text-blue-500 hover:text-blue-600 p-1 transition-colors" title="Open Public Page">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
                @endif
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Footer Pagination --}}
    <div class="px-6 py-4 bg-white border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
      <div>Showing 1 to {{ count($items) }} of {{ count($items) }}</div>
      <div class="flex items-center gap-3">
        <select class="border border-slate-200 rounded-md px-2 py-1 text-xs text-slate-700 bg-white">
          <option>10</option>
        </select>
        <div class="flex items-center gap-1">
          <button type="button" class="w-7 h-7 rounded-md border border-slate-100 bg-slate-50 text-slate-400 flex items-center justify-center cursor-not-allowed">«</button>
          <button type="button" class="w-7 h-7 rounded-md border border-slate-100 bg-slate-50 text-slate-400 flex items-center justify-center cursor-not-allowed">‹</button>
          <button type="button" class="w-7 h-7 rounded-md bg-[#F2ECE3] text-[#10221C] font-bold flex items-center justify-center">1</button>
          <button type="button" class="w-7 h-7 rounded-md border border-slate-100 bg-slate-50 text-slate-400 flex items-center justify-center cursor-not-allowed">›</button>
          <button type="button" class="w-7 h-7 rounded-md border border-slate-100 bg-slate-50 text-slate-400 flex items-center justify-center cursor-not-allowed">»</button>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection
