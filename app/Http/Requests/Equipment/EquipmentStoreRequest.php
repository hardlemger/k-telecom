<?php

namespace App\Http\Requests\Equipment;

use App\Http\Requests\ApiRequest;
use App\Models\Equipment;
use App\Facades\Equipment as EquipmentFacade;
use App\Rules\EquipmentSerialNumberRole;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class EquipmentStoreRequest extends ApiRequest
{
    public function rules()
    {
        return [
            Arr::isAssoc($this->all()) ? 'equipmentTypeId' : '*.equipmentTypeId' => ['required', 'integer', 'exists:equipment_types,id'],
            Arr::isAssoc($this->all()) ? 'serialNumbers' : '*.serialNumbers' => ['required', 'array'],
            Arr::isAssoc($this->all())
                ? 'serialNumbers.*'
                : '*.serialNumbers.*' => [
                    'required', 'string', 'max:255', 'unique:equipment,serial_number',
                    new EquipmentSerialNumberRole(Arr::isAssoc($this->all()) ? $this->input('equipmentTypeId') : $this->all())
            ],
            Arr::isAssoc($this->all()) ? 'note' : '*.note' => ['required', 'string', 'max:255']
        ];
    }

    public function storeEquipment(): Collection
    {
        return EquipmentFacade::storeEquipment($this->all());
    }
}
