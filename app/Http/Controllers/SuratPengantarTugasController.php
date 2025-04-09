<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\SuratPengantarTugas;
use Illuminate\Http\Request;

class SuratPengantarTugasController extends Controller
{
    public function create(Surat $surat)
    {
        return view('surat_pengantar_tugas.create', compact('surat'));
    }

    public function store(Request $request, Surat $surat)
    {
        $request->validate([
            'nrp' => 'required|string',
            'nama' => 'required|string',
            'program_studi' => 'required|string',
            'mata_kuliah' => 'required|string',
            'dosen_pengampu' => 'required|string',
            'instansi_tujuan' => 'required|string',
            'alamat_instansi' => 'required|string',
        ]);

        SuratPengantarTugas::create([
            'surat_id' => $surat->id,
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'program_studi' => $request->program_studi,
            'mata_kuliah' => $request->mata_kuliah,
            'dosen_pengampu' => $request->dosen_pengampu,
            'instansi_tujuan' => $request->instansi_tujuan,
            'alamat_instansi' => $request->alamat_instansi,
        ]);

        return redirect()->route('surat.index')->with('success', 'Data surat pengantar tugas berhasil disimpan.');
    }
}
