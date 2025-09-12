<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code',
        'item_desc',
        'uom_code',
        'unit_price',
        'quantity_on_stock',
    ];

    public function goodsReceiptLines()
    {
        return $this->hasMany(GoodsReceiptLine::class);
    }

    public function goodsIssueLines()
    {
        return $this->hasMany(GoodsIssueLine::class);
    }

    public function inventoryCountLines()
    {
        return $this->hasMany(InventoryCountLine::class);
    }

    public function inventoryPostingLines()
    {
        return $this->hasMany(InventoryPostingLine::class);
    }
}
