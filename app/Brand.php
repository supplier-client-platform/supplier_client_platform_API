<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
