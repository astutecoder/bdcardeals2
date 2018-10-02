@extends ('backend.partials.layout')

@section('title', "Update Car $car->id" )
@section('content-body-head', 'Cars')
@section('breadcrumb-list')
    <li><span>Cars</span></li>
    <li><span>Edit Car</span></li>
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
                    <h2 class="panel-title">Edit Car</h2>
                </header>
                <div class="panel-body">

                    @include('backend.partials.car_edit_partial')

                </div>
            </section>
        </div>
    </div>
@stop

@push('scripts')
    <script src="{{ asset('js/cars_add_edit.js') }}"></script>
    <script>
        function goBack(e) {
            e.preventDefault();
            window.location.replace('/cars/all-cars')
        }

        $('.cancel').on('click', goBack)
    </script>
@endpush