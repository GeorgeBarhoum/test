<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
       // 'slug',
    ];

  

    public function article()
    {
    	return $this->belongsToMany(Articles::class);//->orderBy('created_at','DESC')->paginate(5);
    }

    // public function getRouteKeyName()
    // {
    // 	return 'slug';
    // }
}
