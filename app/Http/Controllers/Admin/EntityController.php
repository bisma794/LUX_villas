<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public static function getAmenitiesStore()
    {
        $filePath = storage_path('app/amenities_data.json');
        if (file_exists($filePath)) {
            $data = json_decode(file_get_contents($filePath), true);
            if (is_array($data) && !empty($data)) {
                return $data;
            }
        }

        $defaults = [
            ['id' => 1, 'key' => 'children-play-area', 'name' => 'Children Play Area', 'img' => 'images/amenity-children.png'],
            ['id' => 2, 'key' => 'schools', 'name' => 'Schools', 'img' => 'images/amenity-schools.png'],
            ['id' => 3, 'key' => 'restaurants', 'name' => 'Restaurants', 'img' => 'images/amenity-restaurants.png'],
            ['id' => 4, 'key' => 'shopping-mall', 'name' => 'Shopping Mall', 'img' => 'images/amenity-mall.png'],
            ['id' => 5, 'key' => 'sports-facilities', 'name' => 'Sports Facilities', 'img' => 'images/amenity-sports.png'],
            ['id' => 6, 'key' => 'fitness-centre', 'name' => 'Fitness Centre', 'img' => 'images/amenity-fitness.png'],
            ['id' => 7, 'key' => 'parking-area', 'name' => 'Parking Area', 'img' => 'images/amenity-parking.png'],
            ['id' => 8, 'key' => 'walking-trails', 'name' => 'Walking Trails', 'img' => 'images/amenity-trails.png'],
        ];

        return $defaults;
    }

    public function amenities()
    {
        $amenities = self::getAmenitiesStore();
        return view('admin.entities.amenities', compact('amenities'));
    }

    public function storeAmenity(Request $request)
    {
        $name = trim($request->input('name'));
        if (!$name) {
            return redirect()->back();
        }

        $key = \Illuminate\Support\Str::slug($name);
        $img = 'images/amenity-children.png';

        if ($request->hasFile('icon_file')) {
            $file = $request->file('icon_file');
            $filename = time() . '_amenity_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $img = 'images/' . $filename;
        }

        $all = self::getAmenitiesStore();
        $newId = count($all) + 1;
        $all[] = [
            'id' => $newId,
            'key' => $key,
            'name' => $name,
            'img' => $img,
        ];

        $filePath = storage_path('app/amenities_data.json');
        file_put_contents($filePath, json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        return redirect()->back()->with('ok', 'New amenity added to library.');
    }

    public static function getCommunityStore()
    {
        $filePath = storage_path('app/communities_data.json');
        if (file_exists($filePath)) {
            $data = json_decode(file_get_contents($filePath), true);
            if (is_array($data) && !empty($data)) {
                return $data;
            }
        }

        $defaults = [
            'the-valley' => [
                'id' => 1,
                'name' => 'The Valley',
                'slug' => 'the-valley',
                'city' => 'Dubai',
                'status' => 'DRAFT',
                'url' => '/communities/the-valley',
                'breadcrumbs' => 'HOME > COMMUNITIES',
                'hero_heading' => 'The Valley Dubai',
                'hero_subtext' => 'Green open spaces, real amenities and the numbers behind each villa community.',
                'hero_img' => 'images/communities-hero-villa.jpg',
                'show_form' => true,
                'form_title' => 'Enquire about The Valley Dubai',
                // Content Section (Community Guide)
                'guide_heading' => 'The Valley Community Guide',
                'guide_description' => 'The Valley is a green, family-first community by Emaar — parks, trails, schools and townhouses and villas set around open space. It suits families who want room to grow, and investors who want strong rental demand at an accessible price point.',
                'media_type' => 'video', // 'video', 'image', or 'hidden'
                'media_image' => 'images/family-park.jpg',
                'video_url' => '',
                // Feature Stats Bar (4 Pairs: upper & lower text)
                'features' => [
                    ['upper' => '7,000+', 'lower' => 'Acres planned'],
                    ['upper' => 'Residential', 'lower' => 'Villas, townhouses.'],
                    ['upper' => 'Green Spaces', 'lower' => 'Parks, lakes and trails'],
                    ['upper' => 'Integrated', 'lower' => 'Live, work, shop and relax'],
                ],
                'assigned_offplan_projects' => ['nara-townhouse', 'the-fairway-villa'],
                'assigned_ready_projects' => ['the-fairway-villa', 'maple-row-villa'],
                'assigned_amenities' => ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'],
                // Community Specific FAQs
                'faqs' => [
                    ['q' => 'What is The Valley Dubai?', 'a' => 'The Valley is a master-planned community by Emaar designed for family living with green open spaces, interconnected parks, and world-class leisure facilities.'],
                    ['q' => 'Who is the developer behind The Valley?', 'a' => 'The Valley is developed by Emaar Properties, the premier master-developer of Burj Khalifa and Downtown Dubai.'],
                    ['q' => 'Where is The Valley located?', 'a' => 'The Valley is strategically positioned on the Dubai–Al Ain Road, offering seamless connectivity to Downtown Dubai, DXB Airport, and academic hubs.'],
                    ['q' => 'What types of properties are available in The Valley?', 'a' => 'The community features spacious 3 and 4-bedroom townhouses and 4 to 5-bedroom luxury villas with contemporary finishes.'],
                    ['q' => 'Is The Valley a good investment opportunity?', 'a' => 'Yes, with competitive entry prices, robust capital growth projections, and high rental yields favored by families and long-term expatriates.'],
                    ['q' => 'Does The Valley offer a flexible payment plan?', 'a' => 'Yes, off-plan projects in The Valley typically provide attractive 80/20 or 70/30 construction-linked payment plans with post-handover options.'],
                ],
                // Full Content Rich Text (Summernote)
                'full_content' => '<h3>Modern lifestyle and residential opportunities</h3><p>Dubai offers a diverse range of residential properties designed to meet different needs. From contemporary apartments to spacious villas and premium residential developments, buyers can explore various options based on their requirements.</p><p>When researching property communities in Dubai, potential buyers should consider important factors such as property location, accessibility, available facilities, and nearby commercial areas. A well-planned residential community can provide convenient access to shopping centers, schools, healthcare facilities, recreational spaces, and major transportation routes.</p><p>These features make Dubai an attractive destination for families, professionals, and international property investors seeking a modern urban lifestyle.</p><h3>Luxury villas and real estate investment opportunities</h3><p>Dubai has established itself as a significant international real estate destination. Its business-friendly environment, tourism industry, modern infrastructure, and international connectivity contribute to continued interest from property investors.</p><p>Before purchasing a property, it is essential to evaluate the total cost of ownership, applicable service charges, payment plans, and the legal status of the development.</p>',
                'meta_title' => 'Luxury Villas & Townhouses in The Valley | LUX Villa Dubai',
                'meta_keyword' => 'the valley dubai, emaar the valley, luxury villas dubai',
                'meta_description' => 'Discover prime villas and spacious modern townhouses in The Valley by Emaar. Exclusive master-planned desert community in Dubai.',
            ],
            'dubai-hills-estate' => [
                'id' => 2,
                'name' => 'Dubai Hills Estate',
                'slug' => 'dubai-hills-estate',
                'city' => 'Dubai',
                'status' => 'DRAFT',
                'url' => '/communities/dubai-hills-estate',
                'breadcrumbs' => 'HOME > COMMUNITIES',
                'hero_heading' => 'Dubai Hills Estate',
                'hero_subtext' => 'The green heart of Dubai, centered around an 18-hole championship golf course.',
                'hero_img' => 'images/community-dubai-hills.jpg',
                'show_form' => true,
                'form_title' => 'Enquire about Dubai Hills Estate',
                'meta_title' => 'Luxury Mansions & Golf Villas in Dubai Hills Estate | LUX Villa Dubai',
                'meta_keyword' => 'dubai hills estate, golf course villas, luxury estates dubai',
                'meta_description' => 'Explore ultra-prime golf estates and luxury family villas in Dubai Hills Estate. Minutes away from Downtown Dubai.',
            ],
            'emaar-south' => [
                'id' => 3,
                'name' => 'Emaar South',
                'slug' => 'emaar-south',
                'city' => 'Dubai',
                'status' => 'DRAFT',
                'url' => '/communities/emaar-south',
                'breadcrumbs' => 'HOME > COMMUNITIES',
                'hero_heading' => 'Emaar South Dubai',
                'hero_subtext' => 'Smart living in Dubai South near Al Maktoum Airport and Expo City.',
                'hero_img' => 'images/golf-vale-main.jpg',
                'show_form' => true,
                'form_title' => 'Enquire about Emaar South',
                'meta_title' => 'Golf Vale & Modern Living in Emaar South | LUX Villa Dubai',
                'meta_keyword' => 'emaar south, golf vale emaar south, expo city living dubai',
                'meta_description' => 'Golf Vale and prime suburban residences in Emaar South Dubai. Contemporary luxury next to championship golf course.',
            ],
            'jvc' => [
                'id' => 4,
                'name' => 'Jumeirah Village Circle',
                'slug' => 'jvc',
                'city' => 'Dubai',
                'status' => 'DRAFT',
                'url' => '/communities/jvc',
                'breadcrumbs' => 'HOME > COMMUNITIES',
                'hero_heading' => 'Jumeirah Village Circle (JVC)',
                'hero_subtext' => 'Family-friendly master development with landscaped parks, schools and apartments.',
                'hero_img' => 'images/community-jvc.jpg',
                'show_form' => true,
                'form_title' => 'Enquire about JVC Dubai',
                'meta_title' => 'Villas & High Yield Residences in JVC | LUX Villa Dubai',
                'meta_keyword' => 'jvc dubai, jumeirah village circle, high roi villas dubai',
                'meta_description' => 'Family community with exceptional yields and boutique contemporary villas in Jumeirah Village Circle (JVC).',
            ],
            'dubailand' => [
                'id' => 5,
                'name' => 'Dubailand',
                'slug' => 'dubailand',
                'city' => 'Dubai',
                'status' => 'DRAFT',
                'url' => '/communities/dubailand',
                'breadcrumbs' => 'HOME > COMMUNITIES',
                'hero_heading' => 'Dubailand Luxury Living',
                'hero_subtext' => 'Expansive residential, sports, and entertainment hub designed for family living.',
                'hero_img' => 'images/community-dubailand.jpg',
                'show_form' => true,
                'form_title' => 'Enquire about Dubailand',
                'meta_title' => 'Sprawling Luxury Villa Communities in Dubailand | LUX Villa Dubai',
                'meta_keyword' => 'dubailand, master planned villas dubai, expansive luxury homes',
                'meta_description' => 'Premier residential communities and leisure destinations in Dubailand. Spacious private villas and lush landscapes.',
            ],
        ];

        return $defaults;
    }

    public static function getCommunityData($slug)
    {
        $all = self::getCommunityStore();
        if (isset($all[$slug])) {
            return $all[$slug];
        }

        return [
            'id' => 99,
            'name' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'city' => 'Dubai',
            'status' => 'DRAFT',
            'url' => '/communities/' . $slug,
            'breadcrumbs' => 'HOME > COMMUNITIES',
            'hero_heading' => ucwords(str_replace('-', ' ', $slug)) . ' Dubai',
            'hero_subtext' => 'Green open spaces, real amenities and the numbers behind each villa community.',
            'hero_img' => 'images/communities-hero-villa.jpg',
            'show_form' => true,
            'form_title' => 'Enquire about ' . ucwords(str_replace('-', ' ', $slug)),
            // Content Section
            'guide_heading' => ucwords(str_replace('-', ' ', $slug)) . ' Community Guide',
            'guide_description' => 'A premier luxury community in Dubai featuring modern villas, landscaped parks, and world-class amenities.',
            'media_type' => 'video',
            'media_image' => 'images/family-park.jpg',
            'video_url' => '',
            'features' => [
                ['upper' => '7,000+', 'lower' => 'Acres planned'],
                ['upper' => 'Residential', 'lower' => 'Villas, townhouses.'],
                ['upper' => 'Green Spaces', 'lower' => 'Parks, lakes and trails'],
                ['upper' => 'Integrated', 'lower' => 'Live, work, shop and relax'],
            ],
            'meta_title' => 'Luxury Properties in ' . ucwords(str_replace('-', ' ', $slug)) . ' | LUX Villa Dubai',
            'meta_keyword' => $slug . ', luxury villas dubai, off plan dubai',
            'meta_description' => 'Looking for properties in ' . ucwords(str_replace('-', ' ', $slug)) . '? Explore exclusive villas and prime residences with LUX Villa Dubai.',
        ];
    }

    public static function getAvailableOffplanProjects()
    {
        return [
            [
                'id' => 1,
                'name' => 'Golf Vale Emaar South',
                'slug' => 'golf-vale-emaar-south',
                'location' => 'Dubai South, Dubai',
                'price' => 'AED 1.1M',
                'specs' => '3 & 4 Beds · 2,400 sqft',
                'image' => 'images/golf-vale-main.jpg',
                'developer' => 'Emaar',
                'url' => '/projects/golf-vale-emaar-south',
            ],
            [
                'id' => 2,
                'name' => 'The Fairway Villa',
                'slug' => 'the-fairway-villa',
                'location' => 'Jumeirah Golf Estates, Dubai',
                'price' => 'AED 18.5M',
                'specs' => '5 Beds · 7,200 sqft',
                'image' => 'images/project-fairway-villa.jpg',
                'developer' => 'Emaar',
                'url' => '/listing/the-valley-prime-location',
            ],
            [
                'id' => 3,
                'name' => 'Maple Row Villa',
                'slug' => 'maple-row-villa',
                'location' => 'Dubai Hills Estate, Dubai',
                'price' => 'AED 7.9M',
                'specs' => '4 Beds · 4,100 sqft',
                'image' => 'images/project-maple-row.jpg',
                'developer' => 'Emaar',
                'url' => '/projects',
            ],
            [
                'id' => 4,
                'name' => 'Nara Townhouse',
                'slug' => 'nara-townhouse',
                'location' => 'The Valley, Dubai',
                'price' => 'AED 2.15M',
                'specs' => '3 Beds · 2,100 sqft',
                'image' => 'images/project-nara-townhouse.jpg',
                'developer' => 'Emaar',
                'url' => '/projects',
            ],
            [
                'id' => 5,
                'name' => 'The Oasis by Emaar',
                'slug' => 'the-oasis-by-emaar',
                'location' => 'Dubailand, Dubai',
                'price' => 'AED 8.4M',
                'specs' => '4 & 5 Beds · 5,100 sqft',
                'image' => 'images/villa-modern.jpg',
                'developer' => 'Emaar',
                'url' => '/projects',
            ],
            [
                'id' => 6,
                'name' => 'Sobha Hartland II Villas',
                'slug' => 'sobha-hartland-ii',
                'location' => 'Sobha Hartland, Dubai',
                'price' => 'AED 12.8M',
                'specs' => '5 Beds · 6,400 sqft',
                'image' => 'images/villa-pool.jpg',
                'developer' => 'Sobha Realty',
                'url' => '/projects',
            ],
        ];
    }

    public static function getAvailableReadyProjects()
    {
        return [
            [
                'id' => 1,
                'name' => 'The Fairway Villa',
                'slug' => 'the-fairway-villa',
                'location' => 'Villa · Jumeirah Golf Estates, Dubai',
                'price' => 'AED 18.5M',
                'specs' => '5 Beds · 6 Baths · 7,200 sqft',
                'image' => 'images/project-fairway-villa.jpg',
                'tag' => 'READY',
                'developer' => 'Emaar',
                'url' => '/listing/the-valley-prime-location',
            ],
            [
                'id' => 2,
                'name' => 'Maple Row Villa',
                'slug' => 'maple-row-villa',
                'location' => 'Villa · Dubai Hills Estate, Dubai',
                'price' => 'AED 7.9M',
                'specs' => '4 Beds · 5 Baths · 4,100 sqft',
                'image' => 'images/project-maple-row.jpg',
                'tag' => 'READY',
                'developer' => 'Emaar',
                'url' => '/listing/the-valley-prime-location',
            ],
            [
                'id' => 3,
                'name' => 'Signature Palm Villa',
                'slug' => 'signature-palm-villa',
                'location' => 'Villa · Palm Jumeirah, Dubai',
                'price' => 'AED 34.0M',
                'specs' => '6 Beds · 7 Baths · 9,500 sqft',
                'image' => 'images/villa-pool.jpg',
                'tag' => 'READY',
                'developer' => 'Nakheel',
                'url' => '/listing/the-valley-prime-location',
            ],
            [
                'id' => 4,
                'name' => 'Al Barari Luxury Villa',
                'slug' => 'al-barari-luxury-villa',
                'location' => 'Villa · Al Barari, Dubai',
                'price' => 'AED 22.0M',
                'specs' => '5 Beds · 6 Baths · 8,300 sqft',
                'image' => 'images/house-facade.jpg',
                'tag' => 'READY',
                'developer' => 'Al Barari Developers',
                'url' => '/listing/the-valley-prime-location',
            ],
        ];
    }

    public function communities()
    {
        $store = self::getCommunityStore();
        $communities = [];
        $i = 1;
        foreach ($store as $slug => $data) {
            $communities[] = [
                'id' => $i++,
                'name' => $data['name'],
                'slug' => $slug,
                'city' => $data['city'] ?? 'Dubai',
                'status' => $data['status'] ?? 'DRAFT',
                'disapprove_comments' => '',
                'url' => $data['url'] ?? ('/communities/' . $slug),
            ];
        }

        return view('admin.entities.communities', compact('communities'));
    }

    public function editCommunity($slug)
    {
        $community = self::getCommunityData($slug);
        $allOffplanProjects = self::getAvailableOffplanProjects();
        $allReadyProjects = self::getAvailableReadyProjects();
        $allAmenities = self::getAmenitiesStore();
        return view('admin.entities.community_edit', compact('community', 'allOffplanProjects', 'allReadyProjects', 'allAmenities'));
    }

    public function updateCommunity(Request $request, $slug)
    {
        $all = self::getCommunityStore();
        $existing = self::getCommunityData($slug);

        $existing['name'] = $request->input('name', $existing['name']);
        $existing['city'] = $request->input('city', $existing['city'] ?? 'Dubai');
        $existing['status'] = $request->input('status', $existing['status'] ?? 'DRAFT');
        $existing['meta_title'] = $request->input('meta_title', $existing['meta_title'] ?? '');
        $existing['meta_keyword'] = $request->input('meta_keywords', $existing['meta_keyword'] ?? '');
        $existing['meta_description'] = $request->input('meta_description', $existing['meta_description'] ?? '');

        // Hero Section inputs: breadcrumbs, heading, description, hero_img, form toggle, form title
        $existing['breadcrumbs'] = $request->input('breadcrumbs', $existing['breadcrumbs'] ?? 'HOME > COMMUNITIES');
        $existing['hero_heading'] = $request->input('hero_heading', $existing['hero_heading'] ?? ($existing['name'] . ' Dubai'));
        $existing['hero_subtext'] = $request->input('hero_subtext', $existing['hero_subtext'] ?? '');
        
        // Handle Hero Background Image direct file upload from laptop
        if ($request->hasFile('hero_img_file')) {
            $file = $request->file('hero_img_file');
            $filename = time() . '_hero_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $existing['hero_img'] = 'images/' . $filename;
        } elseif ($request->filled('hero_img')) {
            $existing['hero_img'] = $request->input('hero_img');
        }

        $existing['show_form'] = $request->has('show_form') ? ($request->input('show_form') == '1') : true;
        $existing['form_title'] = $request->input('form_title', $existing['form_title'] ?? ('Enquire about ' . $existing['name']));

        // Content Section (Community Guide)
        $existing['guide_heading'] = $request->input('guide_heading', $existing['guide_heading'] ?? ($existing['name'] . ' Community Guide'));
        $existing['guide_description'] = $request->input('guide_description', $existing['guide_description'] ?? '');
        $existing['media_type'] = $request->input('media_type', $existing['media_type'] ?? 'video');

        // Handle Content Section Image direct file upload from laptop
        if ($request->hasFile('media_image_file')) {
            $file = $request->file('media_image_file');
            $filename = time() . '_guide_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $existing['media_image'] = 'images/' . $filename;
        } elseif ($request->filled('media_image')) {
            $existing['media_image'] = $request->input('media_image');
        }

        // Handle Video direct file upload or URL
        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $filename = time() . '_video_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $existing['video_url'] = 'images/' . $filename;
        } elseif ($request->has('video_url')) {
            $existing['video_url'] = $request->input('video_url');
        }

        // Features Bar (4 pairs: upper and lower text)
        $features = [];
        $upperTexts = $request->input('features_upper', []);
        $lowerTexts = $request->input('features_lower', []);
        for ($i = 0; $i < 4; $i++) {
            $features[] = [
                'upper' => $upperTexts[$i] ?? ($existing['features'][$i]['upper'] ?? ''),
                'lower' => $lowerTexts[$i] ?? ($existing['features'][$i]['lower'] ?? ''),
            ];
        }
        $existing['features'] = $features;

        // Selected Offplan Projects (dragged into Column S)
        $selectedProjects = $request->input('selected_offplan_projects', []);
        if (is_string($selectedProjects)) {
            $selectedProjects = json_decode($selectedProjects, true) ?: [];
        }
        $existing['assigned_offplan_projects'] = is_array($selectedProjects) ? array_values(array_filter($selectedProjects)) : [];

        // Selected Ready Projects (Listing Projects dragged into Column S)
        $selectedReady = $request->input('selected_ready_projects', []);
        if (is_string($selectedReady)) {
            $selectedReady = json_decode($selectedReady, true) ?: [];
        }
        $existing['assigned_ready_projects'] = is_array($selectedReady) ? array_values(array_filter($selectedReady)) : [];

        // Selected Amenities (from Dropdown / Checkboxes)
        $selectedAmenities = $request->input('selected_amenities', []);
        if (is_string($selectedAmenities)) {
            $selectedAmenities = json_decode($selectedAmenities, true) ?: [];
        }
        $existing['assigned_amenities'] = is_array($selectedAmenities) ? array_values(array_filter($selectedAmenities)) : [];

        // Full Content (Summernote HTML)
        if ($request->has('full_content')) {
            $existing['full_content'] = $request->input('full_content');
        }

        // FAQs (Dynamic questions and answers)
        $faqQuestions = $request->input('faq_q', []);
        $faqAnswers = $request->input('faq_a', []);
        $faqs = [];
        foreach ($faqQuestions as $idx => $q) {
            $q = trim($q);
            $a = trim($faqAnswers[$idx] ?? '');
            if (!empty($q)) {
                $faqs[] = ['q' => $q, 'a' => $a];
            }
        }
        $existing['faqs'] = $faqs;

        $all[$slug] = $existing;

        $filePath = storage_path('app/communities_data.json');
        file_put_contents($filePath, json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        return redirect()->back()->with('status', 'Community updated successfully.');
    }

    public function developers()
    {
        $developers = [
            ['id' => 1, 'name' => 'Emaar Properties', 'slug' => 'emaar-properties', 'city' => 'Dubai', 'status' => 'DRAFT', 'disapprove_comments' => ''],
            ['id' => 2, 'name' => 'DAMAC Properties', 'slug' => 'damac-properties', 'city' => 'Dubai', 'status' => 'DRAFT', 'disapprove_comments' => ''],
            ['id' => 3, 'name' => 'Aldar', 'slug' => 'aldar', 'city' => 'Dubai', 'status' => 'DRAFT', 'disapprove_comments' => ''],
            ['id' => 4, 'name' => 'Sobha Realty', 'slug' => 'sobha-realty', 'city' => 'Dubai', 'status' => 'DRAFT', 'disapprove_comments' => ''],
        ];
        return view('admin.entities.generic', ['title' => 'Developer', 'items' => $developers, 'nameLabel' => 'DEVELOPER NAME']);
    }

    public function cities()
    {
        $cities = [
            ['id' => 1, 'name' => 'Dubai', 'slug' => 'dubai', 'city' => 'UAE', 'status' => 'DRAFT', 'disapprove_comments' => ''],
            ['id' => 2, 'name' => 'Abu Dhabi', 'slug' => 'abu-dhabi', 'city' => 'UAE', 'status' => 'DRAFT', 'disapprove_comments' => ''],
            ['id' => 3, 'name' => 'Sharjah', 'slug' => 'sharjah', 'city' => 'UAE', 'status' => 'DRAFT', 'disapprove_comments' => ''],
        ];
        return view('admin.entities.generic', ['title' => 'City', 'items' => $cities, 'nameLabel' => 'CITY NAME']);
    }

    public function blogs()
    {
        $blogs = [
            ['id' => 1, 'name' => 'Investing in Dubai Real Estate: 2026 Guide', 'slug' => 'investing-in-dubai-2026', 'city' => 'Dubai', 'status' => 'DRAFT', 'disapprove_comments' => '', 'url' => '/blog'],
            ['id' => 2, 'name' => 'Top Luxury Communities for Families', 'slug' => 'top-luxury-communities', 'city' => 'Dubai', 'status' => 'DRAFT', 'disapprove_comments' => '', 'url' => '/blog'],
        ];
        return view('admin.entities.generic', ['title' => 'Blog', 'items' => $blogs, 'nameLabel' => 'BLOG POST TITLE']);
    }

    public function offplanProjects()
    {
        $projects = [
            ['id' => 1, 'name' => 'Golf Vale Emaar South', 'slug' => 'golf-vale-emaar-south', 'city' => 'Dubai', 'status' => 'DRAFT', 'disapprove_comments' => '', 'url' => '/projects/golf-vale-emaar-south'],
            ['id' => 2, 'name' => 'The Fairway Villa', 'slug' => 'the-fairway-villa', 'city' => 'Dubai', 'status' => 'DRAFT', 'disapprove_comments' => '', 'url' => '/listing/the-valley-prime-location'],
            ['id' => 3, 'name' => 'Maple Row Villa', 'slug' => 'maple-row-villa', 'city' => 'Dubai', 'status' => 'DRAFT', 'disapprove_comments' => '', 'url' => '/projects'],
            ['id' => 4, 'name' => 'Nara Townhouse', 'slug' => 'nara-townhouse', 'city' => 'Dubai', 'status' => 'DRAFT', 'disapprove_comments' => '', 'url' => '/projects'],
        ];
        return view('admin.entities.generic', ['title' => 'Off Plan Project', 'items' => $projects, 'nameLabel' => 'PROJECT NAME']);
    }

    public function listingProjects()
    {
        $projects = [
            ['id' => 1, 'name' => 'The Fairway Villa', 'slug' => 'the-fairway-villa', 'city' => 'Dubai', 'status' => 'DRAFT', 'disapprove_comments' => '', 'url' => '/listing/the-valley-prime-location'],
            ['id' => 2, 'name' => 'Maple Row Villa', 'slug' => 'maple-row-villa', 'city' => 'Dubai', 'status' => 'DRAFT', 'disapprove_comments' => '', 'url' => '/listing/the-valley-prime-location'],
        ];
        return view('admin.entities.generic', ['title' => 'Listing Project', 'items' => $projects, 'nameLabel' => 'LISTING PROJECT NAME']);
    }

    public static function getReviewsStore()
    {
        $filePath = storage_path('app/client_reviews_data.json');
        if (file_exists($filePath)) {
            $data = json_decode(file_get_contents($filePath), true);
            if (is_array($data) && !empty($data)) {
                return $data;
            }
        }

        return [
            'heading' => 'Why Our Clients Trust Us',
            'subtext' => 'Discover what our customers are saying about their experiences.',
            'button_text' => 'See all reviews',
            'button_link' => '#',
            'items' => [
                [
                    'name' => 'Bashar Masalha',
                    'meta' => '3 months ago',
                    'rating' => 5,
                    'avatar' => 'images/avatar-man.jpg',
                    'title' => 'An Honest Approach to Real Estate',
                    'text' => 'I worked with Zeinab Haidar, it was an exceptional experience. She combines deep market knowledge with genuine care for her clients, She took the time...',
                    'more_link' => '#',
                ],
                [
                    'name' => 'Sara Jenkins',
                    'meta' => '3 months ago',
                    'rating' => 5,
                    'avatar' => 'images/avatar-woman.jpg',
                    'title' => 'An Honest Approach to Real Estate',
                    'text' => 'I worked with Zeinab Haidar, it was an exceptional experience. She combines deep market knowledge with genuine care for her clients, She took the time...',
                    'more_link' => '#',
                ],
                [
                    'name' => 'Michael Chen',
                    'meta' => '3 months ago',
                    'rating' => 5,
                    'avatar' => 'images/avatar-woman2.jpg',
                    'title' => 'An Honest Approach to Real Estate',
                    'text' => 'I worked with Zeinab Haidar, it was an exceptional experience. She combines deep market knowledge with genuine care for her clients, She took the time...',
                    'more_link' => '#',
                ],
            ],
        ];
    }

    public function reviews()
    {
        $reviewsData = self::getReviewsStore();
        return view('admin.entities.reviews', compact('reviewsData'));
    }

    public function updateReviews(Request $request)
    {
        $data = [
            'heading' => $request->input('heading', 'Why Our Clients Trust Us'),
            'subtext' => $request->input('subtext', 'Discover what our customers are saying about their experiences.'),
            'button_text' => $request->input('button_text', 'See all reviews'),
            'button_link' => $request->input('button_link', '#'),
            'items' => [],
        ];

        $submittedItems = $request->input('items', []);
        $existing = self::getReviewsStore();
        $existingItems = $existing['items'] ?? [];

        foreach ($submittedItems as $idx => $it) {
            $avatar = $it['avatar'] ?? ($existingItems[$idx]['avatar'] ?? 'images/avatar-man.jpg');

            if ($request->hasFile("items.{$idx}.avatar_file")) {
                $file = $request->file("items.{$idx}.avatar_file");
                $filename = time() . "_rev_{$idx}_" . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $avatar = 'images/' . $filename;
            }

            $data['items'][] = [
                'name' => $it['name'] ?? 'Client Name',
                'meta' => $it['meta'] ?? 'Recently',
                'rating' => intval($it['rating'] ?? 5),
                'avatar' => $avatar,
                'title' => $it['title'] ?? 'Review Title',
                'text' => $it['text'] ?? '',
                'more_link' => $it['more_link'] ?? '#',
            ];
        }

        $filePath = storage_path('app/client_reviews_data.json');
        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        return redirect()->back()->with('ok', 'Client Reviews updated successfully.');
    }
}
