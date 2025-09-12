<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCountLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_count_id',
        'item_id',
        'item_desc',
        'in_whs_quantity',
        'uom_counted',
        'counted_qty',
    ];

    public function inventoryCount()
    {
        return $this->belongsTo(InventoryCount::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}