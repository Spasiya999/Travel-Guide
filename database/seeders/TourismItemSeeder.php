<?php

namespace Database\Seeders;

use App\Models\TourismItem;
use Illuminate\Database\Seeder;

class TourismItemSeeder extends Seeder
{
    public function run()
    {
        // National Parks
        $nationalParks = [
            ['name' => 'Minneriya National Park Safari (jeep + tickets)', 'price_usd' => 45, 'price_lkr' => 15000, 'duration' => '3-4 hours'],
            ['name' => 'Kawdulla National Park Safari (jeep + tickets)', 'price_usd' => 40, 'price_lkr' => 13000, 'duration' => '3-4 hours'],
            ['name' => 'Eco Park Safari (jeep + tickets)', 'price_usd' => 35, 'price_lkr' => 11000, 'duration' => '2-3 hours'],
            ['name' => 'Horton Plains National Park tickets', 'price_usd' => 25, 'price_lkr' => 8000, 'duration' => '4-5 hours'],
            ['name' => 'Udawalawa National Park Safari (jeep + tickets)', 'price_usd' => 50, 'price_lkr' => 16000, 'duration' => '3-4 hours'],
            ['name' => 'Yala National Park Safari (jeep + tickets)', 'price_usd' => 60, 'price_lkr' => 20000, 'duration' => '4-5 hours'],
            ['name' => 'Bundala National Park Safari (jeep + tickets)', 'price_usd' => 45, 'price_lkr' => 15000, 'duration' => '3-4 hours'],
            ['name' => 'Kumana National Park Safari (jeep + tickets)', 'price_usd' => 50, 'price_lkr' => 16000, 'duration' => '3-4 hours'],
            ['name' => 'Wilpattu National Park Safari (jeep + tickets)', 'price_usd' => 55, 'price_lkr' => 18000, 'duration' => '4-5 hours'],
        ];

        foreach ($nationalParks as $park) {
            TourismItem::create([
                'name' => $park['name'],
                'type' => 'national_park',
                'price_usd' => $park['price_usd'],
                'price_lkr' => $park['price_lkr'],
                'duration' => $park['duration'],
                'requires_transport' => true,
                'features' => ['wildlife_viewing', 'photography', 'nature_experience'],
                'status' => 'active'
            ]);
        }

        // Heritage Sites
        $heritageSites = [
            ['name' => 'Anuradhapura Heritage Site', 'price_usd' => 30, 'price_lkr' => 10000],
            ['name' => 'Jaya Sri Maha Bodhi', 'price_usd' => 5, 'price_lkr' => 1500],
            ['name' => 'Isurumuniya', 'price_usd' => 8, 'price_lkr' => 2500],
            ['name' => 'Mihinthalaya Rajamaha Viharaya', 'price_usd' => 10, 'price_lkr' => 3000],
            ['name' => 'Sigiriya Lion Rock', 'price_usd' => 35, 'price_lkr' => 12000],
            ['name' => 'Pidurangala Temple', 'price_usd' => 5, 'price_lkr' => 1500],
            ['name' => 'Dambulla Cave Temple', 'price_usd' => 15, 'price_lkr' => 5000],
            ['name' => 'Polonnaruwa Heritage Site', 'price_usd' => 30, 'price_lkr' => 10000],
            ['name' => 'Aukana Rajamaha Viharaya', 'price_usd' => 8, 'price_lkr' => 2500],
            ['name' => 'Dambadeniya Rajadaniya', 'price_usd' => 10, 'price_lkr' => 3000],
            ['name' => 'Yapahuwa Rajadaniya', 'price_usd' => 12, 'price_lkr' => 4000],
            ['name' => 'Matale Aluviharaya Temple', 'price_usd' => 5, 'price_lkr' => 1500],
            ['name' => 'Matale Hindu Temple', 'price_usd' => 3, 'price_lkr' => 1000],
            ['name' => 'Temple of Tooth Relic Kandy', 'price_usd' => 15, 'price_lkr' => 5000],
            ['name' => 'Bahirawa Kanda Temple', 'price_usd' => 8, 'price_lkr' => 2500],
            ['name' => 'Ambuluwawa', 'price_usd' => 10, 'price_lkr' => 3000],
            ['name' => 'Hanuman Temple', 'price_usd' => 5, 'price_lkr' => 1500],
            ['name' => 'Koneswaram Temple', 'price_usd' => 3, 'price_lkr' => 1000],
            ['name' => 'Hot Spring Well Kanniya', 'price_usd' => 5, 'price_lkr' => 1500],
            ['name' => 'Hot Spring Well Madunagala', 'price_usd' => 5, 'price_lkr' => 1500],
        ];

        foreach ($heritageSites as $site) {
            TourismItem::create([
                'name' => $site['name'],
                'type' => 'heritage_site',
                'price_usd' => $site['price_usd'],
                'price_lkr' => $site['price_lkr'],
                'duration' => '1-2 hours',
                'requires_transport' => true,
                'features' => ['cultural_heritage', 'historical_significance', 'photography'],
                'status' => 'active'
            ]);
        }

        // Activities
        $activities = [
            ['name' => 'Hiriwadunna Village Tour', 'price_usd' => 25, 'price_lkr' => 8000, 'duration' => '3-4 hours'],
            ['name' => 'Elephant Ride', 'price_usd' => 20, 'price_lkr' => 6500, 'duration' => '30 minutes'],
            ['name' => 'Ayurvedic Herbal Massage', 'price_usd' => 30, 'price_lkr' => 10000, 'duration' => '1-2 hours'],
            ['name' => 'Pinnawala Elephant Orphanage', 'price_usd' => 15, 'price_lkr' => 5000, 'duration' => '2-3 hours'],
            ['name' => 'Udawalawa Elephant Orphanage', 'price_usd' => 12, 'price_lkr' => 4000, 'duration' => '2-3 hours'],
            ['name' => 'Ella Rock', 'price_usd' => 10, 'price_lkr' => 3000, 'duration' => '4-5 hours'],
            ['name' => 'Bambara Kanda Waterfall', 'price_usd' => 8, 'price_lkr' => 2500, 'duration' => '2-3 hours'],
            ['name' => 'Uda Diyaluma Waterfall', 'price_usd' => 5, 'price_lkr' => 1500, 'duration' => '1-2 hours'],
            ['name' => 'White Water Rafting Kitulgala', 'price_usd' => 40, 'price_lkr' => 13000, 'duration' => '3-4 hours'],
            ['name' => 'Elephant Freedom Project', 'price_usd' => 35, 'price_lkr' => 11000, 'duration' => '2-3 hours'],
            ['name' => 'Moon Plains', 'price_usd' => 10, 'price_lkr' => 3000, 'duration' => '2-3 hours'],
            ['name' => 'Shanthipura Eagle\'s View Point', 'price_usd' => 8, 'price_lkr' => 2500, 'duration' => '1-2 hours'],
            ['name' => 'Pedro Tea Factory', 'price_usd' => 12, 'price_lkr' => 4000, 'duration' => '1-2 hours'],
            ['name' => 'Dambethenna Tea Factory', 'price_usd' => 10, 'price_lkr' => 3000, 'duration' => '1-2 hours'],
            ['name' => 'Lipton\'s Seat', 'price_usd' => 5, 'price_lkr' => 1500, 'duration' => '2-3 hours'],
            ['name' => 'Gregory Lake', 'price_usd' => 8, 'price_lkr' => 2500, 'duration' => '1-2 hours'],
            ['name' => 'Whale Watching Mirissa', 'price_usd' => 50, 'price_lkr' => 16000, 'duration' => '4-5 hours'],
            ['name' => 'Turtle Hatchery', 'price_usd' => 10, 'price_lkr' => 3000, 'duration' => '1 hour'],
            ['name' => 'Pigeon Island (tickets + boat)', 'price_usd' => 25, 'price_lkr' => 8000, 'duration' => '3-4 hours'],
            ['name' => 'Coral Island + Boat', 'price_usd' => 30, 'price_lkr' => 10000, 'duration' => '3-4 hours'],
            ['name' => 'Snorkeling', 'price_usd' => 20, 'price_lkr' => 6500, 'duration' => '2-3 hours'],
        ];

        foreach ($activities as $activity) {
            TourismItem::create([
                'name' => $activity['name'],
                'type' => 'activity',
                'price_usd' => $activity['price_usd'],
                'price_lkr' => $activity['price_lkr'],
                'duration' => $activity['duration'],
                'requires_transport' => true,
                'features' => ['adventure', 'experience', 'fun'],
                'status' => 'active'
            ]);
        }
    }
}
