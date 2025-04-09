<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\LaporanHasilStudi;
use Illuminate\Http\Request;

class LaporanHasilStudiController extends Controller
{
    public function create(Surat $surat)
    {
        return view('laporan_hasil_studi.create', compact('surat'));
    }

    public function store(Request $request, Surat $surat)
    {
        $request->validate([
            'nrp' => 'required|string',
            'nama' => 'required|string',
            'program_studi' => 'required|string',
            'semester' => 'required|string',
            'ip_semester' => 'required|numeric|between:0,4.00',
            'ipk' => 'required|numeric|between:0,4.00',
            'jumlah_sks' => 'required|integer|min:0',
        ]);

        LaporanHasilStudi::create([
            'surat_id' => $surat->id,
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'program_studi' => $request->program_studi,
            'semester' => $request->semester,
            'ip_semester' => $request->ip_semester,
            'ipk' => $request->ipk,
            'jumlah_sks' => $request->jumlah_sks,
        ]);

        return redirect()->route('surat.index')->with('success', 'Laporan hasil studi berhasil disimpan.');
    }
}
