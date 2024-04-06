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
                                                                <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
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
                                                                <option value="{{ $key + 1 }}">{{ $month }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="year">Year</label>
                                                        <select class="form-control" name="year" id="year">
                                                            <option value="all">All</option>
                                                            @foreach($years as $year)
                                                                <option value="{{ $year }}">{{ $year }}</option>
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
                            <div class="table-responsive-sm">
                                <table class="table table-hover">
                                    <tbody>

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
