<?php

namespace App\Http\Controllers;

use App\Models\SuratPengantarTugas;
use Illuminate\Http\Request;

class SuratPengantarTugasController extends Controller
{
    public function index()
    {
        return response()->json(SuratPengantarTugas::with('surat')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'surat_id' => 'required|exists:surat,id',
            'nrp' => 'required',
            'nama' => 'required',
            'program_studi' => 'required',
            'mata_kuliah' => 'required',
            'dosen_pengampu' => 'required',
            'instansi_tujuan' => 'required',
            'alamat_instansi' => 'required',
            'tanggal_kegiatan' => 'required|date',
        ]);

        $created = SuratPengantarTugas::create($data);
        return response()->json($created, 201);
    }

    public function show($id)
    {
        return response()->json(SuratPengantarTugas::with('surat')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $surat = SuratPengantarTugas::findOrFail($id);
        $surat->update($request->all());
        return response()->json($surat);
    }

    public function destroy($id)
    {
        SuratPengantarTugas::destroy($id);
        return response()->json(null, 204);
    }
}
