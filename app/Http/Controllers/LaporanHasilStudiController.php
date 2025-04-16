<?php

namespace App\Http\Controllers;

use App\Models\LaporanHasilStudi;
use Illuminate\Http\Request;

class LaporanHasilStudiController extends Controller
{
    public function index()
    {
        return response()->json(LaporanHasilStudi::with('surat')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'surat_id' => 'required|exists:surat,id',
            'nrp' => 'required',
            'nama' => 'required',
            'program_studi' => 'required',
            'semester' => 'required',
            'ip_semester' => 'required|numeric',
            'ipk' => 'required|numeric',
            'jumlah_sks' => 'required|numeric',
        ]);

        $created = LaporanHasilStudi::create($data);
        return response()->json($created, 201);
    }

    public function show($id)
    {
        return response()->json(LaporanHasilStudi::with('surat')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $surat = LaporanHasilStudi::findOrFail($id);
        $surat->update($request->all());
        return response()->json($surat);
    }

    public function destroy($id)
    {
        LaporanHasilStudi::destroy($id);
        return response()->json(null, 204);
    }
}
