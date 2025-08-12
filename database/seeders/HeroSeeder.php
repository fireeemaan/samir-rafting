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
            ['title' => 'Rafting Samir'],
            [
                'subtitle' => 'Petualangan seru menyusuri sungai penuh tantangan! Siap basah dan beraksi?',
                'button_text' => 'Lihat Paket Rafting'
            ]

            );
    }
}
