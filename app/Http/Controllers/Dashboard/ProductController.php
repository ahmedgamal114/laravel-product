<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\product;
use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
 use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //


        $categories= category::all();


        $products=product::when($request->search,function($q) use ($request){


            return $q->WhereTranslationLike('name','%' .$request->search.'%');

        })->when($request->category_id,function($q) use($request){


            return $q->where('category_id',$request->category_id);

        }) ->latest()->paginate(5);
        
     return view('dashboard.products.index',compact(['products','categories']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('dashboard.products.create',compact('categories'));

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
        $rules=[

'category_id'=>'required',


        ];

        foreach( config('translatable.locales') as $locale)
        {


            $rules += [$locale . '.name'=>'required|unique:product_translations,name'];
            $rules += [$locale . '.description'=>'required'];
        }
        $rules=[

            'category_id'=>'required',
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required',


        ];
        $request->validate($rules);

        $request_data =$request->all();

        if($request->image){


            Image::make($request->image)->resize(300,null,function($constraint){
            
            
            $constraint->aspectRatio();
            
            })->save(public_path('uploads/product_images/' .$request->image->hashName()));
            
            $request_data['image']=$request->image->hashName();
                     }



                     $product= product::create($request_data);


session()->flash('success',__('site.add_successfully'));


return redirect()->route('dashboard.products.index');

                     






    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
        $categories = Category::all();

        return view('dashboard.products.edit',compact(['product','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //

        $rules=[

            'category_id'=>'required',
            
            
                    ];
            
                    foreach( config('translatable.locales') as $locale)
                    {
            
            
                        $rules += [$locale . '.name'=>'required|unique:product_translations,name'];
                        $rules += [$locale . '.description'=>'required'];
                    }
                    $rules=[
            
                        'category_id'=>'required',
                        'purchase_price'=>'required',
                        'sale_price'=>'required',
                        'stock'=>'required',
            
            
                    ];
                   
            
                    
            
                    $request_data =$request->all();

                    $request->validate($rules);

                     
                    if($request->image){

                        if($product->image != 'default.png'){

                            Storage ::disk('public_uploads')->delete('/product_images/'.$product->image);


                        }


                        Image::make($request->image)->resize(300,null,function($constraint){
                        
                        
                        $constraint->aspectRatio();
                        
                        })->save(public_path('uploads/product_images/' .$request->image->hashName()));
                        
                        $request_data['image']=$request->image->hashName();
                                 }


                   
                                 $product->update($request_data);
                     
            
            session()->flash('success',__('site.add_successfully'));
            
            
            return redirect()->route('dashboard.products.index');
            


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //

        if($product->image != 'default.png')
        {

            Storage ::disk('public_uploads')->delete('/product_images/'.$product->image);
        }
        $product->delete();
        session()->flash('success',__('site.delete_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}
