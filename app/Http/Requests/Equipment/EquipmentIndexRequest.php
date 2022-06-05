<?php

namespace App\Http\Requests\Equipment;

use App\Facades\Equipment;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Foundation\Http\FormRequest;

class EquipmentIndexRequest extends FormRequest
{
    public function rules()
    {
        return [
            'serialNumber' => ['nullable', 'string', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function getEquipments(): Paginator
    {
        return Equipment::getEquipments(
            $this->get('serialNumber'),
            $this->get('name'),
            $this->get('note'),
        );
    }
}
