<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\EquipmentIndexRequest;
use App\Http\Requests\Equipment\EquipmentStoreRequest;
use App\Http\Requests\Equipment\EquipmentUpdateRequest;
use App\Http\Resources\Equipment\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EquipmentController extends Controller
{
    /**
     * Get equipment list
     * @param EquipmentIndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(EquipmentIndexRequest $request): AnonymousResourceCollection
    {
        return EquipmentResource::collection(
            $request->getEquipments()
        );
    }

    /**
     * Store new equipments
     * @param EquipmentStoreRequest $request
     * @return JsonResponse
     */
    public function store(EquipmentStoreRequest $request): JsonResponse
    {
        return response()->json(
            EquipmentResource::collection($request->storeEquipment()),
            201
        );
    }

    /**
     * Get equipment
     * @param Equipment $equipment
     * @return JsonResponse
     */
    public function show(Equipment $equipment): JsonResponse
    {
        return response()->json(new EquipmentResource($equipment));
    }

    /**
     * Update equipment
     * @param EquipmentUpdateRequest $request
     * @param Equipment $equipment
     * @return JsonResponse
     */
    public function update(EquipmentUpdateRequest $request, Equipment $equipment): JsonResponse
    {
        return response()->json(
            new EquipmentResource($request->updateEquipment())
        );
    }

    /**
     * Delete equipment
     * @param Equipment $equipment
     * @return JsonResponse
     */
    public function destroy(Equipment $equipment): JsonResponse
    {
        $equipment->delete();
        return response()->json(['status' => 'success']);
    }
}
