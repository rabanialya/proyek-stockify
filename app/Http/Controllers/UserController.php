<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function index()
    {
        $users = $this->userService->all();

        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('pages.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->create(
            $request->validated()
        );

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(int $user)
    {
        $roles = Role::orderBy('name')->get();

        $user = $this->userService->findOrFail($user);

        return view(
            'pages.users.edit',
            compact('user', 'roles')
        );
    }

    public function update(UpdateUserRequest $request, int $user)
    {
        $this->userService->update(
            $user,
            $request->validated()
        );

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(int $user)
    {
        $this->userService->delete($user);

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}