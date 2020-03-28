<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const PAID_INVOICE = 'Đã thanh toán';
    const UNPAID_INVOICE = 'Chưa thanh toán';

    const SHIPPED = 'Đã giao hàng';
    const NOT_SHIPPED = "Chưa giao hàng";
    //
    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'note',
        'ship_status',
        'paid_status',
    ];

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function isPaid () {
        return $this->paid_status == Order::PAID_INVOICE;
    }

    public function isShipped () {
        return $this->ship_status == Order::SHIPPED;
    }
}
