<?php

namespace App\Models\Panel\Products;

use App\Models\CartItem;
use App\Models\Home\Favorite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_variants extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function color()
{
    return $this->belongsTo(Color::class);
}

public function size()
{
    return $this->belongsTo(Size::class);
}
public function product()
{
    return $this->belongsTo(product::class);
}
public function cartItems()
{
    return $this->hasMany(CartItem::class);
}
public function favorites()
{
    return $this->hasMany(Favorite::class);
}

}
