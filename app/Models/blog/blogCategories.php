<?php

namespace App\Models\blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogCategories extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function blogs()
    {
        return $this->hasMany(blogs::class);
    }
}
