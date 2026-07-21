<?php

namespace App\Services\StockIn;

use App\Models\Product;
use App\Repositories\StockIn\StockInRepository;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;

class StockInServiceImplement extends Service implements StockInService
{
    protected $mainRepository;

    public function __construct(
        StockInRepository $mainRepository
    )
    {
        $this->mainRepository = $mainRepository;
    }

    public function create($data)
    {
        return DB::transaction(function () use ($data) {

            // Pisahkan purchase_price — tidak disimpan di tabel stock_ins,
            // tapi digunakan untuk mengupdate harga beli terakhir di produk.
            $purchasePrice = $data['purchase_price'];
            unset($data['purchase_price']);

            $stockIn = $this->mainRepository->create($data);

            $product = Product::findOrFail($data['product_id']);

            // Tambah stok
            $product->increment('stock', $data['qty']);

            // Update harga beli terakhir per unit pada master produk
            $product->update(['purchase_price' => $purchasePrice]);

            return $stockIn;
        });
    }

    public function update($id, array $data)
    {
        $old = $this->mainRepository->findOrFail($id);

        return DB::transaction(function () use ($old, $id, $data) {

            // Pisahkan purchase_price
            $purchasePrice = $data['purchase_price'];
            unset($data['purchase_price']);

            $product = Product::findOrFail($old->product_id);

            // Kembalikan stok lama
            $product->decrement('stock', $old->qty);

            $stockIn = $this->mainRepository->update($id, $data);

            // Ambil produk baru (bisa berbeda jika produk diganti saat edit)
            $product = Product::findOrFail($data['product_id']);

            // Tambah stok baru
            $product->increment('stock', $data['qty']);

            // Update harga beli terakhir per unit pada master produk
            $product->update(['purchase_price' => $purchasePrice]);

            return $stockIn;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {

            $stock = $this->mainRepository->findOrFail($id);

            $product = Product::findOrFail($stock->product_id);

            $product->decrement('stock', $stock->qty);

            // purchase_price tidak di-rollback saat hapus karena tidak ada
            // histori harga sebelumnya yang tersimpan di tabel stock_ins.
            // Nilai purchase_price tetap sebagai "harga beli terakhir yang diketahui".

            return $this->mainRepository->delete($id);
        });
    }
}
