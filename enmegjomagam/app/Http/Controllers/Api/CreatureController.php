<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCreatureRequest;
use App\Http\Requests\UpdateCreatureRequest;
use App\Models\Leny;
use Illuminate\Http\JsonResponse;

class CreatureController extends Controller
{
    public function index(): JsonResponse
    {
        $lenyek = Leny::with(['kategoria', 'kepessegek'])->get();
        
        return response()->json($lenyek);
    }

    public function show(string $id): JsonResponse
    {
        $leny = Leny::with(['kategoria', 'kepessegek', 'galeriakepek', 'user'])->findOrFail($id);
        
        return response()->json($leny);
    }

    public function store(StoreCreatureRequest $request): JsonResponse
    {
        $leny = Leny::create([
            'nev' => $request->nev,
            'leiras' => $request->leiras,
            'kategoria_id' => $request->kategoria_id,
            'user_id' => auth()->id(),
        ]);

        $leny->load(['kategoria', 'kepessegek']);

        return response()->json($leny, 201);
    }

    public function update(UpdateCreatureRequest $request, string $id): JsonResponse
    {
        $leny = Leny::findOrFail($id);
        
        $leny->update($request->validated());
        
        $leny->load(['kategoria', 'kepessegek']);

        return response()->json($leny);
    }

    public function destroy(string $id): JsonResponse
    {
        $leny = Leny::findOrFail($id);
        $leny->delete();

        return response()->json([
            'message' => 'Leny deleted successfully',
        ]);
    }
}
