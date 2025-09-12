<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsIssueLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'goods_issue_id',
        'item_id',
        'item_desc',
        'quantity',
        'uom_code',
        'unit_price',
    ];

    public function goodsIssue()
    {
        return $this->belongsTo(GoodsIssue::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}