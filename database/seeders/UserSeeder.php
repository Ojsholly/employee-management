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
            Company::factory()->count(1)->has(
                Employee::factory()->count(5)
            )
        )->create();                        // 10 companies with 5 employees each
    }
}
