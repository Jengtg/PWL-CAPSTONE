<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{

    public function index()
    {
        $jenisSurat = JenisSurat::all();
        return view('jenis_surat.index', compact('jenisSurat'));
    }


    public function create()
    {
        return view('jenis_surat.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'template_path' => 'nullable|string',
        ]);

        JenisSurat::create($request->all());

        return redirect()->route('jenis_surat.index')->with('success', 'Jenis Surat created successfully!');
    }


    public function edit(JenisSurat $jenisSurat)
    {
        return view('jenis_surat.edit', compact('jenisSurat'));
    }


    public function update(Request $request, JenisSurat $jenisSurat)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'template_path' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $jenisSurat->update($request->all());

        return redirect()->route('jenis_surat.index')->with('success', 'Jenis Surat updated successfully!');
    }


    public function destroy(JenisSurat $jenisSurat)
    {
        $jenisSurat->delete();

        return redirect()->route('jenis_surat.index')->with('success', 'Jenis Surat deleted successfully!');
    }
}
