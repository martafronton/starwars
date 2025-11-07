<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase; // 👈 importante, no el TestCase de Laravel
use App\Models\Mantenimiento;

class MantenimientoTest extends TestCase
{
    /** @test */
    public function calcula_coste_total()
    {

        $mantenimiento = new Mantenimiento([
            'fecha_inicio' => '2025-01-01',
            'fecha_fin' => '2025-01-04',
        ]);


        $coste = $mantenimiento->calcularCosteTotal();

        $this->assertEquals(300, $coste);
    }
}

