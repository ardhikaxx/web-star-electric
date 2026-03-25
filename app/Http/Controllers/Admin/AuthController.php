<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected $pin = '1234';

    public function showLogin()
    {
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'pin' => 'required|digits:4',
        ], [
            'pin.required' => 'PIN wajib diisi',
            'pin.digits' => 'PIN harus 4 digit angka',
        ]);

        if ($request->pin === $this->pin) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
        }

        return back()->with('error', 'PIN yang Anda masukkan salah')->withInput();
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Logout berhasil');
    }
}