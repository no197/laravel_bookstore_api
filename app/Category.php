<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Mass asignment
    protected $fillable=[
        'name',
        'description',
    ];

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
