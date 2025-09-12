<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsReceipt extends Model
{
    protected $fillable = [
        'number','document_date','employee_id','truck_no','supply_point','warehouse_id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function partner()
    {
        return $this->belongsTo(BusinessPartner::class);
    }
    public function lines()
    {
        return $this->hasMany(GoodsReceiptLine::class);
    }
}