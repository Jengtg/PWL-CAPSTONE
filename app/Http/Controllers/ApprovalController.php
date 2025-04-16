<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\Approval;

class ApprovalController extends Controller
{
    // List surat yang menunggu approval Kaprodi
// App\Http\Controllers\ApprovalController.php
public function index()
{
    $user = Auth::user();

    // Eager loading relationships
    $surats = Surat::with(['mahasiswa', 'jenis', 'status'])
                    ->whereHas('mahasiswa', function ($query) use ($user) {
                        $query->where('prodi_id', $user->prodi_id);
                    })
                    ->where('status_id', 1) // Status 1 = Menunggu
                    ->get();

    return view('users.prodi.index', compact('surats'));
}


    // Disetujui langsung oleh Kaprodi
    public function approve($id, Request $request)
    {
        $surat = Surat::findOrFail($id);
        $surat->status_id = 2; // 2 = Disetujui
        $surat->save();

        Approval::create([
            'surat_id' => $surat->id,
            'approved_by' => Auth::id(),
            'status_id' => 2,
            'comment' => $request->comment
        ]);

        return redirect()->back()->with('success', 'Surat berhasil disetujui.');
    }

    // Ditolak langsung oleh Kaprodi
    public function reject($id, Request $request)
    {
        $surat = Surat::findOrFail($id);
        $surat->status_id = 3; // 3 = Ditolak
        $surat->save();

        Approval::create([
            'surat_id' => $surat->id,
            'approved_by' => Auth::id(),
            'status_id' => 3,
            'comment' => $request->comment
        ]);

        return redirect()->back()->with('success', 'Surat berhasil ditolak.');
    }

    // Approval oleh Kaprodi atau TU via form
    public function store(Request $request)
    {
        $request->validate([
            'surat_id' => 'required|exists:surat,id',
            'status_id' => 'required|exists:statuses,id',
            'comment' => 'nullable|string'
        ]);

        // Simpan approval
        Approval::create([
            'surat_id' => $request->surat_id,
            'approved_by' => Auth::id(),
            'status_id' => $request->status_id,
            'comment' => $request->comment
        ]);

        // Update status surat-nya
        $surat = Surat::findOrFail($request->surat_id);
        $surat->status_id = $request->status_id;
        $surat->save();

        return redirect()->back()->with('success', 'Approval berhasil disimpan.');
    }
}
