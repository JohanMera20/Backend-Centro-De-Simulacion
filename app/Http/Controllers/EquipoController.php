<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;


class EquipoController extends Controller
{
     public function index()
    {
      $equipos=Equipo::with(['ambiente','simulaciones'])->get();
      return response()->json($equipos);

    }

   public function store(Request $request)
{
    $request->validate([
    'nombre' => 'required|string|max:255|unique:equipos,nombre',
    'serial' => 'required|string|max:255',
    'ambiente_id' => 'required|exists:ambientes,id',
    ]);

    $equipo = Equipo::create($request->all());

        return response()->json($equipo);
    }

    public function show(int $id)
    {

         $equipo = Equipo::with(['ambiente','simulaciones'])->included()->findOrFail($id);
         return response()->json($equipo);
    }

    public function update(Request $request, Equipo $equipo)
    {
       $request->validate([
        'nombre' => 'required|string|max:255|unique:equipos,nombre,' . $equipo->id,
        'serial' => 'required|string|max:255',
        'ambiente_id' => 'required|exists:ambientes,id',
    ]);

        $equipo->update($request->all());

        return response()->json($equipo);
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();
        return response()->json($equipo);
    }
}
