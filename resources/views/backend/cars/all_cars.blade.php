@extends('backend.partials.layout')
@section('title', 'All Cars')
@section('content-body-head', 'Cars')
@section('breadcrumb-list')
    <li><span>Cars</span></li>
    <li><span>All Cars</span></li>
@stop

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor_assets/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor_assets/jquery-datatables-bs3/assets/css/datatables.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset('js/tables/examples.datatables.default.js') }}"></script>
@endpush

@section('content-body')
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">All Cars</h2>
        </header>
        <div class="panel-body">
            {{-- if no Car is avaiable to show--}}
            @if($errors->any())
                <h4 class="text-danger">{{ $errors->first() }}</h4>
            @else
                <table class="table table-bordered table-striped mb-none" id="datatable-default">
                    <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Body Type</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                            <tr class="gradeX">
                                <td>{{ strtoupper($car->brands->brand_name) }}</td>
                                <td>{{ ucwords($car->model_no) }}</td>
                                <td>{{ strtoupper($car->body_types->body_type) }}</td>
                                <td>{{ $car->year }}</td>
                                <td class="actions">
                                    <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                    <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                    <a href="{{ url('/cars/edit/'. $car->id) }}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('/cars/delete/'. $car->id) }}" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>

@stop