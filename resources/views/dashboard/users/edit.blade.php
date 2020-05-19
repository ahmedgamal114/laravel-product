

@extends('layouts.dashboard.app')


@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1> @lang('site.edit')</h1>

            <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="#"> @lang('site.users')</a></li>
                <li class="active"><a href="#"> @lang('site.edit')</a></li>
                <li ></li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px"><small></small></h3>

                    <form method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    <a href="{{ route('dashboard.users.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> @lang('site.users')</a>
                          
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">
               
@include('partials._errors')
 <form action="{{ route('dashboard.users.update',$user->id) }}" method="post" enctype="multipart/form-data">

{{ csrf_field() }}
{{ method_field('put') }}

<div class="form-group">
    <label>@lang('site.first_name')</label>
    <input type="text" name="first_name" class="form-control" value="{{  $user ? $user->first_name : old('first_name') }}">
</div>

<div class="form-group">
    <label>@lang('site.last_name')</label>
    <input type="text" name="last_name" class="form-control" value="{{$user ? $user->last_name :  old('last_name') }}">
</div>

<div class="form-group">
    <label>@lang('site.email')</label>
    <input type="email" name="email" class="form-control" value="{{ $user ? $user->email: old('email') }}">
</div>


<div class="form-group">
    <label>@lang('site.image')</label>
    <input type="file" name="image" class="form-control image">
</div>


<div class="form-group">
    <img src="{{ $user->image_path }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
</div>
<div class="form-group">
    <label>@lang('site.password')</label>
    <input type="password" name="password" class="form-control">
</div>

<div class="form-group">
<label>@lang('site.password_confirmation')</label>
    <input type="password" name="password_confirmation" class="form-control">
</div>

<div class="form-group">
  <label>@lang('site.permissions')</label>
                            <div class="nav-tabs-custom">

@php
$models=['users','users','products'];
$maps=['create','read','update','delete'];
@endphp
                                <ul class="nav nav-tabs">
                                   
                                   @foreach($models as $index=>$model)
                                        <li class="{{ $index==0  ? 'active': ''}}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.'.$model)</a></li>
                                   @endforeach
                           
                                </ul>

                                <div class="tab-content">

                                @foreach($models as $index=>$model)
                                        <div class="tab-pane {{ $index==0  ? 'active': ''}}" id="{{ $model }}">

                                 @foreach($maps as $map)          
<label><input type="checkbox" value="{{ $map .'_'. $model }}" name="permissions[]" {{ $user->haspermission($map.'_'.$model)? 'checked': '' }}> @lang('site.'.$map)</label>
@endforeach


</div>
@endforeach


                              

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
