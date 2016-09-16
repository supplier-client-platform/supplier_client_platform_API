<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
