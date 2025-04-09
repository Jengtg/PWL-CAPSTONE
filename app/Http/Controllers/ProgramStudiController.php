<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $programStudi = ProgramStudi::all();
        return view('program_studi.index', compact('programStudi'));
    }

    public function create()
    {
        return view('program_studi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:program_studi,name',
        ]);

        ProgramStudi::create($request->all());
        return redirect()->route('program-studi.index')->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function show(ProgramStudi $programStudi)
    {
        return view('program_studi.show', compact('programStudi'));
    }

    public function edit(ProgramStudi $programStudi)
    {
        return view('program_studi.edit', compact('programStudi'));
    }

    public function update(Request $request, ProgramStudi $programStudi)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:program_studi,name,' . $programStudi->id,
        ]);

        $programStudi->update($request->all());
        return redirect()->route('program-studi.index')->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function destroy(ProgramStudi $programStudi)
    {
        $programStudi->delete();
        return redirect()->route('program-studi.index')->with('success', 'Program Studi berhasil dihapus.');
    }
}
