@extends('backend.partials.layout')

@section('title', 'Add new brand')
@section('content-body-head', 'Brands')
@section('breadcrumb-list')
    <li><span>Brands</span></li>
    <li><span>Add Brand</span></li>
@stop

@section('content-body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Add Brand</h2>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal form-bordered" method="post" action="{{ route('store-brand') }}">

                        @csrf

                        {{--Brand Name--}}
                        <div class="form-group {{$errors->has('brand_name')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="brand_name">
                                Brand Name
                            </label>
                            <div class="col-md-6">
                                <input name="brand_name" value="{{ old('brand_name') }}" type="text" class="form-control"
                                       id="brand_name">

                                @if ($errors->has('brand_name'))
                                    <span class="help-block">{{$errors->first('brand_name')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group"><label for="" class="col-md-3 hidden-sm hidden-xs  control-label"></label>
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