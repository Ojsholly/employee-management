<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->clearRolesAndPermissions();

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'create admin accounts', 'retrieve admin accounts', 'update admin accounts', 'delete admin accounts',
            'create company accounts', 'retrieve company accounts', 'update company accounts', 'delete company accounts',
            'create employee accounts', 'retrieve employee accounts', 'update employee accounts', 'delete employee accounts',
        ];

        $this->createPermissions($permissions);

        $this->superAdmin($permissions);

        $adminPermissions = collect($permissions)->except(0, 1, 2, 3, 6, 7, 10, 11)->toArray();               // Remove all the super admin permissions from the admin permissions

        $this->admin($adminPermissions);

        $companyPermissions = collect($permissions)->only(5, 9)->toArray(); // Remove all the super admin permissions and admin permissions from the company permissions

        $this->company($companyPermissions);

        $employeePermissions = collect($permissions)->only(5, 9 )->toArray();       // Remove all the super admin permissions, admin and company permissions from the employee permissions

        $this->employee($employeePermissions);
    }

    /**
     * @return void
     */
    public function clearRolesAndPermissions(): void
    {
        // Empty existing roles and permissions.
        $tables = ['roles', 'permissions', 'role_has_permissions', 'model_has_roles', 'model_has_permissions'];

        foreach ($tables as $table) {
            config('database.default') == 'mysql' ? DB::statement('SET FOREIGN_KEY_CHECKS=0;') : DB::statement('PRAGMA foreign_keys = OFF');
            DB::table($table)->truncate();
            config('database.default') == 'mysql' ? DB::statement('SET FOREIGN_KEY_CHECKS=1;') : DB::statement('PRAGMA foreign_keys = ON');
        }
    }

    /**
     * @param array $permissions
     * @return void
     */
    public function createPermissions(array $permissions): void
    {
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }

    /**
     * @param array $permissions
     * @return void
     */
    public function superAdmin(array $permissions): void
    {
        $superAdmin = Role::create(['name' => 'super-admin']);

        foreach ($permissions as $permission) {
            $superAdmin->givePermissionTo($permission);
        }
    }

    /**
     * @param array $permissions
     * @return void
     */
    public function admin(array $permissions): void
    {
        $admin = Role::create(['name' => 'admin']);

        foreach ($permissions as $permission) {
            $admin->givePermissionTo($permission);
        }
    }

    /**
     * @param array $permissions
     * @return void
     */
    public function company(array $permissions): void
    {
        $company = Role::create(['name' => 'company']);

        foreach ($permissions as $permission) {
            $company->givePermissionTo($permission);
        }
    }

    /**
     * @param array $permissions
     * @return void
     */
    public function employee(array $permissions): void
    {
        $employee = Role::create(['name' => 'employee']);

        foreach ($permissions as $permission) {
            $employee->givePermissionTo($permission);
        }
    }
}
