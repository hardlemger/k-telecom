<?php

namespace App\Http\Requests\Equipment;

use App\Facades\Equipment as EquipmentFacade;
use App\Http\Requests\ApiRequest;
use App\Models\Equipment;
use App\Rules\EquipmentSerialNumberRole;

class EquipmentUpdateRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'serialNumber' => ['required', 'string', 'unique:equipment,serial_number', new EquipmentSerialNumberRole($this->route('equipment')->type)],
            'note' => ['required', 'string', 'max:255']
        ];
    }

    public function updateEquipment(): Equipment
    {
        /** @var Equipment $equipment */
        $equipment = $this->route('equipment');
        return EquipmentFacade::update(
            $equipment,
            $this->input('serialNumber'),
            $this->input('note'),
        );
    }
}
