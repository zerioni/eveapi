<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'industryActivityProducts';

    public function blueprint(){
        return $this->belongsTo(Blueprint::class, 'typeID', 'typeID');
    }
    public function item(){
        return $this->hasOne(Item::class, 'typeID', 'productTypeID');
    }
}
