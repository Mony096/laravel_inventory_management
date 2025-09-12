<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'CardCode',
        'CardName',
        'CardType',
        'Address',
        'PhoneNumber',
    ];
       public function goodsReceipts()
    {
        return $this->hasMany(GoodsReceipt::class);
    }
}