<?php

namespace App\Models\blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogComments extends Model
{
    use HasFactory;
        protected $guarded = [];

    public function blog()
    {
        return $this->belongsTo(blogs::class);
    }
}
