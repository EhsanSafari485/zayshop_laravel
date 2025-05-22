<?php

namespace App\Models;

use App\Models\Panel\Products\product_variants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderItem extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function order()
{
    return $this->belongsTo(order::class);
}

public function variant()
{
    return $this->belongsTo(product_variants::class, 'product_variant_id');
}

}
