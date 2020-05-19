<?php

namespace App\Http\Controllers\Dashboard\client;



use App\order;
use App\client;
use App\category;
use App\product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class orderController extends Controller
{
    //



    public function index(order $order){




    }
    
    public function create(client $client){

        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.create', compact( 'client', 'categories', 'orders'));


    }
    
    public function store(request $request,client $client){


        $request->validate([
            'products' => 'required|array',
        ]);

        $this->attach_order($request, $client);


// $request->validate([
//     'products'=>'required|array',
//    // 'quantities'=>'required|array',

// ]);



// $order =$client->orders()->create([]);

// $order->products()->attach($request->products);


// $total_price=0;


// foreach($request->products as $id=>$quantity)

// {

// $product =Product ::FindOrFail($id);

// $total_price += $product->sale_price* $quantity['quantity'];




// $product->update([

// 'stock'=>$product->stock - $quantity['quantity']

// ]);

// }


// $order->update(['total_price'=>$total_price
//     ]);
    


session()->flash('success',__('site.add_successfully'));


return redirect()->route('dashboard.orders.index');



//rder->products()->attach($product,['quantity'=>$request->quantities[$index]]);

//}
        //dd($request->all());



    }
    
    public function edit(client $client,order $order){

        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);

        return view('dashboard.clients.orders.edit', compact( 'client', 'categories', 'orders','order'));


    }

    public function update(request $request ,client $client, Order $order){


        $request->validate([
            'products' => 'required|array',
        ]);

        $this->detach_order($order);

        $this->attach_order($request, $client);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.orders.index');

    }



        
        private function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::FindOrFail($id);


            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);

        }//end of foreach

        $order->update([
            'total_price' => $total_price
        ]);

    }//end of attach order

    private function detach_order($order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);

        }
    }

  

}
