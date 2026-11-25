<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Section;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeds the whole LUX CMS: admin user, global settings, every global
 * section with the exact Figma copy (Bahria Town mentions kept as-is),
 * and all 11 pages with their sections in the v1 order.
 * `php artisan migrate:fresh --seed` reproduces the entire site.
 */
class LuxContentSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Admin user (credentials are set via env, defaults in README) ----
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@luxvilla.ae')],
            ['name' => 'LUX Admin', 'password' => Hash::make(env('ADMIN_PASSWORD', 'LuxAdmin!2026')), 'email_verified_at' => now()]
        );

        // ---- Global settings (header / footer / contact — no hardcoded copy in Blade) ----
        $settings = [
            'site_name' => 'Lux Villa Dubai',
            'site_tagline' => 'LUX VILLA DUBAI',
            'logo_text' => 'LUX VILLA',
            'logo_sub' => 'DUBAI',
            'header_button_text' => 'Book a Free Consultation →',
            'header_button_link' => '/enquiry',
            'footer_about' => 'Lux Villa Dubai is a specialist advisory for villas and townhouses across Dubai and Abu Dhabi. We publish the numbers — prices, yields, full buying costs — before we ever pitch a home.',
            'footer_disclaimer' => '© 2026 Lux Villa Dubai. All rights reserved. Property information is provided for general information only. Prices, availability, payment plans, specifications, and other details are subject to change without prior notice. Images are for illustrative purposes only and may not reflect actual properties.',
            'footer_copyright' => '© 2026 The Lux Villa Dubai. All rights reserved.',
            'contact_phone' => '+971 50 000 0000',
            'contact_whatsapp_label' => 'WhatsApp Us',
            'contact_city' => 'Dubai, United Arab Emirates',
            'social_facebook' => '#',
            'social_instagram' => '#',
            'social_linkedin' => '#',
            'nav_items' => json_encode([
                ['label' => 'HOME', 'url' => '/'],
                ['label' => 'VILLAS', 'url' => '/villas-for-sale'],
                ['label' => 'BUY', 'url' => '/villas-for-sale'],
                ['label' => 'SELL', 'url' => '/villas-for-sale'],
                ['label' => 'MAINTENANCE', 'url' => '/about'],
                ['label' => 'COMMUNITIES', 'url' => '/communities'],
                ['label' => 'COMPANIES', 'url' => '/projects'],
                ['label' => 'PROJECTS', 'url' => '/projects'],
                ['label' => 'ABOUT US', 'url' => '/about'],
            ]),
            'footer_explore' => json_encode([
                ['label' => 'HOME', 'url' => '/'],
                ['label' => 'VILLAS', 'url' => '/villas-for-sale'],
                ['label' => 'COMMUNITIES', 'url' => '/communities'],
                ['label' => 'PROJECTS', 'url' => '/projects'],
                ['label' => 'ABOUT US', 'url' => '/about'],
                ['label' => 'BLOG', 'url' => '/blog'],
                ['label' => 'AI VILLA ASSESSMENT', 'url' => '/ai-villa-assessment'],
            ]),
        ];
        foreach ($settings as $k => $v) {
            Setting::set($k, $v);
        }

        $this->seedGlobals();
        $this->seedHome();
        $this->seedAbout();
        $this->seedVillas();
        $this->seedListing();
        $this->seedProjectDetails();
        $this->seedAssessment();
        $this->seedEnquiry();
        $this->seedBlog();
        $this->seedCommunities();
        $this->seedValley();
        $this->seedProjects();
        $this->seedPages();
    }

    private function section(string $key, string $name, string $type, array $content, bool $global = true): Section
    {
        return Section::updateOrCreate(['key' => $key], [
            'name' => $name, 'type' => $type, 'content' => $content,
            'is_global' => $global, 'status' => 'published',
        ]);
    }

    private function seedGlobals(): void
    {
        $this->section('global_advisor', 'Advisor band (global)', 'advisor_band', [
            'heading_html' => 'Not sure where to start?<br>Talk to an advisor first.',
            'subtext' => "Tell us your budget and goals. We'll shortlist communities and homes that fit, with the numbers laid out honestly. No pressure, no obligation.",
            'button_text' => 'Book a Free Consultation →', 'button_link' => '/enquiry',
            'button2_text' => 'Chat on WhatsApp', 'button2_link' => '/enquiry',
            'chat_title' => 'Lux Villa Advisor', 'chat_status' => '● Online now',
            'chat_messages' => [
                ['side' => 'left', 'text' => 'What budget are you working with?'],
                ['side' => 'right', 'text' => 'Around AED 2M, mainly for rental income.'],
                ['side' => 'left', 'text' => 'Here are three communities with strong yields, and what each would cost in total.'],
            ],
        ]);
        $this->section('global_seo', 'SEO text block (global)', 'seo_text', [
            'blocks' => [
                ['heading' => 'Modern lifestyle and residential <span class="script">opportunities</span>', 'level' => 2, 'text' => "Dubai's villa communities combine green open spaces, real amenities and the numbers behind each home. From Arabian Ranches and Dubai Hills Estate to The Valley and DAMAC Lagoons, every community has its own character — and its own price, yield and payment plan."],
                ['heading' => 'Luxury villas and real estate investment opportunities', 'level' => 3, 'text' => 'Whether you are buying a family home, a smart investment or a place to call your own, Lux Villa Dubai shows you the full picture first: prices, yields, service charges and the total cost of buying. No hidden numbers, no pressure.'],
                ['heading' => 'Finding The Right Lux Villas In Dubai', 'level' => 3, 'text' => 'Start with your budget and goals, compare communities side by side, and shortlist the homes that fit. Our advisors stay involved from the first search to long after handover.'],
                ['heading' => 'Conclusion', 'level' => 3, 'text' => 'DISCLAIMER: It Is Not Official Bahria Town Dubai Website. Property information is provided for general information only. Prices, availability, payment plans, specifications, and other details are subject to change without prior notice. Images are for illustrative purposes only and may not reflect actual properties.'],
            ],
        ]);
        $this->section('faq_default', 'FAQ — default (global)', 'faq', [
            'eyebrow' => 'FAQS',
            'heading_html' => 'Frequently asked <span class="script">questions</span>',
            'faqs' => [
                ['q' => 'What is Lux Villa Dubai?', 'a' => 'Lux Villa Dubai is a specialist advisory for villas and townhouses across Dubai and Abu Dhabi. We publish the numbers — prices, yields, full buying costs — before we ever pitch a home.'],
                ['q' => 'What types of properties are available in Lux Villa Dubai?', 'a' => 'Ready villas and townhouses, off-plan villas and townhouses, and resale homes across Dubai and Abu Dhabi, from trusted developers and sellers we have checked.'],
                ['q' => 'Is Lux Villa Dubai a good investment opportunity?', 'a' => 'Dubai villas have historically offered strong rental yields and capital growth. We show ROI, rental yields and price trends for every community so you can compare the numbers before you decide.'],
                ['q' => 'Where is Lux Villa Dubai located?', 'a' => 'Lux Villa Dubai advises buyers across Dubai and Abu Dhabi, United Arab Emirates.'],
                ['q' => 'What connectivity does Lux Villa Dubai offer to the rest of the city?', 'a' => 'Our community guides cover road links, schools, shopping, parks and commute times for each community, so you can see how every location connects to the rest of the city.'],
            ],
        ]);
        $this->section('faq_about', 'FAQ — About page', 'faq', [
            'eyebrow' => 'FAQS',
            'heading_html' => 'Frequently asked <span class="script">questions</span>',
            'faqs' => [
                ['q' => 'What Is Lux Villa Dubai?', 'a' => 'Lux Villa Dubai is a specialist advisory for villas and townhouses across Dubai and Abu Dhabi. We publish the numbers — prices, yields, full buying costs — before we ever pitch a home.'],
                ['q' => 'Who Is The Developer Behind Lux Villa Dubai?', 'a' => 'Lux Villa Dubai is an independent advisory. We work with trusted developers and sellers across Dubai and Abu Dhabi, including Emaar, DAMAC and Binghatti.'],
                ['q' => 'Where Is Lux Villa Dubai Located?', 'a' => 'Lux Villa Dubai advises buyers across Dubai and Abu Dhabi, United Arab Emirates.'],
                ['q' => 'What Types Of Properties Are Available In Lux Villa Dubai?', 'a' => 'Ready villas and townhouses, off-plan villas and townhouses, and resale homes across Dubai and Abu Dhabi.'],
                ['q' => 'Is Lux Villa Dubai A Good Investment Opportunity?', 'a' => 'Dubai villas have historically offered strong rental yields and capital growth. We show ROI, rental yields and price trends for every community so you can compare the numbers before you decide.'],
                ['q' => 'What Connectivity Does Lux Villa Dubai Offer To The Rest Of The City?', 'a' => 'Our community guides cover road links, schools, shopping, parks and commute times for each community, so you can see how every location connects to the rest of the city.'],
            ],
        ]);
        $this->section('global_register', 'Register Your Interest (global)', 'register_interest', [
            'disclaimer' => "DISCLAIMER: Its Not Official Bahria Town Dubai Website. We Inform That All Property Information Provided On This Website Is For General Guidance Only And Does Not Constitute A Formal Offer. Prices, Availability, And Property Details May Change At Any Time Without Prior Notice. Images Are For Illustrative Purposes And May Not Reflect Actual Properties. For The Most Accurate And Up-To-Date Information, Please Contact Us Directly Through The Details Provided On The Website.",
            'heading_html' => 'Register Your Interest',
            'subtext' => 'Get clear, personalised guidance on unit availability, current market trends and the collection that best matches your goals — no pressure, just the facts.',
            'button_text' => 'Register Interest  ›',
            'button_link' => '/enquiry',
            'phone_text' => 'Phone Number',
            'phone_link' => 'tel:+971500000000',
        ]);
    }

    private function seedHome(): void
    {
        $this->section('home_hero', 'Home — Hero', 'hero', [
            'image' => 'images/living.jpg', 'image_alt' => 'Bright modern villa living room in Dubai',
            'eyebrow' => '• DUBAI VILLAS & TOWNHOUSES',
            'heading_html' => 'Find Your Ideal<br>Home in <span class="font-script font-normal text-6xl md:text-8xl inline-block ml-1">Dubai</span>',
            'subtext' => 'Explore curated villas and townhouses — ready, off-plan and resale. Compare communities, understand the numbers, and make a confident decision with expert guidance.',
            'button_text' => 'Explore Properties →', 'button_link' => '/villas-for-sale',
        ]);
        $this->section('home_search', 'Home — Search card', 'search_filter', [
            'button_text' => 'Search →', 'button_link' => '/villas-for-sale',
            'fields' => [
                ['label' => 'Property Type', 'name' => 'type', 'options' => ['Villas & Townhouses', 'Villas', 'Townhouses']],
                ['label' => 'Status', 'name' => 'status', 'options' => ['All (Ready, Off-plan, resale)', 'Ready', 'Off-plan', 'Resale']],
                ['label' => 'Budget', 'name' => 'budget', 'options' => ['Any budget', 'Under AED 2M', 'AED 2M–3M', 'AED 3M–5M', 'AED 5M+']],
                ['label' => 'Community', 'name' => 'community', 'options' => ['All Communities', 'Arabian Ranches', 'Dubai Hills Estate', 'The Valley', 'DAMAC Lagoons']],
            ],
        ]);
        $this->section('home_explore', 'Home — Explore properties', 'cards_3col', [
            'eyebrow' => 'EXPLORE PROPERTIES',
            'heading_html' => 'Villas &amp; Townhouses in Dubai',
            'subtext' => "Whether you're looking for a family home, a smart investment or a place to call your own, we have options to match your goals.",
            'header_button_text' => 'View All Properties →',
            'header_button_link' => '/villas-for-sale',
            'items' => [
                ['image' => 'images/readyvilla.png', 'title' => 'Ready Villas & Town Houses', 'link' => '/villas-for-sale', 'button_text' => 'Explore More'],
                ['image' => 'images/realestet.png', 'title' => 'Resale Villas & Town Houses', 'link' => '/villas-for-sale', 'button_text' => 'Explore More'],
                ['image' => 'images/offplan.png', 'title' => 'Off-Plan Villas & Town Houses', 'link' => '/villas-for-sale', 'button_text' => 'Explore More'],
            ],
        ]);
        $this->section('home_journey', 'Home — Home-buying journey', 'text_image', [
            'eyebrow' => 'FIND YOUR PERFECT MORTGAGE',
            'image' => 'images/image 314.png', 'image_alt' => 'Luxury living room with sea view', 'image_side' => 'right',
            'heading_html' => 'Your home-buying journey should be smooth and stress-free',
            'subtext' => 'Speak to our in-house mortgage team today and get access the best rates in the UAE.',
            'button_text' => 'Mortgage Calculator', 'button_link' => '/ai-villa-assessment',
            'button2_text' => 'Speak to the team', 'button2_link' => '/enquiry', 'button2_style' => 'tan',
        ]);
        $this->section('home_numbers', 'Home — Numbers', 'numbers_3col', [
            'heading_html' => 'Buy property with the numbers in front of you',
            'subtext' => 'Everything you need to compare, verify and decide, with an advisor on hand when you want one.',
            'items' => [
                ['type' => 'insights', 'title' => 'Investment Insights', 'text' => 'See ROI, rental yields and price trends for each area before you shortlist.', 'link_text' => 'Explore market data', 'link' => '/projects'],
                ['type' => 'scale', 'title' => 'Side-by-Side Comparisons', 'text' => 'Compare properties, communities and total costs in one view.', 'link_text' => 'Compare properties', 'link' => '/villas-for-sale'],
                ['type' => 'shield', 'title' => 'Curated Listings', 'text' => 'Every property comes from a trusted developer or seller we have checked.', 'link_text' => 'Browse listings', 'link' => '/villas-for-sale'],
                ['type' => 'user', 'title' => 'Expert Advisory', 'text' => 'Personal guidance from first search to handover.', 'link_text' => 'Talk to an advisor', 'link' => '/enquiry'],
            ],
        ]);
        $this->section('home_communities', 'Home — Popular communities', 'communities_grid', [
            'eyebrow' => 'VILLAS & TOWNHOUSES',
            'heading_html' => 'Popular Communities',
            'link_text' => 'Explore More',
            'items' => [
                ['image' => 'images/arabian ranch.png', 'title' => 'Arabian Ranches', 'subtitle' => 'Villas & Townhouses', 'link' => '/communities/the-valley', 'button_text' => 'Explore More'],
                ['image' => 'images/dubai hill estate.png', 'title' => 'Dubai Hills Estate', 'subtitle' => 'Villas & Townhouses', 'link' => '/communities/the-valley', 'button_text' => 'Explore More'],
                ['image' => 'images/the valley.png', 'title' => 'The Valley', 'subtitle' => 'Villas & Townhouses', 'link' => '/communities/the-valley', 'button_text' => 'Explore More'],
                ['image' => 'images/damac.png', 'title' => 'DAMAC Lagoons', 'subtitle' => 'Villas & Townhouses', 'link' => '/communities/the-valley', 'button_text' => 'Explore More'],
            ],
        ]);
        $this->section('home_report', 'Home — Market report', 'text_image', [
            'variant' => 'report_banner',
            'bg_color' => '#FAF8F5',
            'image' => 'images/1st banner.png', 'image_alt' => 'Hand holding the UAE Real Estate Market Sentiment Report', 'image_side' => 'left',
            'heading_html' => 'UAE Real Estate Market<br>Sentiment Report 2026',
            'subtext' => "In the current global environment, investor sentiment toward UAE real estate has become harder to gauge through transactions alone. Provident Estate's Market Research Division conducted this survey across the Emirates and more than 90 countries worldwide to better understand how people currently view the market.",
            'button_text' => 'Download the Report', 'button_link' => '#',
        ]);
        $this->section('home_listings', 'Home — Explore property listings', 'listings', [
            'heading_html' => 'Explore Property in Dubai.',
            'tabs' => [['key' => 'villas', 'label' => 'Villas'], ['key' => 'townhouses', 'label' => 'Town Houses']],
            'panels' => [
                'villas' => [
                    ['tag' => 'READY', 'image' => 'images/villa-modern.jpg', 'title' => 'The Fairway Villa', 'location' => 'Villa · Jumeirah Golf Estates, Dubai', 'beds' => '5 Beds', 'baths' => '6 Baths', 'sqft' => '7,200 sq ft', 'price' => 'AED 18.5M', 'gross_yield' => '5.1%', 'link' => '/listing/the-valley-prime-location'],
                    ['tag' => 'READY', 'image' => 'images/house-facade.jpg', 'title' => 'Maple Row Villa', 'location' => 'Villa · Dubai Hills Estate, Dubai', 'beds' => '4 Beds', 'baths' => '5 Baths', 'sqft' => '4,100 sq ft', 'price' => 'AED 7.9M', 'gross_yield' => '5.6%', 'link' => '/listing/the-valley-prime-location'],
                    ['tag' => 'OFF-PLAN', 'image' => 'images/townhouse.jpg', 'title' => 'Nara Townhouse', 'location' => 'Townhouse · The Valley, Dubai', 'beds' => '3 Beds', 'baths' => '4 Baths', 'sqft' => '2,100 sq ft', 'price' => 'AED 2.15M', 'gross_yield' => '6.8%', 'link' => '/listing/the-valley-prime-location'],
                    ['tag' => 'READY', 'image' => 'images/villa-modern.jpg', 'title' => 'The Fairway Villa', 'location' => 'Villa · Jumeirah Golf Estates, Dubai', 'beds' => '5 Beds', 'baths' => '6 Baths', 'sqft' => '7,200 sq ft', 'price' => 'AED 18.5M', 'gross_yield' => '5.1%', 'link' => '/listing/the-valley-prime-location'],
                    ['tag' => 'READY', 'image' => 'images/house-facade.jpg', 'title' => 'Maple Row Villa', 'location' => 'Villa · Dubai Hills Estate, Dubai', 'beds' => '4 Beds', 'baths' => '5 Baths', 'sqft' => '4,100 sq ft', 'price' => 'AED 7.9M', 'gross_yield' => '5.6%', 'link' => '/listing/the-valley-prime-location'],
                    ['tag' => 'OFF-PLAN', 'image' => 'images/townhouse.jpg', 'title' => 'Nara Townhouse', 'location' => 'Townhouse · The Valley, Dubai', 'beds' => '3 Beds', 'baths' => '4 Baths', 'sqft' => '2,100 sq ft', 'price' => 'AED 2.15M', 'gross_yield' => '6.8%', 'link' => '/listing/the-valley-prime-location'],
                ],
                'townhouses' => [
                    ['tag' => 'READY', 'image' => 'images/villa-modern.jpg', 'title' => 'The Fairway Villa', 'location' => 'Villa · Jumeirah Golf Estates, Dubai', 'beds' => '5 Beds', 'baths' => '6 Baths', 'sqft' => '7,200 sq ft', 'price' => 'AED 18.5M', 'gross_yield' => '5.1%', 'link' => '/listing/the-valley-prime-location'],
                    ['tag' => 'READY', 'image' => 'images/house-facade.jpg', 'title' => 'Maple Row Villa', 'location' => 'Villa · Dubai Hills Estate, Dubai', 'beds' => '4 Beds', 'baths' => '5 Baths', 'sqft' => '4,100 sq ft', 'price' => 'AED 7.9M', 'gross_yield' => '5.6%', 'link' => '/listing/the-valley-prime-location'],
                    ['tag' => 'OFF-PLAN', 'image' => 'images/townhouse.jpg', 'title' => 'Nara Townhouse', 'location' => 'Townhouse · The Valley, Dubai', 'beds' => '3 Beds', 'baths' => '4 Baths', 'sqft' => '2,100 sq ft', 'price' => 'AED 2.15M', 'gross_yield' => '6.8%', 'link' => '/listing/the-valley-prime-location'],
                ],
            ],
        ]);
        $this->section('home_insights', 'Home — Latest market insights', 'blog_cards', [
            'compare_heading' => "Compare.<br>Analyse, Decide.",
            'compare_subtext' => "Use our property comparison tool to evaluate pricing, yields, payment plans and more.",
            'compare_button_text' => "Compare Properties →",
            'compare_button_link' => "/villas-for-sale",
            'insights_heading' => "Latest Market Insights",
            'items' => [
                ['image' => 'images/dubai-skyline.jpg', 'title' => 'Dubai Villa Market 2025: Key Trends and Opportunities', 'date' => '16 Apr 2025', 'link' => '/blog'],
                ['image' => 'images/dubai-marina.jpg', 'title' => 'ROI Analysis: Dubai Townhouses vs Villas', 'date' => '16 Apr 2025', 'link' => '/blog'],
                ['image' => 'images/dubai-towers.jpg', 'title' => 'Planning to Buy in Dubai? Essential Costs to Know', 'date' => '3 Apr 2025', 'link' => '/blog'],
            ],
        ]);
        $this->section('home_testimonials', 'Home — Testimonials', 'testimonials', [
            'heading_html' => 'Why Our Clients Trust Us',
            'subtext' => 'Discover what our customers are saying about their experiences.',
            'button_text' => 'See all reviews',
            'button_link' => '#',
            'items' => [
                ['avatar' => 'images/avatar-man.jpg', 'name' => 'Bashar Masalha', 'meta' => '3 months ago', 'stars' => 5, 'title' => 'An Honest Approach to Real Estate', 'text' => 'I worked with Zeinab Haidar, it was an exceptional experience. She combines deep market knowledge with genuine care for her clients, She took the time...', 'more_link' => '#'],
                ['avatar' => 'images/avatar-woman.jpg', 'name' => 'Bashar Masalha', 'meta' => '3 months ago', 'stars' => 5, 'title' => 'An Honest Approach to Real Estate', 'text' => 'I worked with Zeinab Haidar, it was an exceptional experience. She combines deep market knowledge with genuine care for her clients, She took the time...', 'more_link' => '#'],
                ['avatar' => 'images/avatar-woman2.jpg', 'name' => 'Bashar Masalha', 'meta' => '3 months ago', 'stars' => 5, 'title' => 'An Honest Approach to Real Estate', 'text' => 'I worked with Zeinab Haidar, it was an exceptional experience. She combines deep market knowledge with genuine care for her clients, She took the time...', 'more_link' => '#'],
            ],
        ]);
        $this->section('home_quiz', 'Home — Property quiz CTA', 'text_image', [
            'variant' => 'quiz_section',
            'image' => 'images/dubai-skyline.jpg', 'image_alt' => 'Man in front of the Burj Khalifa, Dubai', 'image_side' => 'left',
            'heading_html' => 'Confused About Where to Buy or<br>Invest in Dubai?',
            'subtext' => 'Take the 30-Second Dubai Property Quiz and instantly get matched with the best projects in Dubai — tailored to your budget, goals, and lifestyle. Perfect for investors and end users alike.',
            'bullets' => [
                ['label' => 'Personalized Matches:', 'text' => 'Find projects tailored to your goals/budget in seconds'],
                ['label' => 'Handpicked Projects:', 'text' => 'Explore the most in-demand Dubai developments'],
                ['label' => 'Smart Investment Insights:', 'text' => 'See which projects offer the best returns and growth.'],
                ['label' => 'Free Guidebook:', 'text' => 'Access market insights, top launches, and expert tips.'],
            ],
            'button_text' => 'Find my dream homes', 'button_link' => '/ai-villa-assessment',
            'button2_text' => 'It takes only 30 seconds', 'button2_link' => '/ai-villa-assessment', 'button2_style' => 'dark',
            'note_title' => 'Take the 30-Second Quiz Now',
            'note' => 'Find your ideal property in Dubai — and unlock your personalized results plus the Dubai Investment Guidebook instantly.',
        ]);
    }

    private function seedAbout(): void
    {
        $this->section('about_hero', 'About — Hero', 'hero', [
            'image' => 'images/house-white.jpg', 'image_alt' => 'Modern white villa with pool',
            'breadcrumb' => 'HOME > ABOUT US',
            'heading_html' => 'Most agents sell.<br>We <span class="font-script font-normal text-6xl md:text-8xl inline-block ml-1">advise.</span>',
            'subtext' => 'Lux Villa Dubai is a specialist advisory for villas and townhouses across Dubai and Abu Dhabi. We publish the numbers — prices, yields, full buying costs — before we ever pitch a home, and we stay involved from the first search to long after handover.',
        ]);
        $this->section('about_stats', 'About — Stats strip', 'stats_strip', [
            'items' => [
                ['value' => '02', 'label' => 'Emirates Covered'],
                ['value' => '06', 'label' => 'Core Communities'],
                ['value' => '4–6%', 'label' => 'Typical Gross Yields'],
                ['value' => '100%', 'label' => 'Costs Shown Up Front'],
            ],
        ]);
        $this->section('about_how', 'About — How we work', 'how_we_work', [
            'eyebrow' => 'How we work',
            'heading_html' => 'One partner, from first<br>viewing to every year after',
            'subtext' => "Whether you're buying your first villa, selling a family home, or caring for a property you own, we handle the details end to end.",
            'items' => [
                [
                    'number' => '01', 'title' => 'Buy', 'badge' => '• Golden Visa eligible from AED 2M',
                    'bullets' => ['Shortlists built around your goals and budget', 'Side-by-side cost and yield comparisons', 'Negotiation and transfer handled end to end'],
                    'link_text' => 'Start your search →', 'link' => '/villas-for-sale'
                ],
                [
                    'number' => '02', 'title' => 'Sell', 'badge' => '• Dubai & Abu Dhabi buyers',
                    'bullets' => ['Pricing backed by community evidence', 'Professional presentation of your home', 'Access to qualified buyers across both emirates'],
                    'link_text' => 'Get a valuation →', 'link' => '/enquiry'
                ],
                [
                    'number' => '03', 'title' => 'Maintain', 'badge' => '• Annual villa care plan',
                    'bullets' => ['AC, plumbing and electrical servicing', 'Pool and garden upkeep', 'Protects your property\'s value and its tenants'],
                    'link_text' => 'Explore care plans →', 'link' => '/enquiry'
                ],
            ],
        ]);
    }

    private function seedVillas(): void
    {
        $this->section('villas_rows', 'Villas — Listing results', 'listing_rows', [
            'breadcrumb' => 'Home > Villas for Sale in Dubai',
            'heading_html' => 'Villas for Sale in Dubai · <span class="script">14,913 Ads</span>',
            'chips' => ['The Valley by Emaar (34)', 'Mohammed Bin Rashid City (88)', 'Arabian Ranches (52)', 'Dubai Hills Estate (61)'],
            'filters' => [
                ['label' => 'All Categories', 'options' => ['All Categories', 'Villas', 'Townhouses']],
                ['label' => 'Property Type', 'options' => ['Property Type', 'Villa', 'Townhouse']],
                ['label' => 'Beds', 'options' => ['Beds', '3+', '4+', '5+']],
                ['label' => 'Price', 'options' => ['Price', 'Under AED 2M', 'AED 2M–5M', 'AED 5M+']],
                ['label' => 'Payment Plan', 'options' => ['Payment Plan', 'Cash', 'Mortgage', 'Payment Plan']],
            ],
            'search_placeholder' => 'Search by community, area or keyword',
            'button_text' => 'Search',
            'items' => [
                ['image' => 'images/villa-modern.jpg', 'title' => 'The Fairway Villa', 'meta' => 'Villa · Arabian Ranches', 'price' => 'AED 4,000,000', 'specs' => '4/5 Beds · 5/6 Bath · 4,800 sqft', 'link' => '/listing/the-valley-prime-location'],
                ['image' => 'images/house-facade.jpg', 'title' => 'Maple Row Villa', 'meta' => 'Villa · Dubai Hills Estate', 'price' => 'AED 4,000,000', 'specs' => '4/5 Beds · 5/6 Bath · 4,800 sqft', 'link' => '/listing/the-valley-prime-location'],
                ['image' => 'images/townhouse.jpg', 'title' => 'Nara Townhouse', 'meta' => 'Villa · The Valley', 'price' => 'AED 4,000,000', 'specs' => '4/5 Beds · 5/6 Bath · 4,800 sqft', 'link' => '/listing/the-valley-prime-location'],
                ['image' => 'images/villa-pool.jpg', 'title' => 'Palm View Villa', 'meta' => 'Villa · DAMAC Lagoons', 'price' => 'AED 4,000,000', 'specs' => '4/5 Beds · 5/6 Bath · 4,800 sqft', 'link' => '/listing/the-valley-prime-location'],
                ['image' => 'images/house-exterior.jpg', 'title' => 'Garden Court Villa', 'meta' => 'Villa · Mohammed Bin Rashid City', 'price' => 'AED 4,000,000', 'specs' => '4/5 Beds · 5/6 Bath · 4,800 sqft', 'link' => '/listing/the-valley-prime-location'],
            ],
            'sidebar' => [
                ['kind' => 'mortgage', 'title' => 'Need a mortgage?', 'text' => 'Estimate your monthly payment in a few seconds.', 'button_text' => 'Open Calculator →', 'link' => '/projects/golf-vale-emaar-south'],
                ['kind' => 'ad', 'image' => 'images/dubai-towers.jpg', 'eyebrow' => 'THE WILDS', 'title' => 'A Community Designed with Mother Nature', 'text' => '1–3 BR Apartments & 3 BR Duplexes, Starting from AED 1.85M, 5% Down Payment, 25 Mins from Downtown Dubai.', 'link_text' => 'DISCOVER MORE →'],
                ['kind' => 'valuation', 'title' => "What's your property worth today?", 'image' => 'images/villa-sunset.jpg', 'button_text' => 'Get a Valuation →', 'link' => '/enquiry'],
                ['kind' => 'transactions', 'title' => 'Recent Sale Transactions', 'rows' => [['The Valley Villa', 'AED 4.0M'], ['Arabian Ranches Villa', 'AED 7.9M'], ['Dubai Hills Townhouse', 'AED 2.15M']]],
                ['kind' => 'alerts', 'title' => 'GET EMAIL ALERTS', 'text' => 'New villas matching your search, in your inbox.', 'placeholder' => 'Your email address', 'button_text' => 'Subscribe'],
                ['kind' => 'projects', 'title' => 'View New Projects in Dubai', 'image' => 'images/dubai-marina.jpg', 'name' => 'One by Binghatti', 'link_text' => 'View Project →', 'link' => '/projects'],
                ['kind' => 'sell', 'title' => 'Looking to sell or rent your home?', 'text' => 'Get a free valuation and an honest plan to sell.', 'button_text' => 'Get a Valuation →', 'link' => '/enquiry'],
            ],
        ]);
    }

    private function seedListing(): void
    {
        $this->section('listing_detail', 'Listing — The Valley detail', 'listing_detail', [
            'gallery' => ['images/dubai-marina.jpg', 'images/villa-pool.jpg', 'images/dubai-towers.jpg'],
            'gallery_alts' => ['Waterfront towers and marina with a boat', 'Modern villa with pool', 'Tower with park'],
            'price' => 'AED 2,740,000',
            'heading_html' => 'The Valley | Prime Location | <span class="script">District Deal</span>',
            'subtext' => '4 Bedroom Villa for Sale in The Valley',
            'overview_heading' => 'Overview',
            'overview_text' => "A bright, modern 4-bedroom villa in The Valley, set on a quiet street with a private garden, covered parking and easy access to the community's parks, schools and retail. Ready to move in, with a practical layout across two floors and plenty of natural light.",
            'button_text' => 'Read Full Description',
            'amenities_heading' => 'Amenities & Facilities',
            'amenities' => ['Swimming Pool', 'Covered Parking', "Maid's Room", 'Garden', 'Children Play Area', 'Schools Nearby', 'Fitness Centre', 'Walking Trails'],
            'location_heading' => 'Property Location',
            'location_text' => 'Nice, Damac Lagoons',
            'location_image' => 'images/dubai-skyline.jpg',
            'location_image_alt' => 'Map of Damac Lagoons, Dubai',
            'button2_text' => 'View on Map', 'button2_link' => '#',
            'trend_heading' => '4 bedroom townhouse price trend in Nice (Dubai, DAMAC Lagoons)',
            'trend_text' => 'Prices have gone down by <strong class="text-red-600">-1.42% (MOM)</strong>',
            'trend_bars' => [40, 55, 35, 70, 60, 85],
            'trend_stats' => [
                ['value' => '+10%', 'label' => 'Average price, year to November'],
                ['value' => 'AED 2.6M', 'label' => 'Peak average price (October)'],
                ['value' => '44', 'label' => 'Properties sold across six months'],
            ],
            'similar_heading' => 'Similar Project',
            'similar' => [
                ['image' => 'images/villa-night.jpg', 'title' => 'Golf Fields by Emaar', 'price' => 'AED 100,000,000', 'link' => '/projects/golf-vale-emaar-south'],
                ['image' => 'images/house-exterior.jpg', 'title' => 'Golf Vale Emaar South', 'price' => 'AED 1,099,888', 'link' => '/projects/golf-vale-emaar-south'],
            ],
            'agent_name' => 'Faraz Shafi', 'agent_role' => 'Property Advisor', 'agent_image' => 'images/agent.jpg',
            'mortgage_title' => 'Need a mortgage?', 'mortgage_text' => 'Estimate your monthly payment in a few seconds.',
            'mortgage_button_text' => 'Open Calculator →', 'mortgage_button_link' => '/projects/golf-vale-emaar-south',
        ]);
        // Standalone reusable blocks (for the page builder library)
        $this->section('block_gallery', 'Gallery (reusable)', 'gallery', [
            'images' => ['images/dubai-marina.jpg', 'images/villa-pool.jpg', 'images/dubai-towers.jpg'],
            'alts' => ['Waterfront towers and marina with a boat', 'Modern villa with pool', 'Tower with park'],
        ], false);
        $this->section('block_amenities', 'Amenities chips (reusable)', 'amenities', [
            'heading_html' => 'Amenities &amp; <span class="script">Facilities</span>',
            'amenities' => ['Swimming Pool', 'Covered Parking', "Maid's Room", 'Garden', 'Children Play Area', 'Schools Nearby', 'Fitness Centre', 'Walking Trails'],
        ], false);
        $this->section('block_price_trend', 'Price trend (reusable)', 'price_trend', [
            'heading_html' => '4 bedroom townhouse price trend in Nice (Dubai, DAMAC Lagoons)',
            'trend_text' => 'Prices have gone down by <strong class="text-red-600">-1.42% (MOM)</strong>',
            'trend_bars' => [40, 55, 35, 70, 60, 85],
            'trend_stats' => [
                ['value' => '+10%', 'label' => 'Average price, year to November'],
                ['value' => 'AED 2.6M', 'label' => 'Peak average price (October)'],
                ['value' => '44', 'label' => 'Properties sold across six months'],
            ],
        ], false);
        $this->section('block_overview', 'Overview text (reusable)', 'overview', [
            'heading_html' => 'Overview',
            'subtext' => "A bright, modern 4-bedroom villa in The Valley, set on a quiet street with a private garden, covered parking and easy access to the community's parks, schools and retail. Ready to move in, with a practical layout across two floors and plenty of natural light.",
            'button_text' => 'Read Full Description',
        ], false);
    }

    private function seedProjectDetails(): void
    {
        $this->section('project_header', 'Project — Golf Vale header', 'project_header', [
            'breadcrumb' => 'Home > Off-Plan Projects > EMAAR Properties > Golf Vale Emaar South',
            'heading_html' => 'Golf Vale Emaar South',
            'subtext' => 'EMAAR Properties · Dubai South, Dubai',
        ]);
        $this->section('project_detail', 'Project — Golf Vale detail', 'project_detail', [
            'gallery' => ['images/villa-modern.jpg', 'images/villa-pool.jpg'],
            'gallery_alts' => ['Modern villa exterior at Golf Vale Emaar South', 'Villa pool at Golf Vale Emaar South'],
            'facts' => [
                ['label' => 'Developer', 'value' => 'Emaar'],
                ['label' => 'Starting Price from', 'value' => 'AED 1,099,888'],
                ['label' => 'Available Units', 'value' => '1–4 br'],
                ['label' => 'Handover', 'value' => '2030 Q1'],
            ],
            'about_heading' => 'About this <span class="script">development</span>',
            'about_text' => "Golf Vale by Emaar is a residential development in Emaar South, offering 1, 2 and 3-bedroom apartments alongside a limited collection of 3-bedroom townhouses. Set within the green surroundings of the community's championship golf course, it combines calm, open living with easy access to Dubai's key destinations.",
            'types_heading' => 'Property types',
            'types' => [['title' => 'Townhouse · 4 Beds · 2,799 sq ft', 'price' => 'AED 5,000,000', 'button_text' => 'View Floorplan', 'button2_text' => 'Enquire Now', 'button2_link' => '/enquiry']],
            'similar_heading' => 'Similar Project',
            'similar' => [
                ['image' => 'images/villa-night.jpg', 'title' => 'Golf Fields by Emaar', 'price' => 'AED 100,000,000', 'link' => '/projects'],
                ['image' => 'images/house-facade.jpg', 'title' => 'The Fairway Villa', 'price' => 'AED 18.5M', 'link' => '/listing/the-valley-prime-location'],
            ],
            'mortgage' => [
                'heading' => 'Mortgage Calculator', 'subtext' => 'Estimate your monthly payment in a few seconds.',
                'price' => '45,000,000', 'down_pct' => 30, 'years' => 25, 'rate' => 3.75,
                'monthly' => 'AED 165,550', 'loan' => 'AED 31,500,000', 'down' => 'AED 13,500,000 (30%)',
                'total_line' => 'AED 49,665,000 total over the loan term · AED 35,199,999 / AED 45,465,873',
                'button_text' => 'Get pre-approved', 'button_link' => '/enquiry',
            ],
            'sidebar_title' => 'Get expert advice about Golf Vale Emaar South',
            'sidebar_text' => 'Talk to an off-plan expert.',
            'sidebar_name_placeholder' => 'Full Name',
            'sidebar_phone_placeholder' => 'Phone / WhatsApp (+971…)',
            'sidebar_button_text' => 'Register now',
            'sidebar_similar' => ['image' => 'images/villa-sunset.jpg', 'title' => 'Golf Fields by Emaar', 'price' => 'AED 100,000,000'],
        ]);
        $this->section('block_property_types', 'Property types (reusable)', 'property_types', [
            'heading_html' => 'Property types',
            'types' => [['title' => 'Townhouse · 4 Beds · 2,799 sq ft', 'price' => 'AED 5,000,000', 'button_text' => 'View Floorplan', 'button2_text' => 'Enquire Now', 'button2_link' => '/enquiry']],
        ], false);
        $this->section('block_mortgage', 'Mortgage calculator (reusable)', 'mortgage_calculator', [
            'heading' => 'Mortgage Calculator', 'subtext' => 'Estimate your monthly payment in a few seconds.',
            'price' => '45,000,000', 'down_pct' => 30, 'years' => 25, 'rate' => 3.75,
            'monthly' => 'AED 165,550', 'loan' => 'AED 31,500,000', 'down' => 'AED 13,500,000 (30%)',
            'total_line' => 'AED 49,665,000 total over the loan term · AED 35,199,999 / AED 45,465,873',
            'button_text' => 'Get pre-approved', 'button_link' => '/enquiry',
        ], false);
    }

    private function seedAssessment(): void
    {
        $this->section('assessment_hero', 'AI Assessment — Hero', 'hero', [
            'image' => 'images/dubai-skyline.jpg', 'image_alt' => 'Dubai skyline and Palm',
            'breadcrumb' => 'HOME > AI VILLA ASSESSMENT',
            'heading_html' => 'Find the Right Villa with <span class="script">AI Insights</span>',
            'subtext' => 'Answer a few questions and get a personalised recommendation based on your goals, budget and market data.',
        ]);
        $this->section('assessment_stepper', 'AI Assessment — Quiz stepper', 'stepper_quiz', [
            'labels' => ['Purpose', 'Preferences', 'Budget', 'Timeline', 'Results'],
            'steps' => [
                ['title' => 'Step 1 — What Is Your Main Purpose For Buying?', 'groups' => [
                    ['kind' => 'options', 'options' => [
                        ['title' => 'Investment', 'text' => 'Generate Income Or Capital Growth', 'selected' => true],
                        ['title' => 'Family Home', 'text' => 'For Daily Use'],
                        ['title' => 'Relocation', 'text' => 'Moving To Dubai Or Abu Dhabi'],
                        ['title' => 'Second Home', 'text' => 'Holiday Or Part-Time Use'],
                    ]],
                ], 'next_text' => 'Next →'],
                ['title' => 'Step 2 — Property Preferences', 'groups' => [
                    ['kind' => 'options', 'options' => [
                        ['title' => 'Villa', 'text' => 'More Space, More Privacy', 'selected' => true],
                        ['title' => 'Townhouse', 'text' => 'Lower Price, Strong Rental Demand'],
                    ]],
                    ['kind' => 'select', 'label' => 'Preferred Location', 'options' => ['Any Where In Dubai, Abu Dhabi', 'Dubai', 'Abu Dhabi']],
                    ['kind' => 'chips', 'label' => 'Minimum Bedrooms', 'options' => [
                        ['title' => 'Any'], ['title' => '3+'], ['title' => '4+'], ['title' => '5+', 'selected' => true], ['title' => '6+'],
                    ]],
                ], 'next_text' => 'Next →'],
                ['title' => 'Step 3 — Budget & Financing', 'groups' => [
                    ['kind' => 'options', 'options' => [
                        ['title' => 'Under AED 2M'], ['title' => 'AED 2M–3M'], ['title' => 'AED 3M–5M', 'selected' => true], ['title' => 'AED 5M+'],
                    ]],
                    ['kind' => 'chips', 'label' => 'How Will You Finance The Purchase?', 'options' => [
                        ['title' => 'Cash', 'selected' => true], ['title' => 'Mortgage'], ['title' => 'Payment Plan'],
                    ]],
                ], 'next_text' => 'Next →'],
                ['title' => 'Step 4 — Timeline & Additional Requirements', 'groups' => [
                    ['kind' => 'options', 'cols' => 3, 'options' => [
                        ['title' => 'Within 3 Months'], ['title' => '3–6 Months', 'selected' => true], ['title' => 'Exploring Options'],
                    ]],
                    ['kind' => 'textarea', 'label' => 'Any Specific Requirements?', 'placeholder' => 'Tell us anything else that matters…'],
                ], 'next_text' => 'See My Shortlist →'],
                ['title' => 'Step 5 — Your Personalised Shortlist', 'summary_rows' => [
                    ['Purpose', 'Investment'], ['Property Type', 'Villa'], ['Location', 'The Valley'],
                    ['Bedrooms', '5+'], ['Budget', 'AED 3M–5M'], ['Financing', '—'], ['Timeline', '3–6 Months'],
                ], 'summary_title' => 'No Exact Matches In The Current List',
                'summary_text' => 'No exact match in the current list — talk to an advisor and we will shortlist homes that fit, with the numbers laid out honestly.',
                'summary_button_text' => 'Talk to an Advisor →', 'summary_button_link' => '/enquiry'],
            ],
        ]);
    }

    private function seedEnquiry(): void
    {
        $this->section('enquiry_hero', 'Enquiry — Hero', 'hero', [
            'image' => 'images/villa-pool-dusk.jpg', 'image_alt' => 'Modern villa at dusk',
            'breadcrumb' => 'HOME > VILLA ENQUIRY QUESTIONNAIRE',
            'heading_html' => 'Tell Us What You Are <span class="script">Looking For</span>',
            'subtext' => 'Five short steps — your purpose, preferences, budget and timeline — then receive a personalised shortlist and a callback from an advisor.',
        ]);
        $this->section('enquiry_stepper', 'Enquiry — Questionnaire stepper', 'stepper_quiz', [
            'labels' => ['Purpose & Goals', 'Preferences', 'Budget & Financing', 'Timeline & Requirements', 'Review & Submit'],
            'steps' => [
                ['title' => 'Step 1 — Purpose & Goals', 'groups' => [
                    ['kind' => 'select', 'label' => 'Main Purpose', 'options' => ['Investment', 'Family Home', 'Relocation', 'Second Home']],
                    ['kind' => 'options', 'options' => [
                        ['title' => 'Investment', 'text' => 'Rental Income & Capital Growth', 'selected' => true],
                        ['title' => 'Family Home', 'text' => 'For Daily Use'],
                        ['title' => 'Relocation', 'text' => 'Moving to Dubai Or Abu Dhabi'],
                        ['title' => 'Second Home', 'text' => 'Holiday Or Part-Time Use'],
                    ]],
                ], 'next_text' => 'Next →'],
                ['title' => 'Step 2 — Preferences', 'groups' => [
                    ['kind' => 'options', 'options' => [
                        ['title' => 'Villa', 'text' => 'More Space, More Privacy', 'selected' => true],
                        ['title' => 'Townhouse', 'text' => 'Lower Price, Strong Rental Demand'],
                    ]],
                    ['kind' => 'select', 'label' => 'Preferred Location', 'options' => ['Any Where In Dubai, Abu Dhabi', 'Dubai', 'Abu Dhabi', 'Saadiyat Island']],
                    ['kind' => 'chips', 'label' => 'Minimum Bedrooms', 'options' => [
                        ['title' => 'Any', 'selected' => true], ['title' => '3+'], ['title' => '4+'], ['title' => '5+'], ['title' => '6+'],
                    ]],
                ], 'next_text' => 'Next →'],
                ['title' => 'Step 3 — Budget & Financing', 'groups' => [
                    ['kind' => 'options', 'options' => [
                        ['title' => 'Under AED 2M'], ['title' => 'AED 2M–3M'], ['title' => 'AED 3M–5M', 'selected' => true], ['title' => 'AED 5M+'],
                    ]],
                    ['kind' => 'chips', 'label' => 'How Will You Finance The Purchase?', 'options' => [
                        ['title' => 'Cash'], ['title' => 'Mortgage'], ['title' => 'Payment Plan', 'selected' => true],
                    ]],
                ], 'next_text' => 'Next →'],
                ['title' => 'Step 4 — Timeline & Requirements', 'groups' => [
                    ['kind' => 'options', 'cols' => 3, 'options' => [
                        ['title' => 'Within 3 Months', 'selected' => true], ['title' => '3–6 Months'], ['title' => 'Exploring Options'],
                    ]],
                    ['kind' => 'textarea', 'label' => 'Any Specific Requirements?', 'placeholder' => 'Tell us anything else that matters…'],
                ], 'next_text' => 'Review & Submit →'],
                ['title' => 'Step 5 — Review & Submit', 'summary_rows' => [
                    ['Purpose', 'Relocation'], ['Property Type', 'Villa'], ['Preferred Locations', 'Saadiyat Island'],
                    ['Minimum Bedrooms', 'Any'], ['Budget', 'AED 3M–5M'], ['Financing', 'Payment Plan'], ['Timeline', 'Within 3 Months'],
                ], 'summary_title' => 'No Exact Matches In The Current List',
                'summary_text' => 'Submit your enquiry and an advisor will call you back with a personalised shortlist.',
                'contact_fields' => true, 'contact_name_placeholder' => 'Full Name', 'contact_phone_placeholder' => 'Phone / WhatsApp (+971…)',
                'summary_button_text' => 'Submit Enquiry →', 'summary_button_link' => '#'],
            ],
        ]);
    }

    private function seedBlog(): void
    {
        $this->section('blog_hero', 'Blog — Hero', 'hero', [
            'image' => 'images/dubai-skyline.jpg', 'image_alt' => 'Dubai skyline',
            'breadcrumb' => 'Home > Blog',
            'heading_html' => 'Dubai Property Blog: Buying Guides &amp; <span class="script">Off-Plan Market Insights</span>',
            'subtext' => 'Discover expert guides, off-plan property advice, and investment insights to help you navigate Dubai\'s real estate market with confidence.',
        ]);
        $this->section('blog_articles', 'Blog — Article grid', 'article_grid', [
            'link_text' => 'Read Now →',
            'items' => [
                ['image' => 'images/dubai-skyline.jpg', 'title' => 'Dubai Villa Market 2025: Key Trends and Opportunities', 'badge' => 'Dubai Villa Market', 'meta' => '16 Apr 2025', 'link' => '#'],
                ['image' => 'images/villa-pool-dusk.jpg', 'title' => 'Planning to Buy in Dubai? Essential Costs to Know', 'badge' => 'Buying Guides', 'meta' => '16 Apr 2025', 'link' => '#'],
                ['image' => 'images/dubai-marina.jpg', 'title' => 'Exclusive Off-Plan Property Launches in Dubai 2025', 'badge' => 'Off-Plan Property', 'meta' => '2 Apr 2025', 'link' => '#'],
                ['image' => 'images/house-exterior.jpg', 'title' => 'Dubai Villa Market 2025: Key Trends and Opportunities', 'badge' => 'Dubai Villa Market', 'meta' => '16 Apr 2025', 'link' => '#'],
                ['image' => 'images/interior-lux.jpg', 'title' => 'Planning to Buy in Dubai? Essential Costs to Know', 'badge' => 'Buying Guides', 'meta' => '16 Apr 2025', 'link' => '#'],
                ['image' => 'images/villa-night.jpg', 'title' => 'Exclusive Off-Plan Property Launches in Dubai 2025', 'badge' => 'Off-Plan Property', 'meta' => '2 Apr 2025', 'link' => '#'],
            ],
            'communities_heading_html' => 'Popular <span class="script">Communities</span>',
            'communities' => [
                ['image' => 'images/villa-pool.jpg', 'title' => 'Arabian Ranches', 'link' => '/communities/the-valley'],
                ['image' => 'images/house-white.jpg', 'title' => 'Dubai Hills Estate', 'link' => '/communities/the-valley'],
                ['image' => 'images/villa-night.jpg', 'title' => 'The Valley', 'link' => '/communities/the-valley'],
            ],
            'communities_link_text' => 'Explore More →',
        ]);
    }

    private function seedCommunities(): void
    {
        $this->section('communities_intro', 'Communities — Intro', 'page_intro', [
            'breadcrumb' => 'HOME > COMMUNITIES',
            'heading_html' => 'Helping you to find the right <span class="script">location</span> in Dubai',
            'subtext' => 'Discover the heart and soul of Dubai\'s communities with our expertly curated community guides.',
        ]);
        $this->section('communities_map', 'Communities — Map view', 'map_view', [
            'heading_html' => 'Map <span class="script">View</span>',
            'image' => 'images/dubai-skyline.jpg', 'image_alt' => 'Map of Dubai communities — Fairways Vistas, Dubai Hills Estate',
            'search_placeholder' => 'Search for a community',
            'card_image' => 'images/house-white.jpg', 'card_title' => 'Dubai Hills Estate',
            'card_text' => 'Fairways Vistas, Dubai Hills Estate, Dubai, UAE',
            'card_link_text' => 'View community →', 'card_link' => '/communities/the-valley',
        ]);
        $this->section('communities_grid', 'Communities — Grid', 'communities_grid', [
            'link_text' => 'View all projects →',
            'items' => [
                ['image' => 'images/villa-pool.jpg', 'title' => 'Jumeirah Village Circle', 'meta' => '20 Projects', 'link' => '/communities/the-valley'],
                ['image' => 'images/villa-sunset.jpg', 'title' => 'DubaiLand', 'meta' => '22 Projects', 'link' => '/communities/the-valley'],
                ['image' => 'images/house-white.jpg', 'title' => 'Dubai Hills Estate', 'meta' => '16 Projects', 'link' => '/communities/the-valley'],
                ['image' => 'images/beach.jpg', 'title' => 'Dubai Islands', 'meta' => '18 Projects', 'link' => '/communities/the-valley'],
                ['image' => 'images/dubai-marina.jpg', 'title' => 'Dubai Marina', 'meta' => '24 Projects', 'link' => '/communities/the-valley'],
                ['image' => 'images/pool-hotel.jpg', 'title' => 'Al Marjan Island', 'meta' => '12 Projects', 'link' => '/communities/the-valley'],
            ],
        ]);
    }

    private function seedValley(): void
    {
        $this->section('valley_hero', 'The Valley — Hero + enquiry card', 'hero', [
            'image' => 'images/villa-night.jpg', 'image_alt' => 'Modern villa community in The Valley Dubai',
            'variant' => 'enquiry_card',
            'breadcrumb' => 'HOME > COMMUNITIES',
            'heading_html' => 'The Valley <span class="script">Dubai</span>',
            'subtext' => 'Green open spaces, real amenities and the numbers behind each villa community.',
            'card_title' => 'Enquire about Bahria Town Dubai',
            'card_name_placeholder' => 'Full Name',
            'card_phone_placeholder' => 'Phone / Whatsapp (+971…)',
            'card_options' => ['Interested In (Villa)', 'Villa', 'Townhouse'],
            'card_button_text' => 'Request a Call Back',
        ]);
        $this->section('valley_guide', 'The Valley — Community guide tabs', 'community_guide', [
            'tabs' => [
                ['key' => 'overview', 'label' => 'Overview'],
                ['key' => 'lifestyle', 'label' => 'Lifestyle'],
                ['key' => 'amenities', 'label' => 'Amenities'],
                ['key' => 'communities', 'label' => 'Communities'],
                ['key' => 'project', 'label' => 'Project'],
            ],
            'panels' => [
                'overview' => ['kind' => 'guide', 'image' => 'images/family-park.jpg', 'image_alt' => 'Family walking in a green park in The Valley', 'heading_html' => 'The Valley <span class="script">Community Guide</span>', 'text' => 'The Valley is a green, family-first community by Emaar — parks, trails, schools and townhouses and villas set around open space. It suits families who want room to grow, and investors who want strong rental demand at an accessible price point.'],
                'lifestyle' => ['kind' => 'text', 'heading_html' => 'Lifestyle in <span class="script">The Valley</span>', 'text' => 'Morning walks on green trails, weekend picnics in the park, and a town centre with cafés, retail and everyday essentials — all within the community.'],
                'amenities' => ['kind' => 'chips', 'heading_html' => 'Amenities &amp; <span class="script">Facilities</span>', 'chips' => ['Children Play Area', 'Schools', 'Restaurants', 'Shopping Malls', 'Sports Facilities', 'Fitness Centre', 'Parking Area', 'Walking Trails']],
                'communities' => ['kind' => 'text', 'heading_html' => 'Nearby <span class="script">Communities</span>', 'text' => 'Dubai Hills Estate, Arabian Ranches and DAMAC Lagoons are all within easy reach of The Valley.'],
                'project' => ['kind' => 'cta', 'heading_html' => 'Projects in <span class="script">The Valley</span>', 'text' => 'See villas and townhouses for sale in The Valley, starting from AED 2,740,000.', 'button_text' => 'Browse Villas →', 'button_link' => '/villas-for-sale'],
            ],
            'amenities_heading_html' => 'Amenities &amp; <span class="script">Facilities</span>',
            'amenities' => ['Children Play Area', 'Schools', 'Restaurants', 'Shopping Malls', 'Sports Facilities', 'Fitness Centre', 'Parking Area', 'Walking Trails'],
        ]);
    }

    private function seedProjects(): void
    {
        $this->section('projects_intro', 'Projects — Intro', 'page_intro', [
            'breadcrumb' => 'HOME > PROJECT',
            'heading_html' => 'Buy your villa<br>with <span class="script">confidence.</span>',
        ]);
        $this->section('projects_listings', 'Projects — Search + listings', 'listings', [
            'search_fields' => [
                ['label' => 'Location', 'kind' => 'text', 'placeholder' => 'Location'],
                ['label' => 'Property Type', 'kind' => 'select', 'options' => ['Villas & Townhouses', 'Villas', 'Townhouses']],
                ['label' => 'Budget', 'kind' => 'select', 'options' => ['Any budget', 'Under AED 2M', 'AED 2M–5M', 'AED 5M+']],
            ],
            'button_text' => 'Search', 'button_link' => '/projects',
            'count_text' => '126 Properties Found',
            'tabs' => [
                ['key' => 'buy', 'label' => 'Buy'],
                ['key' => 'rent', 'label' => 'Rent'],
                ['key' => 'offplan', 'label' => 'Off-plan'],
            ],
            'panels' => [
                'buy' => [
                    ['image' => 'images/villa-modern.jpg', 'title' => 'The Fairway Villa', 'price' => 'AED 18.2M', 'meta' => '5 Beds · 6 Bath · 7,200 sqft', 'link' => '/listing/the-valley-prime-location', 'buttons' => ['View Details', 'Save']],
                    ['image' => 'images/house-facade.jpg', 'title' => 'Maple Row Villa', 'price' => 'AED 7.9M', 'meta' => '4 Beds · 5 Bath · 4,800 sqft', 'link' => '/listing/the-valley-prime-location', 'buttons' => ['View Details', 'Save']],
                    ['image' => 'images/townhouse.jpg', 'title' => 'Nara Townhouse', 'price' => 'AED 2.15M', 'meta' => '3 Beds · 4 Bath · 2,600 sqft', 'link' => '/listing/the-valley-prime-location', 'buttons' => ['View Details', 'Save']],
                    ['image' => 'images/villa-pool.jpg', 'title' => 'The Fairway Villa', 'price' => 'AED 18.2M', 'meta' => '5 Beds · 6 Bath · 7,200 sqft', 'link' => '/listing/the-valley-prime-location', 'buttons' => ['View Details', 'Save']],
                    ['image' => 'images/house-exterior.jpg', 'title' => 'Maple Row Villa', 'price' => 'AED 7.9M', 'meta' => '4 Beds · 5 Bath · 4,800 sqft', 'link' => '/listing/the-valley-prime-location', 'buttons' => ['View Details', 'Save']],
                    ['image' => 'images/villa-night.jpg', 'title' => 'Nara Townhouse', 'price' => 'AED 2.15M', 'meta' => '3 Beds · 4 Bath · 2,600 sqft', 'link' => '/listing/the-valley-prime-location', 'buttons' => ['View Details', 'Save']],
                ],
                'rent' => ['kind' => 'text', 'text' => 'Rental villas and townhouses are listed on request — talk to an advisor for current availability.', 'button_text' => 'Ask an Advisor →', 'button_link' => '/enquiry'],
                'offplan' => ['kind' => 'cards', 'cards' => [
                    ['image' => 'images/villa-modern.jpg', 'title' => 'Golf Vale Emaar South', 'price' => 'AED 1,099,888', 'meta' => 'Emaar · Dubai South · Handover 2030 Q1', 'link' => '/projects/golf-vale-emaar-south'],
                    ['image' => 'images/villa-night.jpg', 'title' => 'Golf Fields by Emaar', 'price' => 'AED 100,000,000', 'meta' => '', 'link' => '/projects/golf-vale-emaar-south'],
                ]],
            ],
        ]);
        $this->section('projects_offplan_text', 'Projects — Offplan text', 'text_block', [
            'heading_html' => 'Offplan Villa <span class="script">For Sale</span>',
            'subtext' => 'Discover premium apartments for sale in Dubai, UAE. Explore luxury residences, stunning waterfront homes, and affordable investment opportunities in prime locations with strong rental yields and long-term ROI potential.',
        ]);
        $this->section('projects_promo', 'Projects — Promo band', 'promo_band', [
            'image' => 'images/dubai-skyline.jpg', 'image_alt' => 'Aerial view of a Dubai community',
            'eyebrow' => 'VILLAS · TOWNHOUSE · APARTMENTS',
            'heading_html' => 'Luxury Living in the Heart of Dubai',
            'subtext' => 'BOOK YOUR DREAM HOME · EMAAR',
            'button_text' => 'Book Your Dream Home →', 'button_link' => '/enquiry',
        ]);
    }

    private function seedPages(): void
    {
        $pages = [
            ['title' => 'Lux Home Page', 'slug' => 'home', 'path' => '', 'seo_title' => 'Lux Villa Dubai — Find Your Ideal Home in Dubai', 'sections' => ['home_hero', 'home_search', 'home_explore', 'home_journey', 'home_numbers', 'home_communities', 'home_report', 'home_listings', 'global_advisor', 'home_insights', 'home_testimonials', 'home_quiz', 'global_seo', 'faq_default', 'global_register']],
            ['title' => 'Lux About US', 'slug' => 'about', 'path' => 'about', 'seo_title' => 'About Us — Lux Villa Dubai', 'sections' => ['about_hero', 'about_stats', 'about_how', 'global_advisor', 'global_seo', 'faq_about', 'global_register']],
            ['title' => 'Lux Villa for selling', 'slug' => 'villas-for-sale', 'path' => 'villas-for-sale', 'seo_title' => 'Villas for Sale in Dubai — Lux Villa Dubai', 'sections' => ['villas_rows', 'global_seo', 'faq_default', 'global_register']],
            ['title' => 'Buy Listing Details', 'slug' => 'listing-the-valley-prime-location', 'path' => 'listing/the-valley-prime-location', 'seo_title' => 'The Valley | Prime Location | District Deal — Lux Villa Dubai', 'sections' => ['listing_detail', 'global_seo', 'faq_default', 'global_register']],
            ['title' => 'Lux Project Details page', 'slug' => 'project-golf-vale-emaar-south', 'path' => 'projects/golf-vale-emaar-south', 'seo_title' => 'Golf Vale Emaar South — Lux Villa Dubai', 'sections' => ['project_header', 'project_detail', 'global_seo', 'faq_default', 'global_register']],
            ['title' => 'AI Villa Assessment', 'slug' => 'ai-villa-assessment', 'path' => 'ai-villa-assessment', 'seo_title' => 'AI Villa Assessment — Lux Villa Dubai', 'sections' => ['assessment_hero', 'assessment_stepper', 'global_seo', 'faq_default', 'global_register']],
            ['title' => 'Enquiry', 'slug' => 'enquiry', 'path' => 'enquiry', 'seo_title' => 'Villa Enquiry — Lux Villa Dubai', 'sections' => ['enquiry_hero', 'enquiry_stepper', 'global_seo', 'faq_default', 'global_register']],
            ['title' => 'Blog', 'slug' => 'blog', 'path' => 'blog', 'seo_title' => 'Dubai Property Blog — Lux Villa Dubai', 'sections' => ['blog_hero', 'blog_articles', 'global_seo', 'faq_default', 'global_register']],
            ['title' => 'Communities Main page', 'slug' => 'communities', 'path' => 'communities', 'seo_title' => 'Communities in Dubai — Lux Villa Dubai', 'sections' => ['communities_intro', 'communities_map', 'communities_grid', 'global_seo', 'faq_default', 'global_register']],
            ['title' => 'Communities inner page', 'slug' => 'communities-the-valley', 'path' => 'communities/the-valley', 'seo_title' => 'The Valley Dubai — Lux Villa Dubai', 'sections' => ['valley_hero', 'valley_guide', 'global_seo', 'faq_default', 'global_register']],
            ['title' => 'Project', 'slug' => 'projects', 'path' => 'projects', 'seo_title' => 'Projects — Buy Your Villa With Confidence — Lux Villa Dubai', 'sections' => ['projects_intro', 'projects_listings', 'projects_offplan_text', 'projects_promo', 'global_seo', 'faq_default', 'global_register']],
            // Demo dynamic page (created in admin during CMS verification): proves any
            // page can be built by calling existing global sections, in any order.
            ['title' => 'Test CMS Page', 'slug' => 'test-cms-page', 'path' => 'test-cms-page', 'seo_title' => 'Test CMS Page', 'sections' => ['home_hero', 'global_advisor', 'faq_default']],
        ];
        foreach ($pages as $p) {
            $page = Page::updateOrCreate(['slug' => $p['slug']], [
                'title' => $p['title'], 'path' => $p['path'], 'status' => 'published',
                'seo_title' => $p['seo_title'], 'seo_description' => '',
            ]);
            $page->sections()->detach();
            foreach ($p['sections'] as $i => $key) {
                $section = Section::where('key', $key)->firstOrFail();
                $page->sections()->attach($section->id, ['sort_order' => $i]);
            }
        }
    }
}
