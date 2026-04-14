<?php

use Illuminate\Foundation\Inspiring;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create {email} {password} {--name=Admin}', function (string $email, string $password): void {
    $user = User::query()->updateOrCreate(
        ['email' => $email],
        [
            'name' => (string) $this->option('name'),
            'password' => Hash::make($password),
            'is_admin' => true,
        ]
    );

    $this->info('Admin user is ready: '.$user->email);
})->purpose('Create or update admin user');
