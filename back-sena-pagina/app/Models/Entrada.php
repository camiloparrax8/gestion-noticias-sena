<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;
    public function autor()
    {
        return $this->belongsTo(Autor::class, 'id_autor');
    }
}
