<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->orderByDesc('created_at')
            ->get();

        return view('index', compact('products'));
    }

    public function showProduct(Product $product)
    {
        abort_unless($product->is_active, 404);

        $relatedProducts = Product::where('is_active', true)
            ->whereKeyNot($product->id)
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function clickProduct(Request $request, Product $product)
    {
        abort_unless($product->is_active, 404);

        $trackedProductIds = collect($request->session()->get('tracked_product_clicks', []))
            ->map(fn ($id) => (int) $id)
            ->all();

        $isUniqueClick = ! in_array($product->id, $trackedProductIds, true);
        $isInterestClick = blank($product->link);

        Product::whereKey($product->id)->update([
            'click_count' => DB::raw('click_count + 1'),
            'unique_click_count' => DB::raw('unique_click_count + ' . ($isUniqueClick ? 1 : 0)),
            'interest_click_count' => DB::raw('interest_click_count + ' . ($isInterestClick ? 1 : 0)),
            'last_clicked_at' => now(),
            'updated_at' => now(),
        ]);

        if ($isUniqueClick) {
            $trackedProductIds[] = $product->id;
            $request->session()->put('tracked_product_clicks', array_values(array_unique($trackedProductIds)));
        }

        if ($isInterestClick) {
            $alert = [
                'icon' => 'info',
                'title' => 'Link pembelian belum tersedia',
                'message' => "Link pembelian untuk {$product->name} belum tersedia saat ini. Silakan hubungi toko untuk informasi pemesanan lebih lanjut.",
            ];

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json($alert);
            }

            return redirect()->route('home')->with('product_alert', $alert);
        }

        return redirect()->away($product->link);
    }
}
