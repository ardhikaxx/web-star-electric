<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('employee.pages.profile.edit', [
            'user' => $request->user()->load('locations'),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'phone_number' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'phone_number')->ignore($user->id),
            ],
            'current_pin' => 'nullable|digits:4',
            'new_pin' => 'nullable|digits:4|confirmed',
        ]);

        if ($request->filled('new_pin') && ! Hash::check((string) $request->current_pin, $user->pin)) {
            return back()->withErrors(['current_pin' => 'PIN saat ini tidak sesuai.'])->withInput();
        }

        $payload = [
            'name' => $data['name'],
            'username' => $data['username'],
            'phone_number' => $data['phone_number'],
        ];

        if (! empty($data['new_pin'])) {
            $payload['pin'] = $data['new_pin'];
        }

        $user->update($payload);

        return redirect()->route('employee.profile.edit')->with('success', 'Profil karyawan berhasil diperbarui.');
    }
}
