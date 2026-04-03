<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private function resolveOldPrice(float $price, $oldPrice = null): ?float
    {
        if ($oldPrice !== null && $oldPrice !== '') {
            return (float) $oldPrice;
        }

        if ($price <= 0) {
            return null;
        }

        $roundingBase = match (true) {
            $price >= 5000000 => 100000,
            $price >= 1000000 => 50000,
            $price >= 100000 => 10000,
            default => 1000,
        };

        $suggested = ceil(($price * 1.15) / $roundingBase) * $roundingBase;

        return $suggested <= $price ? $price + $roundingBase : $suggested;
    }

    public function index(Request $request)
    {
        $query = Product::query()->orderByDesc('created_at');

        if ($request->filled('search')) {
            $query->where(function ($builder) use ($request) {
                $builder->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $statsQuery = clone $query;
        $products = $query->paginate(10)->appends($request->except('page'));
        $productStats = [
            'total' => (clone $statsQuery)->count(),
            'active' => (clone $statsQuery)->where('is_active', true)->count(),
            'inactive' => (clone $statsQuery)->where('is_active', false)->count(),
            'total_clicks' => (clone $statsQuery)->sum('click_count'),
            'unique_clicks' => (clone $statsQuery)->sum('unique_click_count'),
            'interest_clicks' => (clone $statsQuery)->sum('interest_click_count'),
        ];

        return view('admin.pages.products.index', compact('products', 'productStats'));
    }

    public function create()
    {
        return view('admin.pages.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link' => 'nullable|url',
        ], [
            'name.required' => 'Nama produk wajib diisi',
            'description.required' => 'Deskripsi produk wajib diisi',
            'price.required' => 'Harga produk wajib diisi',
            'image.required' => 'Gambar produk wajib diupload',
            'image.image' => 'File harus berupa gambar',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $imageName = 'product_' . time() . '_' . uniqid() . '.' . $request->image->extension();
        $request->image->storeAs('public/uploads/products', $imageName);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $this->resolveOldPrice((float) $request->price, $request->old_price),
            'image' => $imageName,
            'link' => $request->link,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        return view('admin.pages.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link' => 'nullable|url',
        ], [
            'name.required' => 'Nama produk wajib diisi',
            'description.required' => 'Deskripsi produk wajib diisi',
            'price.required' => 'Harga produk wajib diisi',
            'image.image' => 'File harus berupa gambar',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $this->resolveOldPrice((float) $request->price, $request->old_price),
            'link' => $request->link,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            if (Storage::exists('public/uploads/products/' . $product->image)) {
                Storage::delete('public/uploads/products/' . $product->image);
            }

            $imageName = 'product_' . time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->storeAs('public/uploads/products', $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        if (Storage::exists('public/uploads/products/' . $product->image)) {
            Storage::delete('public/uploads/products/' . $product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }
}
