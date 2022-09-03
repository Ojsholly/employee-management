<?php

namespace App\Services;

use App\Models\User;

class Service
{
    /**
     * @param  array  $data
     * @param  string  $role
     * @return User
     */
    public function createUser(array $data, string $role): User
    {
        $user = User::create($data);

        $user->assignRole($role);

        return $user;
    }
}
