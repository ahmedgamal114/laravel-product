<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class categorytranslation extends Model
{
    //


    public $timestamps = false;
    protected $fillable = ['name'];
}
