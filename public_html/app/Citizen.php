<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    protected $fillable = [
        'id','city', 'name', 'f_name', 'o_name',
    ];

}
