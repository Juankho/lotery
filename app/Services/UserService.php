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

        $saveData  = [
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'birth_date' => $data['birth_date'] ?? $user->birth_date,
            'phone' => $data['phone'] ?? $user->phone,
        ];

        if (isset($data['password'])) {
            $saveData['password'] = $data['password'];
        }

        $user->update($saveData);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }
}
