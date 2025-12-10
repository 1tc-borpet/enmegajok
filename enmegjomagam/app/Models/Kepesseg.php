<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kepesseg extends Model
{
    protected $table = 'kepessegek';
    
    protected $fillable = ['nev', 'leiras'];
    
    public function lenyek(): BelongsToMany
    {
        return $this->belongsToMany(Leny::class, 'leny_kepesseg');
    }
}
