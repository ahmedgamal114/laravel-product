<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;

class category extends Model
{
    //
    use Translatable;
  
public $guarded = [];

    public $translatedAttributes = ['name'];



    public function products(){




        return $this->hasMany(Product :: class);
    }

}
