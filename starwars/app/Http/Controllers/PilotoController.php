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
        $piloto->imagen = 'img/perfil.png';
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

    public function desasociarNave(Request $request)
{
    $piloto = Piloto::findOrFail($request->piloto_id);
    $piloto->naves()->detach($request->nave_id);

    return response()->json(['mensaje' => 'Nave desasociada del piloto']);
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


//Sé que en clase no lo hicimos así, pero me salían muchos errores y de esta manera si funcionaba, lo siento
public function subirImagen(Request $request, $pilotoId)
{
    try {
        $file = $request->file('imagen');

        if (!$file) {
            return response()->json(['error' => 'No se recibió ningún archivo'], 400);
        }

        if (!$pilotoId) {
            return response()->json(['error' => 'No se especificó el ID del piloto'], 400);
        }

        $piloto = \App\Models\Piloto::find($pilotoId);

        if (!$piloto) {
            return response()->json(['error' => 'Piloto no encontrado'], 404);
        }

        $config = config('cloudinary');

        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => $config['cloud_name'],
                'api_key'    => $config['api_key'],
                'api_secret' => $config['api_secret'],
            ],
            'url' => [
                'secure' => $config['url']['secure'] ?? true,
            ],
        ]);

        $result = $cloudinary->uploadApi()->upload($file->getRealPath());

        $piloto->imagen = $result['secure_url'];
        $piloto->save();

        return response()->json([
            'message' => 'Imagen subida y guardada correctamente',
            'url' => $piloto->imagen
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Error al subir la imagen',
            'mensaje' => $e->getMessage()
        ]);
    }
}


}
