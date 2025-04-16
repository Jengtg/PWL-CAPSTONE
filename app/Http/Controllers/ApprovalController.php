<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'surat_id' => 'required|exists:surat,id', // Pastikan surat id ada
            'status' => 'required|in:approved,rejected', // Status hanya boleh approved atau rejected
            'comment' => 'nullable|string', // Komentar opsional
        ]);

        // Membuat data approval baru
        $approval = Approval::create([
            'surat_id' => $request->surat_id,
            'approved_by' => Auth::id(), // Gunakan Auth::id() untuk mendapatkan ID user yang login
            'status' => $request->status,
            'comment' => $request->comment,
        ]);

        // Mengupdate status surat
        $surat = Surat::findOrFail($request->surat_id);
        $surat->status_id = ($request->status == 'approved') ? 2 : 3; // 2: Disetujui, 3: Ditolak
        $surat->save();

        // Mengembalikan response JSON atau bisa dengan redirect
        return redirect()->route('kaprodi.surat.index')->with('success', 'Approval berhasil disimpan');
    }
}
