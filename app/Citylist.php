<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citylist extends Model
{
    protected $table = 'city_list';
    protected $fillable = [
        'city'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
