@extends ('backend.partials.layout')

@section('title', 'Add New Car')
@section('content-body-head', 'Cars')
@section('breadcrumb-list')
    <li><span>Cars</span></li>
    <li><span>Add Car</span></li>
@stop

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cars_add_edit.css') }}">
@endpush

{{-- this template has pushed scripts at the bottom of this file --}}

@section('content-body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Add Car</h2>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal form-bordered" method="post" action="{{ route('store-car') }}">

                        @csrf

                        {{--title--}}
                        <div class="form-group {{$errors->has('title')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="title">
                                Title
                            </label>
                            <div class="col-md-6">
                                <input name="title" value="{{ old('title') }}" type="text" class="form-control"
                                       id="title">

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
                                <input name="subtitle" value="{{ old('subtitle') }}" type="text" class="form-control"
                                       id="subtitle">

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
                                <select name="brands_id" class="form-control input-sm" required>
                                    <option value="">--- SELECT AN OPTION ---</option>
                                    @foreach($brands as $brand)
                                        <option
                                                value="{{$brand->id}}"
                                                {{ ($brand->id == old('brands_id')) ? 'selected' : '' }}>
                                            {{ strtoupper($brand->brand_name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brands_id'))
                                    <span class="help-block">{{$errors->first('brands_id')}}</span>
                                @endif

                                {{-- Add New Item If not Exists --}}
                                <span class="help-block add-new-text">Not in the list? Add new</span>
                                <span class="add-new-input-container">
                                    <div class="input-group">
                                        <input type="text" class="form-control" data-col="brand_name"
                                               data-route="/brands/add-brand">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success add-new-btn" type="button"><span
                                                        class="fa fa-check"></span></button>
                                            <button class="btn btn-danger add-new-close" type="button"><span
                                                        class="fa fa-close"></span></button>
                                        </span>
                                    </div>
                                    <span class="has-error"></span>
                                </span>
                            </div>
                        </div>

                        {{--body_types_id--}}
                        <div class="form-group {{$errors->has('body_types_id')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="body_types_id">
                                Body Type
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <select name="body_types_id" class="form-control input-sm" required>
                                    <option value="">--- SELECT AN OPTION ---</option>
                                    @foreach($body_types as $body_type)
                                        <option
                                                value="{{$body_type->id}}"
                                                {{ ($body_type->id == old('body_types_id')) ? 'selected' : '' }}>
                                            {{ strtoupper($body_type->body_type) }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('body_types_id'))
                                    <span class="help-block">{{$errors->first('body_types_id')}}</span>
                                @endif

                                {{-- Add New Item If not Exists --}}
                                <span class="help-block add-new-text">Not in the list? Add new</span>
                                <span class="add-new-input-container">
                                    <div class="input-group">
                                        <input type="text" class="form-control" data-col="body_type"
                                               data-route="/body-types/add-body-type">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success add-new-btn" type="button"><span
                                                        class="fa fa-check"></span></button>
                                            <button class="btn btn-danger add-new-close" type="button"><span
                                                        class="fa fa-close"></span></button>
                                        </span>
                                    </div>
                                    <span class="has-error"></span>
                                </span>
                            </div>
                        </div>

                        {{--fuel_types_id--}}
                        <div class="form-group {{$errors->has('fuel_types_id')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="fuel_types_id">
                                Fuel Type
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <select name="fuel_types_id" class="form-control input-sm" required>
                                    <option value="">--- SELECT AN OPTION ---</option>
                                    @foreach($fuel_types as $fuel_type)
                                        <option
                                                value="{{$fuel_type->id}}"
                                                {{ ($fuel_type->id == old('fuel_types_id')) ? 'selected' : '' }}>
                                            {{ strtoupper($fuel_type->fuel_type) }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('fuel_types_id'))
                                    <span class="help-block">{{$errors->first('fuel_types_id')}}</span>
                                @endif

                                {{-- Add New Item If not Exists --}}
                                <span class="help-block add-new-text">Not in the list? Add new</span>
                                <span class="add-new-input-container">
                                    <div class="input-group">
                                        <input type="text" class="form-control" data-col="fuel_type"
                                               data-route="/fuel-types/add-fuel-type">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success add-new-btn" type="button"><span
                                                        class="fa fa-check"></span></button>
                                            <button class="btn btn-danger add-new-close" type="button"><span
                                                        class="fa fa-close"></span></button>
                                        </span>
                                    </div>
                                    <span class="has-error"></span>
                                </span>
                            </div>
                        </div>

                        {{--source_id--}}
                        <div class="form-group {{$errors->has('source_id')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="source_id">
                                Source
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <select name="source_id" class="form-control input-sm" required>
                                    <option value="">--- SELECT AN OPTION ---</option>
                                    @foreach($sources as $source)
                                        <option
                                                value="{{$source->id}}"
                                                {{ ($source->id == old('source_id')) ? 'selected' : '' }}>
                                            {{ $source->source_code }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('source_id'))
                                    <span class="help-block">{{$errors->first('source_id')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--car_condition--}}
                        <div class="form-group {{$errors->has('car_condition')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="car_condition">
                                Car Condition
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <select name="car_condition" class="form-control input-sm" required>
                                    <option value="">--- SELECT AN OPTION ---</option>
                                        <option
                                                value="new"
                                                {{ (old('car_condition') === 'new') ? 'selected' : '' }}>
                                            New
                                        </option>
                                        <option
                                                value="recondition"
                                                {{ (old('car_condition') === 'recondition') ? 'selected' : '' }}>
                                            Recondition
                                        </option>
                                        <option
                                                value="used"
                                                {{ (old('car_condition') === 'used') ? 'selected' : '' }}>
                                            Second Hand
                                        </option>
                                </select>
                                @if ($errors->has('car_condition'))
                                    <span class="help-block">{{$errors->first('car_condition')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--colors_id--}}
                        <div class="form-group {{$errors->has('colors_id')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="colors_id">
                                Color
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                @foreach($colors as $color)
                                    <label class="checkbox-inline">
                                        <input
                                                name="colors_id[]"
                                                type="checkbox"
                                                id="colors_id"
                                                value="{{ $color->id }}"
                                                {{ old('colors_id') && in_array($color->id, old('colors_id')) ? 'checked' : ''}}
                                        />
                                        {{ ucwords($color->color_name) }}
                                    </label>
                                @endforeach
                                @if($errors->has('colors_id'))
                                    <span class="help-block">{{ $errors->first('colors_id') }}</span>
                                @endif

                                {{-- Add New Item If not Exists --}}
                                <span class="help-block add-new-text">Not in the list? Add new</span>
                                <span class="add-new-input-container">
                                    <div class="input-group">
                                        <input type="text" class="form-control" data-col="color_name"
                                               data-route="/colors/add-color">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success add-new-btn" type="button"><span
                                                        class="fa fa-check"></span></button>
                                            <button class="btn btn-danger add-new-close" type="button"><span
                                                        class="fa fa-close"></span></button>
                                        </span>
                                    </div>
                                    <span class="has-error"></span>
                                </span>
                            </div>
                        </div>

                        {{--model_no--}}
                        <div class="form-group {{$errors->has('model_no')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="model_no">
                                Model No.
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <input name="model_no" value="{{ old('model_no') }}" type="text" class="form-control"
                                       id="model_no" required>

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
                                <input name="year" value="{{ old('year') }}" type="text" class="form-control" id="year"
                                       pattern="^(19|20)[0-9]{2}" placeholder="range between 1900-2099">

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
                                <input name="engine" value="{{ old('engine') }}" type="text" class="form-control"
                                       id="engine">

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
                                <input name="transmission" value="{{ old('transmission') }}" type="text"
                                       class="form-control" id="transmission">

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
                                <input name="mileage" value="{{ old('mileage') }}" type="text" class="form-control"
                                       id="mileage">

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
                                <input name="doors" value="{{ old('doors') }}" type="text" class="form-control"
                                       id="doors">

                                @if ($errors->has('doors'))
                                    <span class="help-block">{{$errors->first('doors')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--price--}}
                        <div class="form-group {{$errors->has('price')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="price">
                                Price
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <input name="price" value="{{ old('price') }}" type="text" class="form-control"
                                       id="price">

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
                                <input name="offer_price" value="{{ old('offer_price') }}" type="text"
                                       class="form-control" id="offer_price">

                                @if ($errors->has('offer_price'))
                                    <span class="help-block">{{$errors->first('offer_price')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--is_negotiable_price && is_featured--}}
                        <div class="form-group {{$errors->has('is_negotiable_price')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <label class="checkbox-inline">
                                    <input
                                            name="is_negotiable_price"
                                            type="checkbox"
                                            id="is_negotiable_price"
                                            value="1"
                                            {{ (old('is_negotiable_price') && old('is_negotiable_price') == 1) ? 'checked' : '' }}
                                    />
                                    Negotiable Price?
                                </label>
                                <label class="checkbox-inline">
                                    <input
                                            name="is_featured"
                                            type="checkbox"
                                            id="is_featured"
                                            value="1" {{ (old('is_featured') && old('is_featured') == 1) ? 'checked' : '' }}
                                    />
                                    Featured?
                                </label>
                            </div>
                        </div>

                        {{--features--}}
                        <div class="form-group {{$errors->has('features')? 'has-error' : ''}}">
                            <labfel class="col-md-3 control-label" for="features">
                                Features
                            </labfel>
                            <div class="col-md-6">
                                <textarea name="features" class="form-control" rows="3"
                                          id="features">{{ old('features') }}</textarea>
                            </div>
                        </div>

                        {{--safety--}}
                        <div class="form-group {{$errors->has('safety')? 'has-error' : ''}}">
                            <labfel class="col-md-3 control-label" for="safety">
                                Safety
                            </labfel>
                            <div class="col-md-6">
                                <textarea name="safety" class="form-control" rows="3"
                                          id="safety">{{ old('safety') }}</textarea>
                            </div>
                        </div>

                        {{--comfort--}}
                        <div class="form-group {{$errors->has('comfort')? 'has-error' : ''}}">
                            <labfel class="col-md-3 control-label" for="comfort">
                                Comfort
                            </labfel>
                            <div class="col-md-6">
                                <textarea name="comfort" class="form-control" rows="3"
                                          id="comfort">{{ old('comfort') }}</textarea>
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


@push('scripts')
    <script src="{{ asset('js/cars_add_edit.js') }}"></script>
@endpush