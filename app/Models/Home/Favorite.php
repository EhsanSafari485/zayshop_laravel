<?php

namespace App\Models\Home;

use App\Models\Panel\Products\product;
use App\Models\Panel\Products\product_variants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable=['product_id','user_id'];
    public function variant()
{
    return $this->belongsTo(product_variants::class);
}

public function product()
{
    return $this->belongsTo(product::class);
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
