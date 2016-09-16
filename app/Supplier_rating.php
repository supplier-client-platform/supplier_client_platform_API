<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier_rating extends Model
{
    protected $table = 'supplier_rating';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
