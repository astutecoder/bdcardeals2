@extends('backend.partials.layout')

@section('title', 'All Body Types')
@section('content-body-head', 'Body Types')
@section('breadcrumb-list')
    <li><span>Body Types</span></li>
    <li><span>All Body Types</span></li>
@stop

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor_assets/select2/select2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor_assets/jquery-datatables-bs3/assets/css/datatables.css') }}"/>
@endpush

@push('scripts')
    <script src="{{ asset('js/tables/all_body_types.datatables.js') }}"></script>
@endpush

@section('content-body')
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">All Body Types</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-md">
                        <a id="addToTable" class="btn btn-success" href="{{ route('add-body-type') }}">Add <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            {{-- if no brand is avaiable to show--}}
            @if($errors->any())
                <h4 class="text-danger">{{ $errors->first() }}</h4>
            @else
                <table class="table table-bordered table-striped mb-none" id="datatable-all-body-types">
                    <thead>
                    <tr>
                        <th>Body Type Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($body_types as $body_type)
                        <tr class="gradeX">
                            <td>{{ strtoupper($body_type->body_type) }}</td>
                            <td class="actions">
                                <a href="{{ url('/body-types/edit/'. $body_type->id) }}" class="on-default edit-row"><i
                                            class="fa fa-pencil"></i></a>
                                @if($body_type->cars_count < 1)
                                    <a href="{{ url('/body-types/delete/'. $body_type->id) }}" class="on-default remove-row"><i
                                                class="fa fa-trash-o"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>

@stop

