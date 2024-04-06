@extends('layouts.user.app')
@section('title', 'Dashboard')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="text-sm breadcrumb-item"><a href="#">Dashboard</a></li>
{{--        <li class="text-sm breadcrumb-item active" aria-current="page">Dashboard</li>--}}
    </ol>
@endsection
@section('content')

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-4 col-md-4">
            <div class="card zoom p-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-start ">
                            <div class="stats-icon purple mb-2">
                                <i class="iconly-boldHome"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Nama Dompet</h6>
                            <h6 class="font-extrabold mb-0">000.000</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-4">
            <div class="card zoom p-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-start ">
                            <div class="stats-icon purple mb-2">
                                <i class="iconly-boldHome"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Nama Dompet</h6>
                            <h6 class="font-extrabold mb-0">000.000</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-4">
            <div class="card zoom p-2">
                <div class="card-body">
                    <div class="row my-1" >
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="stats-icon my-2 purple">
                                <i class="iconly-boldPlus"></i>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <h6 class="text-muted font-semibold">Buat Dompet</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('custom-scripts')
@endsection
