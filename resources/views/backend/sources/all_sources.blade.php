@extends('backend.partials.layout')

@section('title', 'All Sources')
@section('content-body-head', 'Sources')
@section('breadcrumb-list')
    <li><span>Sources</span></li>
    <li><span>All Sources</span></li>
@stop

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor_assets/select2/select2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor_assets/jquery-datatables-bs3/assets/css/datatables.css') }}"/>
@endpush

@push('scripts')
    <script src="{{ asset('js/tables/all_sources.datatables.js') }}"></script>
@endpush

@section('content-body')
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">All Sources</h2>
        </header>
        <div class="panel-body">
            {{-- if no source is avaiable to show--}}
            @if($errors->any())
                <h4 class="text-danger">{{ $errors->first() }}</h4>
            @else
                <table class="table table-bordered table-striped mb-none" id="datatable-all-sources">
                    <thead>
                    <tr>
                        <th>Source Name</th>
                        <th>Source Code</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sources as $source)
                        <tr class="gradeX">
                            <td>{{ strtoupper($source->source_name) }}</td>
                            <td>{{ strtoupper($source->source_code) }}</td>
                            <td>{{ strtoupper($source->contact) }}</td>
                            <td>{{ $source->email }}</td>
                            <td>{{ $source->address }}</td>
                            <td class="actions">
                                <a href="{{ url('/sources/edit/'. $source->id) }}" class="on-default edit-row"><i
                                            class="fa fa-pencil"></i></a>
                                <a href="{{ url('/sources/delete/'. $source->id) }}" class="on-default remove-row"><i
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

