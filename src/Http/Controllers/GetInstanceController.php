<?php

namespace AreiaLab\LaravelSeoSolution\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class GetInstanceController extends Controller
{
    /**
     * Handle the incoming request to fetch model instances
     * that do not yet have an associated SeoMeta record.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $modelClass = $request->string('model')->value();
        $search     = $request->string('q')->value();

        if (!class_exists($modelClass)) {
            return response()->json([]);
        }

        try {
            $instance = new $modelClass;

            if (!method_exists($instance, 'seoMeta')) {
                Log::warning("Model [{$modelClass}] does not have a seoMeta relationship.");
                return response()->json([]);
            }

            $table   = $instance->getTable();
            $columns = collect(['title', 'name'])->filter(
                fn($col) => Schema::hasColumn($table, $col)
            );

            $query = $modelClass::query();

            // Apply search filter
            if ($search && $columns->isNotEmpty()) {
                $query->where(function ($q) use ($search, $columns) {
                    foreach ($columns as $col) {
                        $q->orWhere($col, 'like', "%{$search}%");
                    }
                });
            }

            // Exclude models that already have SeoMeta
            $query->whereDoesntHave('seoMeta', function ($q) use ($modelClass) {
                $q->where('seoable_type', $modelClass);
            });

            // Select only minimal columns for display
            $selectCols = array_merge(['id'], $columns->toArray());
            $results = $query->select($selectCols)->limit(20)->get();

            // Build standardized response
            $response = $results->map(fn($item) => [
                'id'   => $item->id,
                'text' => $item->title ?? $item->name ?? "ID {$item->id}",
            ]);

            return response()->json($response);
        } catch (\Throwable $e) {
            Log::error("SEO Model fetch error [{$modelClass}]: {$e->getMessage()}");
            return response()->json([]);
        }
    }
}
