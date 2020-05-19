


@extends('layouts.dashboard.app')


@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1> @lang('site.add')</h1>

            <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="#"> @lang('site.clients')</a></li>
                <li class="active"><a href="#"> @lang('site.edit')</a></li>
                <li ></li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px"><small></small></h3>

                   

                </div><!-- end of box header -->

    <div class="box-body">
               
@include('partials._errors')
 <form action="{{ route('dashboard.clients.update',$client->id) }}" method="post" enctype="multipart/form-data">


{{ csrf_field() }}
{{ method_field('put') }}

<div class="form-group">





<div class="form-group">
    <label>@lang('site.name')</label>
    <input type="text" name="name" class="form-control" value="{{ $client->name }}">
</div>


@for ($i =0; $i<2 ; $i++)
<div class="form-group">
    <label>@lang('site.phone')</label>
    <input type="text" name="phone[]" class="form-control" value="{{  $client->phone[$i] ?? '' }}" >
</div>
@endfor


<div class="form-group">
    <label>@lang('site.address')</label>
    <input type="text" name="address" class="form-control" value="{{ $client->address }}" >
</div>






                              

                                </div><!-- end of tab content -->
                                
                            </div><!-- end of nav tabs -->
                            
                        </div>
<div class="form-group">
    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.edit')</button>
</div>

</form><!-- end of form -->

               
                  
          
                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
