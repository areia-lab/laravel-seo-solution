<?php

namespace AreiaLab\LaravelSeoSolution\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class GetInstanceController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $modelClass = $request->get('model');
        $search = $request->get('q');

        if (!class_exists($modelClass)) {
            return response()->json([]);
        }

        try {
            $instance = new $modelClass;
            $table = $instance->getTable();

            // Detect searchable columns
            $columns = collect(['title', 'name'])->filter(fn($col) => Schema::hasColumn($table, $col));

            $query = $modelClass::query();

            // Filter by search term
            if ($search && $columns->isNotEmpty()) {
                $query->where(function ($q) use ($search, $columns) {
                    foreach ($columns as $col) {
                        $q->orWhere($col, 'like', "%{$search}%");
                    }
                });
            }

            // Exclude models that already have SEO data
            $query->whereDoesntHave('seoMeta', function ($q) use ($modelClass) {
                $q->where('seoable_type', $modelClass);
            });

            // Select only relevant columns
            $selectCols = array_merge(['id'], $columns->toArray());
            $results = $query->limit(20)->get($selectCols);

            return response()->json(
                $results->map(fn($item) => [
                    'id' => $item->id,
                    'text' => $item->title ?? $item->name ?? "ID {$item->id}",
                ])
            );
        } catch (\Exception $e) {
            Log::error("SEO Model fetch error: {$e->getMessage()}");
            return response()->json([]);
        }
    }
}
