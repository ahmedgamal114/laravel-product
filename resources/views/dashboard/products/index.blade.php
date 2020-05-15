

@extends('layouts.dashboard.app')


@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1> @lang('site.products')</h1><small>{{ $products->total() }}</small>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('site.products')</a></li>
                <li class="active"></li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px"><small></small></h3>

                    <form method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control"  value="{{ request()->search }}" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                            <select name="category_id" class="form_control" >
<option value="">@lang('site.all_categories')</option>

@foreach($categories as $category)

<option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected': ' '  }} >{{ $category->name }}</option>

@endforeach 
</select>

                            </div>



                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                   


                                @if(auth()->user()->haspermission('create_products'))

   <a href="{{ route('dashboard.products.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> @lang('site.add')</a>
   @else
<a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-plus"></i>@lang('site.add')</a>
@endif

                   
                   
                          
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                @if($products->count() > 0)
                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                       
                             <th>@lang('site.name_product')</th>
                             <th>@lang('site.description')</th>
                             <th>@lang('site.image')</th>
                             <th>@lang('site.purchase_price')</th>
                             <th>@lang('site.sale_price')</th>
                             <th>@lang('site.profit')</th>
                              <th>@lang('site.category')</th>
                
                           <th>@lang('site.action')</th>
                               
                            </tr>
                            </thead>
                            
                            <tbody>
                        @foreach($products as $index=>$product)
                                <tr>
                                <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{!! $product->description  !!}</td>
                                    <td><img src="{{ $product->image_path }}" width="100px" class="img-thumnail"></td>
                            

                                    <td>{{ $product->purchase_price }}</td>

                                   
                                    <td>{{ $product->profit_percent}}%</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>{{ $product->category->name }}</td>

                                     <td>

                                      
                                     @if(auth()->user()->haspermission('update_products'))

                                     <a href="{{route('dashboard.products.edit', $product->id )}}" class="btn btn-info btn-sm">@lang('site.edit')</a>
                               
                                     @else
                                    
                                     <a href="#" class="btn btn-info btn-sm disabled">@lang('site.edit')</a>


                                     @endif



   @if(auth()->user()->haspermission('delete_products'))
    <form action="{{route('dashboard.products.destroy',$product->id)}}" method="post" style="display:inline-block">
    {{ csrf_field() }}
    {{ method_field('delete') }}
    <button type="submit" class="btn btn-danger delete btn-sm"> @lang('site.delete')

    </button>
    

</button>

</form>


@else
<a href="#" class="btn btn-danger btn-sm disabled">@lang('site.delete')</a>

@endif

           
                                     
 
                                     </td>
                                    

                                   
                                </tr>
                            @endforeach
                        
                            </tbody>

                        </table><!-- end of table -->
                        
                   
                        @else

                        <h2>@lang('site.no_data_found')</h2>
                        @endif
          
        {{ $products->appends(request()->query())->links() }}
                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
