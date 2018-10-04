@extends('backend.partials.layout')

@section('title')
    @if(!!$car)
        {{strtoupper($car->brands->brand_name) .' '. $car->model_no .' '. $car->year}}
    @else
        BD Car Deals:: no car found
    @endif
@stop

@section('content-body-head', 'Car Details')
@section('breadcrumb-list')
    <li><span>Cars</span></li>
    <li><span>Car Details</span></li>
@stop

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cars_add_edit.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor_assets/jquery-autosize/jquery.autosize.js') }}"></script>
    <script src="{{ asset('js/cars_add_edit.js') }}"></script>
    <script>
        function goBack(e) {
            e.preventDefault();
            window.location.replace('/cars/all-cars')
        }

        $('.cancel').on('click', goBack)
    </script>
@endpush

@section('content-body')
    <div class="row">
        <div class="col-md-3 col-lg-3">

            <section class="panel">
                <div class="panel-body">
                    <div class="thumb-info mb-md">
                        @if(!$car->photos_count)
                            <img src="{{ asset('images/!logged-user.jpg') }}" class="rounded img-responsive" alt="Car">
                        @else
                            @foreach($car->photos as $photo)
                                @if(!!$photo->is_featured)
                                    <img src="{{ asset('storage/car_albums/'.$car->albums->folder_name .'/'.$photo->file_name) }}"
                                         class="rounded img-responsive cover" width="100%" alt="John Doe">
                                @endif
                            @endforeach
                        @endif
                        {{--<div class="thumb-info-title">--}}
                        {{--<span class="thumb-info-inner">{{strtoupper($car->brands->brand_name) .' '. $car->model_no .' '. $car->year}}</span>--}}
                        {{--<span class="thumb-info-type">Cover Image</span>--}}
                        {{--</div>--}}
                    </div>

                    <hr class="dotted short">

                    <div class="widget-toggle-expand mb-md">
                        <div class="widget-header">
                            <h6>Car Source</h6>
                            <div class="widget-toggle">+</div>
                        </div>
                        {{--<div class="widget-content-collapsed">--}}
                        {{--<div class="progress progress-xs light">--}}
                        {{--<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">--}}
                        {{--60%--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="widget-content-expanded">
                            <ul class="simple-todo-list">
                                {{--<li class="completed">Update Profile Picture</li>--}}
                                {{--<li>Update Profile Picture</li>--}}
                                @if($car->sources->source_name)
                                    <li class="completed">Name: {{  $car->sources->source_name }}</li>
                                @endif
                                @if($car->sources->source_code)
                                    <li class="completed">Code: {{  $car->sources->source_code }}</li>
                                @endif
                                @if($car->sources->contact)
                                    <li class="completed">Contact: {{  $car->sources->contact }}</li>
                                @endif
                                @if($car->sources->email)
                                    <li class="completed">Email: {{  $car->sources->email }}</li>
                                @endif
                                @if($car->sources->address)
                                    <li class="completed">Address: {{  $car->sources->address }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </section>

        </div>
        <div class="col-md-6 col-lg-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabs">
                        <ul class="nav nav-tabs tabs-primary">
                            <li class="active">
                                <a href="#overview" data-toggle="tab">Overview</a>
                            </li>
                            @if(!!$car->features || !!$car->safety || !!$car->comfort)
                                <li>
                                    <a href="#features" data-toggle="tab">Extra Details</a>
                                </li>
                            @endif
                            <li>
                                <a href="#edit" data-toggle="tab">Edit</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="overview" class="tab-pane active">

                                <div class="mb-md">
                                    <h3 class="mb-0 title">
                                        @if(!!$car->title)
                                            <span class="">{{ $car->title }}</span>
                                        @else
                                            <span class="title">{{ strtoupper($car->brands->brand_name) .' '. $car->model_no .' '. $car->year }}</span>
                                        @endif
                                    </h3>
                                    <span class="description truncate">{{ $car->subtitle }}</span>
                                </div>

                                <hr class="separator">

                                <h4 class="mb-md">Specification</h4>
                                <ul class="simple-bullet-list custom-inline mb-xlg">
                                    <li class="red">
                                        <span class="title">Model</span>
                                        <span class="description truncate">{{ $car->model_no }}</span>
                                    </li>
                                    <li class="green">
                                        <span class="title">Year</span>
                                        <span class="description truncate">{{ $car->year }}</span>
                                    </li>
                                    <li class="blue">
                                        <span class="title">Engine</span>
                                        <span class="description truncate">
                                        {{ $car->engine ?? 'N/A' }}
                                    </span>
                                    </li>
                                    <li class="orange">
                                        <span class="title">Transmission</span>
                                        <span class="description truncate">
                                        {{ $car->transmission ?? 'N/A' }}
                                    </span>
                                    </li>
                                    <li class="purple">
                                        <span class="title">Mileage</span>
                                        <span class="description truncate">
                                        {{ $car->mileage ?? 'N/A' }}
                                    </span>
                                    </li>
                                    <li class="info">
                                        <span class="title">Doors</span>
                                        <span class="description truncate">
                                        {{ $car->doors ?? 'N/A' }}
                                    </span>
                                    </li>
                                </ul>
                            </div>

                            <div id="features" class="tab-pane">
                                <div class="mb-md">

                                    @if(!!$car->features)
                                        <h4 class="title">Features</h4>
                                        <p>{{ $car->features }}</p>
                                    @endif
                                        <hr class="seperator">
                                    @if(!!$car->safety)
                                        <h4 class="title">Safety</h4>
                                        <p>{{ $car->safety }}</p>
                                    @endif
                                        <hr class="seperator">
                                    @if(!!$car->comfort)
                                        <h4 class="title">Comfort</h4>
                                        <p>{{ $car->comfort }}</p>
                                    @endif
                                </div>
                            </div>

                            <div id="edit" class="tab-pane">

                                @include('backend.partials.car_edit_partial')

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">

                    <section class="panel">
                        <header class="panel-heading">
                            <div class="panel-actions">
                                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                                {{--<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>--}}
                            </div>

                            <h2 class="panel-title">
                                <span class="label label-primary label-sm text-weight-normal va-middle mr-sm">{{ $car->photos_count }}</span>
                                <span class="va-middle">All Images</span>
                            </h2>
                        </header>

                        <div class="panel-body">
                            <div class="content">
                                <ul class="simple-user-list custom-inline">
                                    @foreach($car->photos as $photo)
                                        <li class="cover">
                                            <figure class="rounded">
                                                <img src="{{ asset('storage/car_albums/'.$car->albums->folder_name).'/'.$photo->file_name }}"
                                                     alt="Joseph Doe Junior"
                                                     class="cover rounded">
                                            </figure>
                                        </li>
                                    @endforeach
                                </ul>
                                <hr class="separator">
                                <div class="text-right">
                                    <a class="text-uppercase text-muted"
                                       href="{{ route('edit-album', ['car_id'=>$car->id]) }}">(Edit Album)</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">

            <h4 class="mb-md">Stats</h4>
            <ul class="simple-card-list mb-xlg">
                <li class="primary">
                    <h3>৳ {{ $car->price }}</h3>
                    @if(!!$car->offer_price)
                        <p>offer price: BDT. {{ $car->offer_price }}</p>
                    @else
                        <p>No offer price is available.</p>
                    @endif
                </li>
                <li class="primary">
                    <h3>{{ $car->colors_count }}</h3>
                    <p>available {{ $car->colors_count > 1 ? 'colors': 'color' }}</p>
                </li>
            </ul>

            {{--<h4 class="mb-md">Projects</h4>--}}
            {{--<ul class="simple-bullet-list mb-xlg">--}}
            {{--<li class="red">--}}
            {{--<span class="title">Porto Template</span>--}}
            {{--<span class="description truncate">Lorem ipsom dolor sit.</span>--}}
            {{--</li>--}}
            {{--<li class="green">--}}
            {{--<span class="title">Tucson HTML5 Template</span>--}}
            {{--<span class="description truncate">Lorem ipsom dolor sit amet</span>--}}
            {{--</li>--}}
            {{--<li class="blue">--}}
            {{--<span class="title">Porto HTML5 Template</span>--}}
            {{--<span class="description truncate">Lorem ipsom dolor sit.</span>--}}
            {{--</li>--}}
            {{--<li class="orange">--}}
            {{--<span class="title">Tucson Template</span>--}}
            {{--<span class="description truncate">Lorem ipsom dolor sit.</span>--}}
            {{--</li>--}}
            {{--</ul>--}}
        </div>

    </div>
@stop