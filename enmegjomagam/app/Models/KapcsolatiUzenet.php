<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KapcsolatiUzenet extends Model
{
    protected $table = 'kapcsolati_uzenetek';
    
    protected $fillable = ['nev', 'email', 'uzenet'];
}
