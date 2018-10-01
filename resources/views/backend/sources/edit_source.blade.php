@extends('backend.partials.layout')

@section('title', 'Edit source')
@section('content-body-head', 'Sources')
@section('breadcrumb-list')
    <li><a href="{{ route('all-sources') }}"><span>Sources</span></a></li>
    <li><span>Edit Source</span></li>
@stop

@push('styles')
    <style>
        .help-block {
            margin-bottom : auto;
        }
    </style>
@endpush

@section('content-body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Source</h2>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal form-bordered" method="post" action="{{ route('update-source') }}">

                        {{-- Hidden Fields--}}
                        @csrf
                        <input name="id" type="hidden" value="{{ $source->id }}">

                        {{--Source Name--}}
                        <div class="form-group {{$errors->has('source_name')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="source_name">
                                Source Name
                            </label>
                            <div class="col-md-6">
                                <input name="source_name" value="{{ old('source_name') ?? $source->source_name }}"
                                       type="text"
                                       class="form-control"
                                       id="source_name">

                                @if ($errors->has('source_name'))
                                    <span class="help-block">{{$errors->first('source_name')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--Source Code--}}
                        <div class="form-group {{$errors->has('source_code')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="source_code">
                                Code No.
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <input name="source_code" value="{{ old('source_code')?? $source->source_code }}"
                                       type="text"
                                       class="form-control"
                                       id="source_code">

                                @if ($errors->has('source_code'))
                                    <span class="help-block">{{$errors->first('source_code')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--Source Contact--}}
                        <div class="form-group {{$errors->has('contact')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="contact">
                                Phone No.
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <input name="contact" value="{{ old('contact') ?? $source->contact}}" type="text"
                                       class="form-control"
                                       id="contact">

                                @if ($errors->has('contact'))
                                    <span class="help-block">{{$errors->first('contact')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--Source Email--}}
                        <div class="form-group {{$errors->has('email')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="email">
                                Email
                            </label>
                            <div class="col-md-6">
                                <input name="email" value="{{ old('email') ?? $source->email }}" type="text"
                                       class="form-control"
                                       id="email">

                                @if ($errors->has('email'))
                                    <span class="help-block">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                        </div>

                        {{--Source Address--}}
                        <div class="form-group {{$errors->has('address')? 'has-error' : ''}}">
                            <label class="col-md-3 control-label" for="address">
                                Source Name
                            </label>
                            <div class="col-md-6">
                                <textarea name="address" type="text" class="form-control"
                                          id="address">{{ old('address') ?? $source->address }}</textarea>

                                @if ($errors->has('address'))
                                    <span class="help-block">{{$errors->first('address')}}</span>
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
            window.location.replace('/sources/all-sources')
        }

        $('.cancel').on('click', goBack)
    </script>
@endpush