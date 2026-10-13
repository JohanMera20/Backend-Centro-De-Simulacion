<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simulacion;

class SimulacionController extends Controller
{
     public function index()
    {
      $simulacions=Simulacion::with(['servicio','ambiente','reportes','equipos','insumos'])->get();
      return response()->json($simulacions);

    }

   public function store(Request $request)
{
   $request->validate([
    'nombre' => 'required|string|max:255',
    'descripcion' => 'required|string',
    'servicio_id' => 'required|exists:servicios,id',
    'ambiente_id' => 'required|exists:ambientes,id',
]);

    $simulacion = Simulacion::create($request->all());

        return response()->json($simulacion);
    }

    public function show(int $id)
    {

         $simulacion = Simulacion::with(['servicio','ambiente','reportes','equipos','insumos'])->included()->findOrFail($id);
         return response()->json($simulacion);
    }

    public function update(Request $request, Simulacion $simulacion)
    { 
    $request->validate([
    'nombre' => 'required|string|max:255',
    'descripcion' => 'required|string',
    'servicio_id' => 'required|exists:servicios,id',
    'ambiente_id' => 'required|exists:ambientes,id',
]);


        $simulacion->update($request->all());

        return response()->json($simulacion);
    }

    public function destroy(Simulacion $simulacion)
    {
        $simulacion->delete();
        return response()->json($simulacion);
    }
}
