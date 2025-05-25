<?php

namespace App\Models\blog;

use App\Models\user;
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
    public function users()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
