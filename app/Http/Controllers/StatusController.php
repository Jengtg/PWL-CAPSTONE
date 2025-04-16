<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    // Method buat mahasiswa lihat status suratnya
    public function index()
    {
        $statuses = Surat::with(['status', 'mahasiswa'])->get();
        return view('users.mahasiswa.status.index', compact('statuses'));

    }
}
