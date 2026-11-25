<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'path', 'status', 'seo_title', 'seo_description'];

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'page_section')
            ->withPivot('sort_order')
            ->withTimestamps()
            ->orderBy('page_section.sort_order');
    }

    /** Public URL of the page. */
    public function url(): string
    {
        return $this->path === '' ? '/' : '/'.ltrim($this->path, '/');
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }
}
