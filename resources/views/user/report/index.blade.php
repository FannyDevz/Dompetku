@extends('layouts.user.app')
@section('title', 'Report')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="text-sm breadcrumb-item active">Report</li>
    </ol>
@endsection
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
                <div class="card">
                    <div class="accordion" id="cardAccordion">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                        Search
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form method="GET">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wallet_id">Wallet</label>
                                                        <select class="form-control" name="wallet_id" id="wallet_id">
                                                            @foreach($wallets as $wallet)
                                                                <option value="{{ $wallet->id }}" {{ Request::get('wallet_id') == $wallet->id ? 'selected' : '' }}>{{ $wallet->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="month">Month</label>
                                                        <select class="form-control" name="month" id="month">
                                                            <option value="all">All</option>
                                                            @foreach($months as $key => $month)
                                                                <option value="{{ $key + 1 }}" {{ Request::get('month') == $key + 1 ? 'selected' : '' }}>{{ $month }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="year">Year</label>
                                                        <select class="form-control" name="year" id="year">
                                                            <option value="all">All</option>
                                                            @foreach($years as $year)
                                                                <option value="{{ $year }}" {{ Request::get('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="float-start btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($transactions)
            <div class="col-12 ">
                <div class="card p-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6 table-responsive-sm">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th colspan="2" >Income Transactions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (empty($transactions['income']))
                                        <tr>
                                            <td colspan="2">No data</td>
                                        </tr>
                                    @endif
                                    @foreach($transactions['income'] as $incomeTransaction)
                                        <tr>
                                            <td >{{ $incomeTransaction['category_name'] }} ({{ $incomeTransaction['transaction_count'] }})</td>
                                            <td class="text-nowrap">Rp {{ number_format($incomeTransaction['total_amount'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 table-responsive-sm">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th colspan="2" >Outcome Transactions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (empty($transactions['outcome']))
                                        <tr>
                                            <td colspan="2">No data</td>
                                        </tr>
                                    @endif
                                    @foreach($transactions['outcome'] as $outcomeTransaction)
                                        <tr>
                                            <td >{{ $outcomeTransaction['category_name'] }} ({{ $outcomeTransaction['transaction_count'] }})</td>
                                            <td class="text-nowrap">Rp {{ $outcomeTransaction['total_amount'] != 0 ? '-' : '' }}{{ number_format($outcomeTransaction['total_amount'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12 table-responsive-sm">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th colspan="3" >Total Transactions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Total Income</td>
                                            <td class="text-nowrap font-bold">Rp {{ number_format($transactions['total_income'], 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Outcome</td>
                                            <td class="text-nowrap font-bold">Rp {{ $transactions['total_outcome'] != 0 ? '-' : '' }}{{ number_format($transactions['total_outcome'], 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold">Total</td>
                                            <td class="text-nowrap font-bold">Rp {{ number_format($transactions['total'], 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>
    </div>
@endsection
@section('custom-scripts')
@endsection
