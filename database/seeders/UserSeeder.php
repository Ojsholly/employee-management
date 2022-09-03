<?php

namespace Database\Seeders;

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

        User::factory()->company()->create();

        User::factory()->employee()->create();
    }
}
