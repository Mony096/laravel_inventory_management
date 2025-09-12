<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'document_date',
        'employee_id',
        'truck_no',
        'ship_to',
        'warehouse_id',
        'attachment',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function place()
    {
        return $this->belongsTo(BusinessPlace::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function lines()
    {
        return $this->hasMany(GoodsIssueLine::class);
    }
}