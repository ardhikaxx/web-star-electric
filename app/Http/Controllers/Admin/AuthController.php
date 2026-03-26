<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    private $pinKey = 'admin_pin';

    protected function getPin()
    {
        return config('app.admin_pin', '1234');
    }

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

        if ($request->pin === $this->getPin()) {
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

    public function showChangePin()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return view('admin.pages.change-pin');
    }

    public function changePin(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'current_pin' => 'required|digits:4',
            'new_pin' => 'required|digits:4|confirmed',
        ], [
            'current_pin.required' => 'PIN saat ini wajib diisi',
            'current_pin.digits' => 'PIN saat ini harus 4 digit angka',
            'new_pin.required' => 'PIN baru wajib diisi',
            'new_pin.digits' => 'PIN baru harus 4 digit angka',
            'new_pin.confirmed' => 'Konfirmasi PIN baru tidak cocok',
        ]);

        if ($request->current_pin !== $this->getPin()) {
            return back()->with('error', 'PIN saat ini tidak cocok');
        }

        $this->updatePinInConfig($request->new_pin);

        return redirect()->route('admin.dashboard')->with('success', 'PIN berhasil diubah');
    }

    private function updatePinInConfig($newPin)
    {
        $configPath = base_path('config/app.php');
        $configContent = file_get_contents($configPath);
        
        if (preg_match('/admin_pin.*?=>.*?[\'"](\d+)[\'"]/', $configContent, $matches)) {
            $configContent = preg_replace(
                '/(\'admin_pin\'\s*=>\s*\')(\d+)(\')/',
                '$1' . $newPin . '$3',
                $configContent
            );
        } else {
            $configContent = preg_replace(
                '/(\'app\'\s*=>\s*\[)/',
                "$1\n    'admin_pin' => '$newPin',",
                $configContent
            );
        }
        
        file_put_contents($configPath, $configContent);
    }
}