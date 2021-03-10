<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'id', 'inn', 'name', 'adress', 'tel','type_active','location'
    ];

}
