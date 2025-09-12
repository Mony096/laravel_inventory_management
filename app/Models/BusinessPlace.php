<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPlace extends Model
{
    use HasFactory;
     protected $fillable = [
        'Name',
        'Adress',
        'AliasName',
        'Contact',
        'Administrator'
     ];
     public function goodsIssues()
    {
        return $this->hasMany(GoodsIssue::class);
    }
}