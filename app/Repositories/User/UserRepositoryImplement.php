<?php

namespace App\Repositories\User;

use App\Models\User;
use LaravelEasyRepository\Implementations\Eloquent;

class UserRepositoryImplement extends Eloquent implements UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}