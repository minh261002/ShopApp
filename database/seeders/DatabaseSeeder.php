<?php

namespace Database\Seeders;

use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'image' => '/admin/images/not-found.jpg'
        ]);

        $this->call([
            ProvinceSeeder::class,
            DistrictSeeder::class,
            WardSeeder::class,
            ModuleSeeder::class
        ]);
    }
}