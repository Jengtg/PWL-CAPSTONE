<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $programStudi = ProgramStudi::all();
        return view('users.masteradmin.prodi.index', compact('programStudi'));
    }

    public function create()
    {
        return view('users.masteradmin.prodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:program_studi,name',
        ]);

        ProgramStudi::create($request->only('name'));

        return redirect()->route('program-studi.index')->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $programStudi = ProgramStudi::findOrFail($id);
        return view('users.masteradmin.prodi.edit', compact('programStudi'));
    }

    public function update(Request $request, $id)
    {
        $programStudi = ProgramStudi::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:program_studi,name,' . $id,
        ]);

        $programStudi->update($request->only('name'));

        return redirect()->route('program-studi.index')->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        ProgramStudi::destroy($id);
        return redirect()->route('program-studi.index')->with('success', 'Program Studi berhasil dihapus.');
    }
}
