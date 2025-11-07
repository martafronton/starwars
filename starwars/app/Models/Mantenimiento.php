<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Carbon\Carbon;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = ['nave_id', 'fecha_inicio', 'fecha_fin', 'descripcion', 'coste'];

    public function nave()
    {
        return $this->belongsTo(Nave::class);
    }


    public function diasMantenimiento(): int
    {
        if (!$this->fecha_inicio || !$this->fecha_fin) {
            return 0;
        }

        return Carbon::parse($this->fecha_inicio)->diffInDays(Carbon::parse($this->fecha_fin));
    }


    public function calcularCosteTotal(): float
    {
        return $this->diasMantenimiento() * 100;
    }
}


