<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'email',
        'phone',
        'address',
        'position',
        'salary',
        'hire_date',
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
}