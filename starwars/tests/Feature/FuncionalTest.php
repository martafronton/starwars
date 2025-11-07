<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Nave;
use App\Models\Piloto;
use App\Models\Mantenimiento;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FuncionalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function registrar_nave()
    {
        $nave = Nave::factory()->create([
            'nombre' => 'NaveMarta'
        ]);

        $this->assertDatabaseHas('naves', ['nombre' => 'NaveMarta']);
    }

    /** @test */
    public function borrar_piloto()
    {
        $piloto = Piloto::factory()->create();

        $piloto->delete();

        $this->assertDatabaseMissing('pilotos', ['id' => $piloto->id]);
    }

    /** @test */
    public function modificar_mantenimiento()
    {
        $mantenimiento = Mantenimiento::factory()->create(['coste' => 300]);

        $mantenimiento->update(['coste' => 500]);

        $this->assertDatabaseHas('mantenimientos', ['id' => $mantenimiento->id, 'coste' => 500]);
    }
}
