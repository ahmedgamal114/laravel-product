<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //

    public $guarded = [];


    public function client(){


        return $this->BelongsTo(client::class);
    }

    public function products(){

        return $this->BelongsToMany(product::class,'product_orders')->withPivot('quantity');


    }

}
