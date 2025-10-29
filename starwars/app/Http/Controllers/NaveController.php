<?php

namespace App\Http\Controllers;

use App\Models\Nave;
use Illuminate\Http\Request;

class NaveController extends Controller
{
    public function mostrar_naves()
    {
        return Nave::all();
    }

    public function crear_nave(Request $request)
    {
        $nave = Nave::create($request->all());
        return response()->json($nave, 201);
    }

    public function mostrar_nave($id)
    {
        return Nave::with('planeta', 'pilotos', 'mantenimientos')->findOrFail($id);
    }

    public function modificar(Request $request, $id)
    {
        $nave = Nave::findOrFail($id);
        $nave->update($request->all());
        return response()->json($nave);
    }

    public function eliminar($id)
    {
        Nave::destroy($id);
        return response()->json(['mensaje' => 'Nave eliminada']);
    }
}
