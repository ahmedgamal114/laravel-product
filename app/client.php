<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    //


    public $guarded = [];
    Protected $casts =[

'phone'=>'array',

    ];


    public function getNameAttribute($value){


        return ucfirst($value);
    }
    public function orders(){


        return $this->hasMany(Order::class);
    }
}
