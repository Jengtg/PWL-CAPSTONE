<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('statuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_status' => 'required|string|max:50|unique:statuses,nama_status',
        ]);

        Status::create($request->only('nama_status'));
        return redirect()->route('statuses.index')->with('success', 'Status berhasil ditambahkan.');
    }

    public function show(Status $status)
    {
        return view('statuses.show', compact('status'));
    }

    public function edit(Status $status)
    {
        return view('statuses.edit', compact('status'));
    }

    public function update(Request $request, Status $status)
    {
        $request->validate([
            'nama_status' => 'required|string|max:50|unique:statuses,nama_status,' . $status->id,
        ]);

        $status->update($request->only('nama_status'));
        return redirect()->route('statuses.index')->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('statuses.index')->with('success', 'Status berhasil dihapus.');
    }
}
