<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\client;
use Illuminate\Http\Request;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

$clients=client:: when($request->search,function($q) use ($request){

  return $q->where('name','Like' ,'%'.$request->search.'%')->orwhere('phone','like','%'.$request->search.'%')->orwhere(

'address','like','%'.$request->search.'%' );


})->latest()->paginate(5);

        return view('dashboard.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        $request->validate([


            'name'=>'required',
            'phone'=>'required|array|min:1',
            'phone.0'=>'required',
            'address'=>'required',
          
            
                    ]);
                    $request_data =$request->all();


                    $request_data['phone']=array_filter($request->phone);

                   client::create($request_data);



session()->flash('success',__('site.add_successfully'));


return redirect()->route('dashboard.clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(client $client)
    {
        //
        return view('dashboard.clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, client $client)
    {
        //

        $request->validate([


            'name'=>'required',
            'phone'=>'required|array|min:1',
            'phone.0'=>'required',
            'address'=>'required',
          
            
                    ]);
                    $request_data =$request->all();


                    $request_data['phone']=array_filter($request->phone);


                   $client->update($request_data);



session()->flash('success',__('site.add_successfully'));


return redirect()->route('dashboard.clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(client $client)
    {
        //

        $client->delete();
        session()->flash('success',__('site.delete_successfully'));
        return redirect()->route('dashboard.clients.index');
    
    }
}
