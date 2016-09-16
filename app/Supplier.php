<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
