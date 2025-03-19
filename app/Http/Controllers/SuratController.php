<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
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
