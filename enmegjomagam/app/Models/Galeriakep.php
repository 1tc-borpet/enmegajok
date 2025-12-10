<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeriakep extends Model
{
    protected $table = 'galeriakepek';
    
    protected $fillable = ['leny_id', 'kep_url', 'leiras'];
    
    public function leny(): BelongsTo
    {
        return $this->belongsTo(Leny::class);
    }
}
