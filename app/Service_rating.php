<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_rating extends Model
{
    protected $table = 'service_rating';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
