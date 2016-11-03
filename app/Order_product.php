<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{
    protected $table = 'order_product';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
