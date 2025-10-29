<?php

namespace App\Http\Controllers;

use App\Models\Planeta;
use Illuminate\Http\Request;

class PlanetaController extends Controller
{
    public function mostrar_planetas()
    {
        return Planeta::get();
    }

    public function crear_planeta(Request $request)
    {
        $planeta = Planeta::create($request->all());
        return response()->json($planeta, 201);
    }

    public function mostrar_planeta($id)
    {
        return Planeta::findOrFail($id);
    }

    public function modificar(Request $request, $id)
    {
        $planeta = Planeta::findOrFail($id);
        $planeta->update($request->all());
        return response()->json($planeta);
    }

    public function eliminar($id)
    {
        Planeta::destroy($id);
        return response()->json(['mensaje' => 'Planeta eliminado']);
    }
}

