<?php

namespace App\Models\Panel\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    public function variants()
    {
        return $this->hasMany(product_variants::class);
    }
}
