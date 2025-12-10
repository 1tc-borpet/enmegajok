<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreatureResource extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->nev,
            'description' => $this->leiras,
            'category_id' => $this->kategoria_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => $this->whenLoaded('kategoria', function () {
                return [
                    'id' => $this->kategoria->id,
                    'name' => $this->kategoria->nev,
                    'description' => $this->kategoria->leiras,
                ];
            }),
            'abilities' => $this->whenLoaded('kepessegek', function () {
                return $this->kepessegek->map(function ($kepesseg) {
                    return [
                        'id' => $kepesseg->id,
                        'name' => $kepesseg->nev,
                        'description' => $kepesseg->leiras,
                    ];
                });
            }),
            'gallery' => $this->whenLoaded('galeriakepek', function () {
                return $this->galeriakepek->map(function ($kep) {
                    return [
                        'id' => $kep->id,
                        'file_path' => $kep->fajl_utvonal,
                        'caption' => $kep->kepfelirat,
                    ];
                });
            }),
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                ];
            }),
        ];
    }
}
