<?php

namespace App\Rules;

use App\Facades\Equipment;
use App\Models\EquipmentType;
use Illuminate\Contracts\Validation\Rule;

class EquipmentSerialNumberRole implements Rule
{
    private EquipmentType $equipmentType;
    private array $data;
    private string $invalidSerialNumber;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array|int|EquipmentType $equipmentType)
    {
        if (is_array($equipmentType)) {
            $this->data = $equipmentType;
        } else {
            $this->equipmentType = $equipmentType instanceof EquipmentType ? $equipmentType : EquipmentType::find($equipmentType);
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (isset($this->data)) {
            $this->findEquipmentTypeByValue($value);
        }
        if (!Equipment::validateSerialNumber($this->equipmentType->mask(), $value)) {
            $this->invalidSerialNumber = $value;
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return "The serial number ($this->invalidSerialNumber) does not match {$this->equipmentType->mask()} mask";
    }

    private function findEquipmentTypeByValue(string $value)
    {
        $objects = array_filter($this->data, function ($item) use ($value) {
            return in_array($value, $item['serialNumbers']);
        });
        $object = array_shift($objects);
        $this->equipmentType = EquipmentType::find($object['equipmentTypeId']);
    }
}
