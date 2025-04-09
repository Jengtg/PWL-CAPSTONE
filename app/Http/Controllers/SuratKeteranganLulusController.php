<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\SuratKeteranganLulus;
use Illuminate\Http\Request;

class SuratKeteranganLulusController extends Controller
{
    public function create(Surat $surat)
    {
        return view('surat_keterangan_lulus.create', compact('surat'));
    }

    public function store(Request $request, Surat $surat)
    {
        $request->validate([
            'nrp' => 'required|string',
            'nama' => 'required|string',
            'program_studi' => 'required|string',
            'tanggal_lulus' => 'required|date',
            'ipk' => 'required|numeric|between:0,4.00',
            'gelar' => 'required|string',
        ]);

        SuratKeteranganLulus::create([
            'surat_id' => $surat->id,
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'program_studi' => $request->program_studi,
            'tanggal_lulus' => $request->tanggal_lulus,
            'ipk' => number_format($request->ipk, 2),
            'gelar' => $request->gelar,
        ]);

        return redirect()->route('surat.index')->with('success', 'Data surat keterangan lulus berhasil disimpan.');
    }
}
