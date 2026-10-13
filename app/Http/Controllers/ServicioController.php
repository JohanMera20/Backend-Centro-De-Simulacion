<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    
     public function index()
    {
      $servicios=Servicio::with(['simulaciones'])->get();
      return response()->json($servicios);

    }

   public function store(Request $request)
{
    $request->validate([
    'nombre' => 'required|string|max:255',
    'descripcion' => 'nullable|string|max:255',
]);

    $servicio = Servicio::create($request->all());

        return response()->json($servicio);
    }

    public function show(int $id)
    {

         $servicio = Servicio::with(['simulaciones'])->included()->findOrFail($id);
         return response()->json($servicio);
    }

    public function update(Request $request, Servicio $servicio)
    { 
        $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:255',
    ]);


        $servicio->update($request->all());

        return response()->json($servicio);
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return response()->json($servicio);
    }
}
