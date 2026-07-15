<?php

namespace App\Services\Category;

use LaravelEasyRepository\Service;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Str;

class CategoryServiceImplement extends Service implements CategoryService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(CategoryRepository $mainRepository)
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

    // Define your custom methods :)
}
