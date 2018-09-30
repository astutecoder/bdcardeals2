@extends('backend.partials.layout')

@section('title', 'Edit brand')
@section('content-body-head', 'Brands')
@section('breadcrumb-list')
    <li><a href="{{ route('all-brands') }}"><span>Brands</span></a></li>
    <li><span>Edit Brand</span></li>
@stop

@section('content-body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Brand</h2>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal form-bordered" method="post" action="{{ route('update-brand') }}">

                        {{--hidden fields--}}
                        @csrf
                        <input name="id" value="{{  $brand->id }}" type="hidden">

                        {{--Brand Name--}}
                        <div class="form-group {{$errors->has('brand_name')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="brand_name">
                                Brand Name
                            </label>
                            <div class="col-md-6">
                                <input
                                        name="brand_name"
                                        type="text" class="form-control"
                                        id="brand_name"
                                        value="{{ old('brand_name')? strtoupper(old('brand_name')) : strtoupper($brand->brand_name) }}"
                                        autofocus
                                >
                                @if ($errors->has('brand_name'))
                                    <span class="help-block">{{$errors->first('brand_name')}}</span>
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
            window.location.replace('/brands/all-brands')
        }
        $('.cancel').on('click', goBack)
    </script>
@endpush