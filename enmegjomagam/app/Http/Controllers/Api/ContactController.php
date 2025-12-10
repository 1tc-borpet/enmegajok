<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\KapcsolatiUzenet;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request): JsonResponse
    {
        $uzenet = KapcsolatiUzenet::create($request->validated());

        return response()->json([
            'message' => 'Contact message sent successfully',
            'data' => $uzenet,
        ], 201);
    }
}
