<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nave extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'modelo', 'tripulacion', 'pasajeros', 'clase_nave', 'planeta_id'];

    public function planeta()
    {
        return $this->belongsTo(Planeta::class);
    }

    public function pilotos()
    {
        return $this->belongsToMany(Piloto::class)
                    ->withPivot('fecha_inicio', 'fecha_fin')
                    ->withTimestamps();
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }
}

