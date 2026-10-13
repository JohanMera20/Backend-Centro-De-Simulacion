<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = Reporte::with(['usser', 'simulacion'])->get();
        return response()->json($reportes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'usser_id' => 'required|exists:ussers,id',
            'simulacion_id' => 'required|exists:simulacions,id',
        ]);

        $reporte = Reporte::create($request->all());

        return response()->json($reporte);
    }

    public function show(int $id)
    {
        $reporte = Reporte::with(['usser', 'simulacion'])->included()->findOrFail($id);
        return response()->json($reporte);
    }

    public function update(Request $request, Reporte $reporte)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'usser_id' => 'required|exists:ussers,id',
            'simulacion_id' => 'required|exists:simulacions,id',
        ]);

        $reporte->update($request->all());

        return response()->json($reporte);
    }

    public function destroy(Reporte $reporte)
    {
        $reporte->delete();
        return response()->json($reporte);
    }
}