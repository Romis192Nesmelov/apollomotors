<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HomePrice>
 */
class HomePriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $electedBrands = Brand::where('elected',1)->where('active',1)->pluck('id')->toArray();
        return [
            'name' => fake()->text('20'),
            'value' => rand(1000,10000),
            'active' => 1,
            'brand_id' => $electedBrands[array_rand($electedBrands)]
        ];
    }
}
