<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('admin.pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'pin' => 'required|digits:4',
        ], [
            'username.required' => 'Username wajib diisi.',
            'pin.required' => 'PIN wajib diisi.',
            'pin.digits' => 'PIN harus terdiri dari 4 digit angka.',
        ]);

        $user = User::query()
            ->where('username', $request->username)
            ->where('is_active', true)
            ->first();

        if (! $user || ! Hash::check($request->pin, $user->pin)) {
            return back()->with('error', 'Username atau PIN tidak sesuai.')->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectByRole($user)->with('success', 'Login berhasil.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }

    public function showForgotPin()
    {
        return view('admin.pages.forgot-pin');
    }

    public function verifyPhone(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
        ], [
            'phone_number.required' => 'Nomor telepon wajib diisi.',
        ]);

        $user = User::query()
            ->where('phone_number', $request->phone_number)
            ->where('is_active', true)
            ->first();

        if (! $user) {
            return back()->with('error', 'Nomor telepon belum terdaftar di sistem.')->withInput();
        }

        session([
            'pin_reset_user_id' => $user->id,
            'pin_reset_verified_at' => now()->timestamp,
        ]);

        return redirect()->route('pin.reset.form')->with('success', 'Nomor telepon berhasil diverifikasi. Silakan buat PIN baru.');
    }

    public function showResetPin()
    {
        if (! session()->has('pin_reset_user_id')) {
            return redirect()->route('pin.forgot')->with('error', 'Silakan verifikasi nomor telepon terlebih dahulu.');
        }

        return view('admin.pages.reset-pin');
    }

    public function resetPin(Request $request)
    {
        $userId = session('pin_reset_user_id');

        if (! $userId) {
            return redirect()->route('pin.forgot')->with('error', 'Sesi reset PIN telah berakhir.');
        }

        $request->validate([
            'pin' => 'required|digits:4|confirmed',
        ], [
            'pin.required' => 'PIN baru wajib diisi.',
            'pin.digits' => 'PIN baru harus terdiri dari 4 digit angka.',
            'pin.confirmed' => 'Konfirmasi PIN tidak cocok.',
        ]);

        $user = User::findOrFail($userId);
        $user->update(['pin' => $request->pin]);

        session()->forget(['pin_reset_user_id', 'pin_reset_verified_at']);

        return redirect()->route('login')->with('success', 'PIN berhasil diperbarui. Silakan login kembali.');
    }

    private function redirectByRole(User $user)
    {
        return redirect()->route($user->isAdmin() ? 'admin.dashboard' : 'employee.dashboard');
    }
}
