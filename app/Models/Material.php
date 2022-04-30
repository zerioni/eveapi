<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'industryActivityMaterials';

    public function Blueprints(){
        return $this->belongsToMany(Blueprint::class);
    }

    public function item(){
        return $this->hasOne(Item::class, 'typeID', 'materialTypeID');
    }

}
