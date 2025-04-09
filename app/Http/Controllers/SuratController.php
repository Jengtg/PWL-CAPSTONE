<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\SuratKeteranganAktif;
use App\Models\SuratPengantarTugas;
use App\Models\SuratKeteranganLulus;
use App\Models\LaporanHasilStudi;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function index()
    {
        return response()->json(Surat::where('user_id', Auth::id())->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|string|max:255',
        ]);

        $surat = Surat::create([
            'user_id' => Auth::id(),
            'jenis_surat' => $request->jenis_surat,
            'status_id' => 1, // Default: Menunggu Persetujuan
        ]);

        return response()->json(['message' => 'Surat berhasil diajukan', 'surat' => $surat], 201);
    }

    public function show($id)
    {
        return response()->json(Surat::findOrFail($id));
    }
}

class SuratKeteranganAktifController extends Controller
{
    public function index() {
        return response()->json(SuratKeteranganAktif::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'surat_id' => 'required|exists:surat,id',
            'nrp' => 'required',
            'nama' => 'required',
            'program_studi' => 'required',
            'fakultas' => 'required',
            'semester' => 'required',
            'tahun_akademik' => 'required',
        ]);

        return response()->json(SuratKeteranganAktif::create($data), 201);
    }

    public function show($id) {
        return response()->json(SuratKeteranganAktif::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $surat = SuratKeteranganAktif::findOrFail($id);
        $surat->update($request->all());
        return response()->json($surat);
    }

    public function destroy($id) {
        SuratKeteranganAktif::destroy($id);
        return response()->json(null, 204);
    }
}

class SuratPengantarTugasController extends Controller
{
    public function index() {
        return response()->json(SuratPengantarTugas::all());
    }

    public function store(Request $request) {
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

        return response()->json(SuratPengantarTugas::create($data), 201);
    }

    public function show($id) {
        return response()->json(SuratPengantarTugas::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $surat = SuratPengantarTugas::findOrFail($id);
        $surat->update($request->all());
        return response()->json($surat);
    }

    public function destroy($id) {
        SuratPengantarTugas::destroy($id);
        return response()->json(null, 204);
    }
}

class SuratKeteranganLulusController extends Controller
{
    public function index() {
        return response()->json(SuratKeteranganLulus::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'surat_id' => 'required|exists:surat,id',
            'nrp' => 'required',
            'nama' => 'required',
            'program_studi' => 'required',
            'tanggal_lulus' => 'required|date',
            'ipk' => 'required|numeric',
            'gelar' => 'required',
        ]);

        return response()->json(SuratKeteranganLulus::create($data), 201);
    }

    public function show($id) {
        return response()->json(SuratKeteranganLulus::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $surat = SuratKeteranganLulus::findOrFail($id);
        $surat->update($request->all());
        return response()->json($surat);
    }

    public function destroy($id) {
        SuratKeteranganLulus::destroy($id);
        return response()->json(null, 204);
    }
}

class LaporanHasilStudiController extends Controller
{
    public function index() {
        return response()->json(LaporanHasilStudi::all());
    }

    public function store(Request $request) {
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

        return response()->json(LaporanHasilStudi::create($data), 201);
    }

    public function show($id) {
        return response()->json(LaporanHasilStudi::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $surat = LaporanHasilStudi::findOrFail($id);
        $surat->update($request->all());
        return response()->json($surat);
    }

    public function destroy($id) {
        LaporanHasilStudi::destroy($id);
        return response()->json(null, 204);
    }
}
