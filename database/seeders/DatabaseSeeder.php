<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Company
        $a = Company::create([
            'name' => 'Acme',
            'hq' => 'Milan'
        ]);

        $b = Company::create([
            'name' => 'Radius',
            'hq' => 'Rome'
        ]);

        $c = Company::create([
            'name' => 'Lab',
            'hq' => 'Venice'
        ]);

        // Application, one per status

        $user = User::where('is_admin', true)->first();

        Application::create([
            'status' => 0,
            'role' => 'Frontend Developer',
            'notes' => '',
            'company_id' => $c->id,
            'type' => 0,
            'user_id' => $user->id
        ]);

        Application::create([
            'status' => 1,
            'role' => 'Backend Developer',
            'notes' => '',
            'company_id' => $a->id,
            'type' => 2,
            'user_id' => $user->id
        ]);

        Application::create([
            'status' => 2,
            'role' => 'Web Developer',
            'notes' => '',
            'company_id' => $b->id,
            'type' => 1,
            'user_id' => $user->id
        ]);

        Application::create([
            'status' => 3,
            'role' => 'FullStack Developer',
            'notes' => '',
            'company_id' => $b->id,
            'type' => 2,
            'user_id' => $user->id
        ]);

        Application::create([
            'status' => 4,
            'role' => 'HR Manager',
            'notes' => '',
            'company_id' => $a->id,
            'type' => 0,
            'user_id' => $user->id
        ]);
    }
}
