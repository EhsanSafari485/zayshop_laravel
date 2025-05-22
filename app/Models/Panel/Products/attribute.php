<?php

namespace App\Models\Panel\products;

use App\Models\Panel\Products\product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attribute extends Model
{
    use HasFactory;
    protected $fillable=['attribute','product_id'];
    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
