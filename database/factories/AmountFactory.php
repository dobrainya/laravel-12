<?php

namespace Database\Factories;

use App\Models\Reference;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Amount>
 */
class AmountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $refs = Reference::all()->map(fn(Reference $ref) => $ref->id);
        return [
            'name' => $this->faker->text(),
            'amount' => $this->faker->randomFloat(15),
            'type_id' => $this->faker->randomElement($refs->toArray()),
//            'created_at' => $this->faker->dateTime()
        ];
    }
}
