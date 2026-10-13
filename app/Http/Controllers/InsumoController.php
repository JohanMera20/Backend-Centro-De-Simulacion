<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insumo;

class InsumoController extends Controller
{
    public function index()
    {
        $insumos = Insumo::with(['ambiente', 'simulaciones'])->get();
        return response()->json($insumos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
            'ambiente_id' => 'required|exists:ambientes,id',
        ]);

        $insumo = Insumo::create($request->all());

        return response()->json($insumo);
    }

    public function show(int $id)
    {
        $insumo = Insumo::with(['ambiente', 'simulaciones'])->included()->findOrFail($id);
        return response()->json($insumo);
    }

    public function update(Request $request, Insumo $insumo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
            'ambiente_id' => 'required|exists:ambientes,id',
        ]);

        $insumo->update($request->all());

        return response()->json($insumo);
    }

    public function destroy(Insumo $insumo)
    {
        $insumo->delete();
        return response()->json($insumo);
    }
}