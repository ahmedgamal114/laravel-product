<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
class product extends Model
{
    //
    use Translatable;
    public $guarded = [];
    protected $appends=['image_path','profit_percent'];


    public $translatedAttributes = ['name','description'];



    public function category(){


        return $this->BelongsTo (category::class );


    }
    public function getImagePathAttribute($value){


        return asset('uploads/product_images/'.$this->image);
        
            }

            public function getProfitPercentAttribute($value){


               $profit = $this->sale_price -$this->purchase_price;

         $profit_percent =$profit *100/$this->purchase_price;

         return number_format($profit_percent,2);

                
                    }


                    public function orders(){

                        return $this->BelongsToMany(order::class,'product_orders');
                
                
                    }

                    

}
