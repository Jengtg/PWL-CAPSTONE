<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Surat;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $approvals = Approval::whereHas('surat.user', function ($query) use ($user) {
            $query->where('prodi_id', $user->prodi_id);
        })->get();

        return view('approval.index', compact('approvals'));
    }

    public function create(Surat $surat)
    {
        $statuses = Status::all();
        return view('approval.create', compact('surat', 'statuses'));
    }

    public function store(Request $request, Surat $surat)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
            'comment' => 'nullable|string',
        ]);

        Approval::create([
            'surat_id' => $surat->id,
            'approved_by' => Auth::id(),
            'status_id' => $request->status_id,
            'comment' => $request->comment,
        ]);

        // Update status surat
        $surat->update(['status_id' => $request->status_id]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil diperiksa.');
    }
}
