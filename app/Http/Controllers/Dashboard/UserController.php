<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
 use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
    $this->middleware(['permission:read_users'])->only('index');
    $this->middleware(['permission:create_users'])->only('create');
    $this->middleware(['permission:update_users'])->only('edit');
    $this->middleware(['permission:delete_users'])->only('destroy');

    }

    public function index(request $request)
    {
        //

$users=User::whereRoleIs('admin')->where(function($q) use ($request){



   return $q->when($request->search,function($query) use ($request){

        return $query->where('first_name','like','%' .$request->search.'%')->OrWhere('last_name','like','%' .$request->search.'%');
        


});





})->latest()->paginate(2);

       /**if($request->search)
        {

            //dd($request->search);

            $users=User::where('first_name','like','%' .$request->search.'%')->OrWhere('last_name','like','%' .$request->search.'%')->whereRoleIs('admin')->get();

        }

        else{
        $users=User::whereRoleIs('admin')->get();
        }
        **/
        return view ('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.users.create');
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


        //dd($request->all());
        $request->validate([


'first_name'=>'required',
'last_name'=>'required',
'email'=>'required|unique:users',
'image'=>'image',
'permissions'=>'required|min:1',
'password'=>'required|confirmed',

        ]);
        $request_data =$request->except(['password','password_confirmation','permissions','image']);

         $request_data['password']= bcrypt('$request->password');


         if($request->image){


Image::make($request->image)->resize(300,null,function($constraint){


$constraint->aspectRatio();

})->save(public_path('uploads/user_image/' .$request->image->hashName()));

$request_data['image']=$request->image->hashName();
         }

$user= User::create($request_data);
$user->attachRole('admin');
$user->syncpermissions($request->permissions);


session()->flash('success',__('site.add_successfully'));


return redirect()->route('dashboard.users.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //

      
        return view('dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //

        $request->validate([


            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>['required', Rule::unique('users')->ignore($user->id)],
            'image'=>'image',
            'permissions'=>'required|min:1',
           
            
                    ]);
                    $request_data =$request->except(['permissions','image']);

                    
                    if($request->image){

                        if($user->image != 'default.png'){

                            Storage ::disk('public_uploads')->delete('/user_image/'.$user->image);


                        }


                        Image::make($request->image)->resize(300,null,function($constraint){
                        
                        
                        $constraint->aspectRatio();
                        
                        })->save(public_path('uploads/user_image/' .$request->image->hashName()));
                        
                        $request_data['image']=$request->image->hashName();
                                 }

                                 

                    $user->update($request_data);
           $user->syncpermissions($request->permissions);


session()->flash('success',__('site.edit_successfully'));


return redirect()->route('dashboard.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if($user->image != 'default.png')
        {

            Storage ::disk('public_uploads')->delete('/user_image/'.$user->image);
        }
        $user->delete();
        session()->flash('success',__('site.delete_successfully'));
        return redirect()->route('dashboard.users.index');

    }
}
