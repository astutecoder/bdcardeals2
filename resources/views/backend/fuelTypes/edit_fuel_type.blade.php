@extends('backend.partials.layout')

@section('title', 'Edit fuel type')
@section('content-body-head', 'Fuel Types')
@section('breadcrumb-list')
    <li><a href="{{ route('all-fuel-types') }}"><span>Fuel Types</span></a></li>
    <li><span>Edit Fuel Type</span></li>
@stop

@section('content-body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Fuel type</h2>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal form-bordered" method="post" action="{{ route('update-fuel-type') }}">

                        {{--hidden fields--}}
                        @csrf
                        <input name="id" value="{{  $fuel_type->id }}" type="hidden">

                        {{--Body Type --}}
                        <div class="form-group {{$errors->has('fuel_type')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="fuel_type">
                                Fuel Type
                            </label>
                            <div class="col-md-6">
                                <input
                                        name="fuel_type"
                                        autofocus
                                        type="text" class="form-control"
                                        id="fuel_type"
                                        value="{{ old('fuel_type')? strtoupper(old('fuel_type')) : strtoupper($fuel_type->fuel_type) }}"
                                >
                                @if ($errors->has('fuel_type'))
                                    <span class="help-block">{{$errors->first('fuel_type')}}</span>
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
            window.location.replace('/fuel-types/all-fuel-types')
        }
        $('.cancel').on('click', goBack)
    </script>
@endpush