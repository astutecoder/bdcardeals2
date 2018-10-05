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
    <link rel="stylesheet" href="{{ asset('vendor_assets/pnotify/pnotify.custom.css') }}">
@endpush

@section('content-body')
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">All Brands</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-md">
                        <a id="addToTable" class="btn btn-success" href="{{ route('add-brand') }}">Add <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
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
                                @if($brand->cars_count < 1)
                                    <a href="#modalPrimary" class="on-default remove-row modal-basic" data-id={{ $brand->id }}><i class="fa fa-trash-o"></i></a>
                                @endif
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
                                    <p>Are you sure that you want to delete this Brand?</p>
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
    <script src="{{ asset('js/tables/all_brands.datatables.js') }}"></script>
    <script src="{{ asset('vendor_assets/pnotify/pnotify.custom.js') }}"></script>
    <script>
        var id = '',
            _csrf = $('meta[name=csrf]').attr('content');
        console.log(_csrf);
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
                url: '/brands/delete',
                method: 'POST',
                headers:{
                    'X-CSRF-TOKEN': _csrf
                },
                data: {
                    id: id
                },
                success: function(data){
                    if(data){
                        $.magnificPopup.close();
                        alert('Successfully Deleted');
                        window.location.reload()
                    }else{
                        throw new Error('Failed to Delete')
                    }
                },
                error: function(err){
                    alert(err.message);
                }
            });
        });

        $(document).on('click', '.modal-dismiss', function (e) {
            e.preventDefault();
            $.magnificPopup.close();
        });
    </script>

@endpush