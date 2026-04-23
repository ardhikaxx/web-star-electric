<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SalesProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalesProductController extends Controller
{
    public function index(Request $request)
    {
        $query = SalesProduct::query()->orderBy('name');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $salesProducts = $query->paginate(10)->withQueryString();

        return view('admin.pages.sales-products.index', compact('salesProducts'));
    }

    public function create()
    {
        $catalogProducts = Product::orderBy('name')->get();
        return view('admin.pages.sales-products.create', compact('catalogProducts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:sales_products,name',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($data) {
            $salesProduct = SalesProduct::create([
                ...$data,
                'stock' => 0, // initially 0, then updated via updateStock for logging
                'is_active' => (bool) ($data['is_active'] ?? true),
            ]);

            if ($data['stock'] > 0) {
                $salesProduct->updateStock($data['stock'], 'initial_stock');
            }
        });

        return redirect()->route('admin.sales-products.index')->with('success', 'Produk penjualan berhasil ditambahkan.');
    }

    public function edit(SalesProduct $salesProduct)
    {
        $catalogProducts = Product::orderBy('name')->get();
        return view('admin.pages.sales-products.edit', compact('salesProduct', 'catalogProducts'));
    }

    public function update(Request $request, SalesProduct $salesProduct)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sales_products', 'name')->ignore($salesProduct->id),
            ],
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($data, $salesProduct) {
            $oldStock = $salesProduct->stock;
            $newStock = (int) $data['stock'];

            $salesProduct->update([
                'name' => $data['name'],
                'purchase_price' => $data['purchase_price'],
                'selling_price' => $data['selling_price'],
                'is_active' => (bool) ($data['is_active'] ?? false),
            ]);

            if ($newStock !== $oldStock) {
                $change = $newStock - $oldStock;
                $type = $change > 0 ? 'restock' : 'correction';
                $salesProduct->updateStock($change, $type);
            }
        });

        return redirect()->route('admin.sales-products.index')->with('success', 'Produk penjualan berhasil diperbarui.');
    }

    public function destroy(SalesProduct $salesProduct)
    {
        $salesProduct->delete();

        return redirect()->route('admin.sales-products.index')->with('success', 'Produk penjualan berhasil dihapus.');
    }
}
