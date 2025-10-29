<?php

namespace App\Http\Controllers;

use App\Models\Piloto;
use Illuminate\Http\Request;

class PilotoController extends Controller
{
    public function mostrar_pilotos()
    {
        return Piloto::get();
    }

    public function crear_piloto(Request $request)
    {
        $piloto = Piloto::create($request->all());
        return response()->json($piloto, 201);
    }

    public function mostrar_piloto($id)
    {
        return Piloto::findOrFail($id);
    }

    public function modificar(Request $request, $id)
    {
        $piloto = Piloto::findOrFail($id);
        $piloto->update($request->all());
        return response()->json($piloto);
    }

    public function eliminar($id)
    {
        Piloto::destroy($id);
        return response()->json(['mensaje' => 'Piloto eliminado']);
    }

    public function asignarNave(Request $request)
    {
        $piloto = Piloto::findOrFail($request->piloto_id);
        $piloto->naves()->attach($request->nave_id, [
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);
        return response()->json(['mensaje' => 'Nave asignada al piloto']);
    }

    public function sinNave()
    {
        return Piloto::doesntHave('naves')->get();
    }

    public function conNave()
    {
        return Piloto::has('naves')->get();
    }

    public function asignacionesActuales()
    {
        return Piloto::whereHas('naves', function ($query) {
            $query->whereNull('fecha_fin');
        })->get();
    }
}
