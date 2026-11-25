<section class="max-w-[1280px] mx-auto px-6 pt-10">
  <div class="grid md:grid-cols-3 gap-4">
    <img src="{{ asset(($c['images'] ?? [])[0] ?? '') }}" alt="{{ ($c['alts'] ?? [])[0] ?? '' }}" class="md:col-span-2 card-img h-[440px]">
    <div class="grid grid-rows-2 gap-4"><img src="{{ asset(($c['images'] ?? [])[1] ?? '') }}" alt="{{ ($c['alts'] ?? [])[1] ?? '' }}" class="card-img h-[212px]"><img src="{{ asset(($c['images'] ?? [])[2] ?? '') }}" alt="{{ ($c['alts'] ?? [])[2] ?? '' }}" class="card-img h-[212px]"></div>
  </div>
</section>
