<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        "title",
        'body',
       // 'slug',
    ];

    public function likes()
    {   // select * from like where article_id = 
    	return $this->hasMany(Like::class)->withTimestamps();
    }

    public function categories()
    {
    	return $this->belongsToMany(Category::class)->withTimestamps();
    }

   public function user()
   {
       return $this->belongsTo(User::class);
   }

   public function comments()
   {
       return $this->hasMany(Comment::class);
   }
}
