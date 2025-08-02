<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $title = fake()->sentence(3);

        $imageUrl = 'https://picsum.photos/640/480';
        $imageContents = file_get_contents($imageUrl);
        $imageName = 'package_images/' . $title . '.jpg';

        Storage::disk('public')->put($imageName, $imageContents);
        return [
            //
        ];
    }
}
