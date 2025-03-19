<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\Surat;

class ApprovalController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'surat_id' => 'required|exists:surat,id',
            'status' => 'required|in:approved,rejected',
            'comment' => 'nullable|string',
        ]);

        $approval = Approval::create([
            'surat_id' => $request->surat_id,
            'approved_by' => auth()->id(),
            'status' => $request->status,
            'comment' => $request->comment,
        ]);

        // Update status surat
        $surat = Surat::find($request->surat_id);
        $surat->status_id = ($request->status == 'approved') ? 2 : 3; // 2: Disetujui, 3: Ditolak
        $surat->save();

        return response()->json(['message' => 'Approval berhasil disimpan', 'approval' => $approval]);
    }
}
