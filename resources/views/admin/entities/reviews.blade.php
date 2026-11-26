@extends('layouts.admin')

@section('content')
<div class="space-y-6 font-inter max-w-5xl mx-auto">

  {{-- Top Header Card --}}
  <div class="bg-white rounded-[16px] border border-slate-100 p-5 sm:p-6 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
      <h1 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight">
        Manage &gt; Client Reviews
      </h1>
      <p class="text-xs text-slate-500 font-medium mt-1">
        Configure the global client testimonials section shown across all pages on the website.
      </p>
    </div>

    <div class="flex items-center gap-3">
      <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF8F5] text-[#C5A47E] border border-[#C5A47E]/30">
        Global Section Active
      </span>
      <a href="/" target="_blank" class="px-4 py-2 rounded-xl bg-[#0E3B2C] hover:bg-[#16503c] text-white text-xs font-semibold shadow-xs transition-colors">
        View Live Website ↗
      </a>
    </div>
  </div>

  {{-- Reviews Editor Form --}}
  <form action="{{ route('admin.reviews.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[16px] border border-slate-100 p-6 sm:p-8 shadow-xs space-y-7">
    @csrf

    {{-- Section Level Details: Heading, Subtext, and "See all reviews" button --}}
    <div class="border-b border-slate-100 pb-6 space-y-5">
      <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Section Header</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-2">Section Heading</label>
          <input 
            type="text" 
            name="heading" 
            value="{{ old('heading', $reviewsData['heading'] ?? 'Why Our Clients Trust Us') }}" 
            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
          >
        </div>

        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-2">Top Action Button Text</label>
          <input 
            type="text" 
            name="button_text" 
            value="{{ old('button_text', $reviewsData['button_text'] ?? 'See all reviews') }}" 
            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
          >
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-2">Subtext / Tagline</label>
          <input 
            type="text" 
            name="subtext" 
            value="{{ old('subtext', $reviewsData['subtext'] ?? 'Discover what our customers are saying about their experiences.') }}" 
            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
          >
        </div>

        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-2">Top Action Button Link</label>
          <input 
            type="text" 
            name="button_link" 
            value="{{ old('button_link', $reviewsData['button_link'] ?? '#') }}" 
            class="w-full bg-[#FAF8F5] border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-[13px] text-slate-800 focus:outline-none focus:border-[#C5A47E]"
          >
        </div>
      </div>
    </div>

    {{-- Individual Review Cards --}}
    <div class="space-y-6">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Client Review Cards</h2>
          <p class="text-xs text-slate-400 mt-0.5">Displayed on the frontend client reviews section.</p>
        </div>
        <button type="button" onclick="addClientReviewCard()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs font-semibold shadow-xs cursor-pointer transition-colors">
          + Add Review Card
        </button>
      </div>

      <div id="client-reviews-grid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach(($reviewsData['items'] ?? []) as $i => $item)
          <div class="bg-[#FAF8F5]/70 border border-slate-200 rounded-2xl p-5 shadow-xs space-y-4 flex flex-col justify-between">
            
            <div class="space-y-3.5">
              {{-- Card Header --}}
              <div class="flex items-center justify-between pb-2 border-b border-slate-200">
                <span class="text-xs font-bold text-slate-800">Review #{{ $i + 1 }}</span>
                <div class="flex text-[#C5A47E] text-xs">
                  ★★★★★
                </div>
              </div>

              {{-- Avatar Upload & Browse Button --}}
              <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1.5">Client Avatar / Photo</label>
                <div class="flex items-center gap-3">
                  <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-200 shrink-0 border border-slate-200">
                    <img 
                      id="rev-avatar-preview-{{ $i }}"
                      src="{{ !empty($item['avatar']) ? asset($item['avatar']) : asset('images/avatar-man.jpg') }}" 
                      alt="{{ $item['name'] }}" 
                      class="w-full h-full object-cover"
                    >
                  </div>
                  <div class="flex-1 min-w-0">
                    <label class="px-3 py-1.5 rounded-lg bg-[#C5A47E] hover:bg-[#b8956e] text-white text-[11px] font-semibold shadow-xs cursor-pointer transition-colors inline-block">
                      <span>Browse Photo</span>
                      <input 
                        type="file" 
                        name="items[{{ $i }}][avatar_file]" 
                        accept="image/*" 
                        class="hidden"
                        onchange="previewRevAvatar(this, 'rev-avatar-preview-{{ $i }}')"
                      >
                    </label>
                    <input 
                      type="hidden" 
                      name="items[{{ $i }}][avatar]" 
                      value="{{ $item['avatar'] ?? '' }}"
                    >
                  </div>
                </div>
              </div>

              {{-- Client Name --}}
              <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Client Name</label>
                <input 
                  type="text" 
                  name="items[{{ $i }}][name]" 
                  value="{{ $item['name'] ?? 'Bashar Masalha' }}" 
                  class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                >
              </div>

              {{-- Review Date / Meta --}}
              <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Time / Meta (e.g. 3 months ago)</label>
                <input 
                  type="text" 
                  name="items[{{ $i }}][meta]" 
                  value="{{ $item['meta'] ?? '3 months ago' }}" 
                  class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-[#C5A47E]"
                >
              </div>

              {{-- Review Title / Heading --}}
              <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Review Title</label>
                <input 
                  type="text" 
                  name="items[{{ $i }}][title]" 
                  value="{{ $item['title'] ?? 'An Honest Approach to Real Estate' }}" 
                  class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]"
                >
              </div>

              {{-- Review Description Text --}}
              <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Review Text</label>
                <textarea 
                  name="items[{{ $i }}][text]" 
                  rows="4" 
                  class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs text-slate-700 focus:outline-none focus:border-[#C5A47E] leading-relaxed"
                >{{ $item['text'] ?? '' }}</textarea>
              </div>

              {{-- "More" Link URL --}}
              <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">"More" Link URL</label>
                <input 
                  type="text" 
                  name="items[{{ $i }}][more_link]" 
                  value="{{ $item['more_link'] ?? '#' }}" 
                  class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-[#C5A47E]"
                >
              </div>

            </div>

          </div>
        @endforeach
      </div>
    </div>

    {{-- Submit Button --}}
    <div class="pt-5 border-t border-slate-100 flex items-center justify-between">
      <button 
        type="submit" 
        class="px-7 py-3 rounded-xl bg-[#C5A47E] hover:bg-[#b8956e] text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors cursor-pointer"
      >
        Save All Client Reviews
      </button>

      <span class="text-xs text-slate-400">
        Changes reflect instantly across all pages featuring client reviews.
      </span>
    </div>

  </form>

</div>

<script>
  function addClientReviewCard() {
    const grid = document.getElementById('client-reviews-grid');
    if (!grid) return;
    const idx = grid.children.length;
    const card = document.createElement('div');
    card.className = 'bg-[#FAF8F5]/70 border border-slate-200 rounded-2xl p-5 shadow-xs space-y-4 flex flex-col justify-between';
    card.innerHTML = `
      <div class="space-y-3.5">
        <div class="flex items-center justify-between pb-2 border-b border-slate-200">
          <span class="text-xs font-bold text-slate-800">Review #${idx + 1}</span>
          <button type="button" onclick="this.closest('.bg-\\\\[\\\\#FAF8F5\\\\]\\\\/70').remove()" class="text-rose-500 hover:text-rose-600 text-xs font-semibold cursor-pointer">Remove ✕</button>
        </div>
        <div>
          <label class="block text-[11px] font-semibold text-slate-600 mb-1.5">Client Avatar / Photo</label>
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-200 shrink-0 border border-slate-200">
              <img id="rev-avatar-preview-${idx}" src="/images/avatar-man.jpg" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 min-w-0">
              <label class="px-3 py-1.5 rounded-lg bg-[#C5A47E] hover:bg-[#b8956e] text-white text-[11px] font-semibold shadow-xs cursor-pointer inline-block">
                <span>Browse Photo</span>
                <input type="file" name="items[${idx}][avatar_file]" accept="image/*" class="hidden" onchange="previewRevAvatar(this, 'rev-avatar-preview-${idx}')">
              </label>
              <input type="hidden" name="items[${idx}][avatar]" value="images/avatar-man.jpg">
            </div>
          </div>
        </div>
        <div>
          <label class="block text-[11px] font-semibold text-slate-600 mb-1">Client Name</label>
          <input type="text" name="items[${idx}][name]" value="" placeholder="Client Name" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]">
        </div>
        <div>
          <label class="block text-[11px] font-semibold text-slate-600 mb-1">Time / Meta</label>
          <input type="text" name="items[${idx}][meta]" value="Recently" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-[#C5A47E]">
        </div>
        <div>
          <label class="block text-[11px] font-semibold text-slate-600 mb-1">Review Title</label>
          <input type="text" name="items[${idx}][title]" value="" placeholder="Review Title" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#C5A47E]">
        </div>
        <div>
          <label class="block text-[11px] font-semibold text-slate-600 mb-1">Review Text</label>
          <textarea name="items[${idx}][text]" rows="4" placeholder="Write client testimonial..." class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs text-slate-700 focus:outline-none focus:border-[#C5A47E] leading-relaxed"></textarea>
        </div>
        <div>
          <label class="block text-[11px] font-semibold text-slate-600 mb-1">"More" Link URL</label>
          <input type="text" name="items[${idx}][more_link]" value="#" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-[#C5A47E]">
        </div>
      </div>
    `;
    grid.appendChild(card);
  }

  function previewRevAvatar(input, targetId) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const img = document.getElementById(targetId);
        if (img) {
          img.src = e.target.result;
        }
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endsection
