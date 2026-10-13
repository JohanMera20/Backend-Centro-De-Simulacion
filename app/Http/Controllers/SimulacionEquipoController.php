<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimulacionEquipo;

class SimulacionEquipoController extends Controller
{
    public function index()
    {
        $result = SimulacionEquipo::with(['simulacion', 'equipo'])->get();
        return response()->json($result);
    }

    public function store(Request $request)
    {
        $request->validate([
            'simulacion_id' => 'required|exists:simulacions,id',
            'equipo_id' => 'required|exists:equipos,id',
        ]);

        $result = SimulacionEquipo::create($request->all());

        return response()->json($result);
    }

    public function show(int $id)
    {
        $result = SimulacionEquipo::with(['simulacion', 'equipo'])->included()->findOrFail($id);
        return response()->json($result);
    }

    public function update(Request $request, SimulacionEquipo $simulacionEquipo)
    {
        $request->validate([
            'simulacion_id' => 'required|exists:simulacions,id',
            'equipo_id' => 'required|exists:equipos,id',
        ]);

        $simulacionEquipo->update($request->all());

        return response()->json($simulacionEquipo);
    }

    public function destroy(SimulacionEquipo $simulacionEquipo)
    {
        $simulacionEquipo->delete();
        return response()->json($simulacionEquipo);
    }
}