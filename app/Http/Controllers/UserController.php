<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        return response()->json(User::all());
    }

    // Menampilkan detail user tertentu
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
}
