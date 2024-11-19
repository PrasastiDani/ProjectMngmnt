<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function authenticate(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required|min:8',
        ]);

        // Attempt untuk login
        // if (auth()->attempt($validated)) {
        //     // Regenerasi sesi untuk menghindari session fixation attacks
        //     $request->session()->regenerate();

        //     // Redirect ke halaman yang dituju setelah login berhasil
        //     return redirect()->route('transaction.index')->with('success', 'Login Berhasil!');
        // }

        if ($validated['username'] === 'admin' && $validated['password'] === 'admin123') {
            // Jika sesuai, regenerasi session dan redirect ke halaman yang diinginkan
            $request->session()->regenerate();

            return redirect()->route('transaction.index')->with('success', 'Login Berhasil!');
        }

        // Jika login gagal, redirect kembali ke halaman login dengan pesan error
        return redirect()->route('auth.login')->with('error', 'Akun yang anda masukan salah');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('auth.login')->with('success', 'Logout Berhasil!');
    }
}
