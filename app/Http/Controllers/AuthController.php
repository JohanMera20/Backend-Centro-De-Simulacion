<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usser;
use App\Models\Role;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'documento' => 'required|string|max:255|unique:ussers,documento',
            'correo' => 'required|email|max:255|unique:ussers,correo',
            'telefono' => 'nullable|string|max:255',
            'usuario' => 'nullable|string|max:255|unique:ussers,usuario',
            'password' => 'required|string|min:6',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        $role = Role::where('nombre_rol', 'Aprendiz')->first();

        $data = $request->all();
        $data['estado'] = 'Activo';
        $data['role_id'] = $data['role_id'] ?? $role?->id;
        $data['usuario'] = $data['usuario'] ?? explode('@', $data['correo'])[0];
        $data['telefono'] = $data['telefono'] ?? '';

        $usser = Usser::create($data);

        $token = $usser->createToken('sena-app')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'token' => $token,
            'user' => $usser->load('role'),
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required|string',
        ]);

        $usser = Usser::where('correo', $request->correo)->first();

        if (!$usser || !Hash::check($request->password, $usser->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas',
            ], 401);
        }

        if ($usser->estado === 'Inactivo') {
            return response()->json([
                'message' => 'Usuario inactivo',
            ], 403);
        }

        $token = $usser->createToken('sena-app')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'token' => $token,
            'user' => $usser->load('role'),
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user()->load('role'));
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente',
        ]);
    }
}