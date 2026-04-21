<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminEmail = (string) env('ADMIN_EMAIL', 'arjunh2194@gmail.com');
        $adminPassword = (string) env('ADMIN_PASSWORD', 'Achu@4912');

        User::query()->updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Arjun Admin',
                'password' => $adminPassword,
                'is_admin' => true,
            ]
        );

        foreach (['Food', 'Rent', 'Travel', 'Utilities', 'Shopping'] as $category) {
            ExpenseCategory::query()->firstOrCreate(['name' => $category]);
        }
    }
}
