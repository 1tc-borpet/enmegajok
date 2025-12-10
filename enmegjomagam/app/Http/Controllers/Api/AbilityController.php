<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kepesseg;
use Illuminate\Http\JsonResponse;

class AbilityController extends Controller
{
    /**
     * Get all abilities
     */
    public function index(): JsonResponse
    {
        $abilities = Kepesseg::select('id', 'nev as name', 'leiras as description')
            ->orderBy('nev')
            ->get();

        return response()->json($abilities);
    }
}
