<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SuratController extends Controller
{
    use HasFactory;
    protected $table = 'surat';

    public function index()
    {
        $user = Auth::user();
        $surat = $user->role->name === 'Mahasiswa'
            ? Surat::where('user_id', $user->id)->with('status')->get()
            : Surat::whereHas('user', fn($query) => $query->where('prodi_id', $user->prodi_id))->with('status')->get();

        return view('surat.index', compact('surat'));
    }

    public function create()
    {
        return view('surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|string|max:255',
        ]);

        Surat::create([
            'user_id' => Auth::id(),
            'jenis_surat' => $request->jenis_surat,
            'status_id' => 1, // default status: diajukan
        ]);

        return redirect()->route('surat.index')->with('success', 'Pengajuan surat berhasil dibuat.');
    }

    public function show(Surat $surat)
    {
        return view('surat.show', compact('surat'));
    }

    public function uploadFile(Request $request, Surat $surat)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($surat->file_path) {
            Storage::delete($surat->file_path); // Hapus file lama jika ada
        }

        $path = $request->file('file')->store('surat');

        $surat->update([
            'file_path' => $path,
            'uploaded_by' => Auth::id(),
            'status_id' => 3, // contoh status: selesai
        ]);

        return redirect()->route('surat.index')->with('success', 'File berhasil diunggah.');
    }

    public function destroy(Surat $surat)
    {
        if ($surat->file_path) {
            Storage::delete($surat->file_path);
        }

        $surat->delete();
        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus.');
    }
}
