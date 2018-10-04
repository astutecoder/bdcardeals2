@extends ('backend.partials.layout')
@section('title', "Album: ".$photos[0]->albums->album_name )
@section('content-body-head', 'Albums')
@section('breadcrumb-list')
    <li>
        <a href="{{ route('albums') }}">
            <span>All Cars Album</span>
        </a>
    </li>
    <li><span>{{ $photos[0]->albums->album_name }}</span></li>
@stop

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor_assets/pnotify/pnotify.custom.css') }}">
@endpush

{{-- this template has pushed scripts at the bottom of this file --}}

@section('content-body')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Showing: {{ $photos[0]->albums->album_name }}</h2>
                </header>
                <div class="panel-body">
                    <div id="album_edit"></div>
                </div>
            </section>
        </div>
    </div>
@stop

@push('scripts')
    <script src="{{ asset('js/backend.js') }}"></script>
    <script src="{{ asset('vendor_assets/pnotify/pnotify.custom.js') }}"></script>
@endpush