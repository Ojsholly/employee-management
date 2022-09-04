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

    /**
     * @return int
     */
    public function countSuperAdmins(): int
    {
        return User::role('super-admin')->count();
    }

    /**
     * @return int
     */
    public function countAdmins(): int
    {
        return User::role('admin')->count();
    }

    /**
     * @return int
     */
    public function countCompanies(): int
    {
        return User::role('company')->count();
    }

    /**
     * @return int
     */
    public function countEmployees(): int
    {
        return User::role('employee')->count();
    }

    public function getMetrics(): array
    {
        return [
            'superAdminCount' => $this->countSuperAdmins(),
            'adminCount' => $this->countAdmins(),
            'companyCount' => $this->countCompanies(),
            'employeeCount' => $this->countEmployees(),
        ];
    }
}
