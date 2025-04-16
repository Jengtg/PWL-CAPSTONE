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
<<<<<<< Updated upstream
        return view('users.index', compact('users'));
=======
        return view('users.masteradmin.user.index', compact('users'));
>>>>>>> Stashed changes
    }

    public function create()
    {
        $roles = Role::all();
<<<<<<< Updated upstream
        $prodis = ProgramStudi::all();
        return view('users.create', compact('roles', 'prodis'));
=======
        $programStudi = ProgramStudi::all();
        return view('users.masteradmin.user.create', compact('roles', 'programStudi'));
>>>>>>> Stashed changes
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|unique:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'prodi_id' => 'required|exists:program_studi,id',
        ]);

        User::create([
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'prodi_id' => $request->prodi_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
<<<<<<< Updated upstream
        $prodis = ProgramStudi::all();
        return view('users.edit', compact('user', 'roles', 'prodis'));
=======
        $programStudi = ProgramStudi::all();
        return view('users.masteradmin.user.edit', compact('user', 'roles', 'programStudi'));
>>>>>>> Stashed changes
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'prodi_id' => 'required|exists:program_studi,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role_id' => $request->role_id,
            'prodi_id' => $request->prodi_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}
