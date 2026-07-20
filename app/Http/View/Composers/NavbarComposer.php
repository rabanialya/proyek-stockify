<?php

namespace App\Http\View\Composers;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOpname;
use App\Models\StockOut;
use Illuminate\View\View;

class NavbarComposer
{
    public function compose(View $view): void
    {
        // Produk dengan stok menipis (max 5 untuk notifikasi)
        $navLowStockProducts = Product::with('category')
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock')
            ->take(5)
            ->get();

        // Aktivitas terbaru gabungan (max 5)
        $stockIns = StockIn::with('product')
            ->latest()
            ->take(3)
            ->get()
            ->map(fn($s) => [
                'type'       => 'stock-in',
                'label'      => ($s->product->name ?? '-'),
                'sub'        => '+' . $s->qty . ' unit masuk',
                'time_human' => $s->created_at->diffForHumans(),
            ]);

        $stockOuts = StockOut::with('product')
            ->latest()
            ->take(2)
            ->get()
            ->map(fn($s) => [
                'type'       => 'stock-out',
                'label'      => ($s->product->name ?? '-'),
                'sub'        => '-' . $s->qty . ' unit keluar',
                'time_human' => $s->created_at->diffForHumans(),
            ]);

        $navRecentActivities = $stockIns->concat($stockOuts)
            ->take(5)
            ->values();

        // Badge count = jumlah produk stok menipis
        $navNotifCount = $navLowStockProducts->count();

        $view->with(compact(
            'navLowStockProducts',
            'navRecentActivities',
            'navNotifCount'
        ));
    }
}
