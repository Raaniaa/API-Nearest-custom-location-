<?php

namespace Database\Factories;

use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PharmacyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pharmacy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // rania location 30.1338824,31.2682503
            // 30.1338824,31.2682503
            'name' => $this->faker->sentence,
            'phone' => $this->faker->e164PhoneNumber,
            'address' => $this->faker->address,
            'lat' => $this->faker->randomFloat(7, 30.1338824, 31.2682503), // 30.778054,30.782433
            'lng' => $this->faker->randomFloat(7, 30.1338824, 31.2682503), //30.989893,30.988500
        ];

    }
}
