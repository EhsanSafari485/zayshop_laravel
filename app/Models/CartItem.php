<?php

namespace App\Models;

use App\Models\Panel\Products\product_variants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable=['user_id','product_variant_id','quantity'];

    public function variant()
{
    return $this->belongsTo(product_variants::class,'product_variant_id');
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
