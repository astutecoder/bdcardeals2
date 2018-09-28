@extends ('backend.partials.layout')

@section('title', 'Add New Car')
@section('content-body-head', 'Cars')

@section('content-body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Form Elements</h2>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal form-bordered" method="post" action="{{ url('/cars/add-car') }}">

                        @csrf

                        {{--title--}}
                        <div class="form-group {{$errors->has('title')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="title">
                                Title
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="title">

                                @if ($errors->has('title'))
                                    <span class="help-block">{{$errors->first('title')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--subtitle--}}
                        <div class="form-group {{$errors->has('subtitle')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="subtitle">
                                Subtitle
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="subtitle">

                                @if ($errors->has('subtitle'))
                                    <span class="help-block">{{$errors->first('subtitle')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--brand--}}
                        <div class="form-group {{$errors->has('brands_id')? 'has-error' : ''}}">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="brands_id">
                                    Brand
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm mb-md">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                    </select>
                                    @if ($errors->has('brands_id'))
                                        <span class="help-block">{{$errors->first('brands_id')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{--body_types_id--}}
                        <div class="form-group {{$errors->has('body_types_id')? 'has-error' : ''}}">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="body_types_id">
                                    Body Type
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm mb-md">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                    </select>
                                    @if ($errors->has('body_types_id'))
                                        <span class="help-block">{{$errors->first('body_types_id')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{--fuel_types_id--}}
                        <div class="form-group {{$errors->has('fuel_types_id')? 'has-error' : ''}}">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="fuel_types_id">
                                    Fuel Type
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm mb-md">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                    </select>
                                    @if ($errors->has('fuel_types_id'))
                                        <span class="help-block">{{$errors->first('fuel_types_id')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputSuccess">Select sizing</label>
                            <div class="col-md-6">
                                <select class="form-control input-sm mb-md">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputSuccess">Inline checkboxes</label>
                            <div class="col-md-6">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> 1
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox2" value="option2"> 2
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox3" value="option3"> 3
                                </label>
                            </div>
                        </div>

                        <div class="form-group"><label for="" class="col-md-3 control-label"></label>
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