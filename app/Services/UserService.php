<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    public function getAllUsers(array $filters)
    {
        return User::query()
            ->with('role')
            ->applyFilters($filters)
            ->get();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser(User $user, array $data)
    {
        $user->update($data);

        return $user;
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }
}
