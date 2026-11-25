<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
    protected $fillable = ['key', 'name', 'type', 'content', 'is_global', 'status'];

    protected $casts = [
        'content' => 'array',
        'is_global' => 'boolean',
    ];

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'page_section')
            ->withPivot('sort_order')
            ->withTimestamps()
            ->orderBy('page_section.sort_order');
    }

    /** Content as array, always. */
    public function c(): array
    {
        return is_array($this->content) ? $this->content : [];
    }

    /** One content field with fallback. */
    public function field(string $key, mixed $default = ''): mixed
    {
        return $this->c()[$key] ?? $default;
    }

    public static function types(): array
    {
        return [
            'hero' => 'Hero (image + heading + button)',
            'search_filter' => 'Search / filter card',
            'cards_3col' => 'Cards — 3 columns',
            'text_image' => 'Text + image (journey / report / quiz CTA)',
            'numbers_3col' => 'Numbers — 3 columns with icons',
            'communities_grid' => 'Communities grid',
            'listings' => 'Listings with tabs',
            'blog_cards' => 'Blog / insight cards',
            'article_grid' => 'Article grid (blog)',
            'testimonials' => 'Testimonials',
            'advisor_band' => 'Advisor band (dark green)',
            'seo_text' => 'SEO text block',
            'faq' => 'FAQ accordion',
            'register_interest' => 'Register Your Interest band',
            'stats_strip' => 'Stats strip (dark)',
            'how_we_work' => 'How we work — numbered steps',
            'listing_rows' => 'Listing search results + sidebar',
            'listing_detail' => 'Listing detail (gallery, overview, trend)',
            'gallery' => 'Photo gallery',
            'overview' => 'Overview text block',
            'amenities' => 'Amenities chips',
            'price_trend' => 'Price trend chart + stats',
            'property_types' => 'Property types',
            'project_header' => 'Project header band (tan)',
            'project_detail' => 'Project detail (gallery, facts, calculator)',
            'mortgage_calculator' => 'Mortgage calculator',
            'stepper_quiz' => 'Multi-step quiz / enquiry stepper',
            'map_view' => 'Map view + community cards',
            'community_guide' => 'Community guide tabs',
            'promo_band' => 'Promo band (image + heading)',
            'page_intro' => 'Page intro (breadcrumb + heading)',
            'text_block' => 'Text block (heading + paragraph)',
        ];
    }
}
