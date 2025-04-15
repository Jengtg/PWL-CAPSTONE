<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'string', 'max:7'],  // Validasi ID (NRP)
            'password' => ['required', 'string'],
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Cari user berdasarkan ID (NRP)
        $user = User::where('id', $request->id)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Jika tidak ada user atau password tidak cocok
            return back()->withErrors([
                'id' => 'The provided credentials are incorrect.',
            ]);
        }
    
        // Login user
        Auth::login($user);
    
        // Regenerasi session untuk keamanan
        $request->session()->regenerate();
    
        // Redirect berdasarkan role
        switch ($user->role->name) {
            case 'Master Admin':
                return redirect()->route('admin.dashboard');
            case 'Tata Usaha':
                return redirect()->route('tataUsaha.dashboard');
            case 'Kepala Prodi':
                return redirect()->route('kaprodi.dashboard');
            case 'Mahasiswa':
                return redirect()->route('mahasiswa.dashboard');
            default:
                return redirect()->route('dashboard');
        }
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
