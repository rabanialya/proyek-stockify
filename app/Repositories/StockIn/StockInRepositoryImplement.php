<?php

namespace App\Repositories\StockIn;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\StockIn;

class StockInRepositoryImplement extends Eloquent implements StockInRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(StockIn $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
