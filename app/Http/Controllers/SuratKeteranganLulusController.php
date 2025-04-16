<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganLulus;
use Illuminate\Http\Request;

class SuratKeteranganLulusController extends Controller
{
    public function index()
    {
        return response()->json(SuratKeteranganLulus::with('surat')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'surat_id' => 'required|exists:surat,id',
            'nrp' => 'required',
            'nama' => 'required',
            'program_studi' => 'required',
            'tanggal_lulus' => 'required|date',
            'ipk' => 'required|numeric',
            'gelar' => 'required',
        ]);

        $created = SuratKeteranganLulus::create($data);
        return response()->json($created, 201);
    }

    public function show($id)
    {
        return response()->json(SuratKeteranganLulus::with('surat')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $surat = SuratKeteranganLulus::findOrFail($id);
        $surat->update($request->all());
        return response()->json($surat);
    }

    public function destroy($id)
    {
        SuratKeteranganLulus::destroy($id);
        return response()->json(null, 204);
    }
}
