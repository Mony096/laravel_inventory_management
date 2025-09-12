<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'count_date',
        'count_time',
        'count_type',
        'inventory_counter_user',
        'status',
        'warehouse_id',
        'attachment',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function lines()
    {
        return $this->hasMany(InventoryCountLine::class);
    }
}