<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hero::firstOrCreate(
            ['title' => 'Wisata Desa Bantal'],
            [
                'subtitle' => 'Nikmati wisata alam dan arung jeram Sungai Samir di satu destinasi.',
                'button_text' => 'Lihat Paket'
            ]

            );
    }
}
