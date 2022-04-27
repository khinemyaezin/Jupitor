<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleHeaderFactory extends Factory
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
            'title' =>  $this->faker->jobTitle,
            'short_desc'=>$this->faker->paragraph,
            'long_desc' => $this->faker->paragraph,
            'theme_style' => 1,
        ];
    }
}
