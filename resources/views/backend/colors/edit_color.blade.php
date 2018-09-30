@extends('backend.partials.layout')

@section('title', 'Edit fuel type')
@section('content-body-head', 'Colors')
@section('breadcrumb-list')
    <li><a href="{{ route('all-colors') }}"><span>Colors</span></a></li>
    <li><span>Edit Color</span></li>
@stop

@section('content-body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Color</h2>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal form-bordered" method="post" action="{{ route('update-color') }}">

                        {{--hidden fields--}}
                        @csrf
                        <input name="id" value="{{  $color->id }}" type="hidden">

                        {{--Body Type --}}
                        <div class="form-group {{$errors->has('color_name')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="color_name">
                                Color
                            </label>
                            <div class="col-md-6">
                                <input
                                        name="color_name"
                                        autofocus
                                        type="text" class="form-control"
                                        id="color_name"
                                        value="{{ old('color_name')? strtoupper(old('color_name')) : strtoupper($color->color_name) }}"
                                >
                                @if ($errors->has('color_name'))
                                    <span class="help-block">{{$errors->first('color_name')}}</span>
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
            window.location.replace('/colors/all-colors')
        }
        $('.cancel').on('click', goBack)
    </script>
@endpush