<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        $categories=['category one','category two',
        'category three'];


        foreach($categories as $category){

            \App\Category::create([

'ar'=>['name'=>$category],

'en'=>['name'=>$category]





            ]);
        }
  
    }
}
