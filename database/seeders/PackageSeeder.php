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
                'name' => 'Paket Ceria Rafting Samir (Pemula)',
                'price' => 250000,
                'description' => 'Rasakan keseruan mengarungi jeram Sungai Samir yang aman untuk pemula dan keluarga. Nikmati pemandangan alam pedesaan Situbondo yang asri di sepanjang rute pendek yang menyegarkan. Cocok untuk pengalaman arung jeram pertama Anda.',
                'thumbnail' => 'thumbnails/rafting-ceria.jpg',
                'facilities' => json_encode([
                    ['facility' => 'Perlengkapan arung jeram standar'],
                    ['facility' => 'Pemandu profesional'],
                    ['facility' => 'Asuransi'],
                    ['facility' => 'Kelapa muda segar setelah finish'],
                    ['facility' => 'Transportasi lokal ke start point']
                ]),
            ],
            [
                'name' => 'Paket Petualang Rafting Samir (Menengah)',
                'price' => 375000,
                'description' => 'Bagi Anda yang mencari tantangan lebih, paket ini menawarkan rute yang lebih panjang dengan jeram-jeram yang lebih menantang. Pacu adrenalin Anda dan taklukkan arus Sungai Samir bersama tim yang solid. Pengalaman seru yang tak terlupakan!',
                'thumbnail' => 'thumbnails/rafting-petualang.jpg',
                'facilities' => json_encode([
                    ['facility' => 'Semua fasilitas Paket Ceria'],
                    ['facility' => 'Makan siang prasmanan khas lokal'],
                    ['facility' => 'Dokumentasi foto dan video'],
                    ['facility' => 'Snack dan air mineral']
                ]),
            ],
            [
                'name' => 'Paket Ekstrem Rafting Samir (Profesional)',
                'price' => 550000,
                'description' => 'Taklukkan rute terpanjang dan jeram paling ganas di Sungai Samir! Paket ini dirancang khusus untuk para pecandu adrenalin dan rafter berpengalaman. Didampingi oleh tim penyelamat ahli, rasakan sensasi maksimal dari hulu hingga hilir sungai.',
                'thumbnail' => 'thumbnails/rafting-ekstrem.jpg',
                'facilities' => json_encode([
                    ['facility' =>'Semua fasilitas Paket Petualang'],
                    ['facility' => 'Pemandu dan tim rescue khusus'],
                    ['facility' => 'Sertifikat penakluk jeram'],
                    ['facility' => 'Welcome drink dan souvenir eksklusif']
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
