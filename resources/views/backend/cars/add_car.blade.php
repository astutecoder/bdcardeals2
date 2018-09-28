@extends ('backend.partials.layout')

@section('title', 'Add New Car')
@section('content-body-head', 'Cars')

@section('content-body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Add Car</h2>
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

                        {{--brands_id--}}
                        <div class="form-group {{$errors->has('brands_id')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="brands_id">
                                Brand
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control input-sm mb-md" required>
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                                @if ($errors->has('brands_id'))
                                    <span class="help-block">{{$errors->first('brands_id')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--body_types_id--}}
                        <div class="form-group {{$errors->has('body_types_id')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="body_types_id">
                                Body Type
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control input-sm mb-md" required>
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                                @if ($errors->has('body_types_id'))
                                    <span class="help-block">{{$errors->first('body_types_id')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--fuel_types_id--}}
                        <div class="form-group {{$errors->has('fuel_types_id')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="fuel_types_id">
                                Fuel Type
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control input-sm mb-md" required>
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                                @if ($errors->has('fuel_types_id'))
                                    <span class="help-block">{{$errors->first('fuel_types_id')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--colors_id--}}
                        <div class="form-group {{$errors->has('colors_id')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="colors_id">Colors</label>
                            <div class="col-md-6">
                                <label class="checkbox-inline">
                                    <input name="colors_id[]" type="checkbox" id="colors_id" value="1" {{ old('colors_id') && in_array(1, old('colors_id')) ? 'checked' : ''}}> 1
                                </label>
                                <label class="checkbox-inline">
                                    <input name="colors_id[]" type="checkbox" id="colors_id" value="2" {{ old('colors_id') && in_array(2, old('colors_id'))? 'checked' : ''}}> 2
                                </label>
                                <label class="checkbox-inline">
                                    <input name="colors_id[]" type="checkbox" id="colors_id" value="3" {{ old('colors_id') && in_array(3, old('colors_id'))? 'checked' : '' }}> 3
                                </label>
                            </div>
                        </div>

                        {{--model_no--}}
                        <div class="form-group {{$errors->has('model_no')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="model_no">
                                Model No.
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="model_no">

                                @if ($errors->has('model_no'))
                                    <span class="help-block">{{$errors->first('model_no')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--year--}}
                        <div class="form-group {{$errors->has('year')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="year">
                                Year
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" id="year">

                                @if ($errors->has('year'))
                                    <span class="help-block">{{$errors->first('year')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--engine--}}
                        <div class="form-group {{$errors->has('engine')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="engine">
                                Engine
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="engine">

                                @if ($errors->has('engine'))
                                    <span class="help-block">{{$errors->first('engine')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--transmission--}}
                        <div class="form-group {{$errors->has('transmission')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="transmission">
                                Transmission
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="transmission">

                                @if ($errors->has('transmission'))
                                    <span class="help-block">{{$errors->first('transmission')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--mileage--}}
                        <div class="form-group {{$errors->has('mileage')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="mileage">
                                Mileage
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="mileage">

                                @if ($errors->has('mileage'))
                                    <span class="help-block">{{$errors->first('mileage')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--doors--}}
                        <div class="form-group {{$errors->has('doors')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="doors">
                                Doors
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="doors">

                                @if ($errors->has('doors'))
                                    <span class="help-block">{{$errors->first('doors')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--price--}}
                        <div class="form-group {{$errors->has('price')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="price">
                                Price
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="price">

                                @if ($errors->has('price'))
                                    <span class="help-block">{{$errors->first('price')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--offer_price--}}
                        <div class="form-group {{$errors->has('offer_price')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="offer_price">
                                Offer Price
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="offer_price">

                                @if ($errors->has('offer_price'))
                                    <span class="help-block">{{$errors->first('offer_price')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--is_negotiable_price--}}
                        <div class="form-group {{$errors->has('is_negotiable_price')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="is_negotiable_price"></label>
                            <div class="col-md-6">
                                <label class="checkbox-inline">
                                    <input name="is_negotiable_price" type="checkbox" id="is_negotiable_price" value="1"> 1
                                </label>
                            </div>
                        </div>

                        {{--is_featured--}}
                        <div class="form-group {{$errors->has('is_featured')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="is_featured">Inline checkboxes</label>
                            <div class="col-md-6">
                                <label class="checkbox-inline">
                                    <input name="is_featured" type="checkbox" id="is_featured" value="1"> 1
                                </label>
                            </div>
                        </div>

                        {{--features--}}
                        <div class="form-group {{$errors->has('features')? 'has-error' : ''}}">
                            <labfel class="col-md-3 control-label" for="features">
                                Features
                            </labfel>
                            <div class="col-md-6">
                                <textarea name="features" class="form-control" rows="3" id="features"></textarea>
                            </div>
                        </div>

                        {{--safety--}}
                        <div class="form-group {{$errors->has('safety')? 'has-error' : ''}}">
                            <labfel class="col-md-3 control-label" for="safety">
                                Safety
                            </labfel>
                            <div class="col-md-6">
                                <textarea name="safety" class="form-control" rows="3" id="safety"></textarea>
                            </div>
                        </div>

                        {{--comfort--}}
                        <div class="form-group {{$errors->has('comfort')? 'has-error' : ''}}">
                            <labfel class="col-md-3 control-label" for="comfort">
                                Comfort
                            </labfel>
                            <div class="col-md-6">
                                <textarea name="comfort" class="form-control" rows="3" id="comfort"></textarea>
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