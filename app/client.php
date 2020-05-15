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
}
