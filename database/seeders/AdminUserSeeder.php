<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@esmart.com.bd'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin!esmart50'),
            ]
        );
    }
}
