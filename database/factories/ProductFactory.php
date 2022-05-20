<?php

namespace Database\Factories;
use App\Models\products;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = products::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(50),
            'description' => $this->faker->text(300),
            'image' => $this->faker->text(50),
           
        ];
    }
}
