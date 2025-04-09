<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\SuratKeteranganAktif;
use Illuminate\Http\Request;

class SuratKeteranganAktifController extends Controller
{
    public function create(Surat $surat)
    {
        return view('surat_keterangan_aktif.create', compact('surat'));
    }

    public function store(Request $request, Surat $surat)
    {
        $request->validate([
            'nrp' => 'required|string',
            'nama' => 'required|string',
            'program_studi' => 'required|string',
            'fakultas' => 'required|string',
            'semester' => 'required|string',
            'tahun_akademik' => 'required|string',
        ]);

        SuratKeteranganAktif::create([
            'surat_id' => $surat->id,
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'program_studi' => $request->program_studi,
            'fakultas' => $request->fakultas,
            'semester' => $request->semester,
            'tahun_akademik' => $request->tahun_akademik,
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat keterangan aktif berhasil disimpan.');
    }
}
