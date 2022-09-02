<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        User::factory()->admin()->create();

        User::factory()->company()->create();

        User::factory()->employee()->create();
    }
}
