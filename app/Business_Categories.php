<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business_Categories extends Model
{
    protected $table = 'supplier_category';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
