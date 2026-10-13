<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambiente;


class AmbienteController extends Controller
{
    
    public function index()
    {
      $ambientes=Ambiente::with(['simulacion','equipos','insumos'])->get();
      return response()->json($ambientes);

    }

   public function store(Request $request)
{
    $request->validate([
    'nombre' => 'required|string|max:255|unique:ambientes,nombre',
    'ubicacion' => 'required|string|max:255',
    ]);

    $ambiente = Ambiente::create($request->all());

        return response()->json($ambiente);
    }

    public function show(int $id)
    {

         $ambiente = Ambiente::with(['simulacion','equipos','insumos'])->included()->findOrFail($id);
         return response()->json($ambiente);
    }

    public function update(Request $request, Ambiente $ambiente)
    {
       $request->validate([
        'nombre' => 'required|string|max:255|unique:ambientes,nombre,' . $ambiente->id,
        'ubicacion' => 'required|string|max:255',
    ]);

        $ambiente->update($request->all());

        return response()->json($ambiente);
    }

    public function destroy(Ambiente $ambiente)
    {
        $ambiente->delete();
        return response()->json($ambiente);
    }
}
