<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        //'slug',
    ];

    public function articles()
    {
    	return $this->belongsTo(Articles::class);//->orderBy('created_at','DESC')->paginate(5);
    }


    public function likes()

    {
        return $this->belongsTo(User::class);
    }
    // public function getRouteKeyName()
    // {
    // 	return 'slug';
    // }  
}
