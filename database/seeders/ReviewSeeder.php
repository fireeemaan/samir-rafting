<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Review::create([
                'name' => $faker->name(),
                'rating' => $faker->numberBetween(1, 5),
                'comment' => $faker->sentence(10),
                'is_accepted' => $faker->boolean(20),
            ]);
        }
    }
}
