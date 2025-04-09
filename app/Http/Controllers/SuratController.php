<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role->name === 'mahasiswa') {
            $surat = Surat::where('user_id', $user->id)->get();
        } else {
            $surat = Surat::whereHas('user', function ($query) use ($user) {
                $query->where('prodi_id', $user->prodi_id);
            })->get();
        }

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
            'status_id' => 1, // default: diajukan
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

        $path = $request->file('file')->store('surat');

        $surat->update([
            'file_path' => $path,
            'uploaded_by' => Auth::id(),
            'status_id' => 3, // misal: selesai
        ]);

        return redirect()->route('surat.index')->with('success', 'File berhasil diunggah.');
    }

    public function destroy(Surat $surat)
    {
        $surat->delete();
        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus.');
    }
}
