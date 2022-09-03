<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param  array  $data
     * @return User|null
     */
    public function verifyUserCredentials(array $data): ?User
    {
        $user = User::with('roles')->when(array_key_exists('identifier', $data), function ($query) use ($data) {
            return $query->where('email', $data['identifier'])
                ->orWhere('username', $data['identifier']);
        })->first();

        if (! $user) {
            return null;
        }

        if (! Hash::check($data['password'], $user->password)) {
            return null;
        }

        return $user;
    }
}
