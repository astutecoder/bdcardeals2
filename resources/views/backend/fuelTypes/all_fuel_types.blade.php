@extends('backend.partials.layout')

@section('title', 'All Fuel Types')
@section('content-body-head', 'Fuel Types')
@section('breadcrumb-list')
    <li><span>Fuel Types</span></li>
    <li><span>All Fuel Types</span></li>
@stop

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor_assets/select2/select2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor_assets/jquery-datatables-bs3/assets/css/datatables.css') }}"/>
@endpush

@push('scripts')
    <script src="{{ asset('js/tables/all_fuel_types.datatables.js') }}"></script>
@endpush

@section('content-body')
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">All Fuel Types</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-md">
                        <a id="addToTable" class="btn btn-success" href="{{ route('add-fuel-type') }}">Add <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            {{-- if no brand is avaiable to show--}}
            @if($errors->any())
                <h4 class="text-danger">{{ $errors->first() }}</h4>
            @else
                <table class="table table-bordered table-striped mb-none" id="datatable-all-fuel-types">
                    <thead>
                    <tr>
                        <th>Fuel Type Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fuel_types as $fuel_type)
                        <tr class="gradeX">
                            <td>{{ strtoupper($fuel_type->fuel_type) }}</td>
                            <td class="actions">
                                <a href="{{ url('/fuel-types/edit/'. $fuel_type->id) }}" class="on-default edit-row"><i
                                            class="fa fa-pencil"></i></a>
                                <a href="{{ url('/fuel-types/delete/'. $fuel_type->id) }}" class="on-default remove-row"><i
                                            class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>

@stop

