<?php

namespace App\Http\Requests\Equipment;

use App\Facades\Equipment;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Foundation\Http\FormRequest;

class EquipmentTypesIndexRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'serialNumberMask' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function getTypes(): Paginator
    {
        return Equipment::getEquipmentTypes(
            $this->get('name'),
            $this->get('serialNumberMask'),
        );
    }
}
