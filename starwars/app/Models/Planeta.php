<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Planeta extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'periodo_rotacion', 'poblacion', 'clima'];

    public function naves()
    {
        return $this->hasMany(Nave::class);
    }
}
