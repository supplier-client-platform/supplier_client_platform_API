<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_group extends Model
{
    protected $table = 'customer_group';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
