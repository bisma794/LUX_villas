@extends('layouts.admin')

@section('content')
<div class="space-y-6 font-inter">

  {{-- Page Header --}}
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="font-heading font-medium text-3xl sm:text-[34px] text-[#10221C] tracking-tight leading-snug">
        Manage &gt; Amenities
      </h1>
      <p class="text-xs text-neutral-400 font-medium mt-1">
        Home &nbsp;–&nbsp; Manage &nbsp;–&nbsp; Amenities &amp; Facilities
      </p>
    </div>

    {{-- Trigger Add Amenity Modal / Form Toggle --}}
    <button 
      type="button" 
      onclick="document.getElementById('add-amenity-modal').classList.remove('hidden')" 
      class="inline-flex items-center gap-1.5 px-4.5 py-2.5 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs transition-colors cursor-pointer"
    >
      + Add Amenity
    </button>
  </div>

  {{-- Amenities Grid / Table Card --}}
  <div class="bg-white rounded-[16px] border border-slate-100 shadow-xs overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
      <h3 class="text-sm font-bold text-slate-800">Available Amenities (Database Library)</h3>
      <span class="text-xs font-semibold text-slate-500 bg-[#FAF8F5] px-3 py-1 rounded-full border border-slate-200">
        {{ count($amenities) }} items registered
      </span>
    </div>

    <div class="p-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($amenities as $am)
          <div class="bg-white border border-[#D2D2D2] rounded-[15px] p-4.5 flex items-center gap-3.5 shadow-2xs hover:border-[#0E3B2C] hover:shadow-xs transition-all duration-300 group relative">
            <div class="w-10 h-10 shrink-0 flex items-center justify-center p-1 bg-[#FAF8F5] rounded-xl border border-slate-100">
              <img src="{{ asset($am['img']) }}" alt="{{ $am['name'] }}" class="w-full h-full object-contain">
            </div>
            <div class="flex-1 min-w-0">
              <h4 class="font-inter font-semibold text-xs sm:text-[13px] text-[#10221C] leading-snug truncate">
                {{ $am['name'] }}
              </h4>
              <span class="text-[10px] text-slate-400 font-mono">{{ $am['key'] }}</span>
            </div>
            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700">
              Active
            </span>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- Add Amenity Modal --}}
  <div id="add-amenity-modal" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-[20px] max-w-md w-full p-6 shadow-2xl border border-slate-100 space-y-5">
      <div class="flex items-center justify-between pb-3 border-b border-slate-100">
        <h3 class="text-base font-bold text-slate-800">Add New Amenity</h3>
        <button 
          type="button" 
          onclick="document.getElementById('add-amenity-modal').classList.add('hidden')" 
          class="text-slate-400 hover:text-slate-600 text-lg font-bold"
        >
          ×
        </button>
      </div>

      <form action="{{ route('admin.amenities.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Amenity Name <span class="text-rose-500">*</span></label>
          <input 
            type="text" 
            name="name" 
            required 
            placeholder="e.g. Infinity Pool, Kids Play Area" 
            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-[#C5A47E]"
          >
        </div>

        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Amenity Icon / Image <span class="text-rose-500">*</span></label>
          <div class="flex items-center gap-3">
            <input 
              type="file" 
              name="icon_file" 
              accept="image/*" 
              class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#F2ECE3] file:text-[#10221C] hover:file:bg-[#e6dccf] cursor-pointer"
            >
          </div>
          <p class="text-[11px] text-slate-400 mt-1">Upload PNG, SVG, or JPG icon</p>
        </div>

        <div class="pt-3 flex items-center justify-end gap-3 border-t border-slate-100">
          <button 
            type="button" 
            onclick="document.getElementById('add-amenity-modal').classList.add('hidden')" 
            class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold"
          >
            Cancel
          </button>
          <button 
            type="submit" 
            class="px-5 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs"
          >
            Save Amenity
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection
