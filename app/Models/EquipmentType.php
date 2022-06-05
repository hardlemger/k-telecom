<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'serial_number_mask'];

    public function mask(): string
    {
        return $this->serial_number_mask;
    }
}
