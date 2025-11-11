<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HeroSection>
 */
class HeroSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'subtitle' => $this->faker->optional()->sentence(10),
            'button_text' => $this->faker->optional()->words(2, true),
            'button_url' => $this->faker->optional()->url(),
            'background_image' => null,
            'is_active' => true,
        ];
    }
}
