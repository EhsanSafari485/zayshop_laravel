<?php

namespace App\Models\Panel\Products;

use App\Models\Panel\Category;
use App\Models\Panel\products\attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function stock()
    {
        return $this->hasOne(product_variants::class);
    }
    public function variants()
    {
        return $this->hasMany(product_variants::class);
    }

    public function category()
    {
    return $this->belongsTo(Category::class);
    }

    public function images()
    {
    return $this->hasMany(product_image::class);
    }
    public function attributes()
    {
    return $this->hasMany(attribute::class);
    }


}
