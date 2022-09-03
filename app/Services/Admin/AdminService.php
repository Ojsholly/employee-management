<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Services\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class AdminService extends Service
{
    /**
     * @param array $data
     * @return User
     */
    public function createAdmin(array $data): User
    {
        return $this->createUser($data, 'admin');
    }

    /**
     * @param string $uuid
     * @return mixed
     * @throws Throwable
     */
    public function getAdmin(string $uuid): mixed
    {
        $admin = User::where('uuid', $uuid)->role('admin')->first();

        throw_if(! $admin, new ModelNotFoundException("Requested administrator account not found.", ResponseAlias::HTTP_NOT_FOUND));

        return $admin;
    }

    /**
     * @return mixed
     */
    public function getAdmins(): mixed
    {
        return User::role('admin')->paginate(10);
    }

    /**
     * @param string $uuid
     * @return bool
     * @throws Throwable
     */
    public function deleteAdmin(string $uuid): bool
    {
        $admin = $this->getAdmin($uuid);

        return $admin->delete();
    }
}
