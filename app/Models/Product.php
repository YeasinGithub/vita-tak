<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Tax;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function productQties(){
        return $this->hasMany(ProductQuantity::class,'product_id','id');
    }

    public function attachments(){
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

    public function tax(){
        return $this->belongsTo(Tax::class,'tax_id','id');
    }
}
