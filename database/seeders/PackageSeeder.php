<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $packages = [
            [
                'name' => 'Rafting Samir',
                'price' => 150000,
                'description' => 'Rasakan keseruan mengarungi jeram Sungai Samir yang aman untuk pemula dan keluarga. Nikmati pemandangan alam pedesaan Situbondo yang asri di sepanjang rute pendek yang menyegarkan. Cocok untuk pengalaman arung jeram pertama Anda.',
                'thumbnail' => 'thumbnails/rafting-ceria.jpg',
                'facilities' => json_encode([
                    ['facility' => 'Perlengkapan arung jeram standar'],
                    ['facility' => 'Pemandu profesional'],
                    ['facility' => 'Fotografer & videografer profesional'],
                    ['facility' => 'Makan'],
                    ['facility' => 'Transportasi lokal ke start point']
                ]),
            ],
            [
                'name' => 'Wisata Gunung Panceng',
                'price' => 0,
                'description' => 'Wisata Gunung Panceng menawarkan suasana asri dengan panorama alam yang memikat. Dari puncaknya, pengunjung dapat menikmati momen matahari terbit maupun terbenam yang indah, menjadikannya spot favorit untuk bersantai dan berfoto.',
                'thumbnail' => 'thumbnails/wisata-panceng.jpg',
                'facilities' => json_encode([
                    ['facility' => 'Spot sunset / sunrise'],
                ]),
            ],
            [
                'name' => 'Bukit Samir',
                'price' => 0,
                'description' => 'Bukit Samir menghadirkan pemandangan terbuka yang menenangkan, cocok untuk melepas penat sejenak. Keindahan sunrise dan sunset dari bukit ini memberikan pengalaman berkesan sekaligus latar foto yang menawan.',
                'thumbnail' => 'thumbnails/bukit-samir.jpg',
                'facilities' => json_encode([
                    ['facility' => 'Spot sunset / sunrise'],
                ]),
            ],
        ];

        foreach ($packages as $package) {
            DB::table('packages')->insert([
                'name' => $package['name'],
                'slug' => Str::slug($package['name']),
                'price' => $package['price'],
                'description' => $package['description'],
                'thumbnail' => $package['thumbnail'],
                'facilities' => $package['facilities'],
            ]);
        }
    }
}
