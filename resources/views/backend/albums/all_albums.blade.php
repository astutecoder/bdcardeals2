@extends('backend.partials.layout')
@section('title', 'All Albums')
@section('content-body-head', 'Cars Album')
@section('breadcrumb-list')
    <li><span>Cars</span></li>
    <li><span>All Cars Album</span></li>
@stop

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor_assets/select2/select2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor_assets/jquery-datatables-bs3/assets/css/datatables.css') }}"/>
    <style>
        .all-albums-cover-container {
        }

        .all-albums-cover-container img {
            width      : 120px;
            height     : 100px;
            object-fit : cover;
        }

        .table * {
            vertical-align : middle !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/tables/all_albums.datatables.js') }}"></script>
@endpush

@section('content-body')
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">All Cars Album</h2>
        </header>
        <div class="panel-body">
            {{-- if no Car is avaiable to show--}}
            @if($errors->any())
                <h4 class="text-danger">{{ $errors->first() }}</h4>
                <p>Please check <a href="{{ route('all-cars') }}">cars list</a> to add new albums</p>
            @else
                <table class="table table-bordered table-striped mb-none" id="datatable-all-albums">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Album Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($albums as $album)
                            <tr class="gradeX">
                                <td>
                                    @foreach($album->photos as $photo)
                                        <div class="all-albums-cover-container">
                                            <img src="{{ '/storage/car_albums/'.$album->folder_name.'/'.$photo->file_name }}"
                                                 alt="{{ $photo->file_name }}">
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    <span>{{ $album->album_name }}</span>
                                    <span class="text-muted">
                                         ({{ $album->photos_count }} images)
                                    </span>
                                </td>
                                <td class="actions">
                                    <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                    <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                    <a href="{{ url('/cars/edit/'. $album->id) }}" class="on-default edit-row"><i
                                                class="fa fa-pencil"></i></a>
                                    <a href="{{ url('/cars/delete/'. $album->id) }}" class="on-default remove-row"><i
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