<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blueprint extends Model
{
    use HasFactory;

    protected $table = 'industryBlueprints';
    protected $primaryKey = 'typeID';

    public function item()
    {
        return $this->hasOne(Item::class, 'typeID', 'typeID');
    }
    public function product(){
        return $this->hasOneThrough(Item::class, Product::class, 'typeID', 'typeID', 'typeID', 'productTypeID')->where('industryActivityProducts.activityID', '=', '1');
    }

    public function materials(){
        return $this->belongsToMany(Item::class, 'industryActivityMaterials', 'typeID', 'materialTypeID')->withPivot('quantity');
    }

    public function BaseCost(){
        $cost = 0;
        foreach($this->materials as $mat){
            $cost = $cost + ($mat->basePrice * $mat->pivot->quantity);
        }
        return $cost;
    }

}
