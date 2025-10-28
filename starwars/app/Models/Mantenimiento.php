<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = ['nave_id', 'fecha', 'descripcion', 'coste'];

    public function nave()
    {
        return $this->belongsTo(Nave::class);
    }
}

