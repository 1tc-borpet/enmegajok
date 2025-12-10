<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachAbilityRequest;
use App\Models\Leny;
use Illuminate\Http\JsonResponse;

class CreatureAbilityController extends Controller
{
    public function attach(AttachAbilityRequest $request, string $id): JsonResponse
    {
        $leny = Leny::findOrFail($id);
        
        $leny->kepessegek()->attach($request->kepesseg_id);
        
        $leny->load('kepessegek');

        return response()->json([
            'message' => 'Ability attached successfully',
            'leny' => $leny,
        ]);
    }

    public function detach(string $id, string $abilityId): JsonResponse
    {
        $leny = Leny::findOrFail($id);
        
        $leny->kepessegek()->detach($abilityId);
        
        $leny->load('kepessegek');

        return response()->json([
            'message' => 'Ability detached successfully',
            'leny' => $leny,
        ]);
    }
}
