<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    
     public function index()
    {
      $roles=Role::with(['ussers'])->get();
      return response()->json($roles);

    }

   public function store(Request $request)
{
        $request->validate([
        'nombre_rol' => 'required|string|max:255|unique:roles,nombre_rol',
        'descripcion' => 'nullable|string|max:255',
    ]);

    $role = Role::create($request->all());

        return response()->json($role);
    }

    public function show(int $id)
    {

         $role = Role::with(['ussers'])->included()->findOrFail($id);
         return response()->json($role);
    }

    public function update(Request $request, Role $role)
    { 
        $request->validate([
        'nombre_rol' => 'required|string|max:255|unique:roles,nombre_rol,' . $role->id,
        'descripcion' => 'nullable|string|max:255',
    ]);


        $role->update($request->all());

        return response()->json($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json($role);
    }
}
