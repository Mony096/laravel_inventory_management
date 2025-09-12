<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'location',
    ];

    public function goodsReceipts()
    {
        return $this->hasMany(GoodsReceipt::class);
    }

    public function goodsIssues()
    {
        return $this->hasMany(GoodsIssue::class);
    }

    public function inventoryCounts()
    {
        return $this->hasMany(InventoryCount::class);
    }

    public function inventoryPostings()
    {
        return $this->hasMany(InventoryPosting::class);
    }
}