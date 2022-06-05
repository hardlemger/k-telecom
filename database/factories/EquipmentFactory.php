<?php

namespace Database\Factories;

use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'equipment_types_id' => EquipmentType::select('id')->inRandomOrder()->first()->id,
            'serial_number' => strtoupper(Str::random(10)),
            'note' => $this->faker->sentence()
        ];
    }
}
