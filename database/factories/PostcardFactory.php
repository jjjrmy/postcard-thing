<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Postcard>
 */
class PostcardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'name' => fake()->name(),
            'address_1' => fake()->streetAddress(),
            'address_2' => fake()->optional(0.3)->secondaryAddress(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'zip' => fake()->postcode(),
            'message' => fake()->paragraphs(2, true),
            'image_caption' => fake()->optional(0.7)->sentence(),
            'image_url' => fake()->imageUrl(640, 480, 'nature'),
            'published_at' => fake()->optional(0.8)->dateTimeBetween('-1 year', 'now'),
            'first_viewed_at' => fake()->optional(0.6)->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
