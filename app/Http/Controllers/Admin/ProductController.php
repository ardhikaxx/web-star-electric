<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        $products = Product::orderBy('created_at', 'desc');

        if ($request->has('search') && $request->search != '') {
            $products->where('name', 'like', '%' . $request->search . '%')
                     ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $products->where('is_active', $request->status == 'active');
        }

        $products = $products->paginate(10)->appends($request->except('page'));
        return view('admin.pages.products.index', compact('products'));
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
        $request->image->move(public_path('uploads/products'), $imageName);

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
            if (File::exists(public_path('uploads/products/' . $product->image))) {
                File::delete(public_path('uploads/products/' . $product->image));
            }

            $imageName = 'product_' . time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        if (File::exists(public_path('uploads/products/' . $product->image))) {
            File::delete(public_path('uploads/products/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }
}
