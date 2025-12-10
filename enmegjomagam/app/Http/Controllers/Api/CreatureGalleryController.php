<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryImageRequest;
use App\Models\Galeriakep;
use App\Models\Leny;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class CreatureGalleryController extends Controller
{
    public function index(string $id): JsonResponse
    {
        $leny = Leny::findOrFail($id);
        $galeriakepek = $leny->galeriakepek;

        return response()->json($galeriakepek);
    }

    public function store(StoreGalleryImageRequest $request, string $id): JsonResponse
    {
        $leny = Leny::findOrFail($id);

        $path = $request->file('kep')->store('galeriakepek', 'public');

        $galeriakep = Galeriakep::create([
            'leny_id' => $leny->id,
            'kep_url' => $path,
            'leiras' => $request->leiras,
        ]);

        return response()->json($galeriakep, 201);
    }
}
