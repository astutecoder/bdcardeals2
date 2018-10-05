@extends('backend.partials.layout');

@section('title', 'Dashboard')
@section('content-body-head', 'Dashboard')
@section('breadcrumb-list')
    <li><span>Dashboard</span></li>
@stop
@php
    $lastDay = date('Y-m-d H:i:s', strtotime('-2days', time()));
@endphp

@push('styles')
@endpush
@section('content-body')
    <div class="row">
        <div class="col-md-12 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-primary">
                                <i class="fa fa-car"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Total Cars</h4>
                                <div class="info">
                                    <strong class="amount">{{ $cars }}</strong>
                                    <span class="text-primary">(
                                        {{ (App\Car::where('created_at', '>=', $lastDay)->count()) }}
                                        new)
                                    </span>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase" href="{{ route('all-cars') }}">(view all)</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-secondary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary">
                                <i class="fa fa-tasks"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Brands</h4>
                                <div class="info">
                                    <strong class="amount">{{ $brands }}</strong>
                                    <span class="text-primary">(
                                        {{ (App\Brand::where('created_at', '>=', $lastDay)->count()) }}
                                        new)
                                    </span>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase" href="{{ route('all-brands') }}">(view all)</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-tertiary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-tertiary">
                                <i class="glyphicon glyphicon-grain"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Sources</h4>
                                <div class="info">
                                    <strong class="amount">{{ $sources }}</strong>
                                    <span class="text-primary">(
                                        {{ (App\Source::where('created_at', '>=', $lastDay)->count()) }}
                                        new)
                                    </span>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase" href="{{ route('all-sources') }}">(view all)</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-quartenary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-quartenary">
                                <i class="fa fa-film"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Photos</h4>
                                <div class="info">
                                    <strong class="amount">{{ $photos }}</strong>
                                    <span class="text-primary">(
                                        {{ (App\Photo::where('created_at', '>=', $lastDay)->count()) }}
                                        new item)
                                    </span>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase" href="{{ route('albums') }}">(view albums)</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop