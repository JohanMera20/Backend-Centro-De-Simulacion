<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimulacionInsumo;

class SimulacionInsumoController extends Controller
{
    public function index()
    {
        $result = SimulacionInsumo::with(['simulacion', 'insumo'])->get();
        return response()->json($result);
    }

    public function store(Request $request)
    {
        $request->validate([
            'simulacion_id' => 'required|exists:simulacions,id',
            'insumo_id' => 'required|exists:insumos,id',
        ]);

        $result = SimulacionInsumo::create($request->all());

        return response()->json($result);
    }

    public function show(int $id)
    {
        $result = SimulacionInsumo::with(['simulacion', 'insumo'])->included()->findOrFail($id);
        return response()->json($result);
    }

    public function update(Request $request, SimulacionInsumo $simulacionInsumo)
    {
        $request->validate([
            'simulacion_id' => 'required|exists:simulacions,id',
            'insumo_id' => 'required|exists:insumos,id',
        ]);

        $simulacionInsumo->update($request->all());

        return response()->json($simulacionInsumo);
    }

    public function destroy(SimulacionInsumo $simulacionInsumo)
    {
        $simulacionInsumo->delete();
        return response()->json($simulacionInsumo);
    }
}