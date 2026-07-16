<?php

namespace App\Repositories\Product;

use App\Models\Product;
use LaravelEasyRepository\Implementations\Eloquent;

class ProductRepositoryImplement extends Eloquent implements ProductRepository
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}