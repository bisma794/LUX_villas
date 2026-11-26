@extends('layouts.admin')

@section('content')
<div class="space-y-6 font-inter">

  <div class="flex items-center justify-between">
    <div>
      <h1 class="font-heading font-medium text-3xl sm:text-[34px] text-[#10221C] tracking-tight leading-snug">
        Manage &gt; Blog
      </h1>
      <p class="text-xs text-neutral-400 font-medium mt-1">
        Home &nbsp;&ndash;&nbsp; Manage &nbsp;&ndash;&nbsp; Blog (Auto-synced to /blog, newest at top)
      </p>
    </div>

    <a href="{{ route('admin.blogs.create') }}" class="inline-flex items-center gap-1.5 px-4.5 py-2.5 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs transition-colors">
      + Add Blog Post
    </a>
  </div>

  <div class="bg-white rounded-[16px] border border-slate-100 shadow-xs overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs sm:text-[13px]">
        <thead>
          <tr class="bg-[#F8FAFC] text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
            <th class="py-4 px-6 w-20">S.NO.</th>
            <th class="py-4 px-6">BLOG POST TITLE</th>
            <th class="py-4 px-6">CATEGORY</th>
            <th class="py-4 px-6">DATE</th>
            <th class="py-4 px-6">STATUS</th>
            <th class="py-4 px-6 text-right">ACTIONS</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700">
          @foreach($blogs as $item)
          <tr class="hover:bg-slate-50/60 transition-colors">
            <td class="py-4 px-6 text-slate-600 font-medium">{{ $item['id'] }}</td>
            <td class="py-4 px-6">
              <div class="flex items-center gap-3">
                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-9 rounded-lg object-cover border border-slate-200 shrink-0">
                <div>
                  <div class="font-semibold text-slate-800">{{ $item['name'] }}</div>
                  <div class="text-[11px] text-slate-400 font-mono">{{ $item['slug'] }}</div>
                </div>
              </div>
            </td>
            <td class="py-4 px-6 text-slate-600">{{ $item['badge'] }}</td>
            <td class="py-4 px-6 text-slate-500">{{ $item['meta'] }}</td>
            <td class="py-4 px-6">
              @if($item['status'] === 'PUBLISHED')
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase bg-[#10B981] text-white">
                  PUBLISHED
                </span>
              @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase bg-[#E2E8F0] text-slate-600">
                  DRAFT
                </span>
              @endif
            </td>
            <td class="py-4 px-6 text-right whitespace-nowrap">
              <div class="inline-flex items-center gap-2">
                <a href="{{ $item['edit_url'] }}" class="text-emerald-600 hover:text-emerald-700 p-1 transition-colors" title="Edit Blog Post">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </a>
                <form action="{{ route('admin.blogs.destroy', $item['slug']) }}" method="POST" onsubmit="return confirm('Delete this blog post?')" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-rose-500 hover:text-rose-600 p-1 transition-colors cursor-pointer" title="Delete">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </form>
                <a href="{{ $item['url'] }}" target="_blank" class="text-blue-500 hover:text-blue-600 p-1 transition-colors" title="View /blog">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
