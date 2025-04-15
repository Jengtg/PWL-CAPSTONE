<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProgramStudi;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $programStudi = ProgramStudi::all();
        return view('auth.register', compact('programStudi'));
    }
    

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi inputan, pastikan 'id' (yang nanti akan diisi dengan 'nrp') unik
        $request->validate([
            'id' => ['required', 'string', 'max:7', 'unique:'.User::class], // Validasi 'id' (yang disesuaikan dengan 'nrp')
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'prodi_id' => ['required', 'exists:program_studi,id'],  // Validasi 'prodi_id' yang sesuai dengan id yang ada di tabel 'program_studi'
        ]);
    
        // Membuat user dengan NRP yang dimasukkan manual sebagai 'id'
        $user = User::create([
            'id' => $request->id, // Menggunakan 'id' (yang nanti diinput sebagai NRP)
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 4,  // Sesuaikan role_id dengan role default yang diinginkan
            'prodi_id' => $request->prodi_id,  // Simpan 'prodi_id'
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect(route('dashboard', absolute: false));
    }
    
}
