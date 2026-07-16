<?php

namespace App\Services\StockOut;

use App\Models\Product;
use App\Repositories\StockOut\StockOutRepository;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;

class StockOutServiceImplement extends Service implements StockOutService
{
    protected $mainRepository;

    public function __construct(
        StockOutRepository $mainRepository
    )
    {
        $this->mainRepository = $mainRepository;
    }

    public function create($data)
    {
        return DB::transaction(function () use ($data) {

            $product = Product::findOrFail($data['product_id']);

            if ($product->stock < $data['qty']) {
                throw new \Exception('Stok produk tidak mencukupi.');
            }

            $stockOut = $this->mainRepository->create($data);

            $product->decrement('stock', $data['qty']);

            return $stockOut;
        });
    }

    public function update($id, array $data)
    {
        $old = $this->mainRepository->findOrFail($id);

        return DB::transaction(function () use ($old, $id, $data) {

            $oldProduct = Product::findOrFail($old->product_id);

            // kembalikan stok lama
            $oldProduct->increment('stock', $old->qty);

            $newProduct = Product::findOrFail($data['product_id']);

            if ($newProduct->stock < $data['qty']) {

                // rollback stok lama
                $oldProduct->decrement('stock', $old->qty);

                throw new \Exception('Stok produk tidak mencukupi.');
            }

            $stockOut = $this->mainRepository->update($id, $data);

            $newProduct->decrement('stock', $data['qty']);

            return $stockOut;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {

            $stockOut = $this->mainRepository->findOrFail($id);

            $product = Product::findOrFail($stockOut->product_id);

            $product->increment('stock', $stockOut->qty);

            return $this->mainRepository->delete($id);
        });
    }
}