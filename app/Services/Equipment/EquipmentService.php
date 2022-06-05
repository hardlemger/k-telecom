<?php

namespace App\Services\Equipment;

use App\Models\Equipment;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class EquipmentService
{
    use EquipmentHelper;

    private const ITEMS_COUNT = 5;

    /**
     * Equipments list
     * @param string|null $serialNumber
     * @param string|null $name
     * @param string|null $note
     * @return Paginator
     */
    public function getEquipments(?string $serialNumber = NULL, ?string $name = NULL, ?string $note = NULL): Paginator
    {
        return $this->buildEquipmentsQuery($serialNumber, $name, $note)->simplePaginate(5);
    }

    /**
     * Store Equipments
     * @param array $data
     * @return Collection
     */
    public function storeEquipment(array $data): Collection
    {
        if (Arr::isAssoc($data)) {
            $collection = $this->store($data);
        } else {
            $collection = new Collection();
            foreach ($data as $datum) {
                foreach ($this->store($datum) as $item) {
                    $collection->add($item);
                }
            }
        }
        return $collection;
    }

    /**
     * Update Equipments
     * @param Equipment $equipment
     * @param string $serialNumber
     * @param string $note
     * @return Equipment
     */
    public function update(Equipment $equipment, string $serialNumber, string $note): Equipment
    {
        $equipment->update([
            'serial_number' => $serialNumber,
            'note' => $note,
        ]);
        return $equipment;
    }

    /**
     * Equipments types list
     * @param string|null $name
     * @param string|null $serialNumberMask
     * @return Paginator
     */
    public function getEquipmentTypes(?string $name = NULL, ?string $serialNumberMask = NULL): Paginator
    {
        return $this->buildEquipmentTypesQuery($serialNumberMask, $name)->simplePaginate(5);
    }

    /**
     * Validate serial number
     * @param string $mask
     * @param string $serialNumber
     * @return bool
     */
    public function validateSerialNumber(string $mask, string $serialNumber): bool
    {
        preg_match($this->getRegexByMask($mask), $serialNumber, $matches);
        return !empty($matches);
    }
}
