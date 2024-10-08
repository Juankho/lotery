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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'birth_date' => $data['birthDate'],
            'phone' => $data['phone'],
        ]);
    }

    public function updateUser(User $user, array $data)
    {


        $emailExists = User::where('email', $data['email'])
            ->where('id', '!=', $user->id)->exists();

        if ($emailExists) {
            throw new \Exception('Email already exists', 400);
        }

        $saveData  = [
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'birth_date' => $data['birthDate'] ?? $user->birth_date,
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
