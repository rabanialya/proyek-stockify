<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use LaravelEasyRepository\Service;

class UserServiceImplement extends Service implements UserService
{
    protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function create($data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->mainRepository->create($data);
    }

    public function update($id, array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->mainRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->mainRepository->delete($id);
    }
}