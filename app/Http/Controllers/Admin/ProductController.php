<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

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
        $query = Product::query()->with('images')->orderByDesc('created_at');

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
        if ($request->has('price')) {
            $request->merge(['price' => str_replace('.', '', $request->price)]);
        }
        if ($request->has('old_price')) {
            $request->merge(['old_price' => str_replace('.', '', $request->old_price)]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'link' => 'nullable|url',
        ], [
            'name.required' => 'Nama produk wajib diisi',
            'description.required' => 'Deskripsi produk wajib diisi',
            'price.required' => 'Harga produk wajib diisi',
            'images.required' => 'Minimal satu gambar produk wajib diupload',
            'images.*.image' => 'File harus berupa gambar',
            'images.*.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $this->resolveOldPrice((float) $request->price, $request->old_price),
            'link' => $request->link,
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imageName = 'product_' . time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(storage_path('uploads/products'), $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imageName,
                    'position' => $index,
                ]);

                // Set the first image as the primary image in products table for backward compatibility
                if ($index === 0) {
                    $product->update(['image' => $imageName]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        return view('admin.pages.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if ($request->has('price')) {
            $request->merge(['price' => str_replace('.', '', $request->price)]);
        }
        if ($request->has('old_price')) {
            $request->merge(['old_price' => str_replace('.', '', $request->old_price)]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'link' => 'nullable|url',
        ], [
            'name.required' => 'Nama produk wajib diisi',
            'description.required' => 'Deskripsi produk wajib diisi',
            'price.required' => 'Harga produk wajib diisi',
            'images.*.image' => 'File harus berupa gambar',
            'images.*.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $this->resolveOldPrice((float) $request->price, $request->old_price),
            'link' => $request->link,
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->hasFile('images')) {
            $lastPosition = ProductImage::where('product_id', $product->id)->max('position') ?? -1;
            foreach ($request->file('images') as $index => $image) {
                $imageName = 'product_' . time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(storage_path('uploads/products'), $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imageName,
                    'position' => $lastPosition + $index + 1,
                ]);
            }
        }

        // Update the primary image if it's empty or the first one changed
        $firstImage = ProductImage::where('product_id', $product->id)->orderBy('position')->first();
        if ($firstImage) {
            $product->update(['image' => $firstImage->image_path]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $images = ProductImage::where('product_id', $product->id)->get();
        foreach ($images as $image) {
            $imagePath = storage_path('uploads/products/' . $image->image_path);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }

    public function deleteImage(ProductImage $image)
    {
        $product = $image->product;
        $imagePath = storage_path('uploads/products/' . $image->image_path);
        
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $image->delete();

        // Update primary image if the deleted one was primary
        if ($product->image === $image->image_path) {
            $nextImage = ProductImage::where('product_id', $product->id)->orderBy('position')->first();
            $product->update(['image' => $nextImage ? $nextImage->image_path : null]);
        }

        return response()->json(['success' => true]);
    }
}
