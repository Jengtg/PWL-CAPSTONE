<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenSurat;
use Illuminate\Support\Facades\Storage;

class DokumenSuratController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'surat_id' => 'required|exists:surat,id',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $filePath = $request->file('file')->store('dokumen_surat');

        $dokumen = DokumenSurat::create([
            'surat_id' => $request->surat_id,
            'file_path' => $filePath,
            'uploaded_by' => auth()->id(),
        ]);

        return response()->json(['message' => 'Dokumen berhasil diupload', 'dokumen' => $dokumen]);
    }

    public function download($id)
    {
        $dokumen = DokumenSurat::findOrFail($id);
        return Storage::download($dokumen->file_path);
    }
}
