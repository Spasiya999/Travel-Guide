<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->insert([
            [
                'name' => 'Cultural Triangle Explorer',
                'short_description' => 'Explore the cultural wonders of the region.',
                'description' => 'A 7-day tour covering the most famous cultural sites.',
                'image' => 'frontend/img/packges (1).png',
                'duration' => '7 Days / 6 Nights',
                'category_id' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Wildlife Safari Adventure',
                'short_description' => 'Experience the wild like never before.',
                'description' => 'A thrilling safari through national parks.',
                'image' => 'frontend/img/packges (2).png',
                'duration' => '5 Days / 4 Nights',
                'category_id' => 3,
                'status' => 1,
            ],
            [
                'name' => 'Beach Relaxation Retreat',
                'short_description' => 'Relax on pristine beaches.',
                'description' => 'A relaxing getaway to the most beautiful beaches.',
                'image' => 'frontend/img/packges (3).png',
                'duration' => '4 Days / 3 Nights',
                'category_id' => 4,
                'status' => 1,
            ],
            [
                'name' => 'Mountain Hiking Expedition',
                'short_description' => 'Conquer the highest peaks.',
                'description' => 'A challenging hike for adventure seekers.',
                'image' => 'frontend/img/packges (4).png',
                'duration' => '6 Days / 5 Nights',
                'category_id' => 5,
                'status' => 1,
            ],
            [
                'name' => 'Luxury City Tour',
                'short_description' => 'Experience the city in luxury.',
                'description' => 'A premium tour of the city’s highlights.',
                'image' => 'frontend/img/packges (5).png',
                'duration' => '3 Days / 2 Nights',
                'category_id' => 6,
                'status' => 1,
            ],
            [
                'name' => 'Family Fun Package',
                'short_description' => 'Fun for the whole family.',
                'description' => 'Activities and tours suitable for all ages.',
                'image' => 'frontend/img/packges (6).png',
                'duration' => '5 Days / 4 Nights',
                'category_id' => 7,
                'status' => 1,
            ],
            [
                'name' => 'Romantic Getaway',
                'short_description' => 'Perfect for couples.',
                'description' => 'A romantic escape with special amenities.',
                'image' => 'frontend/img/packges (7).png',
                'duration' => '4 Days / 3 Nights',
                'category_id' => 8,
                'status' => 1,
            ],
            [
                'name' => 'Historical Sites Tour',
                'short_description' => 'Discover ancient history.',
                'description' => 'Visit the most important historical landmarks.',
                'image' => 'frontend/img/packges (8).png',
                'duration' => '6 Days / 5 Nights',
                'category_id' => 9,
                'status' => 1,
            ],
            [
                'name' => 'Eco Adventure',
                'short_description' => 'Eco-friendly tours for nature lovers.',
                'description' => 'Sustainable travel experiences in nature.',
                'image' => 'frontend/img/packges (9).png',
                'duration' => '5 Days / 4 Nights',
                'category_id' => 10,
                'status' => 1,
            ],
            [
                'name' => 'Adventure Sports Package',
                'short_description' => 'For adrenaline junkies.',
                'description' => 'Includes rafting, climbing, and more.',
                'image' => 'frontend/img/packges (10).png',
                'duration' => '7 Days / 6 Nights',
                'category_id' => 1,
                'status' => 1,
            ],
        ]);
    }
}
