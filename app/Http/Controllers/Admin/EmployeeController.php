<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreLocation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->with('locations')
            ->where('role', 'employee')
            ->orderBy('name');

        if ($request->filled('search')) {
            $query->where(function ($builder) use ($request): void {
                $builder->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('username', 'like', '%' . $request->search . '%')
                    ->orWhere('phone_number', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('location')) {
            $query->whereHas('locations', fn ($builder) => $builder->where('store_locations.id', $request->location));
        }

        $employees = $query->paginate(10)->withQueryString();
        $locations = StoreLocation::orderBy('name')->get();

        return view('admin.pages.employees.index', compact('employees', 'locations'));
    }

    public function create()
    {
        $locations = StoreLocation::orderBy('name')->get();

        return view('admin.pages.employees.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|alpha_dash|unique:users,username',
            'phone_number' => 'required|string|max:30|unique:users,phone_number',
            'pin' => 'required|digits:4',
            'is_active' => 'nullable|boolean',
            'location_ids' => 'required|array|min:1',
            'location_ids.*' => 'exists:store_locations,id',
        ], [
            'location_ids.required' => 'Pilih minimal satu lokasi untuk karyawan.',
            'location_ids.min' => 'Pilih minimal satu lokasi untuk karyawan.',
        ]);

        $employee = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'phone_number' => $data['phone_number'],
            'pin' => $data['pin'],
            'role' => 'employee',
            'is_active' => (bool) ($data['is_active'] ?? true),
        ]);

        $employee->locations()->sync($data['location_ids']);

        return redirect()->route('admin.employees.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        abort_unless($user->isEmployee(), 404);

        $user->load('locations');
        $locations = StoreLocation::orderBy('name')->get();

        return view('admin.pages.employees.edit', [
            'employee' => $user,
            'locations' => $locations,
        ]);
    }

    public function update(Request $request, User $user)
    {
        abort_unless($user->isEmployee(), 404);

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
            'pin' => 'nullable|digits:4',
            'is_active' => 'nullable|boolean',
            'location_ids' => 'required|array|min:1',
            'location_ids.*' => 'exists:store_locations,id',
        ]);

        $payload = [
            'name' => $data['name'],
            'username' => $data['username'],
            'phone_number' => $data['phone_number'],
            'is_active' => (bool) ($data['is_active'] ?? false),
        ];

        if (! empty($data['pin'])) {
            $payload['pin'] = $data['pin'];
        }

        $user->update($payload);
        $user->locations()->sync($data['location_ids']);

        return redirect()->route('admin.employees.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        abort_unless($user->isEmployee(), 404);

        $user->delete();

        return redirect()->route('admin.employees.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
