@extends('layouts.admin')

@section('content')
<div class="space-y-6 font-inter">

  <div class="bg-white rounded-[16px] border border-slate-100 p-5 sm:p-6 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight">
        {{ !empty($isNew) ? 'Add New Listing Project (Ready To Move)' : 'Update Listing Project — ' . ($listing['name'] ?? '') }}
      </h1>
      <p class="text-xs text-slate-500 font-medium mt-1">
        Listings added here appear automatically at the top of <strong>/projects (Ready To Move)</strong> and <strong>/villas-for-sale</strong>.
      </p>
    </div>

    <div class="flex items-center gap-3">
      @if(empty($isNew) && !empty($listing['url']))
        <a href="{{ $listing['url'] }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#10221C] hover:bg-[#0E3B2C] text-white text-xs font-semibold shadow-xs transition-colors">
          Preview Live Page ↗
        </a>
      @endif
      <a href="{{ route('admin.listing-projects') }}" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
        Back
      </a>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
    <aside class="lg:col-span-3 space-y-2 sticky top-24">
      @php
        $tabs = [
          ['id' => 'basic', 'label' => 'Basic Detail & Price', 'active' => true],
          ['id' => 'gallery', 'label' => 'Gallery (3 Photos)', 'active' => false],
          ['id' => 'overview', 'label' => 'Overview & USPs', 'active' => false],
          ['id' => 'amenities', 'label' => 'Amenities', 'active' => false],
          ['id' => 'location', 'label' => 'Location (Lat / Lng)', 'active' => false],
          ['id' => 'full_content', 'label' => 'Full Content', 'active' => false],
          ['id' => 'faqs', 'label' => 'FAQs', 'active' => false],
        ];
      @endphp
      <div class="bg-white rounded-[16px] border border-slate-100 p-2 shadow-xs space-y-1">
        @foreach($tabs as $idx => $tab)
          <button type="button" data-listing-tab="{{ $tab['id'] }}"
            class="listing-nav-tab w-full text-left px-4 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold transition-all cursor-pointer flex items-center justify-between {{ $tab['active'] ? 'bg-[#F2ECE3] text-[#10221C] border-l-4 border-[#C5A47E] font-bold' : 'text-slate-600 hover:bg-slate-50' }}">
            <span class="truncate">{{ $tab['label'] }}</span>
            <span class="text-[10px] font-mono text-neutral-400 ml-1 shrink-0">#{{ $idx + 1 }}</span>
          </button>
        @endforeach
      </div>
    </aside>

    <div class="lg:col-span-9 bg-white rounded-[16px] border border-slate-100 p-6 sm:p-8 shadow-xs">
      <form action="{{ !empty($isNew) ? route('admin.listing-projects.store') : route('admin.listing-projects.update', $listing['slug']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="amenities_present" value="1">

        {{-- TAB 1: BASIC DETAIL & PRICE --}}
        <div data-listing-pane="basic" class="space-y-5">
          <div class="border-b border-slate-100 pb-3">
            <h2 class="font-heading font-medium text-xl text-[#10221C]">Basic Listing Details &amp; Pricing</h2>
            <p class="text-xs text-slate-400 mt-0.5">Configure title, property specs, price, community, and badges.</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Listing Name *</label>
              <input type="text" name="name" value="{{ old('name', $listing['name'] ?? '') }}" required class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Property Type</label>
              <select name="property_type" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
                <option value="Villa" {{ ($listing['property_type'] ?? 'Villa') === 'Villa' ? 'selected' : '' }}>Villa</option>
                <option value="Townhouse" {{ ($listing['property_type'] ?? '') === 'Townhouse' ? 'selected' : '' }}>Townhouse</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Price (e.g. AED 4,500,000)</label>
              <input type="text" name="price" value="{{ $listing['price'] ?? '' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Badge / Tag (e.g. READY TO MOVE)</label>
              <input type="text" name="tag" value="{{ $listing['tag'] ?? 'READY TO MOVE' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Bedrooms (e.g. 4)</label>
              <input type="text" name="beds" value="{{ $listing['beds'] ?? '' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Bathrooms (e.g. 5)</label>
              <input type="text" name="baths" value="{{ $listing['baths'] ?? '' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Area Size (e.g. 3,450 sq.ft)</label>
              <input type="text" name="sqft" value="{{ $listing['sqft'] ?? '' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Handover Status</label>
              <input type="text" name="handover" value="{{ $listing['handover'] ?? 'Ready to Move' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Payment Plan</label>
              <input type="text" name="payment_plan" value="{{ $listing['payment_plan'] ?? 'Cash / Mortgage' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Community</label>
              <input type="text" name="community" value="{{ $listing['community'] ?? 'The Valley' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">City</label>
              <select name="city" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
                <option value="Dubai" {{ ($listing['city'] ?? 'Dubai') === 'Dubai' ? 'selected' : '' }}>Dubai</option>
                <option value="Abu Dhabi" {{ ($listing['city'] ?? '') === 'Abu Dhabi' ? 'selected' : '' }}>Abu Dhabi</option>
                <option value="Sharjah" {{ ($listing['city'] ?? '') === 'Sharjah' ? 'selected' : '' }}>Sharjah</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Status</label>
              <select name="status" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-bold text-emerald-700 focus:outline-none focus:border-[#C5A47E]">
                <option value="PUBLISHED" {{ ($listing['status'] ?? 'PUBLISHED') === 'PUBLISHED' ? 'selected' : '' }}>PUBLISHED</option>
                <option value="DRAFT" {{ ($listing['status'] ?? '') === 'DRAFT' ? 'selected' : '' }}>DRAFT</option>
              </select>
            </div>
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Developer</label>
            <input type="text" name="developer" value="{{ $listing['developer'] ?? 'Emaar' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Meta Title</label>
            <input type="text" name="meta_title" value="{{ $listing['meta_title'] ?? '' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
          </div>
        </div>

        {{-- TAB 2: GALLERY --}}
        <div data-listing-pane="gallery" class="hidden space-y-5">
          <div class="border-b border-slate-100 pb-3">
            <h2 class="font-heading font-medium text-xl text-[#10221C]">Listing Photos (3-Photo Gallery)</h2>
            <p class="text-xs text-slate-400 mt-0.5">Upload cover image and secondary gallery photos.</p>
          </div>
          @foreach([
            ['field' => 'gallery_main', 'label' => 'Main Cover Photo (Also shown on cards)'],
            ['field' => 'gallery_top_right', 'label' => 'Top Right Photo'],
            ['field' => 'gallery_bottom_right', 'label' => 'Bottom Right Photo'],
          ] as $g)
            <div class="border border-slate-200 rounded-2xl p-4 bg-white flex flex-col sm:flex-row items-center gap-4">
              <div class="w-full sm:w-40 h-28 rounded-xl bg-slate-100 overflow-hidden border border-slate-200 shrink-0">
                <img id="prev-{{ $g['field'] }}" src="{{ asset($listing[$g['field']] ?? 'images/project-fairway-villa.jpg') }}" class="w-full h-full object-cover">
              </div>
              <div class="flex-1 w-full space-y-2">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-semibold text-slate-700">{{ $g['label'] }}</span>
                  <label class="px-4 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold cursor-pointer">
                    Browse
                    <input type="file" name="{{ $g['field'] }}_file" accept="image/*" class="hidden" onchange="if(this.files && this.files[0]){ const r=new FileReader(); r.onload=e=>document.getElementById('prev-{{ $g['field'] }}').src=e.target.result; r.readAsDataURL(this.files[0]); }">
                  </label>
                </div>
                <input type="text" name="{{ $g['field'] }}" value="{{ $listing[$g['field']] ?? '' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-500 font-mono">
              </div>
            </div>
          @endforeach
        </div>

        {{-- TAB 3: OVERVIEW & USPs --}}
        <div data-listing-pane="overview" class="hidden space-y-5">
          <div class="border-b border-slate-100 pb-3">
            <h2 class="font-heading font-medium text-xl text-[#10221C]">Overview &amp; USPs</h2>
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Headline USPs (separate with | e.g. The Valley | Prime Location | District Deal)</label>
            <input type="text" name="usps_text" value="{{ implode(' | ', $listing['usps'] ?? []) }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Subtitle</label>
            <input type="text" name="subtext" value="{{ $listing['subtext'] ?? '' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Authenticity Validation Text</label>
            <input type="text" name="authenticity" value="{{ $listing['authenticity'] ?? '' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Overview Heading</label>
            <input type="text" name="overview_heading" value="{{ $listing['overview_heading'] ?? 'Overview' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Overview Description</label>
            <textarea name="overview_text" rows="6" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl p-4 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]">{{ $listing['overview_text'] ?? '' }}</textarea>
          </div>
        </div>

        {{-- TAB 4: AMENITIES --}}
        <div data-listing-pane="amenities" class="hidden space-y-5">
          <div class="border-b border-slate-100 pb-3">
            <h2 class="font-heading font-medium text-xl text-[#10221C]">Amenities &amp; Facilities</h2>
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Amenities Heading</label>
            <input type="text" name="amenities_heading" value="{{ $listing['amenities_heading'] ?? 'Amenities & Facilities' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800">
          </div>
          @php $assignedAm = $listing['assigned_amenities'] ?? []; @endphp
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
            @foreach($allAmenities as $am)
              <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 bg-[#FAF8F5] cursor-pointer hover:border-[#C5A47E]">
                <input type="checkbox" name="assigned_amenities[]" value="{{ $am['key'] }}" {{ in_array($am['key'], $assignedAm) ? 'checked' : '' }} class="w-4 h-4 accent-[#0E3B2C]">
                <span class="text-xs font-semibold text-slate-800">{{ $am['name'] }}</span>
              </label>
            @endforeach
          </div>
        </div>

        {{-- TAB 5: LOCATION --}}
        <div data-listing-pane="location" class="hidden space-y-5">
          <div class="border-b border-slate-100 pb-3">
            <h2 class="font-heading font-medium text-xl text-[#10221C]">Property Location (Map Coordinates)</h2>
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Location Section Heading</label>
            <input type="text" name="location_heading" value="{{ $listing['location_heading'] ?? 'Property Location' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800">
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-2">Address / Location Text</label>
            <input type="text" name="location_text" value="{{ $listing['location_text'] ?? '' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800">
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Latitude</label>
              <input type="text" name="latitude" value="{{ $listing['latitude'] ?? '25.0085' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-mono">
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Longitude</label>
              <input type="text" name="longitude" value="{{ $listing['longitude'] ?? '55.4392' }}" class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] font-mono">
            </div>
          </div>
        </div>

        {{-- TAB 6: FULL CONTENT --}}
        <div data-listing-pane="full_content" class="hidden space-y-5">
          <div class="border-b border-slate-100 pb-3">
            <h2 class="font-heading font-medium text-xl text-[#10221C]">Full Content (Summernote)</h2>
          </div>
          <textarea name="full_content" rows="10" class="summernote-editor w-full">{!! $listing['full_content'] ?? '' !!}</textarea>
        </div>

        {{-- TAB 7: FAQS --}}
        <div data-listing-pane="faqs" class="hidden space-y-5">
          <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <h2 class="font-heading font-medium text-xl text-[#10221C]">Listing FAQs</h2>
            <button type="button" onclick="addListingFaq()" class="px-3.5 py-2 rounded-xl bg-[#10221C] text-white text-xs font-semibold cursor-pointer">+ Add FAQ</button>
          </div>
          <div id="listing-faqs-wrap" class="space-y-4">
            @foreach(($listing['faqs'] ?? []) as $fq)
              <div class="p-4 rounded-xl border border-slate-200 bg-[#FAF8F5] space-y-3">
                <input type="text" name="faq_q[]" value="{{ $fq['q'] ?? '' }}" placeholder="Question..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs font-semibold">
                <textarea name="faq_a[]" rows="2" placeholder="Answer..." class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs">{{ $fq['a'] ?? '' }}</textarea>
              </div>
            @endforeach
          </div>
        </div>

        <div class="pt-6 mt-8 border-t border-slate-100 flex items-center justify-end gap-3">
          <button type="submit" class="px-7 py-3 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold shadow-xs cursor-pointer">
            {{ !empty($isNew) ? 'Publish Listing Project' : 'Save Listing Changes' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function addListingFaq() {
    const wrap = document.getElementById('listing-faqs-wrap');
    const div = document.createElement('div');
    div.className = 'p-4 rounded-xl border border-slate-200 bg-[#FAF8F5] space-y-3';
    div.innerHTML = `<input type="text" name="faq_q[]" placeholder="Question..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs font-semibold"><textarea name="faq_a[]" rows="2" placeholder="Answer..." class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs"></textarea>`;
    wrap.appendChild(div);
  }
  document.addEventListener('DOMContentLoaded', function() {
    if (typeof $ !== 'undefined' && $.fn.summernote) {
      $('.summernote-editor').summernote({ height: 240 });
    }
    const tabs = document.querySelectorAll('[data-listing-tab]');
    const panes = document.querySelectorAll('[data-listing-pane]');
    tabs.forEach(t => t.addEventListener('click', function() {
      const target = this.getAttribute('data-listing-tab');
      tabs.forEach(x => {
        x.classList.remove('bg-[#F2ECE3]', 'text-[#10221C]', 'border-l-4', 'border-[#C5A47E]', 'font-bold');
        x.classList.add('text-slate-600');
      });
      this.classList.add('bg-[#F2ECE3]', 'text-[#10221C]', 'border-l-4', 'border-[#C5A47E]', 'font-bold');
      panes.forEach(p => p.classList.toggle('hidden', p.getAttribute('data-listing-pane') !== target));
    }));
  });
</script>
@endsection
