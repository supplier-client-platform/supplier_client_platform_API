<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//product categories
class Category extends Model
{
    protected $table = 'category';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
