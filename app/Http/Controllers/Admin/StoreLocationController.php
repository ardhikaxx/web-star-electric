<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreLocationController extends Controller
{
    public function index(Request $request)
    {
        $locations = StoreLocation::query();

        if ($request->filled('search')) {
            $locations->where('name', 'like', '%' . $request->search . '%');
        }

        $locations = $locations->orderBy('name')->paginate(10)->withQueryString();

        return view('admin.pages.store-locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.pages.store-locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:store_locations,name',
        ], [
            'name.required' => 'Nama lokasi wajib diisi.',
            'name.unique' => 'Nama lokasi sudah terdaftar.',
            'name.max' => 'Nama lokasi maksimal 255 karakter.',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (StoreLocation::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        StoreLocation::create($validated);

        return redirect()->route('admin.store-locations.index')->with('success', 'Lokasi toko cabang berhasil ditambahkan.');
    }

    public function edit(StoreLocation $storeLocation)
    {
        return view('admin.pages.store-locations.edit', compact('storeLocation'));
    }

    public function update(Request $request, StoreLocation $storeLocation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:store_locations,name,' . $storeLocation->id,
        ], [
            'name.required' => 'Nama lokasi wajib diisi.',
            'name.unique' => 'Nama lokasi sudah terdaftar.',
            'name.max' => 'Nama lokasi maksimal 255 karakter.',
        ]);

        if ($storeLocation->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
            
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (StoreLocation::where('slug', $validated['slug'])->where('id', '!=', $storeLocation->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        $storeLocation->update($validated);

        return redirect()->route('admin.store-locations.index')->with('success', 'Lokasi toko cabang berhasil diperbarui.');
    }

    public function destroy(StoreLocation $storeLocation)
    {
        if ($storeLocation->employees()->exists() || $storeLocation->dailyReports()->exists()) {
            return back()->with('error', 'Lokasi toko tidak dapat dihapus karena masih terkait dengan karyawan atau laporan.');
        }

        $storeLocation->delete();

        return back()->with('success', 'Lokasi toko cabang berhasil dihapus.');
    }
}
