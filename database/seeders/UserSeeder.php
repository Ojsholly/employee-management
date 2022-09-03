<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->superAdmin()->create();

        User::factory(20)->admin()->create();

        User::factory(10)->company()->has(
            Company::factory()->count(15)->has(
                Employee::factory()->count(50)
            )
        )->create();                        // 15 companies with 5 employees each
    }
}
