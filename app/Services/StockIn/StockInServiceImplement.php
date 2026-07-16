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

            $stockIn = $this->mainRepository->create($data);

            $product = Product::findOrFail($data['product_id']);

            $product->increment('stock', $data['qty']);

            return $stockIn;
        });
    }

    public function update($id, array $data)
    {
        $old = $this->mainRepository->findOrFail($id);

        return DB::transaction(function () use ($old, $id, $data) {

            $product = Product::findOrFail($old->product_id);

            $product->decrement('stock', $old->qty);

            $stockIn = $this->mainRepository->update($id, $data);

            $product = Product::findOrFail($data['product_id']);

            $product->increment('stock', $data['qty']);

            return $stockIn;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {

            $stock = $this->mainRepository->findOrFail($id);

            $product = Product::findOrFail($stock->product_id);

            $product->decrement('stock', $stock->qty);

            return $this->mainRepository->delete($id);
        });
    }
}