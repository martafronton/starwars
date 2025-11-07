<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;


class UsuarioController extends Controller
{
    function add_user(Request $request) {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password =($request->input('password'));
        $user->save();

        return response()->json(['mensaje' => 'Usuario creado'], 201);
    }

    public function cambiarRol(Request $request, $id)
{
    $usuario = \App\Models\User::find($id);

    if (!$usuario) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    $rol = $request->rol;
    if (!in_array($rol, ['admin', 'gestor', 'piloto'])) {
        return response()->json(['error' => 'Rol no válido'], 400);
    }

    $usuario->rol = $rol;
    $usuario->save();

    return response()->json([
        'message' => 'Rol actualizado correctamente',
        'usuario' => $usuario
    ]);
}
public function mostrarUsuarios()
{
    $usuarios = User::all();
    return response()->json(['usuarios' => $usuarios]);
}



}
