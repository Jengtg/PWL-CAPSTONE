<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'programStudi'])->get();
        return view('users.masteradmin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $programStudi = ProgramStudi::all();
        return view('users.masteradmin.user.create', compact('roles', 'programStudi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:7|unique:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'prodi_id' => 'nullable|exists:program_studi,id',
        ]);

        User::create([
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'prodi_id' => $request->prodi_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $programStudi = ProgramStudi::all();
        return view('users.masteradmin.user.edit', compact('user', 'roles', 'programStudi'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$id},id",
            'role_id' => 'required|exists:roles,id',
            'prodi_id' => 'nullable|exists:program_studi,id',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'prodi_id' => $request->prodi_id,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}