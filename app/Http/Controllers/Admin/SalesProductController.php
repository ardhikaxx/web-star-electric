<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.pages.sales-products.create');
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

        SalesProduct::create([
            ...$data,
            'is_active' => (bool) ($data['is_active'] ?? true),
        ]);

        return redirect()->route('admin.sales-products.index')->with('success', 'Produk penjualan berhasil ditambahkan.');
    }

    public function edit(SalesProduct $salesProduct)
    {
        return view('admin.pages.sales-products.edit', compact('salesProduct'));
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

        $salesProduct->update([
            ...$data,
            'is_active' => (bool) ($data['is_active'] ?? false),
        ]);

        return redirect()->route('admin.sales-products.index')->with('success', 'Produk penjualan berhasil diperbarui.');
    }

    public function destroy(SalesProduct $salesProduct)
    {
        $salesProduct->delete();

        return redirect()->route('admin.sales-products.index')->with('success', 'Produk penjualan berhasil dihapus.');
    }
}
