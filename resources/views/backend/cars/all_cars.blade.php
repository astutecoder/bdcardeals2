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
    <link rel="stylesheet" href="{{ asset('vendor_assets/pnotify/pnotify.custom.css') }}">
@endpush

@section('content-body')
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">All Cars</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-md">
                        <a id="addToTable" class="btn btn-success" href="{{ route('add-car') }}">Add <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
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
                            <th>Source Code</th>
                            <th>Album</th>
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
                                <td>{{ $car->sources->source_code }}</td>
                                <td>
                                    @if(!empty($car->albums))
                                        <a href="{{ route('edit-album', ['car_id'=> $car->id]) }}" class="text-info">
                                            {{ $car->albums->album_name }}
                                        </a>
                                    @else
                                        <a href="{{ route("create-album",['car_id'=>$car->id]) }}">Add image</a>
                                    @endif
                                </td>
                                <td class="actions">
                                    <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                    <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                    <a href="{{ url('/cars/car/'. $car->id) }}" class="on-default"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('/cars/edit/'. $car->id) }}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                    <a href="#modalPrimary" class="on-default remove-row modal-basic" data-id={{ $car->id }}><i class="fa fa-trash-o"></i></a>
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
                                    <p>Are you sure that you want to delete this Car?</p>
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
    <script src="{{ asset('js/tables/examples.datatables.default.js') }}"></script>
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
                url: '/cars/delete',
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
                           alert('Successfully Deleted');
                       }else{
                           throw new Error('Failed to Delete')
                       }
                   } catch (e){
                       alert(e.message);
                   } finally {
                        $.magnificPopup.close();
                        window.location.reload();
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
