<?php

use Illuminate\Database\Seeder;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

$products=['product one','product two','product three'];



foreach($products as $product){

\App\Product ::create([


    'category_id'=>'1',
    'ar'=>['name'=>$product,'description'=>$product.'des'],
    'en'=>['name'=>$product,'description'=>$product.'des'],
    'purchase_price'=>'100',
    'sale_price'=>'150',
    'stock'=>'100',
    




]);



}









    }
}
