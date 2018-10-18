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
    <link rel="stylesheet" href="{{ asset('vendor_assets/pnotify/pnotify.custom.css') }}">
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
                                            <img src="{{ '/storage_image/car_albums/'.$album->folder_name.'/'.$photo->file_name }}"
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
                                    <a href="{{ url('/cars/albums/edit/'. $album->cars_id) }}" class="on-default edit-row"><i
                                                class="fa fa-pencil"></i></a>
                                    <a href="#modalPrimary" class="on-default remove-row modal-basic" data-id={{ $album->id }}><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="modalPrimary" class="modal-block modal-block-primary mfp-hide">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Are you sure?</h2>
                        </header>
                        <div class="panel-body">
                            <div class="modal-wrapper">
                                <div class="modal-icon">
                                    <i class="fa fa-question-circle"></i>
                                </div>
                                <div class="modal-text">
                                    <h4>Hey!</h4>
                                    <p>Are you sure that you want to delete this Album?</p>
                                </div>
                            </div>
                        </div>
                        <footer class="panel-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a class="btn btn-primary modal-confirm">Confirm</a>
                                    <a class="btn btn-default modal-dismiss">Cancel</a>
                                </div>
                            </div>
                        </footer>
                    </section>
                </div>
            @endif
        </div>
    </section>

@stop

@push('scripts')
    <script src="{{ asset('js/tables/all_albums.datatables.js') }}"></script>
    <script src="{{ asset('vendor_assets/pnotify/pnotify.custom.js') }}"></script>
    <script>
        var id = '',
            _csrf = $('meta[name=csrf]').attr('content');
        $('.modal-basic').magnificPopup({
            type: 'inline',
            preloader: false,
            modal: true
        });

        $('.modal-basic').on('click', function(){
            id = $(this).data('id');
        })

        $(document).on('click', '.modal-confirm', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/cars/albums/delete',
                method: 'POST',
                headers:{
                    'X-CSRF-TOKEN': _csrf
                },
                data: {
                    id: id
                },
                success: function(data){
                    try {
                        if(data){
                            $.magnificPopup.close();
                            alert('Successfully Deleted');
                        }else{
                            throw new Error('Failed to Delete')
                        }
                    }catch(e) {
                        alert(e.message);
                    }finally {
                        $.magnificPopup.close();
                        window.location.reload()
                    }
                },
                error: function(err){
                    alert(err.message);
                    $.magnificPopup.close();
                }
            });
        });

        $(document).on('click', '.modal-dismiss', function (e) {
            e.preventDefault();
            $.magnificPopup.close();
        });
    </script>
@endpush