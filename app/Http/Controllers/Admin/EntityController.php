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

    public function destroyAmenity($key)
    {
        $all = array_values(array_filter(self::getAmenitiesStore(), fn ($am) => ($am['key'] ?? '') !== $key));
        file_put_contents(storage_path('app/amenities_data.json'), json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        return redirect()->route('admin.amenities')->with('ok', 'Amenity deleted from library.');
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
        $store = self::getOffplanProjectStore();
        $list = [];
        $seen = [];
        $i = 1;
        foreach ($store as $slug => $proj) {
            $seen[$slug] = true;
            $dev = $proj['stats'][0]['lower'] ?? ($proj['stats'][0]['upper'] ?? 'Emaar');
            $price = $proj['stats'][1]['upper'] ?? 'AED 1.1M';
            $units = $proj['stats'][2]['upper'] ?? '3-4br';
            $loc = !empty($proj['usps'][2]) ? $proj['usps'][2] : ($proj['location_text'] ?? ($proj['city'] ?? 'Dubai'));
            $list[] = [
                'id' => $i++,
                'name' => $proj['name'] ?? ucwords(str_replace('-', ' ', $slug)),
                'slug' => $slug,
                'location' => $loc,
                'price' => $price,
                'specs' => $units . ' · ' . ($proj['city'] ?? 'Dubai'),
                'image' => !empty($proj['gallery_main']) ? $proj['gallery_main'] : 'images/golf-vale-main.jpg',
                'badge' => 'OFF-PLAN',
                'developer' => $dev,
                'property_category' => $proj['property_category'] ?? (str_contains(strtolower(($proj['name'] ?? '') . ' ' . $slug), 'townhouse') ? 'townhouse' : 'villa'),
                'url' => $proj['url'] ?? ('/projects/' . $slug),
            ];
        }

        $extras = [
            [
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
                'name' => 'Sobha Hartland II Villas',
                'slug' => 'sobha-hartland-ii',
                'location' => 'Sobha Hartland, Dubai',
                'price' => 'AED 12.8M',
                'specs' => '5 Beds · 6,400 sqft',
                'image' => 'images/villa-pool.jpg',
                'developer' => 'Sobha Realty',
                'url' => '/projects',
            ],
            [
                'name' => 'Golf Fields by Emaar',
                'slug' => 'golf-fields-by-emaar',
                'location' => 'EMAAR SOUTH, DUBAI',
                'price' => 'AED 100,000',
                'specs' => '1–3 Beds · Emaar South',
                'image' => 'images/similar-golf-fields.png',
                'badge' => 'OFF-PLAN',
                'developer' => 'Emaar',
                'url' => '/projects/golf-vale-emaar-south',
            ],
            [
                'name' => 'Terra Heights by Emaar at Emaar South',
                'slug' => 'terra-heights-by-emaar',
                'location' => 'EMAAR SOUTH, DUBAI',
                'price' => 'AED 100,000',
                'specs' => '1–3 Beds · Emaar South',
                'image' => 'images/similar-terra-heights.png',
                'badge' => 'OFF-PLAN',
                'developer' => 'Emaar',
                'url' => '/projects/golf-vale-emaar-south',
            ],
            [
                'name' => 'Greenville 2 at Emaar South, Dubai',
                'slug' => 'greenville-2-at-emaar-south',
                'location' => 'EMAAR SOUTH, DUBAI',
                'price' => 'AED 100,000',
                'specs' => '3 & 4 Beds · Emaar South',
                'image' => 'images/similar-greenville-2.png',
                'badge' => 'OFF-PLAN',
                'developer' => 'Emaar',
                'url' => '/projects/golf-vale-emaar-south',
            ],
            [
                'name' => 'Golf Edge at Emaar South, Dubai',
                'slug' => 'golf-edge-at-emaar-south',
                'location' => 'EMAAR SOUTH, DUBAI',
                'price' => 'AED 100,000',
                'specs' => '1–3 Beds · Emaar South',
                'image' => 'images/similar-golf-edge.png',
                'badge' => 'NEW LAUNCH',
                'developer' => 'Emaar',
                'url' => '/projects/golf-vale-emaar-south',
            ],
        ];
        foreach ($extras as $ex) {
            if (!isset($seen[$ex['slug']])) {
                $ex['id'] = $i++;
                $list[] = $ex;
            }
        }
        return $list;
    }

    public static function getAvailableReadyProjects()
    {
        $store = self::getListingProjectStore();
        $list = [];
        $i = 1;
        foreach ($store as $slug => $item) {
            $beds = $item['beds'] ?? '4';
            $baths = $item['baths'] ?? '4';
            $sqft = $item['sqft'] ?? '2,462 sq.ft';
            $loc = $item['location_text'] ?? (($item['community'] ?? 'The Valley') . ', ' . ($item['city'] ?? 'Dubai'));
            $list[] = [
                'id' => $i++,
                'name' => $item['name'] ?? ucwords(str_replace('-', ' ', $slug)),
                'slug' => $slug,
                'location' => $loc,
                'price' => $item['price'] ?? 'AED 2,740,000',
                'beds' => $beds,
                'baths' => $baths,
                'sqft' => $sqft,
                'specs' => $beds . ' Beds · ' . $baths . ' Baths · ' . $sqft,
                'image' => !empty($item['gallery_main']) ? $item['gallery_main'] : 'images/project-fairway-villa.jpg',
                'tag' => $item['tag'] ?? 'READY',
                'property_type' => $item['property_type'] ?? 'Villa',
                'handover' => $item['handover'] ?? 'Ready to Move',
                'payment_plan' => $item['payment_plan'] ?? 'Cash / Mortgage',
                'authenticity' => $item['authenticity'] ?? 'Property authenticity validated',
                'developer' => $item['developer'] ?? 'Emaar',
                'url' => $item['url'] ?? ('/listing/' . $slug),
            ];
        }
        return $list;
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

    public function createCommunity()
    {
        $community = self::getCommunityData('the-valley');
        $community['name'] = '';
        $community['slug'] = '';
        $community['url'] = '/communities';
        $community['status'] = 'PUBLISHED';
        $community['meta_title'] = '';
        $allOffplanProjects = self::getAvailableOffplanProjects();
        $allReadyProjects = self::getAvailableReadyProjects();
        $allAmenities = self::getAmenitiesStore();
        $isNew = true;
        return view('admin.entities.community_edit', compact('community', 'allOffplanProjects', 'allReadyProjects', 'allAmenities', 'isNew'));
    }

    public function storeCommunity(Request $request)
    {
        $request->validate(['name' => ['required', 'string', 'max:255']]);
        $all = self::getCommunityStore();
        $baseSlug = \Illuminate\Support\Str::slug($request->input('slug') ?: $request->input('name')) ?: ('community-' . time());
        $slug = $baseSlug;
        $counter = 2;
        while (isset($all[$slug])) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $this->updateCommunity($request, $slug);
        return redirect()->route('admin.communities.edit', $slug)->with('ok', 'New Community created with full community template and synced to /communities.');
    }

    public function editCommunity($slug)
    {
        $community = self::getCommunityData($slug);
        $allOffplanProjects = self::getAvailableOffplanProjects();
        $allReadyProjects = self::getAvailableReadyProjects();
        $allAmenities = self::getAmenitiesStore();
        $isNew = false;
        return view('admin.entities.community_edit', compact('community', 'allOffplanProjects', 'allReadyProjects', 'allAmenities', 'isNew'));
    }

    public function updateCommunity(Request $request, $slug)
    {
        $all = self::getCommunityStore();
        $isNewRecord = !isset($all[$slug]);
        $existing = self::getCommunityData($slug);
        $str = fn (string $k, string $def = ''): string => $request->exists($k) ? (string) ($request->input($k) ?? '') : ($existing[$k] ?? $def);

        $existing['name'] = $str('name', $existing['name'] ?? '');
        $existing['slug'] = $slug;
        $existing['url'] = '/communities/' . $slug;
        $existing['city'] = $str('city', 'Dubai');
        $existing['status'] = $str('status', 'DRAFT');
        $existing['meta_title'] = $str('meta_title');
        $existing['meta_keyword'] = $request->exists('meta_keywords') ? (string) ($request->input('meta_keywords') ?? '') : ($existing['meta_keyword'] ?? '');
        $existing['meta_description'] = $str('meta_description');

        // Hero Section inputs: breadcrumbs, heading, description, hero_img, form toggle, form title
        $existing['breadcrumbs'] = $str('breadcrumbs');
        $existing['hero_heading'] = $str('hero_heading');
        $existing['hero_subtext'] = $str('hero_subtext');
        
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
        $existing['form_title'] = $str('form_title');

        // Content Section (Community Guide)
        $existing['guide_heading'] = $str('guide_heading');
        $existing['guide_description'] = $str('guide_description');
        $existing['media_type'] = $str('media_type', 'video');

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
            $existing['video_url'] = (string) ($request->input('video_url') ?? '');
        }

        // Features Bar (4 pairs: upper and lower text)
        if ($request->has('features_upper') || $request->has('features_lower')) {
            $features = [];
            $upperTexts = $request->input('features_upper', []);
            $lowerTexts = $request->input('features_lower', []);
            for ($i = 0; $i < 4; $i++) {
                $features[] = [
                    'upper' => (string) ($upperTexts[$i] ?? ''),
                    'lower' => (string) ($lowerTexts[$i] ?? ''),
                ];
            }
            $existing['features'] = $features;
        }

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
        if ($request->exists('full_content')) {
            $fc = (string) ($request->input('full_content') ?? '');
            $existing['full_content'] = preg_replace('/(<(?:p|h[1-6])\b[^>]*?)\sstyle="[^"]*"/i', '$1', $fc);
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

        if ($isNewRecord) {
            $all = [$slug => $existing] + $all;
        } else {
            $all[$slug] = $existing;
        }

        $filePath = storage_path('app/communities_data.json');
        file_put_contents($filePath, json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        return redirect()->back()->with('status', 'Community updated successfully.');
    }

    public function destroyCommunity($slug)
    {
        $all = self::getCommunityStore();
        if (isset($all[$slug])) {
            unset($all[$slug]);
            file_put_contents(storage_path('app/communities_data.json'), json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }
        return redirect()->route('admin.communities')->with('ok', 'Community deleted.');
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

    public static function getBlogStore(): array
    {
        $filePath = storage_path('app/blogs_data.json');
        if (file_exists($filePath)) {
            $data = json_decode(file_get_contents($filePath), true);
            if (is_array($data) && !empty($data)) {
                return $data;
            }
        }

        $defaults = [
            'dubai-villa-market-2025' => ['name' => 'Dubai Villa Market 2025: Key Trends and Opportunities', 'image' => 'images/dubai-skyline.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'planning-to-buy-in-dubai' => ['name' => 'Planning to Buy in Dubai? Essential Costs to Know', 'image' => 'images/dubai-marina.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'exclusive-offplan-launches-2025' => ['name' => 'Exclusive Off-Plan Property Launches in Dubai 2025', 'image' => 'images/palm-jumeirah-ai-hero.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'roi-analysis-townhouses-vs-villas' => ['name' => 'ROI Analysis: Dubai Townhouses vs Luxury Villas', 'image' => 'images/dubai-towers.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'top-family-villa-communities-2026' => ['name' => 'Top Family Villa Communities in Dubai for 2026', 'image' => 'images/blog-hero-villa.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'golden-visa-dubai-property-guide' => ['name' => 'Golden Visa Through Dubai Property: Full Guide', 'image' => 'images/enquiry-hero-villa.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'dubai-hills-vs-arabian-ranches-3' => ['name' => 'Dubai Hills Estate vs Arabian Ranches 3 Comparison', 'image' => 'images/communities-hero-villa.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'why-the-valley-attracts-buyers' => ['name' => 'Why The Valley by Emaar Attracts Global Buyers', 'image' => 'images/clean-valley-1.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'offplan-payment-plans-explained' => ['name' => 'Off-Plan Payment Plans Explained for Investors', 'image' => 'images/clean-valley-2.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'waterfront-living-palm-dubai-islands' => ['name' => 'Waterfront Living: Palm Jumeirah & Dubai Islands', 'image' => 'images/clean-valley-4.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'dld-fees-escrow-legal-checklist' => ['name' => 'DLD Fees, Escrow & Legal Checklist When Buying', 'image' => 'images/clean-valley-5.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'golf-course-villas-capital-growth' => ['name' => 'Golf Course Villas: Long-Term Capital Growth', 'image' => 'images/community-dubai-hills.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'ready-villas-vs-offplan-goals' => ['name' => 'Ready Villas vs Off-Plan: Which Suits Your Goals?', 'image' => 'images/community-dubailand.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'high-yield-hubs-new-dubai' => ['name' => 'High-Yield Residential Hubs Across New Dubai', 'image' => 'images/community-jvc.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'modern-architectural-trends-dubai' => ['name' => 'Modern Architectural Trends in Dubai Luxury Homes', 'image' => 'images/listing-modern-villa.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'private-pool-villas-rental-demand' => ['name' => 'Private Pool Villas: Rental Demand & Resale Value', 'image' => 'images/listing-pool-villa.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'mortgage-financing-non-residents-uae' => ['name' => 'Mortgage Financing Options for Non-Residents in UAE', 'image' => 'images/house-exterior.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
            'choose-right-plot-orientation-dubai' => ['name' => 'How to Choose the Right Plot & Orientation in Dubai', 'image' => 'images/house-white.jpg', 'badge' => 'Buying Advice & Investment', 'meta' => '23rd March 2026', 'city' => 'Dubai', 'status' => 'PUBLISHED', 'link' => '#'],
        ];

        file_put_contents($filePath, json_encode($defaults, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        return $defaults;
    }

    public function blogs()
    {
        $store = self::getBlogStore();
        $blogs = [];
        $i = 1;
        foreach ($store as $slug => $data) {
            $blogs[] = [
                'id' => $i++,
                'name' => $data['name'] ?? '',
                'slug' => $slug,
                'city' => $data['city'] ?? 'Dubai',
                'badge' => $data['badge'] ?? 'Buying Advice & Investment',
                'meta' => $data['meta'] ?? '23rd March 2026',
                'image' => $data['image'] ?? 'images/dubai-skyline.jpg',
                'status' => $data['status'] ?? 'PUBLISHED',
                'url' => '/blog',
                'edit_url' => route('admin.blogs.edit', $slug),
            ];
        }
        return view('admin.entities.blogs', ['blogs' => $blogs]);
    }

    public function createBlog()
    {
        return view('admin.entities.blog_edit', [
            'isNew' => true,
            'slug' => '',
            'blog' => [
                'name' => '',
                'badge' => 'Buying Advice & Investment',
                'meta' => date('jS F Y'),
                'image' => 'images/dubai-skyline.jpg',
                'city' => 'Dubai',
                'status' => 'PUBLISHED',
                'link' => '#',
            ],
        ]);
    }

    public function storeBlog(Request $request)
    {
        $request->validate(['name' => ['required', 'string', 'max:255']]);
        $store = self::getBlogStore();

        $baseSlug = \Illuminate\Support\Str::slug($request->input('slug') ?: $request->input('name')) ?: ('blog-' . time());
        $slug = $baseSlug;
        $counter = 2;
        while (isset($store[$slug])) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $imagePath = $request->input('image', 'images/dubai-skyline.jpg');
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_blog_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('images'), $filename);
            $imagePath = 'images/' . $filename;
        }

        $newItem = [
            'name' => $request->input('name'),
            'badge' => $request->input('badge', 'Buying Advice & Investment'),
            'meta' => $request->input('meta', date('jS F Y')),
            'image' => $imagePath ?: 'images/dubai-skyline.jpg',
            'city' => $request->input('city', 'Dubai'),
            'status' => $request->input('status', 'PUBLISHED'),
            'link' => $request->input('link', '#') ?: '#',
        ];

        // Prepend so newly added blog posts appear at the TOP of /blog and Manage > Blog
        $store = [$slug => $newItem] + $store;
        file_put_contents(storage_path('app/blogs_data.json'), json_encode($store, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        return redirect()->route('admin.blogs')->with('ok', 'Blog post added and synced to the top of /blog.');
    }

    public function editBlog($slug)
    {
        $store = self::getBlogStore();
        $blog = $store[$slug] ?? abort(404);
        return view('admin.entities.blog_edit', [
            'isNew' => false,
            'slug' => $slug,
            'blog' => $blog,
        ]);
    }

    public function updateBlog(Request $request, $slug)
    {
        $request->validate(['name' => ['required', 'string', 'max:255']]);
        $store = self::getBlogStore();
        $existing = $store[$slug] ?? abort(404);

        $imagePath = $request->input('image', $existing['image'] ?? 'images/dubai-skyline.jpg');
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_blog_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('images'), $filename);
            $imagePath = 'images/' . $filename;
        }

        $store[$slug] = [
            'name' => $request->input('name'),
            'badge' => $request->input('badge', $existing['badge'] ?? 'Buying Advice & Investment'),
            'meta' => $request->input('meta', $existing['meta'] ?? '23rd March 2026'),
            'image' => $imagePath ?: 'images/dubai-skyline.jpg',
            'city' => $request->input('city', $existing['city'] ?? 'Dubai'),
            'status' => $request->input('status', $existing['status'] ?? 'PUBLISHED'),
            'link' => $request->input('link', $existing['link'] ?? '#') ?: '#',
        ];

        file_put_contents(storage_path('app/blogs_data.json'), json_encode($store, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        return redirect()->route('admin.blogs')->with('ok', 'Blog post updated.');
    }

    public function destroyBlog($slug)
    {
        $store = self::getBlogStore();
        if (isset($store[$slug])) {
            unset($store[$slug]);
            file_put_contents(storage_path('app/blogs_data.json'), json_encode($store, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }
        return redirect()->route('admin.blogs')->with('ok', 'Blog post deleted.');
    }

    public function offplanProjects()
    {
        $store = self::getOffplanProjectStore();
        $projects = [];
        $i = 1;
        foreach ($store as $slug => $data) {
            $projects[] = [
                'id' => $i++,
                'name' => $data['name'],
                'slug' => $slug,
                'city' => $data['city'] ?? 'Dubai',
                'status' => $data['status'] ?? 'DRAFT',
                'disapprove_comments' => '',
                'url' => $data['url'] ?? ('/projects/' . $slug),
                'edit_url' => route('admin.offplan-projects.edit', $slug),
                'delete_url' => route('admin.offplan-projects.destroy', $slug),
            ];
        }
        return view('admin.entities.generic', [
            'title' => 'Off Plan Project',
            'items' => $projects,
            'nameLabel' => 'PROJECT NAME',
            'create_url' => route('admin.offplan-projects.create'),
        ]);
    }

    public static function getOffplanProjectStore()
    {
        $filePath = storage_path('app/offplan_projects_data.json');
        if (file_exists($filePath)) {
            $data = json_decode(file_get_contents($filePath), true);
            if (is_array($data) && !empty($data)) {
                return $data;
            }
        }

        $defaultPropertyTypes = [
            ['title' => '4 Bedroom Townhouse', 'type' => 'Townhouse', 'beds' => '4 Bedroom', 'size' => '2,789 sq ft', 'price' => 'AED 5,060,000'],
            ['title' => '4 Bedroom Townhouse', 'type' => 'Townhouse', 'beds' => '4 Bedroom', 'size' => '2,789 sq ft', 'price' => 'AED 5,060,000'],
            ['title' => '4 Bedroom Townhouse', 'type' => 'Townhouse', 'beds' => '4 Bedroom', 'size' => '2,789 sq ft', 'price' => 'AED 5,060,000'],
            ['title' => '4 Bedroom Townhouse', 'type' => 'Townhouse', 'beds' => '4 Bedroom', 'size' => '2,789 sq ft', 'price' => 'AED 5,060,000'],
            ['title' => '4 Bedroom Townhouse', 'type' => 'Townhouse', 'beds' => '4 Bedroom', 'size' => '2,789 sq ft', 'price' => 'AED 5,060,000'],
        ];

        $defaultFaqs = [
            ['q' => 'What Is Lux Villa Dubai?', 'a' => 'LUX Villa Dubai is a luxury real estate advisory and portfolio showcasing curated villas, townhouses, and premier off-plan opportunities across Dubai\'s most prestigious neighborhoods.'],
            ['q' => 'Who Is The Developer Behind Lux Villa Dubai?', 'a' => 'We partner directly with leading developers including Emaar, Nakheel, Meraas, Sobha, and Damac to bring you verified, tier-one properties with developer-direct pricing.'],
            ['q' => 'Where Is Lux Villa Dubai Located?', 'a' => 'Our flagship properties span prime Dubai locations including Palm Jumeirah, Dubai Hills Estate, Emirates Hills, The Valley, and Emaar South.'],
            ['q' => 'What Types Of Properties Are Available In Lux Villa Dubai?', 'a' => 'We specialize exclusively in luxury standalone villas, modern semi-detached homes, waterfront townhouses, and signature branded estates.'],
            ['q' => 'Is Lux Villa Dubai A Good Investment Opportunity?', 'a' => 'Yes, our properties are curated for strong capital appreciation and attractive rental yields (typically 6% - 8%+ gross yields) in zero capital gains tax jurisdictions.'],
            ['q' => 'Does Lux Villa Dubai Have Government Or Authority Backing?', 'a' => 'All advertised projects are 100% compliant and registered with the Dubai Land Department (DLD) and the Real Estate Regulatory Agency (RERA), with secure escrow accounts.'],
        ];

        $defaultFullContent = '<h3>Modern lifestyle and residential opportunities</h3><p>dubai offers a diverse range of residential properties designed to meet different needs. from contemporary apartments to spacious villas and premium residential developments, buyers can explore various options based on their requirements.</p><p>when researching baharia town dubai, potential buyers should consider important factors such as property location, accessibility, available facilities, and nearby commercial areas. a well-planned residential community can provide convenient access to shopping centers, schools, healthcare facilities, recreational spaces, and major transportation routes.</p><p>these features make dubai an attractive destination for families, professionals, and international property investors seeking a modern urban lifestyle.</p><h3>luxury villas and real estate investment opportunities</h3><p>dubai has established itself as a significant international real estate destination. its business-friendly environment, tourism industry, modern infrastructure, and international connectivity contribute to continued interest from property investors.</p><p>investors researching baharia town dubai may also explore other residential developments throughout the city to compare prices, locations, amenities, and potential rental demand.</p><p>before purchasing a property, it is essential to evaluate the total cost of ownership, applicable service charges, payment plans, and the legal status of the development. buyers should also verify whether a property is located in an area where foreign ownership is permitted and review the relevant registration requirements.</p>';

        $defaultAbout = '<p><strong>Golf Vale by Emaar</strong> is a residential development in Emaar South, offering 1, 2 and 3-bedroom apartments alongside a limited collection of 3-bedroom townhouses. Set within the green surroundings of the community\'s championship golf course, the development combines contemporary architecture with open fairway views and landscaped outdoor spaces.</p><p>The development comprises 262 residences, including 117 one-bedroom apartments, 117 two-bedroom apartments, 22 three-bedroom apartments and six three-bedroom townhouses. Homes range from 672 sq ft to 2,816 sq ft, giving buyers a choice from compact one-bedroom layouts through to larger family homes.</p><p>Inside, Golf Vale takes a clean and understated approach. Warm wood, textured stone, metal and glass are paired with minimalist architecture and open layouts, creating bright living spaces with a strong connection to the surrounding greenery. Large windows bring natural light into the homes and frame views across the golf course.</p><p>Residents have access to an infinity-edge swimming pool, kids\' pool, indoor and outdoor gyms, indoor and outdoor yoga areas, padel court, BBQ area and kids\' play area. The wider Emaar South community is centred around an 18-hole championship golf course and includes retail, education, healthcare, hotels and recreational facilities.</p><p>Golf Vale is located in Emaar South, approximately 5 minutes from Al Maktoum International Airport, 10 minutes from Expo City Dubai, 30 minutes from Dubai Marina, 35 minutes from Downtown Dubai and Burj Khalifa, and 45 minutes from Dubai International Airport.</p>';

        return [
            'golf-vale-emaar-south' => [
                'id' => 1,
                'name' => 'Golf Vale Emaar South',
                'slug' => 'golf-vale-emaar-south',
                'city' => 'Dubai',
                'property_category' => 'villa',
                'status' => 'DRAFT',
                'url' => '/projects/golf-vale-emaar-south',
                'breadcrumbs' => '1. Home > Off-plan > EMAAR Properties > Golf Vale Emaar South',
                'usps' => ['Golf Vale Emaar South', 'EMAAR Properties', 'Dubai South, Dubai'],
                'gallery_main' => 'images/arabian ranch.png',
                'gallery_top_right' => 'images/golf-vale-pool.png',
                'gallery_bottom_right' => 'images/golf-vale-bedroom.png',
                'stats' => [
                    ['upper' => 'Developer', 'lower' => 'Emaar'],
                    ['upper' => 'AED 1,099,888', 'lower' => 'Starting Price from'],
                    ['upper' => '1-4br', 'lower' => 'Available Units'],
                    ['upper' => '2030 Q1', 'lower' => 'Handover'],
                ],
                'about_eyebrow' => '1, 2 and 3-bedroom apartments',
                'about_heading' => 'About this development',
                'about_description' => $defaultAbout,
                'show_form' => true,
                'form_title' => 'Get expert advice about Golf Vale Emaar South',
                'form_subtitle' => 'Connect with our experts to learn more about Golf Vale Emaar South.',
                'property_types_heading' => 'Property types',
                'property_types' => $defaultPropertyTypes,
                'similar_heading' => 'Similar Project',
                'assigned_similar_projects' => ['the-fairway-villa', 'maple-row-villa', 'nara-townhouse', 'the-oasis-by-emaar'],
                'amenities_heading' => 'Amenities & Facilities',
                'assigned_amenities' => ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'],
                'location_heading' => 'Map View',
                'location_text' => 'Fairways Vistas, Dubai Hills Estate, Dubai, UAE',
                'latitude' => '24.8962',
                'longitude' => '55.1614',
                'payment_heading' => 'Payment Plan',
                'payment_subtitle' => 'For 1 Bedroom · AED 1,250,000',
                'payment_options_label' => '3 Options',
                'payment_step1_pct' => '20',
                'payment_step1_title' => 'On Booking',
                'payment_step1_sub' => 'Step 1 · 20% paid',
                'payment_step2_pct' => '40',
                'payment_step2_title' => 'During Construction',
                'payment_step2_sub' => 'Step 2 · 60% paid',
                'payment_step3_pct' => '40',
                'payment_step3_title' => 'On Handover',
                'payment_step3_sub' => 'Step 3 · 100% paid',
                'payment_disclaimer' => 'Emaar offers a buyer-friendly payment structure designed to make luxury home ownership more accessible. 20% down payment on booking, 40% during construction, 40% payable upon handover. Transparent pricing with no hidden charges. Suitable for both investors and end-users. Professional assistance throughout the purchasing process.',
                'full_content' => $defaultFullContent,
                'faqs' => $defaultFaqs,
            ],
            'the-fairway-villa' => [
                'id' => 2,
                'name' => 'The Fairway Villa',
                'slug' => 'the-fairway-villa',
                'city' => 'Dubai',
                'property_category' => 'villa',
                'status' => 'DRAFT',
                'url' => '/projects/the-fairway-villa',
                'breadcrumbs' => '1. Home > Off-plan > EMAAR Properties > The Fairway Villa',
                'usps' => ['The Fairway Villa', 'EMAAR Properties', 'Jumeirah Golf Estates, Dubai'],
                'gallery_main' => 'images/apartment.jpg',
                'gallery_top_right' => 'images/golf-vale-pool.png',
                'gallery_bottom_right' => 'images/golf-vale-bedroom.png',
                'stats' => [
                    ['upper' => 'Developer', 'lower' => 'Emaar'],
                    ['upper' => 'AED 18,500,000', 'lower' => 'Starting Price from'],
                    ['upper' => '4-6br', 'lower' => 'Available Units'],
                    ['upper' => '2028 Q4', 'lower' => 'Handover'],
                ],
                'about_eyebrow' => '4, 5 and 6-bedroom luxury villas',
                'about_heading' => 'About this development',
                'about_description' => $defaultAbout,
                'show_form' => true,
                'form_title' => 'Get expert advice about The Fairway Villa',
                'form_subtitle' => 'Connect with our experts to learn more about The Fairway Villa.',
                'property_types_heading' => 'Property types',
                'property_types' => $defaultPropertyTypes,
                'similar_heading' => 'Similar Project',
                'assigned_similar_projects' => ['golf-vale-emaar-south', 'maple-row-villa', 'nara-townhouse'],
                'amenities_heading' => 'Amenities & Facilities',
                'assigned_amenities' => ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'],
                'location_heading' => 'Map View',
                'location_text' => 'Jumeirah Golf Estates, Dubai, UAE',
                'latitude' => '25.0211',
                'longitude' => '55.2004',
                'payment_heading' => 'Payment Plan',
                'payment_subtitle' => 'For 5 Bedroom Villa · AED 18,500,000',
                'payment_options_label' => '3 Options',
                'payment_step1_pct' => '20',
                'payment_step1_title' => 'On Booking',
                'payment_step1_sub' => 'Step 1 · 20% paid',
                'payment_step2_pct' => '40',
                'payment_step2_title' => 'During Construction',
                'payment_step2_sub' => 'Step 2 · 60% paid',
                'payment_step3_pct' => '40',
                'payment_step3_title' => 'On Handover',
                'payment_step3_sub' => 'Step 3 · 100% paid',
                'payment_disclaimer' => 'Emaar offers a buyer-friendly payment structure designed to make luxury home ownership more accessible. 20% down payment on booking, 40% during construction, 40% payable upon handover.',
                'full_content' => $defaultFullContent,
                'faqs' => $defaultFaqs,
            ],
            'maple-row-villa' => [
                'id' => 3,
                'name' => 'Maple Row Villa',
                'slug' => 'maple-row-villa',
                'city' => 'Dubai',
                'property_category' => 'villa',
                'status' => 'DRAFT',
                'url' => '/projects/maple-row-villa',
                'breadcrumbs' => '1. Home > Off-plan > EMAAR Properties > Maple Row Villa',
                'usps' => ['Maple Row Villa', 'EMAAR Properties', 'Dubai Hills Estate, Dubai'],
                'gallery_main' => 'images/arabian ranch.png',
                'gallery_top_right' => 'images/golf-vale-pool.png',
                'gallery_bottom_right' => 'images/golf-vale-bedroom.png',
                'stats' => [
                    ['upper' => 'Developer', 'lower' => 'Emaar'],
                    ['upper' => 'AED 7,900,000', 'lower' => 'Starting Price from'],
                    ['upper' => '3-5br', 'lower' => 'Available Units'],
                    ['upper' => '2029 Q2', 'lower' => 'Handover'],
                ],
                'about_eyebrow' => '3, 4 and 5-bedroom villas',
                'about_heading' => 'About this development',
                'about_description' => $defaultAbout,
                'show_form' => true,
                'form_title' => 'Get expert advice about Maple Row Villa',
                'form_subtitle' => 'Connect with our experts to learn more about Maple Row Villa.',
                'property_types_heading' => 'Property types',
                'property_types' => $defaultPropertyTypes,
                'similar_heading' => 'Similar Project',
                'assigned_similar_projects' => ['golf-vale-emaar-south', 'the-fairway-villa', 'nara-townhouse'],
                'amenities_heading' => 'Amenities & Facilities',
                'assigned_amenities' => ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'],
                'location_heading' => 'Map View',
                'location_text' => 'Dubai Hills Estate, Dubai, UAE',
                'latitude' => '25.1135',
                'longitude' => '55.2528',
                'payment_heading' => 'Payment Plan',
                'payment_subtitle' => 'For 4 Bedroom Villa · AED 7,900,000',
                'payment_options_label' => '3 Options',
                'payment_step1_pct' => '20',
                'payment_step1_title' => 'On Booking',
                'payment_step1_sub' => 'Step 1 · 20% paid',
                'payment_step2_pct' => '40',
                'payment_step2_title' => 'During Construction',
                'payment_step2_sub' => 'Step 2 · 60% paid',
                'payment_step3_pct' => '40',
                'payment_step3_title' => 'On Handover',
                'payment_step3_sub' => 'Step 3 · 100% paid',
                'payment_disclaimer' => 'Emaar offers a buyer-friendly payment structure designed to make luxury home ownership more accessible.',
                'full_content' => $defaultFullContent,
                'faqs' => $defaultFaqs,
            ],
            'nara-townhouse' => [
                'id' => 4,
                'name' => 'Nara Townhouse',
                'slug' => 'nara-townhouse',
                'city' => 'Dubai',
                'property_category' => 'townhouse',
                'status' => 'DRAFT',
                'url' => '/projects/nara-townhouse',
                'breadcrumbs' => '1. Home > Off-plan > EMAAR Properties > Nara Townhouse',
                'usps' => ['Nara Townhouse', 'EMAAR Properties', 'The Valley, Dubai'],
                'gallery_main' => 'images/apartment.jpg',
                'gallery_top_right' => 'images/golf-vale-pool.png',
                'gallery_bottom_right' => 'images/golf-vale-bedroom.png',
                'stats' => [
                    ['upper' => 'Developer', 'lower' => 'Emaar'],
                    ['upper' => 'AED 2,150,000', 'lower' => 'Starting Price from'],
                    ['upper' => '3-4br', 'lower' => 'Available Units'],
                    ['upper' => '2028 Q3', 'lower' => 'Handover'],
                ],
                'about_eyebrow' => '3 and 4-bedroom family townhouses',
                'about_heading' => 'About this development',
                'about_description' => $defaultAbout,
                'show_form' => true,
                'form_title' => 'Get expert advice about Nara Townhouse',
                'form_subtitle' => 'Connect with our experts to learn more about Nara Townhouse.',
                'property_types_heading' => 'Property types',
                'property_types' => $defaultPropertyTypes,
                'similar_heading' => 'Similar Project',
                'assigned_similar_projects' => ['golf-vale-emaar-south', 'the-fairway-villa', 'maple-row-villa'],
                'amenities_heading' => 'Amenities & Facilities',
                'assigned_amenities' => ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'],
                'location_heading' => 'Map View',
                'location_text' => 'The Valley, Dubai–Al Ain Road, Dubai',
                'latitude' => '25.0085',
                'longitude' => '55.4392',
                'payment_heading' => 'Payment Plan',
                'payment_subtitle' => 'For 3 Bedroom Townhouse · AED 2,150,000',
                'payment_options_label' => '3 Options',
                'payment_step1_pct' => '20',
                'payment_step1_title' => 'On Booking',
                'payment_step1_sub' => 'Step 1 · 20% paid',
                'payment_step2_pct' => '40',
                'payment_step2_title' => 'During Construction',
                'payment_step2_sub' => 'Step 2 · 60% paid',
                'payment_step3_pct' => '40',
                'payment_step3_title' => 'On Handover',
                'payment_step3_sub' => 'Step 3 · 100% paid',
                'payment_disclaimer' => 'Emaar offers a buyer-friendly payment structure designed to make luxury home ownership more accessible.',
                'full_content' => $defaultFullContent,
                'faqs' => $defaultFaqs,
            ],
        ];
    }

    public static function getOffplanProjectData($slug)
    {
        $all = self::getOffplanProjectStore();
        if (isset($all[$slug])) {
            return $all[$slug];
        }
        $first = reset($all);
        return array_merge($first, [
            'name' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'url' => '/projects/' . $slug,
        ]);
    }

    public function createOffplanProject()
    {
        $project = self::getOffplanProjectData('golf-vale-emaar-south');
        $project['name'] = '';
        $project['slug'] = '';
        $project['url'] = '/projects';
        $project['status'] = 'DRAFT';
        $project['property_category'] = 'villa';
        $allOffplanProjects = self::getAvailableOffplanProjects();
        $allReadyProjects = self::getAvailableReadyProjects();
        $allAmenities = self::getAmenitiesStore();
        $isNew = true;
        return view('admin.entities.offplan_edit', compact('project', 'allOffplanProjects', 'allReadyProjects', 'allAmenities', 'isNew'));
    }

    public function storeOffplanProject(Request $request)
    {
        $request->validate(['name' => ['required', 'string', 'max:255']]);
        $all = self::getOffplanProjectStore();
        $baseSlug = \Illuminate\Support\Str::slug($request->input('slug') ?: $request->input('name')) ?: ('project-' . time());
        $slug = $baseSlug;
        $counter = 2;
        while (isset($all[$slug])) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $this->updateOffplanProject($request, $slug);
        return redirect()->route('admin.offplan-projects.edit', $slug)->with('status', 'New Off-Plan Project created successfully.');
    }

    public function editOffplanProject($slug)
    {
        $project = self::getOffplanProjectData($slug);
        $allOffplanProjects = self::getAvailableOffplanProjects();
        $allReadyProjects = self::getAvailableReadyProjects();
        $allAmenities = self::getAmenitiesStore();
        return view('admin.entities.offplan_edit', compact('project', 'allOffplanProjects', 'allReadyProjects', 'allAmenities'));
    }

    public function updateOffplanProject(Request $request, $slug)
    {
        $all = self::getOffplanProjectStore();
        $isNewRecord = !isset($all[$slug]);
        $existing = self::getOffplanProjectData($slug);
        $str = fn (string $k, string $def = ''): string => $request->exists($k) ? (string) ($request->input($k) ?? '') : ($existing[$k] ?? $def);

        $existing['name'] = $str('name', $existing['name'] ?? '');
        $existing['slug'] = $slug;
        $existing['url'] = '/projects/' . $slug;
        $existing['city'] = $str('city', 'Dubai');
        $existing['status'] = $str('status', 'DRAFT');
        $defaultCat = str_contains(strtolower(($existing['name'] ?? '') . ' ' . $slug), 'townhouse') ? 'townhouse' : 'villa';
        $existing['property_category'] = $str('property_category', $existing['property_category'] ?? $defaultCat);
        $existing['meta_title'] = $str('meta_title');
        $existing['meta_keyword'] = $request->exists('meta_keywords') ? (string) ($request->input('meta_keywords') ?? '') : ($existing['meta_keyword'] ?? '');
        $existing['meta_description'] = $str('meta_description');

        // Hero & Gallery
        $existing['breadcrumbs'] = $str('breadcrumbs');

        if ($request->has('usps') && is_array($request->input('usps'))) {
            $usps = array_values(array_filter(array_map('trim', $request->input('usps')), fn ($v) => $v !== ''));
            $existing['usps'] = $usps;
        }

        foreach (['gallery_main', 'gallery_top_right', 'gallery_bottom_right'] as $gField) {
            if ($request->hasFile($gField . '_file')) {
                $file = $request->file($gField . '_file');
                $filename = time() . '_offplan_' . $gField . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                $file->move(public_path('images'), $filename);
                $existing[$gField] = 'images/' . $filename;
            } elseif ($request->exists($gField)) {
                $existing[$gField] = (string) ($request->input($gField) ?? '');
            }
        }

        // Key Stats Bar (4 pairs: upper & lower)
        if ($request->has('stats_upper') || $request->has('stats_lower')) {
            $stats = [];
            $statUpper = $request->input('stats_upper', []);
            $statLower = $request->input('stats_lower', []);
            for ($i = 0; $i < 4; $i++) {
                $stats[] = [
                    'upper' => (string) ($statUpper[$i] ?? ''),
                    'lower' => (string) ($statLower[$i] ?? ''),
                ];
            }
            $existing['stats'] = $stats;
        }

        // About Development & Expert Form
        $existing['about_eyebrow'] = $str('about_eyebrow');
        $existing['about_heading'] = $str('about_heading');
        $existing['about_description'] = $str('about_description');
        $existing['show_form'] = $request->has('show_form') ? ($request->input('show_form') == '1') : true;
        $existing['form_title'] = $str('form_title');
        $existing['form_subtitle'] = $str('form_subtitle');

        // Property Types Dynamic Rows
        $existing['property_types_heading'] = $str('property_types_heading');
        if ($request->has('pt_title') && is_array($request->input('pt_title'))) {
            $ptTitles = $request->input('pt_title', []);
            $ptTypes = $request->input('pt_type', []);
            $ptBeds = $request->input('pt_beds', []);
            $ptSizes = $request->input('pt_size', []);
            $ptPrices = $request->input('pt_price', []);
            $propTypes = [];
            foreach ($ptTitles as $idx => $t) {
                $t = trim((string) ($t ?? ''));
                if ($t !== '') {
                    $propTypes[] = [
                        'title' => $t,
                        'type' => trim((string) ($ptTypes[$idx] ?? '')),
                        'beds' => trim((string) ($ptBeds[$idx] ?? '')),
                        'size' => trim((string) ($ptSizes[$idx] ?? '')),
                        'price' => trim((string) ($ptPrices[$idx] ?? '')),
                    ];
                }
            }
            $existing['property_types'] = $propTypes;
        }

        // Similar Projects (Column A -> Column S Drag & Drop)
        $existing['similar_heading'] = $str('similar_heading');
        $selectedSim = $request->input('selected_similar_projects', []);
        if (is_string($selectedSim)) {
            $selectedSim = json_decode($selectedSim, true) ?: [];
        }
        $existing['assigned_similar_projects'] = is_array($selectedSim) ? array_values(array_filter($selectedSim)) : [];

        // Amenities (Dropdown & Checkboxes)
        $existing['amenities_heading'] = $str('amenities_heading');
        $selectedAm = $request->input('selected_amenities', []);
        if (is_string($selectedAm)) {
            $selectedAm = json_decode($selectedAm, true) ?: [];
        }
        $existing['assigned_amenities'] = is_array($selectedAm) ? array_values(array_filter($selectedAm)) : [];

        // Map Location (Latitude & Longitude)
        $existing['location_heading'] = $str('location_heading');
        $existing['location_text'] = $str('location_text');
        $existing['latitude'] = $str('latitude');
        $existing['longitude'] = $str('longitude');

        // Payment Plan (3 steps)
        $existing['payment_heading'] = $str('payment_heading');
        $existing['payment_subtitle'] = $str('payment_subtitle');
        $existing['payment_options_label'] = $str('payment_options_label');
        $existing['payment_step1_pct'] = $str('payment_step1_pct');
        $existing['payment_step1_title'] = $str('payment_step1_title');
        $existing['payment_step1_sub'] = $str('payment_step1_sub');
        $existing['payment_step2_pct'] = $str('payment_step2_pct');
        $existing['payment_step2_title'] = $str('payment_step2_title');
        $existing['payment_step2_sub'] = $str('payment_step2_sub');
        $existing['payment_step3_pct'] = $str('payment_step3_pct');
        $existing['payment_step3_title'] = $str('payment_step3_title');
        $existing['payment_step3_sub'] = $str('payment_step3_sub');
        $existing['payment_disclaimer'] = $str('payment_disclaimer');

        // Full Content (Summernote)
        if ($request->exists('full_content')) {
            $fc = (string) ($request->input('full_content') ?? '');
            $existing['full_content'] = preg_replace('/(<(?:p|h[1-6])\b[^>]*?)\sstyle="[^"]*"/i', '$1', $fc);
        }

        // FAQs
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

        if ($isNewRecord) {
            $all = [$slug => $existing] + $all;
        } else {
            $all[$slug] = $existing;
        }
        $filePath = storage_path('app/offplan_projects_data.json');
        file_put_contents($filePath, json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        return redirect()->back()->with('ok', 'Off Plan Project "' . $existing['name'] . '" updated successfully.');
    }

    public function destroyOffplanProject($slug)
    {
        $all = self::getOffplanProjectStore();
        if (isset($all[$slug])) {
            unset($all[$slug]);
            file_put_contents(storage_path('app/offplan_projects_data.json'), json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }
        return redirect()->route('admin.offplan-projects')->with('ok', 'Off Plan Project deleted.');
    }

    public static function getListingProjectStore(): array
    {
        $filePath = storage_path('app/listing_projects_data.json');
        if (file_exists($filePath)) {
            $data = json_decode(file_get_contents($filePath), true);
            if (is_array($data) && !empty($data)) {
                return $data;
            }
        }

        $defaultOverview = "Presenting an exceptional family residence designed around privacy, natural light, and resort-style outdoor living.\n\nThis ready-to-move property features spacious open-plan living areas, private landscaped gardens, and seamless indoor-outdoor entertaining spaces.\n\n- Prime Community Location\n- Spacious Living & Dining\n- Private Landscaped Garden & Parking";

        return [
            'the-valley-prime-location' => [
                'id' => 1,
                'name' => 'The Valley Prime Location Villa',
                'slug' => 'the-valley-prime-location',
                'city' => 'Dubai',
                'community' => 'The Valley',
                'developer' => 'Emaar',
                'status' => 'PUBLISHED',
                'property_type' => 'Villa',
                'tag' => 'READY TO MOVE',
                'price' => 'AED 2,740,000',
                'beds' => '4',
                'baths' => '4',
                'sqft' => '2,462 sq.ft',
                'handover' => 'Ready to Move',
                'payment_plan' => 'Cash / Mortgage',
                'authenticity' => 'Property authenticity validated by DLD Trakheesi',
                'url' => '/listing/the-valley-prime-location',
                'gallery_main' => 'images/arabian ranch.png',
                'gallery_top_right' => 'images/apartment.jpg',
                'gallery_bottom_right' => 'images/family-park.jpg',
                'usps' => ['The Valley', 'Prime Location', 'District Deal'],
                'subtext' => '4 Bedroom Villa for Sale in The Valley.',
                'overview_heading' => 'Overview',
                'overview_text' => $defaultOverview,
                'button_text' => 'See full description',
                'amenities_heading' => 'Amenities & Facilities',
                'assigned_amenities' => ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'],
                'location_heading' => 'Property Location',
                'location_text' => 'The Valley, Dubai-Al Ain Road, Dubai',
                'latitude' => '25.0085',
                'longitude' => '55.4392',
                'similar_heading' => 'Similar Projects',
                'assigned_similar_projects' => ['golf-fields-by-emaar', 'terra-heights-by-emaar', 'greenville-2-at-emaar-south', 'golf-edge-at-emaar-south'],
                'full_content' => '',
                'faqs' => [],
                'meta_title' => 'The Valley Prime Location Villa — Lux Villa Dubai',
            ],
            'the-fairway-villa-ready' => [
                'id' => 2,
                'name' => 'The Fairway Villa (Ready)',
                'slug' => 'the-fairway-villa-ready',
                'city' => 'Dubai',
                'community' => 'Jumeirah Golf Estates',
                'developer' => 'Emaar',
                'status' => 'PUBLISHED',
                'property_type' => 'Villa',
                'tag' => 'READY TO MOVE',
                'price' => 'AED 18,500,000',
                'beds' => '5',
                'baths' => '6',
                'sqft' => '7,200 sq.ft',
                'handover' => 'Ready to Move',
                'payment_plan' => 'Cash / Mortgage',
                'authenticity' => 'Property authenticity validated by DLD Trakheesi',
                'url' => '/listing/the-fairway-villa-ready',
                'gallery_main' => 'images/apartment.jpg',
                'gallery_top_right' => 'images/arabian ranch.png',
                'gallery_bottom_right' => 'images/golf-vale-bedroom.png',
                'usps' => ['The Fairway Villa', 'Jumeirah Golf Estates', 'Golf Course View'],
                'subtext' => '5 Bedroom Championship Golf Villa Ready for Immediate Handover.',
                'overview_heading' => 'Overview',
                'overview_text' => $defaultOverview,
                'button_text' => 'See full description',
                'amenities_heading' => 'Amenities & Facilities',
                'assigned_amenities' => ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'],
                'location_heading' => 'Property Location',
                'location_text' => 'Jumeirah Golf Estates, Dubai',
                'latitude' => '25.0211',
                'longitude' => '55.2004',
                'similar_heading' => 'Similar Projects',
                'assigned_similar_projects' => ['golf-fields-by-emaar', 'terra-heights-by-emaar', 'greenville-2-at-emaar-south', 'golf-edge-at-emaar-south'],
                'full_content' => '',
                'faqs' => [],
                'meta_title' => 'The Fairway Villa — Lux Villa Dubai',
            ],
            'maple-row-villa-ready' => [
                'id' => 3,
                'name' => 'Maple Row Villa (Ready)',
                'slug' => 'maple-row-villa-ready',
                'city' => 'Dubai',
                'community' => 'Dubai Hills Estate',
                'developer' => 'Emaar',
                'status' => 'PUBLISHED',
                'property_type' => 'Villa',
                'tag' => 'READY TO MOVE',
                'price' => 'AED 7,900,000',
                'beds' => '4',
                'baths' => '5',
                'sqft' => '4,100 sq.ft',
                'handover' => 'Ready to Move',
                'payment_plan' => 'Cash / Mortgage',
                'authenticity' => 'Property authenticity validated by DLD Trakheesi',
                'url' => '/listing/maple-row-villa-ready',
                'gallery_main' => 'images/arabian ranch.png',
                'gallery_top_right' => 'images/apartment.jpg',
                'gallery_bottom_right' => 'images/family-park.jpg',
                'usps' => ['Maple Row Villa', 'Dubai Hills Estate', 'Corner Plot'],
                'subtext' => '4 Bedroom Ready Villa in Dubai Hills Estate.',
                'overview_heading' => 'Overview',
                'overview_text' => $defaultOverview,
                'button_text' => 'See full description',
                'amenities_heading' => 'Amenities & Facilities',
                'assigned_amenities' => ['children-play-area', 'schools', 'restaurants', 'shopping-mall', 'sports-facilities', 'fitness-centre', 'parking-area', 'walking-trails'],
                'location_heading' => 'Property Location',
                'location_text' => 'Dubai Hills Estate, Dubai',
                'latitude' => '25.1135',
                'longitude' => '55.2528',
                'similar_heading' => 'Similar Projects',
                'assigned_similar_projects' => ['golf-fields-by-emaar', 'terra-heights-by-emaar', 'greenville-2-at-emaar-south', 'golf-edge-at-emaar-south'],
                'full_content' => '',
                'faqs' => [],
                'meta_title' => 'Maple Row Villa — Lux Villa Dubai',
            ],
        ];
    }

    public static function getListingProjectData(string $slug): array
    {
        $all = self::getListingProjectStore();
        if (isset($all[$slug])) {
            return $all[$slug];
        }
        $first = reset($all);
        return array_merge($first, [
            'name' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'url' => '/listing/' . $slug,
        ]);
    }

    public function listingProjects()
    {
        $store = self::getListingProjectStore();
        $projects = [];
        $i = 1;
        foreach ($store as $slug => $data) {
            $projects[] = [
                'id' => $i++,
                'name' => $data['name'] ?? $slug,
                'slug' => $slug,
                'city' => $data['city'] ?? 'Dubai',
                'status' => $data['status'] ?? 'PUBLISHED',
                'disapprove_comments' => '',
                'url' => $data['url'] ?? ('/listing/' . $slug),
                'edit_url' => route('admin.listing-projects.edit', $slug),
                'delete_url' => route('admin.listing-projects.destroy', $slug),
            ];
        }
        return view('admin.entities.generic', [
            'title' => 'Listing Project',
            'items' => $projects,
            'nameLabel' => 'LISTING PROJECT NAME',
            'create_url' => route('admin.listing-projects.create'),
        ]);
    }

    public function createListingProject()
    {
        $listing = self::getListingProjectData('the-valley-prime-location');
        $listing['name'] = '';
        $listing['slug'] = '';
        $listing['url'] = '/listing';
        $listing['status'] = 'PUBLISHED';
        $listing['meta_title'] = '';
        $allAmenities = self::getAmenitiesStore();
        $isNew = true;
        return view('admin.entities.listing_edit', compact('listing', 'allAmenities', 'isNew'));
    }

    public function storeListingProject(Request $request)
    {
        $request->validate(['name' => ['required', 'string', 'max:255']]);
        $all = self::getListingProjectStore();
        $baseSlug = \Illuminate\Support\Str::slug($request->input('slug') ?: $request->input('name')) ?: ('listing-' . time());
        $slug = $baseSlug;
        $counter = 2;
        while (isset($all[$slug])) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $this->updateListingProject($request, $slug);
        return redirect()->route('admin.listing-projects.edit', $slug)->with('ok', 'New Listing Project created and synced to /projects (Ready To Move) & /villas-for-sale.');
    }

    public function editListingProject($slug)
    {
        $listing = self::getListingProjectData($slug);
        $allAmenities = self::getAmenitiesStore();
        $isNew = false;
        return view('admin.entities.listing_edit', compact('listing', 'allAmenities', 'isNew'));
    }

    public function updateListingProject(Request $request, $slug)
    {
        $all = self::getListingProjectStore();
        $isNewRecord = !isset($all[$slug]);
        $existing = self::getListingProjectData($slug);
        $str = fn (string $k, string $def = ''): string => $request->exists($k) ? (string) ($request->input($k) ?? '') : ($existing[$k] ?? $def);

        $existing['name'] = $str('name', $existing['name'] ?? '');
        $existing['slug'] = $slug;
        $existing['url'] = '/listing/' . $slug;
        $existing['city'] = $str('city', 'Dubai');
        $existing['community'] = $str('community', 'Dubai');
        $existing['developer'] = $str('developer', 'Emaar');
        $existing['status'] = $str('status', 'PUBLISHED');
        $existing['property_type'] = $str('property_type', 'Villa');
        $existing['tag'] = $str('tag', 'READY TO MOVE');
        $existing['price'] = $str('price', 'AED 2,740,000');
        $existing['beds'] = $str('beds', '4');
        $existing['baths'] = $str('baths', '4');
        $existing['sqft'] = $str('sqft', '2,462 sq.ft');
        $existing['handover'] = $str('handover', 'Ready to Move');
        $existing['payment_plan'] = $str('payment_plan', 'Cash / Mortgage');
        $existing['authenticity'] = $str('authenticity');
        $existing['subtext'] = $str('subtext');
        $existing['overview_heading'] = $str('overview_heading', 'Overview');
        $existing['overview_text'] = $str('overview_text');
        $existing['button_text'] = $str('button_text', 'See full description');
        $existing['location_heading'] = $str('location_heading', 'Property Location');
        $existing['location_text'] = $str('location_text');
        $existing['latitude'] = $str('latitude', '25.0085');
        $existing['longitude'] = $str('longitude', '55.4392');
        $existing['amenities_heading'] = $str('amenities_heading', 'Amenities & Facilities');
        $existing['meta_title'] = $str('meta_title');

        if ($request->exists('usps_text')) {
            $lines = array_values(array_filter(array_map('trim', explode('|', (string) $request->input('usps_text'))), fn ($v) => $v !== ''));
            $existing['usps'] = $lines;
        }

        foreach (['gallery_main', 'gallery_top_right', 'gallery_bottom_right'] as $gField) {
            if ($request->hasFile($gField . '_file')) {
                $file = $request->file($gField . '_file');
                $filename = time() . '_listing_' . $gField . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                $file->move(public_path('images'), $filename);
                $existing[$gField] = 'images/' . $filename;
            } elseif ($request->exists($gField)) {
                $existing[$gField] = (string) ($request->input($gField) ?? '');
            }
        }

        $selectedAm = $request->input('assigned_amenities', []);
        if ($request->exists('amenities_present')) {
            $existing['assigned_amenities'] = is_array($selectedAm) ? array_values(array_filter($selectedAm)) : [];
        }

        if ($request->exists('full_content')) {
            $fc = (string) ($request->input('full_content') ?? '');
            $existing['full_content'] = preg_replace('/(<(?:p|h[1-6])\b[^>]*?)\sstyle="[^"]*"/i', '$1', $fc);
        }

        if ($request->has('faq_q')) {
            $faqQuestions = $request->input('faq_q', []);
            $faqAnswers = $request->input('faq_a', []);
            $faqs = [];
            foreach ($faqQuestions as $idx => $q) {
                $q = trim((string) $q);
                $a = trim((string) ($faqAnswers[$idx] ?? ''));
                if ($q !== '') {
                    $faqs[] = ['q' => $q, 'a' => $a];
                }
            }
            $existing['faqs'] = $faqs;
        }

        if ($isNewRecord) {
            $all = [$slug => $existing] + $all;
        } else {
            $all[$slug] = $existing;
        }
        file_put_contents(storage_path('app/listing_projects_data.json'), json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        return redirect()->back()->with('ok', 'Listing Project "' . $existing['name'] . '" saved successfully.');
    }

    public function destroyListingProject($slug)
    {
        $all = self::getListingProjectStore();
        if (isset($all[$slug])) {
            unset($all[$slug]);
            file_put_contents(storage_path('app/listing_projects_data.json'), json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }
        return redirect()->route('admin.listing-projects')->with('ok', 'Listing Project deleted.');
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

    /** Build unified database/CMS cards for /projects filterable listing sections. */
    public static function buildProjectFilterCards(?array $assignedSlugs = null, string $defaultFilter = 'all'): array
    {
        $offplanStore = self::getOffplanProjectStore();
        $readyList = self::getAvailableReadyProjects();
        $catalog = [];

        foreach ($offplanStore as $slug => $proj) {
            $priceStr = $proj['stats'][1]['upper'] ?? 'AED 1.1M';
            $unitsStr = $proj['stats'][2]['upper'] ?? '3-4 Beds';
            $handoverStr = $proj['stats'][3]['upper'] ?? '2028';
            $name = $proj['name'] ?? ucwords(str_replace('-', ' ', $slug));
            $cat = $proj['property_category'] ?? (str_contains(strtolower($name . ' ' . $slug), 'townhouse') ? 'townhouse' : 'villa');
            $isTown = ($cat === 'townhouse');
            $numVal = 0.0;
            if (preg_match('/([\d,.]+)\s*M/i', $priceStr, $m)) {
                $numVal = (float) str_replace(',', '', $m[1]);
            } elseif (preg_match('/([\d,]+)/', $priceStr, $m)) {
                $raw = (float) str_replace(',', '', $m[1]);
                $numVal = $raw > 1000 ? ($raw / 1000000) : $raw;
            }
            $catalog[$slug] = [
                'slug' => $slug,
                'tag' => 'OFF-PLAN',
                'tag_bg' => 'bg-[#C5A47E]',
                'image' => !empty($proj['gallery_main']) ? $proj['gallery_main'] : 'images/project-nara-townhouse.jpg',
                'title' => $name,
                'location' => ($isTown ? 'Townhouse' : 'Villa') . ' · ' . ($proj['city'] ?? 'Dubai'),
                'type' => $isTown ? 'townhouse' : 'villa',
                'beds' => $unitsStr,
                'baths' => '4 Baths',
                'sqft' => '2,400 sq ft',
                'price' => $priceStr,
                'price_m' => round($numVal, 2),
                'handover' => $handoverStr,
                'mode' => 'offplan',
                'yield' => '6.5%',
                'link' => $proj['url'] ?? ('/projects/' . $slug),
            ];
        }

        foreach ($readyList as $rp) {
            $slug = 'ready_' . $rp['slug'];
            $priceStr = $rp['price'] ?? 'AED 7.9M';
            $numVal = 0.0;
            if (preg_match('/([\d,.]+)\s*M/i', $priceStr, $m)) {
                $numVal = (float) str_replace(',', '', $m[1]);
            } elseif (preg_match('/([\d,]+)/', $priceStr, $m)) {
                $raw = (float) str_replace(',', '', $m[1]);
                $numVal = $raw > 1000 ? ($raw / 1000000) : $raw;
            }
            $pType = strtolower($rp['property_type'] ?? (str_contains(strtolower(($rp['name'] ?? '') . ' ' . $rp['slug']), 'townhouse') ? 'townhouse' : 'villa'));
            $isTown = ($pType === 'townhouse');
            $catalog[$slug] = [
                'slug' => $rp['slug'],
                'tag' => $rp['tag'] ?? 'READY',
                'tag_bg' => 'bg-[#18392B]',
                'image' => $rp['image'] ?? 'images/project-fairway-villa.jpg',
                'title' => $rp['name'] ?? $rp['slug'],
                'location' => ($isTown ? 'Townhouse' : 'Villa') . ' · ' . ($rp['location'] ?? 'Dubai'),
                'type' => $isTown ? 'townhouse' : 'villa',
                'beds' => ($rp['beds'] ?? '4') . ' Beds',
                'baths' => ($rp['baths'] ?? '4') . ' Baths',
                'sqft' => $rp['sqft'] ?? '2,462 sq.ft',
                'price' => $priceStr,
                'price_m' => round($numVal, 2),
                'handover' => $rp['handover'] ?? 'Ready',
                'mode' => 'buy',
                'yield' => '5.6%',
                'link' => $rp['url'] ?? ('/listing/' . $rp['slug']),
            ];
        }

        $items = array_values($catalog);

        if ($defaultFilter === 'villa') {
            return array_values(array_filter($items, fn ($it) => $it['mode'] === 'offplan' && $it['type'] === 'villa'));
        }
        if ($defaultFilter === 'townhouse') {
            return array_values(array_filter($items, fn ($it) => $it['mode'] === 'offplan' && $it['type'] === 'townhouse'));
        }
        if ($defaultFilter === 'ready') {
            return array_values(array_filter($items, fn ($it) => $it['mode'] === 'buy'));
        }

        if (!empty($assignedSlugs) && is_array($assignedSlugs)) {
            $bySlug = [];
            foreach ($items as $it) {
                if (!isset($bySlug[$it['slug']])) {
                    $bySlug[$it['slug']] = $it;
                }
            }
            $out = [];
            foreach ($assignedSlugs as $s) {
                if (isset($bySlug[$s])) {
                    $out[] = $bySlug[$s];
                }
            }
            if (!empty($out)) {
                return $out;
            }
        }

        return $items;
    }
}
