<?php

namespace AreiaLab\LaravelSeoSolution\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class GetInstanceController extends Controller
{
    /**
     * Summary of get model instance
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $modelClass = $request->get('model'); // Example: App\Models\Post
        $search = $request->get('q');

        if (!class_exists($modelClass)) {
            return response()->json([]);
        }

        $query = $modelClass::query();

        if ($search) {
            // Assume model has 'title' or 'name' field for searching
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        }

        $results = $query->limit(20)->get(['id', 'title', 'name']);

        return response()->json(
            $results->map(function ($item) {
                return [
                    'id'   => $item->id,
                    'text' => $item->title ?? $item->name ?? "ID {$item->id}",
                ];
            })
        );
    }
}
