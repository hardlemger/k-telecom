<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Contracts\Pagination\Paginator getEquipments(?string $serialNumber = NULL, ?string $name = NULL, ?string $note = NULL)
 * @method static \Illuminate\Database\Eloquent\Collection storeEquipment(array $data)
 * @method static \App\Models\Equipment update(\App\Models\Equipment $equipment, string $serialNumber, string $note)
 * @method static \Illuminate\Contracts\Pagination\Paginator getEquipmentTypes(?string $name = NULL, ?string $serialNumberMask = NULL)
 * @method static bool validateSerialNumber(string $mask, string $serialNumber)
 */

class Equipment extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'equipment';
    }
}
