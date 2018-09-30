@extends('backend.partials.layout')

@section('title', 'Add new color')
@section('content-body-head', 'Colors')
@section('breadcrumb-list')
    <li><a href="{{ route('all-colors') }}"><span>Colors</span></a></li>
    <li><span>Add Color</span></li>
@stop

@section('content-body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Add Color</h2>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal form-bordered" method="post" action="{{ route('store-color') }}">

                        @csrf

                        {{--Brand Name--}}
                        <div class="form-group {{$errors->has('color_name')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="color_name">
                                Color
                            </label>
                            <div class="col-md-6">
                                <input name="color_name" value="{{ old('color_name') }}" type="text"
                                       class="form-control"
                                       id="color_name">

                                @if ($errors->has('color_name'))
                                    <span class="help-block">{{$errors->first('color_name')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group"><label for=""
                                                       class="col-md-3 hidden-sm hidden-xs  control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </section>
        </div>
    </div>
@stop