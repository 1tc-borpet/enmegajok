<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Leny extends Model
{
    protected $table = 'lenyek';
    
    protected $fillable = ['nev', 'leiras', 'kategoria_id', 'user_id'];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function kategoria(): BelongsTo
    {
        return $this->belongsTo(Kategoria::class);
    }
    
    public function kepessegek(): BelongsToMany
    {
        return $this->belongsToMany(Kepesseg::class, 'leny_kepesseg');
    }
    
    public function galeriakepek(): HasMany
    {
        return $this->hasMany(Galeriakep::class);
    }
}
