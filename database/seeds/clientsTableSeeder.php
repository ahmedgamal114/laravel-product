<?php

use Illuminate\Database\Seeder;

class clientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //




        $clients=['ahmed','mohamed'];
        foreach($clients as $client){

\App\client::create([

'name'=>$client,
'phone'=>'010012013',
'address'=>'portsaid',

]);


        }
    }
}
