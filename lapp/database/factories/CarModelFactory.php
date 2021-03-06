<?php

namespace Database\Factories;

use App\Models\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;


class CarModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CarModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = 'Asia/Baku'),
            'updated_at' => $this->faker->dateTime($max = 'now', $timezone = 'Asia/Baku')
        ];
    }
}
