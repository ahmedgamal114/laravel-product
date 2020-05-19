

@extends('layouts.dashboard.app')


@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1> @lang('site.add')</h1>

            <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="#"> @lang('site.categories')</a></li>
                <li class="active"><a href="#"> @lang('site.add')</a></li>
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
 <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">

{{ csrf_field() }}
{{ method_field('post') }}


@foreach(config('translatable.locales') as $locale)
<div class="form-group">

    <label>@lang('site.' . $locale . '.name_category')</label>
    <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}" required>
</div>

@endforeach


<div class="form-group">
  <label>@lang('site.permissions')</label>
                            <div class="nav-tabs-custom">

@php
$models=['categories','categories','products'];
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
<label><input type="checkbox" value="{{ $map .'_'. $model }}" name="permissions[]"> @lang('site.'.$map)</label>
@endforeach


</div>
@endforeach


                              

                                </div><!-- end of tab content -->
                                
                            </div><!-- end of nav tabs -->
                            
                        </div>
<div class="form-group">
    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
</div>

</form><!-- end of form -->

               
                  
          
                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
