<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['equipment_types_id', 'serial_number', 'note'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class, 'equipment_types_id');
    }
}
