<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariationAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('variation_attributes')
            ->insert([
                [
                    'name' => 'Kích thước',
                    'slug' => 'kich-thuoc',
                ],
                [
                    'name' => 'Màu sắc',
                    'slug' => 'mau-sac',
                ],
                [
                    'name' => 'Chất liệu',
                    'slug' => 'chat-lieu',
                ],
            ]);
    }
}