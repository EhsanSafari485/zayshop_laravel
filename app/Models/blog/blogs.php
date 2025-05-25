<?php

namespace App\Models\blog;

use App\Models\user;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function category()
    {
        return $this->belongsTo(blogCategories::class);
    }
        public function users()
    {
        return $this->belongsTo(user::class,'writer_id');
    }

    public function comments()
    {
        return $this->hasMany(blogComments::class, 'blog_id');
    }

}
