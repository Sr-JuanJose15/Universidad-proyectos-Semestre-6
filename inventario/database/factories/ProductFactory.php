<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'sku' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'category' => $this->faker->word(),
            'supplier' => $this->faker->word(),
            'purchase_price' => $this->faker->randomFloat(2, 1, 100),
            'sale_price' => $this->faker->randomFloat(2, 1, 100),
            'acquisition_date' => $this->faker->date(),
            'quantity_in_stock' => $this->faker->numberBetween(1, 100),
            'min_quantity' => $this->faker->numberBetween(1, 10),
            'max_quantity' => $this->faker->numberBetween(10, 100),
        ];
    }
}
