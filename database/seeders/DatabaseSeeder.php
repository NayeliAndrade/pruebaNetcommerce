<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* User::factory(10)->create()->each(function ($user) {
            $companies = Company::factory(3)->create();

            $companies->each(function ($company) use ($user) {
                Task::factory(5)->create([
                    'user_id' => $user->id,
                    'company_id' => $company->id,
                ]);
            });
        }); */

        User::factory(10)->create();
        Company::factory(10)->create();
        Task::factory(10)->create();
    }
}
