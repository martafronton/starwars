<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function mostrar_mantenimientos()
    {
        return Mantenimiento::all();
    }

    public function guardar_mantenimiento(Request $request)
    {
            $mantenimiento = new Mantenimiento();
            $mantenimiento->descripcion = $request->descripcion;
            $mantenimiento->coste = $request->coste;
            $mantenimiento->nave_id = $request->nave_id;
            $mantenimiento->fecha = $request->fecha ?? now(); // si no la mandan, se pone la actual
            $mantenimiento->save();

        return response()->json($mantenimiento, 201);
    }

    public function mostrar_mantenimiento($id)
    {
        return Mantenimiento::with('nave')->findOrFail($id);
    }

    public function modificar(Request $request, $id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->update($request->all());
        return response()->json($mantenimiento);
    }

    public function eliminar($id)
    {
        Mantenimiento::destroy($id);
        return response()->json(['mensaje' => 'Mantenimiento eliminado']);
    }

    public function mantenimientoFechas(Request $request)
    {
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;

        return Mantenimiento::whereBetween('fecha', [$inicio, $fin])->with('nave')->get();
    }
}
