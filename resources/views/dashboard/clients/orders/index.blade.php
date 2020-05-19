

@extends('layouts.dashboard.app')


@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1> @lang('site.clients')</h1><small></small>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('site.clients')</a></li>
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
                   


                                @if(auth()->user()->haspermission('create_clients'))

   <a href="{{ route('dashboard.clients.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> @lang('site.add')</a>
   @else
<a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-plus"></i>@lang('site.add')</a>
@endif

                   
                   
                          
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                @if($clients->count() > 0)
                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                       
                             <th>@lang('site.name')</th>
                             <th>@lang('site.phone')</th>
                             <th>@lang('site.address')</th>
                         
                
                           <th>@lang('site.action')</th>
                               
                            </tr>
                            </thead>
                            
                            <tbody>
                        @foreach($clients as $index=>$client)
                                <tr>
                                <td>{{ $client->id }}</td>
                                    <td>{{ $client->name }}</td>
                                
                                    <td>{{ implode(' - ',$client->phone ) }}


                               <!-- {{$client->phone[0]}} - {{$client->phone[1]   }}
                               --></td>
                                    <td>{{ $client->address }}</td>

                                     <td>

                                      
                                     @if(auth()->user()->haspermission('update_clients'))

                                     <a href="{{route('dashboard.clients.edit', $client->id )}}" class="btn btn-info btn-sm">@lang('site.edit')</a>
                               
                                     @else
                                    
                                     <a href="#" class="btn btn-info btn-sm disabled">@lang('site.edit')</a>


                                     @endif



   @if(auth()->user()->haspermission('delete_clients'))
    <form action="{{route('dashboard.orders.destroy',$client->id)}}" method="post" style="display:inline-block">
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
  
                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
