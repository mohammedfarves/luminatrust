<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@luminatrust.org'],
            [
                'name' => 'Lumina Administrator',
                'password' => Hash::make('admin123')
            ]
        );

        $this->call(LuminaSeeder::class);
    }
}
