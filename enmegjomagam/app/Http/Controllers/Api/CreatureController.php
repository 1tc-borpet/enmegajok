<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCreatureRequest;
use App\Http\Requests\UpdateCreatureRequest;
use App\Http\Resources\CreatureResource;
use App\Models\Leny;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CreatureController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $lenyek = Leny::with(['kategoria', 'kepessegek'])->get();
        
        return CreatureResource::collection($lenyek);
    }

    public function show(string $id): CreatureResource
    {
        $leny = Leny::with(['kategoria', 'kepessegek', 'galeriakepek', 'user'])->findOrFail($id);
        
        return new CreatureResource($leny);
    }

    public function store(StoreCreatureRequest $request): JsonResponse
    {
        $validated = $request->validated();
        
        $data = [
            'nev' => $validated['name'],
            'leiras' => $validated['description'] ?? null,
            'kategoria_id' => $validated['category_id'],
        ];
        
        // Add user_id - use authenticated user or default to first user
        $data['user_id'] = auth()->id() ?? \App\Models\User::first()->id;
        
        $leny = Leny::create($data);

        $leny->load(['kategoria', 'kepessegek']);

        return (new CreatureResource($leny))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateCreatureRequest $request, string $id): CreatureResource
    {
        $leny = Leny::findOrFail($id);
        
        $data = $request->validatedWithDbFields();
        
        $leny->update($data);
        
        // Refresh from database to get updated values
        $leny->refresh();
        $leny->load(['kategoria', 'kepessegek']);

        return new CreatureResource($leny);
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
