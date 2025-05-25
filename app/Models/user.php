<?php

namespace App\Models;

use App\Models\blog\blogComments;
use App\Models\blog\blogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class user extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'password','role','phone','address'];

    protected $hidden = ['password'];

        public function blogs()
    {
        return $this->hasMany(blogs::class);
    }
    public function comments()
    {
        return $this->hasMany(blogComments::class);
    }
}
