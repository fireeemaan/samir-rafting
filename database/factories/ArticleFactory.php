<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();

        $imageUrl = 'https://picsum.photos/640/480';
        $imageContents = file_get_contents($imageUrl);
        $imageName = 'feature_image/' . $title . '.jpg';

        Storage::disk('public')->put($imageName, $imageContents);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => fake()->paragraph(),
            'images' => [$imageName],
            'created_by' => User::factory(),
        ];
    }
}
