@extends('backend.partials.layout')

@section('title', 'Edit body type')
@section('content-body-head', 'Body Types')
@section('breadcrumb-list')
    <li><a href="{{ route('all-body-types') }}"><span>Body Types</span></a></li>
    <li><span>Edit Body Type</span></li>
@stop

@section('content-body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Body type</h2>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal form-bordered" method="post" action="{{ route('update-body-type') }}">

                        {{--hidden fields--}}
                        @csrf
                        <input name="id" value="{{  $body_type->id }}" type="hidden">

                        {{--Body Type --}}
                        <div class="form-group {{$errors->has('body_type')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="body_type">
                                Body Type
                            </label>
                            <div class="col-md-6">
                                <input
                                        name="body_type"
                                        autofocus
                                        type="text" class="form-control"
                                        id="body_type"
                                        value="{{ old('body_type')? strtoupper(old('body_type')) : strtoupper($body_type->body_type) }}"
                                >
                                @if ($errors->has('body_type'))
                                    <span class="help-block">{{$errors->first('body_type')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group"><label for=""
                                                       class="col-md-3 hidden-sm hidden-xs  control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-success" type="submit">Submit</button>
                                <button class="btn btn-danger cancel" type="button">Cancel</button>
                            </div>
                        </div>
                    </form>

                </div>
            </section>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        function goBack(e) {
            e.preventDefault();
            window.location.replace('/body-types/all-body-types')
        }
        $('.cancel').on('click', goBack)
    </script>
@endpush