<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class
        ]);
        \App\Models\User::factory(100)->create();
        \App\Models\Employee::factory(101)->create();
        \App\Models\Company::factory(100)->create();
        \App\Models\Manager::factory(100)->create();
        \App\Models\Branch::factory(100)->create();
        \App\Models\ClassRoom::factory(100)->create();
        \App\Models\Vendor::factory(100)->create();
        \App\Models\Course::factory(100)->create();

        foreach (range(1, 100) as $num) {
            Employee::find($num)->update(['user_id' => $num]);
            Manager::find($num)->update(['company_id' => $num]);
        }
    }
}
