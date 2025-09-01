<?php

namespace AreiaLab\LaravelSeoSolution\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    protected $fillable = [
        'type',
        'page',
        'title',
        'description',
        'keywords',
        'meta_robots',
        'meta_author',
        'canonical',

        'og_title',
        'og_description',
        'og_image',
        'og_type',

        'twitter_title',
        'twitter_description',
        'twitter_image',
        'twitter_card',

        'seoable_type',
        'seoable_id',
    ];

    protected $casts = [
        'keywords' => 'array',
        'seoable_id' => 'integer',
    ];

    public function seoable()
    {
        return $this->morphTo();
    }
}
