<?php

namespace AreiaLab\LaravelSeoSolution\Database\Seeders;

use Illuminate\Database\Seeder;
use AreiaLab\LaravelSeoSolution\Models\SeoMeta;

class SeoMetaSeeder extends Seeder
{
    public function run(): void
    {
        SeoMeta::where('type', 'global')->delete();

        SeoMeta::create([
            'type' => 'global',
            'title' => 'Welcome to My Site',
            'description' => 'This is the default SEO description for my website.',
            'keywords' => 'laravel, seo, package, areia-lab',
            'meta_robots' => 'index, follow',
            'meta_author' => 'AreiaLab',
            'seoable_id' => null,
            'seoable_type' => null,

            'og_title' => 'Welcome to My Site',
            'og_description' => 'This is the OpenGraph description for social sharing.',
            'og_image' => '/images/default-og.jpg',

            'twitter_title' => 'Welcome to My Site',
            'twitter_description' => 'This is the Twitter card description.',
            'twitter_image' => '/images/default-twitter.jpg',

        ]);
    }
}
