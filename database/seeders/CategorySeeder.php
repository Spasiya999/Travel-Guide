<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Adventure',
            'Cultural',
            'Wildlife',
            'Beach',
            'Hiking',
            'Luxury',
            'Family',
            'Romantic',
            'Historical',
            'Eco Tours',
        ];

        $data = [];
        foreach ($categories as $name) {
            $data[] = [
                'name' => $name,
                'image' => 'frontend/img/category (1).png',
                'status' => 1,
                'is_popular' => rand(0, 1), // Random boolean
            ];
        }

        DB::table('categories')->insert($data);
    }
}
