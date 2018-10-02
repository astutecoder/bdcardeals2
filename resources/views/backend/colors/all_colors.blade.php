@extends('backend.partials.layout')

@section('title', 'All Colors')
@section('content-body-head', 'Colors')
@section('breadcrumb-list')
    <li><span>Colors</span></li>
    <li><span>All Colors</span></li>
@stop

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor_assets/select2/select2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor_assets/jquery-datatables-bs3/assets/css/datatables.css') }}"/>
@endpush

@push('scripts')
    <script src="{{ asset('js/tables/all_colors.datatables.js') }}"></script>
@endpush

@section('content-body')
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">All Colors</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-md">
                        <a id="addToTable" class="btn btn-success" href="{{ route('add-color') }}">Add <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            {{-- if no brand is avaiable to show--}}
            @if($errors->any())
                <h4 class="text-danger">{{ $errors->first() }}</h4>
            @else
                <table class="table table-bordered table-striped mb-none" id="datatable-all-colors">
                    <thead>
                    <tr>
                        <th>Color Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($colors as $color)
                        <tr class="gradeX">
                            <td>{{ strtoupper($color->color_name) }}</td>
                            <td class="actions">
                                <a href="{{ url('/colors/edit/'. $color->id) }}" class="on-default edit-row"><i
                                            class="fa fa-pencil"></i></a>
                                <a href="{{ url('/colors/delete/'. $color->id) }}" class="on-default remove-row"><i
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

