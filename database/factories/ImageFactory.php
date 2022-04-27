<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status'=> 2,
            'biz_status'=> 2,
            'name'=> $this->faker->word,
            'url'=> $this->faker->image(public_path('storage\images'),640,480, null, false),
        ];
    }
}
