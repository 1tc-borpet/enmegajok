<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategoria;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Get all categories
     */
    public function index(): JsonResponse
    {
        $categories = Kategoria::select('id', 'nev as name')
            ->orderBy('nev')
            ->get();

        return response()->json($categories);
    }
}
