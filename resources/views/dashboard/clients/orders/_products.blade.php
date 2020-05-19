


{{ products }}

<!--
    






@extends('layouts.dashboard.app')


@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1> @lang('site.orders')</h1><small></small>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('site.orders')</a></li>
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
 

                            </div>



                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                   


                                @if(auth()->user()->haspermission('create_orders'))

   <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> @lang('site.add')</a>
   @else
<a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-plus"></i>@lang('site.add')</a>
@endif

                   
                   
                          
                            </div>

                        </div>
                    </form> end of form 

                    </div> end of box header 

<div class="row">

<div class="col-md-8">

<div class="box-body">

@if($orders->count() > 0)
        <table class="table table-hover">

            <thead>
            <tr>
                <th>#</th>
       
             <th>@lang('site.name_client')</th>
             <th>@lang('site.price')</th>
     
           <th>@lang('site.action')</th>
               
            </tr>
            </thead>
            
            <tbody>
        @foreach($orders as $order)
                <tr>
                <td>{{ $order->id }}</td>
                    <td>{{ $order->client->name }}</td>

                    <td>{{ number_format($order->total_price) }}</td>
                    



            

                     <td>
                     <button class="btn btn-primary btn-sm order-products"
                                        data-url="{{ route('dashboard.orders.products', $order->id) }}"
                                        data-method="get"
                            
                                    <i class="fa fa-list"></i>
                                    @lang('site.show')
                                </button>
                              
                     @if(auth()->user()->haspermission('update_orders'))

                     <a href="{{route('dashboard.orders.edit', $order->id )}}" class="btn btn-info btn-sm">@lang('site.edit')</a>
               
                     @else
                 
                     <a href="#" class="btn btn-info btn-sm disabled">@lang('site.edit')</a>


                     @endif



@if(auth()->user()->haspermission('delete_orders'))
<form action="{{route('dashboard.orders.destroy',$order->id)}}" method="post" style="display:inline-block">
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

        </table>end of table 
        
   
        @else

        <h2>@lang('site.no_data_found')</h2>
        @endif
        {{ $orders->appends(request()->query())->links() }}


</div>

<div class="col-md-4">

    <div class="box box-primary">

        <div class="box-header">
            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.show_products')</h3>
        </div>

        <div class="box-body">

            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                <div class="loader"></div>
                <p style="margin-top: 10px">@lang('site.loading')</p>
            </div>

            <div id="order-product-list">

            </div>end of order product list 

        </div> end of box body 

    </div> end of box 

</div> end of col 


</div>

</section> end of content 

</div> end of content wrapper 


@endsection


-->