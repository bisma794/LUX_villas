<section class="max-w-[1280px] mx-auto px-6 py-12 font-inter">
  @php
    $amenityList = [
      ['name' => 'Children Play Area', 'img' => 'images/amenity-children.png'],
      ['name' => 'Schools', 'img' => 'images/amenity-schools.png'],
      ['name' => 'Restaurants', 'img' => 'images/amenity-restaurants.png'],
      ['name' => 'Shopping Mall', 'img' => 'images/amenity-mall.png'],
      ['name' => 'Sports Facilities', 'img' => 'images/amenity-sports.png'],
      ['name' => 'Fitness Centre', 'img' => 'images/amenity-fitness.png'],
      ['name' => 'Parking Area', 'img' => 'images/amenity-parking.png'],
      ['name' => 'Walking Trails', 'img' => 'images/amenity-trails.png'],
    ];
  @endphp

  <div class="mb-8">
    <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-[42px] text-[#0E3B2C] leading-tight">
      {!! $c['heading_html'] ?? 'Amenities &amp; Facilities' !!}
    </h2>
  </div>

  <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6">
    @foreach($amenityList as $am)
      <div class="bg-white border border-[#D2D2D2] rounded-[15px] p-5 sm:p-6 flex items-center gap-3.5 sm:gap-4 shadow-2xs hover:border-[#0E3B2C] hover:shadow-xs transition-all duration-300">
        <div class="w-10 h-10 sm:w-11 sm:h-11 shrink-0 flex items-center justify-center">
          <img src="{{ asset($am['img']) }}" alt="{{ $am['name'] }}" class="w-full h-full object-contain">
        </div>
        <span class="font-inter font-medium text-xs sm:text-sm text-[#10221C] leading-snug">
          {{ $am['name'] }}
        </span>
      </div>
    @endforeach
  </div>
</section>
