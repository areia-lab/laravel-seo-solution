<?php

namespace AreiaLab\LaravelSeoSolution\Http\Controllers;

use AreiaLab\LaravelSeoSolution\Models\SeoMeta;
use AreiaLab\LaravelSeoSolution\Http\Requests\SeoMetaRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $query = SeoMeta::query();

        if ($request->has('type') && in_array($request->type, ['global', 'page', 'model'])) {
            $query->where('type', $request->type);
        }

        // Paginate results
        $items = $query->orderBy('updated_at', 'desc')->paginate(15)->withQueryString();

        return view('areia.seo.admin.index', compact('items'));
    }

    public function create()
    {
        return view('areia.seo.admin.form', ['seo' => new SeoMeta()]);
    }

    public function store(SeoMetaRequest $request)
    {
        $data = $this->handleUploads($request->validated());
        if (($data['type'] ?? null) === 'global') {
            SeoMeta::where('type', 'global')->delete();
        }
        SeoMeta::create($data);
        return redirect()->route('seo.index')->with('success', 'SEO record created.');
    }

    public function edit(SeoMeta $seo)
    {
        return view('areia.seo.admin.form', compact('seo'));
    }

    public function update(SeoMetaRequest $request, SeoMeta $seo)
    {
        $data = $this->handleUploads($request->validated(), $seo);
        if (($data['type'] ?? null) === 'global') {
            SeoMeta::where('type', 'global')->where('id', '!=', $seo->id)->delete();
        }
        $seo->update($data);
        return redirect()->route('seo.index')->with('success', 'SEO record updated.');
    }

    public function destroy(SeoMeta $seo)
    {
        $seo->delete();
        return redirect()->route('seo.index')->with('success', 'SEO record deleted.');
    }

    protected function handleUploads(array $data, ?SeoMeta $existing = null): array
    {
        $disk = config('seo.disk', 'public');

        foreach (['og_image', 'twitter_image'] as $field) {
            if (request()->hasFile($field)) {
                $path = request()->file($field)->store('seo', $disk);
                $data[$field] = Storage::disk($disk)->url($path);
            } else {
                if ($existing && !empty($existing->{$field})) {
                    $data[$field] = $existing->{$field};
                }
            }
        }

        return $data;
    }
}
