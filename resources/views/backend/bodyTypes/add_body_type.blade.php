@extends('backend.partials.layout')

@section('title', 'Add new body type')
@section('content-body-head', 'Body Types')
@section('breadcrumb-list')
    <li><a href="{{ route('all-body-types') }}"><span>Body Types</span></a></li>
    <li><span>Add Body Type</span></li>
@stop

@section('content-body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Add Body Type</h2>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal form-bordered" method="post" action="{{ route('store-body-type') }}">

                        @csrf

                        {{--Brand Name--}}
                        <div class="form-group {{$errors->has('body_type')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="body_type">
                                Body Type
                            </label>
                            <div class="col-md-6">
                                <input name="body_type" value="{{ old('body_type') }}" type="text"
                                       class="form-control"
                                       id="body_type">

                                @if ($errors->has('body_type'))
                                    <span class="help-block">{{$errors->first('body_type')}}</span>
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