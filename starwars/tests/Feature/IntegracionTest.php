<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Nave;
use App\Models\Piloto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IntegracionTest extends TestCase
{
    use RefreshDatabase;

/** @test */
public function crear_piloto_nave()
{
    $piloto = Piloto::factory()->create(['nombre' => 'Marta Fronton']);
    $nave = Nave::factory()->create(['nombre' => 'NaveMarta']);

    $this->assertDatabaseHas('pilotos', ['nombre' => 'Marta Fronton']);
    $this->assertDatabaseHas('naves', ['nombre' => 'NaveMarta']);
}



//No funciona por los token
/** @test */
public function asignar_piloto_nave()
{
    $piloto = Piloto::factory()->create();
    $nave = Nave::factory()->create();

    $nave->piloto_id = $piloto->id;
    $nave->save();

    $this->assertEquals($piloto->id, $nave->piloto_id);
}


}
