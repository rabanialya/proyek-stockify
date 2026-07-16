<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Str;
use LaravelEasyRepository\Service;

class ProductServiceImplement extends Service implements ProductService
{
    /**
     * don't change $this->mainRepository
     */
    protected $mainRepository;

    public function __construct(ProductRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function create($data)
    {
        $data['slug'] = Str::slug($data['name']);

        return $this->mainRepository->create($data);
    }

    public function update($id, array $data)
    {
        $data['slug'] = Str::slug($data['name']);

        return $this->mainRepository->update($id, $data);
    }
}