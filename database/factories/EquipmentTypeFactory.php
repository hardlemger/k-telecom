<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentType>
 */
class EquipmentTypeFactory extends Factory
{
    private const NAMES = ['TP-Link TL-WR74', 'D-Link DIR-300', 'D-Link DIR-300 E'];
    private const MASKS = ['XXAAAAAXAA', 'NXXAAXZXaa', 'NAAAAXZXXX'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => Arr::random(self::NAMES),
            'serial_number_mask' => Arr::random(self::MASKS)
        ];
    }
}
