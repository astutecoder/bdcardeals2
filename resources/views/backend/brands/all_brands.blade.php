@extends('backend.partials.layout')

@section('title', 'All Brands')
@section('content-body-head', 'Brands')
@section('breadcrumb-list')
    <li><span>Brands</span></li>
    <li><span>All Brands</span></li>
@stop

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor_assets/select2/select2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor_assets/jquery-datatables-bs3/assets/css/datatables.css') }}"/>
@endpush

@push('scripts')
    <script src="{{ asset('js/tables/all_brands.datatables.js') }}"></script>
@endpush

@section('content-body')
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">All Brands</h2>
        </header>
        <div class="panel-body">
            {{-- if no brand is avaiable to show--}}
            @if($errors->any())
                <h4 class="text-danger">{{ $errors->first() }}</h4>
            @else
                <table class="table table-bordered table-striped mb-none" id="datatable-all-brands">
                    <thead>
                    <tr>
                        <th>Brand Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $brand)
                        <tr class="gradeX">
                            <td>{{ strtoupper($brand->brand_name) }}</td>
                            <td class="actions">
                                <a href="{{ url('/brands/edit/'. $brand->id) }}" class="on-default edit-row"><i
                                            class="fa fa-pencil"></i></a>
                                <a href="{{ url('/brands/delete/'. $brand->id) }}" class="on-default remove-row"><i
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

