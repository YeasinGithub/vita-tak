<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuantity extends Model
{
    use HasFactory;
    public function warehouse(){
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }

}
