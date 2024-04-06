@extends('layouts.user.app')
@if (Request::routeIs('wallet.transactions'))
    @section('title', 'Transactions Wallet')
@elseif(Request::routeIs('recycle-bin.wallet.transactions'))
    @section('title', 'Transactions Recycle Bin Wallet')
@endif
@if (Request::routeIs('wallet.transactions'))
    @section('breadcrumb')
        <ol class="breadcrumb">
            <li class="text-sm breadcrumb-item"><a href="{{ route('wallet.index') }}">Wallet</a></li>
            <li class="text-sm breadcrumb-item active" aria-current="page">Transactions</li>
        </ol>
    @endsection
@elseif(Request::routeIs('recycle-bin.wallet.transactions'))
    @section('breadcrumb')
        <ol class="breadcrumb">
            <li class="text-sm breadcrumb-item"><a href="{{ route('recycle-bin.wallet.index') }}">Recycle BinWallet</a></li>
            <li class="text-sm breadcrumb-item active" aria-current="page">Transactions</li>
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
            <div class="col-12 ">
                <div class="card p-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12  d-flex justify-content-end ">
                                <div class="dropdown">
                                    <button class="btn btn-sm  " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                        @if (Request::routeIs('wallet.transactions'))
                                        <a class="dropdown-item" href="{{ route('wallet.edit', $wallet->id) }}">Edit</a>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $wallet->id }}">Delete</a>
                                        @elseif(Request::routeIs('recycle-bin.wallet.transactions'))
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#restoreModal{{ $wallet->id }}">Restore</a>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deletePermanentModal{{ $wallet->id }}">Delete Permanent</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center ">
                                <div class="stats-icon mb-2 {{$wallet->color}}">
                                    <i class="iconly-bold{{ $wallet->icon }}"></i>
                                </div>
                            </div>
                            <div class="col-md-12  d-flex justify-content-center">
                                <h6 class="text-muted font-semibold mt-1">{{ $wallet->name }}</h6>
                            </div>
                            <div class="col-md-12  d-flex justify-content-center">
                                <h6 class="font-extrabold text-xl">Rp {{ number_format($wallet->totalBalance, 0, ',', '.') }}</h6>
                            </div>
                            <div class="col-md-12  d-flex justify-content-center">
                                <h6 class="text-muted text-sm text-center font-semibold mt-1">{{ $wallet->description }}</h6>
                            </div>
                            @if (Request::routeIs('wallet.transactions'))
                            <div class="col-md-12  d-flex justify-content-between px-2">
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#incomeAddModal">Add Income</button>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#outcomeAddModal">Add Outcome</button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if (Request::routeIs('wallet.transactions'))
                @include('user.wallet.layout.modal-delete')
                @include('user.wallet.layout.modal-add-income')
                @include('user.wallet.layout.modal-add-outcome')
            @elseif(Request::routeIs('recycle-bin.wallet.transactions'))
                @include('user.wallet.layout.modal-permanent-delete')
                @include('user.wallet.layout.modal-restore')
            @endif
            @include('user.wallet.layout.modal-filter')
{{--            @include('user.wallet.layout.modal-search')--}}
            <div class="col-12 ">
                <div class="card p-2">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-start mt-2">
                                <h6 class="text-sm">
                                @if (request('show') == 'all')
                                    @php
                                        $currentCount = $transactions->count();
                                    @endphp
                                    Showing all of {{$currentCount}} results
                                @else
                                    @php
                                        $currentCount = $transactions->count();
                                        $totalCount = $transactions->total();
                                    @endphp
                                    Showing {{$currentCount}} of {{$totalCount}} results
                                @endif
                                </h6>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
{{--                                <button class="btn btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#searchModal" >--}}
{{--                                    <i class="bi bi-search"></i>--}}
{{--                                </button>--}}
                                <button class="btn btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#filterModal" >
                                    <i class="bi bi-filter"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive-sm">
                                <table class="table table-hover">
                                    <tbody>
                                    @foreach($transactions as $key => $transaction)
                                        <tr class="{{ $transaction->category_type === 'Income' ? '' : 'bg-warning bg-opacity-25' }}" data-bs-toggle="modal" data-bs-target="#detailModal{{ $transaction->id }}">

                                            <td>{{ $transaction->name }}
                                                <br>
                                                <span class="text-muted text-sm">{{ $transaction->date }}</span>
                                                <br>
                                                <span class="text-muted text-sm">{{ $transaction->note }}</span>
                                            </td >
                                            <td class="text-nowrap">
                                                <div class="align-items-end justify-content-end">
                                                    Rp {{ $transaction->category_type === 'Income' ? '' : '-' }}{{ number_format( $transaction->amount, 0, ',', '.') }}
                                                    <br>
                                                    {{ $transaction->category_name }}
                                                </div>
                                            </td>
                                        </tr>
                                        @include('user.wallet.layout.modal-detail-transaction')
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-end py-2">
                                @include('user.wallet.layout.pagination')
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
