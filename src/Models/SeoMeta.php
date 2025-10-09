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

        'schema_code',

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

    /**
     * Mutator to normalize page attribute when storing.
     * Removes leading/trailing slashes except for home page '/'.
     */
    public function setPageAttribute(?string $value)
    {
        if ($value === '/') {
            $this->attributes['page'] = '/';
        } else {
            $this->attributes['page'] = $value ? trim($value, '/') : null;
        }
    }
}
