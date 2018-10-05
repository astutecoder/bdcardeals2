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
    <link rel="stylesheet" href="{{ asset('vendor_assets/pnotify/pnotify.custom.css') }}">
@endpush

@section('content-body')
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">All Sources</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-md">
                        <a id="addToTable" class="btn btn-success" href="{{ route('add-source') }}">Add <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
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
                                @if($source->cars_count < 1)
                                    <a href="#modalPrimary" class="on-default remove-row modal-basic" data-id={{ $source->id }}><i class="fa fa-trash-o"></i></a>
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
                                    <p>Are you sure that you want to delete this Source?</p>
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
    <script src="{{ asset('js/tables/all_sources.datatables.js') }}"></script>
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
                url: '/sources/delete',
                method: 'POST',
                headers:{
                    'X-CSRF-TOKEN': _csrf
                },
                data: {
                    id: id
                },
                success: function(data){
                    try{
                        if(data){
                            $.magnificPopup.close();
                            alert('Successfully Deleted');
                            window.location.reload()
                        }else{
                            throw new Error('Failed to Delete')
                        }
                    } catch (e){
                        alert(e.message)
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

