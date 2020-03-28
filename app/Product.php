<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'image',
        'price',
        'price_discount',
        'rating_average',
        'rating_quantity',

    ];

    public function  author() {
        return $this->belongsTo(Author::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function getPriceProduct () {
        if (!$this->discount_price) return $this->discount_price;
        return $this->price;
    }
}
