<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganAktif;
use Illuminate\Http\Request;

class SuratKeteranganAktifController extends Controller
{
    public function index()
    {
        return response()->json(SuratKeteranganAktif::with('surat')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'surat_id' => 'required|exists:surat,id',
            'nrp' => 'required|string',
            'nama' => 'required|string',
            'program_studi' => 'required|string',
            'fakultas' => 'required|string',
            'semester' => 'required|string',
            'tahun_akademik' => 'required|string',
        ]);

        $created = SuratKeteranganAktif::create($data);
        return response()->json($created, 201);
    }

    public function show($id)
    {
        return response()->json(SuratKeteranganAktif::with('surat')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $data = SuratKeteranganAktif::findOrFail($id);
        $data->update($request->all());
        return response()->json($data);
    }

    public function destroy($id)
    {
        SuratKeteranganAktif::destroy($id);
        return response()->json(null, 204);
    }
}
