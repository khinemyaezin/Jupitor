<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuotationFactory extends Factory
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
            'biz_status'=> 6,
            'name' =>  $this->faker->userName,
            'email'=>$this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
           
            'message'=>''
        ];
    }
}
