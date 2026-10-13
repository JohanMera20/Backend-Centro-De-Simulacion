<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usser;
use Illuminate\Validation\Rule;

class UsserController extends Controller
{
     public function index()
    {
        $ussers = Usser::with(['role', 'reportes'])->get();

        return response()->json($ussers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'documento' => 'required|string|max:255|unique:ussers,documento',
            'correo' => 'required|string|max:255|unique:ussers,correo',
            'telefono' => 'required|string|max:255',
            'usuario' => 'required|string|max:255|unique:ussers,usuario',
            'password' => 'required|string',

            'estado' => 'required|in:Activo,Inactivo',

            'role_id' => 'required|exists:roles,id',

            'especialidad' => 'nullable|string|max:255',
            'profesion' => 'nullable|string|max:255',
            'experiencia' => 'nullable|integer',

            'ficha' => 'nullable|string|max:255',
            'programa' => 'nullable|string|max:255',
            'trimestre' => 'nullable|integer',
        ]);

        $usser = Usser::create($request->all());

        return response()->json($usser);
    }

    public function show(int $id)
    {
        $usser = Usser::with(['role', 'reportes'])
            ->included()
            ->findOrFail($id);

        return response()->json($usser);
    }

    public function updateRole(Request $request, Usser $usser)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $usser->update(['role_id' => $request->role_id]);

        return response()->json($usser->load('role'));
    }

    public function update(Request $request, Usser $usser)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',

            'documento' => [
                'required',
                'string',
                'max:255',
                Rule::unique('ussers', 'documento')->ignore($usser->id),
            ],

            'correo' => [
                'required',
                'string',
                'max:255',
                Rule::unique('ussers', 'correo')->ignore($usser->id),
            ],

            'telefono' => 'required|string|max:255',

            'usuario' => [
                'required',
                'string',
                'max:255',
                Rule::unique('ussers', 'usuario')->ignore($usser->id),
            ],

            'password' => 'required|string',

            'estado' => 'required|in:Activo,Inactivo',

            'role_id' => 'required|exists:roles,id',

            'especialidad' => 'nullable|string|max:255',
            'profesion' => 'nullable|string|max:255',
            'experiencia' => 'nullable|integer',

            'ficha' => 'nullable|string|max:255',
            'programa' => 'nullable|string|max:255',
            'trimestre' => 'nullable|integer',
        ]);

        $usser->update($request->all());

        return response()->json($usser);
    }

    public function destroy(Usser $usser)
    {
        $usser->delete();

        return response()->json($usser);
    }
}
