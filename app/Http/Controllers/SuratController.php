<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LaporanHasilStudi;
use App\Models\SuratKeteranganAktif;
use App\Models\SuratKeteranganLulus;
use App\Models\SuratPengantarTugas;
use App\Models\JenisSurat;

class SuratController extends Controller
{
    // Ambil semua surat user + filter
    public function index(Request $request)
    {
        $query = Surat::with(['status', 'user'])
                      ->where('user_id', Auth::id());

        if ($request->filled('jenis_surat')) {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id);
        }

        return response()->json([
            'success' => true,
            'data' => $query->latest()->get(),
        ]);
    }


    public function create()
    {
        $jenis_surats = JenisSurat::where('is_active', true)->get();
    
        return view('users.mahasiswa.create', compact('jenis_surats'));
    }


    public function showSuratIsi($id)
    {
        $surat = Surat::with('user')->findOrFail($id);
    
        switch ($surat->jenis_surat) {
            case 'Surat Keterangan Mahasiswa Aktif':
                $data = SuratKeteranganAktif::where('surat_id', $id)->first();
                return view('users.TU.aktif', compact('surat', 'data'));
    
            case 'Surat Pengantar Tugas Mata Kuliah':
                $data = SuratPengantarTugas::where('surat_id', $id)->first();
                return view('users.TU.tugas', compact('surat', 'data'));
    
            case 'Surat Keterangan Lulus':
                $data = SuratKeteranganLulus::where('surat_id', $id)->first();
                return view('users.TU.lulus', compact('surat', 'data'));
    
            case 'Laporan Hasil Studi':
                $data = LaporanHasilStudi::where('surat_id', $id)->first();
                return view('users.TU.studi', compact('surat', 'data'));
    
            default:
                abort(404, 'Jenis surat tidak dikenal.');
        }
    }
    

public function uploadPDF(Request $request, $id)
{
    $request->validate([
        'file' => 'required|mimes:pdf|max:2048',
    ]);

    $surat = Surat::findOrFail($id);

    $filePath = $request->file('file')->store('surat_pdf', 'public');

    $surat->file_path = $filePath;
    $surat->save();

    return redirect()->back()->with('success', 'File PDF berhasil diunggah.');
}


// Form Surat Keterangan Mahasiswa Aktif
public function createAktif()
{
    $user = Auth::user();
    $surat_id = null;

    return view('users.mahasiswa.surat.aktif-create', compact('user', 'surat_id'));
}

// Form Surat Keterangan Lulus
public function createLulus()
{
    $user = Auth::user();
    $surat_id = null;

    return view('users.mahasiswa.surat.lulus-create', compact('user', 'surat_id'));
}

// Form Surat Pengantar Tugas Mata Kuliah
public function createTugas()
{
    $user = Auth::user();
    $surat_id = null;

    return view('users.mahasiswa.surat.tugas-create', compact('user', 'surat_id'));
}

// Form Laporan Hasil Studi
public function createStudi()
{
    $user = Auth::user();
    $surat_id = null;

    return view('users.mahasiswa.surat.studi-create', compact('user', 'surat_id'));
}

public function indexTataUsaha()
{
    $user = Auth::user();

    // Ambil 2 digit awal dari user_id TU (untuk memeriksa prodi)
    $prodiTU = substr($user->id, 0, 2);

    // Ambil semua surat yang disetujui dan prodi cocok
    $surats = Surat::with(['user', 'jenisSurat'])
        ->where('status_id', 2) // Surat yang disetujui
        ->whereHas('user', function ($query) use ($prodiTU) {
            // Menyesuaikan dengan prodi TU berdasarkan ID
            $query->whereRaw('SUBSTRING(id, 3, 2) = ?', [$prodiTU]);
        })
        ->get();

    return view('users.TU.index', compact('surats'));
}



    public function storeAktif(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'nrp' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'tahun_akademik' => 'required|string|max:255',
        ]);

        // Store Surat Keterangan Aktif
        // Store Surat Keterangan Mahasiswa Aktif
        $surat = Surat::create([
            'user_id' => Auth::id(),
            'jenis_surat' => 'Surat Keterangan Mahasiswa Aktif',
            'status_id' => 1,
        ]);


        SuratKeteranganAktif::create([
            'surat_id' => $surat->id,
            'nrp' => $validated['nrp'],
            'nama' => $validated['nama'],
            'program_studi' => $validated['program_studi'],
            'fakultas' => $validated['fakultas'],
            'semester' => $validated['semester'],
            'tahun_akademik' => $validated['tahun_akademik'],
        ]);

        return redirect()->route('surat.create')->with('success', 'Surat Keterangan Aktif berhasil diajukan');
    }

    public function storeLulus(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'nrp' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'tanggal_lulus' => 'required|date',
            'ipk' => 'required|numeric',
            'gelar' => 'required|string|max:255',
        ]);

        // Store Surat Keterangan Lulus
        $surat = Surat::create([
            'user_id' => Auth::id(),
            'jenis_surat' => 'Surat Keterangan Lulus',
            'status_id' => 1,
        ]);

        SuratKeteranganLulus::create([
            'surat_id' => $surat->id,
            'nrp' => $validated['nrp'],
            'nama' => $validated['nama'],
            'program_studi' => $validated['program_studi'],
            'tanggal_lulus' => $validated['tanggal_lulus'],
            'ipk' => $validated['ipk'],
            'gelar' => $validated['gelar'],
        ]);

        return redirect()->route('surat.create')->with('success', 'Surat Keterangan Lulus berhasil diajukan');
    }

    public function storeTugas(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'nrp' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'mata_kuliah' => 'required|string|max:255',
            'dosen_pengampu' => 'required|string|max:255',
            'instansi_tujuan' => 'required|string|max:255',
            'alamat_instansi' => 'required|string',
        ]);

        // Store Surat Pengantar Tugas Mata Kuliah
        $surat = Surat::create([
            'user_id' => Auth::id(),
            'jenis_surat' => 'Surat Pengantar Tugas Mata Kuliah',
            'status_id' => 1,
        ]);


        SuratPengantarTugas::create([
            'surat_id' => $surat->id,
            'nrp' => $validated['nrp'],
            'nama' => $validated['nama'],
            'program_studi' => $validated['program_studi'],
            'mata_kuliah' => $validated['mata_kuliah'],
            'dosen_pengampu' => $validated['dosen_pengampu'],
            'instansi_tujuan' => $validated['instansi_tujuan'],
            'alamat_instansi' => $validated['alamat_instansi'],
        ]);

        return redirect()->route('surat.create')->with('success', 'Surat Pengantar Tugas berhasil diajukan');
    }

    public function storeStudi(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'nrp' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'ip_semester' => 'required|numeric',
            'ipk' => 'required|numeric',
            'jumlah_sks' => 'required|integer',
        ]);

        // Store Laporan Hasil Studi
        $surat = Surat::create([
            'user_id' => Auth::id(),
            'jenis_surat' => 'Laporan Hasil Studi',
            'status_id' => 1,
        ]);


        LaporanHasilStudi::create([
            'surat_id' => $surat->id,
            'nrp' => $validated['nrp'],
            'nama' => $validated['nama'],
            'program_studi' => $validated['program_studi'],
            'semester' => $validated['semester'],
            'ip_semester' => $validated['ip_semester'],
            'ipk' => $validated['ipk'],
            'jumlah_sks' => $validated['jumlah_sks'],
        ]);

        return redirect()->route('surat.create')->with('success', 'Laporan Hasil Studi berhasil diajukan');
    }

    // Simpan pengajuan surat
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_surat' => 'required|string|max:255',
        ]);

        // Jika ada file yang diupload
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('surat_files', 'public');
        }

        $surat = Surat::create([
            'user_id' => Auth::id(),
            'jenis_surat' => $validated['jenis_surat'],
            'status_id' => 1, // default: Menunggu Persetujuan
            'file_path' => $filePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Surat berhasil diajukan',
            'data' => $surat,
        ]);
    }

    // Detail surat tertentu
    public function show($id)
    {
        $surat = Surat::with(['status', 'user'])
                      ->where('user_id', Auth::id()) // biar user lain gak bisa lihat
                      ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $surat,
        ]);
    }

    // Download surat
    public function download($id)
    {
        $surat = Surat::findOrFail($id);

        if ($surat->file_path && file_exists(storage_path('app/public/' . $surat->file_path))) {
            return response()->download(storage_path('app/public/' . $surat->file_path));
        }

        return response()->json([
            'error' => 'File tidak ditemukan.',
        ], 404);
    }
}
