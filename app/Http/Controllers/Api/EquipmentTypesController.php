<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\EquipmentTypesIndexRequest;
use App\Http\Resources\Equipment\EquipmentTypeResource;

class EquipmentTypesController extends Controller
{
    /**
     * Equipment types list
     * @param EquipmentTypesIndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(EquipmentTypesIndexRequest $request)
    {
        return EquipmentTypeResource::collection($request->getTypes());
    }
}
