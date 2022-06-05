<?php

namespace App\Services\Equipment;

use App\Models\Equipment;
use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

trait EquipmentHelper
{
    /**
     * Prepare query for fetching Equipments
     * @param string|null $serialNumber
     * @param string|null $name
     * @param string|null $note
     * @return Builder
     */
    protected function buildEquipmentsQuery(?string $serialNumber = NULL, ?string $name = NULL, ?string $note = NULL): Builder
    {
        $builder = Equipment::query();
        if (!is_null($serialNumber)) {
            $builder->where('serial_number', 'LIKE', "%$serialNumber%");
        }
        if (!is_null($name)) {
            $builder->whereHas('type', function ($query) use ($name) {
                return $query->where('name', 'LIKE', "%$name%");
            });
        }
        if (!is_null($note)) {
            $builder->where('note', 'LIKE', "%$note%");
        }
        return $builder;
    }

    /**
     * Prepare query for fetching equipment types
     * @param string|null $serialNumberMask
     * @param string|null $name
     * @return Builder
     */
    protected function buildEquipmentTypesQuery(?string $serialNumberMask = NULL, ?string $name = NULL): Builder
    {
        $builder = EquipmentType::query();
        if (!is_null($serialNumberMask)) {
            $builder->where('serial_number_mask', 'LIKE', "%$serialNumberMask%");
        }
        if (!is_null($name)) {
            $builder->where('name', 'LIKE', "%$name%");
        }
        return $builder;
    }

    /**
     * Generate regex pattern by serial number mask
     * @param string $mask
     * @return string
     */
    protected function getRegexByMask(string $mask): string
    {
        $pattern = '';
        $maskSplit = str_split($mask);
        foreach ($maskSplit as $item) {
            $pattern .= config("equipment.mask.$item");
        }
        return "/(^$pattern)$/";
    }

    /**
     * Store Equipment to database
     * @param array $data
     * @return Collection
     */
    protected function store(array $data): Collection
    {
        $collection = new Collection();
        foreach ($data['serialNumbers'] as $serialNumber) {
            $equipment = Equipment::create([
                'equipment_types_id' => $data['equipmentTypeId'],
                'serial_number' => $serialNumber,
                'note' => $data['note'],
            ]);
            $collection->push($equipment);
        }
        return $collection;
    }
}
