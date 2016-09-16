<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_rating extends Model
{
    protected $table = 'product_rating';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
