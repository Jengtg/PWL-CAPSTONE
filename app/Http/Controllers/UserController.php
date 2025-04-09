<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // Hanya Master Admin yang boleh akses controller ini
        $this->middleware('cekRole:Master Admin');
    }

    public function index()
    {
        $users = User::with(['role', 'programStudi'])->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $prodis = ProgramStudi::all();
        return view('users.create', compact('roles', 'prodis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|max:7|unique:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'prodi_id' => 'nullable|exists:program_studi,id',
        ]);

        // Jika role bukan Master Admin, prodi_id wajib diisi
        $role = Role::find($validated['role_id']);
        if ($role->name !== 'Master Admin' && !$validated['prodi_id']) {
            return back()->withErrors(['prodi_id' => 'Program Studi wajib diisi untuk peran selain Master Admin']);
        }

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $prodis = ProgramStudi::all();
        return view('users.edit', compact('user', 'roles', 'prodis'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id,id",
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'prodi_id' => 'nullable|exists:program_studi,id',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        // Jika bukan master admin, wajib punya prodi
        $role = Role::find($validated['role_id']);
        if ($role->name !== 'Master Admin' && !$validated['prodi_id']) {
            return back()->withErrors(['prodi_id' => 'Program Studi wajib diisi untuk peran selain Master Admin']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
