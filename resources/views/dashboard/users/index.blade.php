

@extends('layouts.dashboard.app')


@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1> @lang('site.users')</h1><small>{{ $users->total() }}</small>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('site.users')</a></li>
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
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                   
                                @if(auth()->user()->haspermission('create_users'))
                                <a href="{{ route('dashboard.users.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> @lang('site.add')</a>
@else
<a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-plus"></i>@lang('site.add')</a>

@endif
                   
                   
                          
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                @if($users->count() > 0)
                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.first_name')</th>
                                <th>@lang('site.last_name')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.action')</th>
                               
                            </tr>
                            </thead>
                            
                            <tbody>
                        @foreach($users as $index=>$user)
                                <tr>
                                <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td> 

                                     <td>{{ $user->email }}</td>  
                                     <td><img src="{{ $user->image_path }}" width="100px" class="img-thumnail"></td>
                                     <td>
                                         

                                     @if(auth()->user()->haspermission('update_users'))

                                     <a href="{{route('dashboard.users.edit', $user->id )}}" class="btn btn-info btn-sm">@lang('site.edit')</a>
                                     @else
                                     <a href="#" class="btn btn-info btn-sm disabled">@lang('site.edit')</a>

           @endif
           @if(auth()->user()->haspermission('delete_users'))
                                 
    <form action="{{route('dashboard.users.destroy',$user->id)}}" method="post" style="display:inline-block">
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
          
        {{ $users->appends(request()->query())->links() }}
                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
