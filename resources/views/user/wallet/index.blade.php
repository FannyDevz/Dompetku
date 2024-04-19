@extends('layouts.user.app')
@if (Request::routeIs('wallet.index'))
    @section('title', 'Wallet')
@elseif(Request::routeIs('recycle-bin.wallet.index'))
    @section('title', 'Recycle Bin Wallet')
@endif

@if (Request::routeIs('wallet.index'))
    @section('breadcrumb')
        <ol class="breadcrumb">
            <li class="text-sm breadcrumb-item"><a href="{{ route('wallet.index') }}">Wallet</a></li>
        </ol>
    @endsection
@elseif(Request::routeIs('recycle-bin.wallet.index'))
    @section('breadcrumb')
        <ol class="breadcrumb">
            <li class="text-sm breadcrumb-item"><a href="{{ route('recycle-bin.wallet.index') }}">Recycle Bin Wallet</a></li>
        </ol>
    @endsection
@endif
@section('content')

    <div class="page-content">
        <section class="row">
            <div class="col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            @if(Request::routeIs('wallet.index'))
                @foreach ($results as $result)
                    <div class="col-12 col-lg-4 col-md-4">
                        <a href="{{ route('wallet.transactions', $result->id) }}">
                        <div class="card zoom p-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-start ">
                                        <div class="stats-icon mb-2 {{$result->color}}">
                                            <i class="iconly-bold{{ $result->icon }}"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h6 class="text-muted font-semibold mt-1">{{ $result->name }}</h6>
                                        <h6 class="font-extrabold text-xl">Rp {{ number_format($result->totalBalance, 0, ',', '.') }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach
            @elseif(Request::routeIs('recycle-bin.wallet.index'))
                @if (count($results) > 0)
                @foreach ($results as $result)
                    <div class="col-12 col-lg-4 col-md-4">
                        <a href="{{ route('recycle-bin.wallet.transactions', $result->id) }}">
                            <div class="card zoom p-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-start ">
                                            <div class="stats-icon mb-2 {{$result->color}}">
                                                <i class="iconly-bold{{ $result->icon }}"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h6 class="text-muted font-semibold mt-1">{{ $result->name }}</h6>
                                            <h6 class="font-extrabold text-xl">Rp {{ number_format($result->totalBalance, 0, ',', '.') }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                @else
                    <div class="col-12 ">
                        <div class="card p-2">
                            <div class="card-body">
                                <div class="row my-2">
                                    <div class="col-md-12  d-flex justify-content-center">
                                        <h6 class="text-muted font-semibold text-xl">Empty Wallet</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            @if(Request::routeIs('wallet.index'))
            <div class="col-12 col-lg-4 col-md-4">
                <a href="{{ route('wallet.create') }}">
                    <div class="card zoom p-2">
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-md-12 my-1 d-flex justify-content-center ">
                                    <div class="stats-icon mb-2 red">
                                        <i class="iconly-boldPlus"></i>
                                    </div>
                                </div>
                                <div class="col-md-12  d-flex justify-content-center">
                                    <h6 class="text-muted font-semibold text-xl">Buat Dompet</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif
        </section>
    </div>
@endsection
@section('custom-scripts')
@endsection
