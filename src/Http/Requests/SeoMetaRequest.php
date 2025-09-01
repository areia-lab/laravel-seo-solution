<?php

namespace AreiaLab\LaravelSeoSolution\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoMetaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|in:global,page,model',
            'page' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'keywords' => 'nullable|string',
            'meta_author' => 'nullable|string',
            'meta_robots' => 'nullable|string',
            'canonical' => 'nullable|url',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:4096',
            'og_type' => 'nullable|string|max:255',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string',
            'twitter_image' => 'nullable|image|max:4096',
            'twitter_card' => 'nullable|in:summary,summary_large_image,app,player',
            'seoable_type' => 'nullable|string|max:255',
            'seoable_id' => 'nullable|integer',
        ];
    }
}
