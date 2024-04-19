@extends('layouts.user.app')
@section('title', 'Dashboard')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="text-sm breadcrumb-item"><a href="{{ route('import-excel') }}">Import</a></li>
        <li class="text-sm breadcrumb-item active">Import Preview</li>
        {{--        <li class="text-sm breadcrumb-item active" aria-current="page">Dashboard</li>--}}
    </ol>
@endsection
@section('content')
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Preview Data</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Wallet Name</th>
                                        <th>Category Name</th>
                                        <th>Category Type</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Note</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $row)
                                        <tr>
                                            <td>{{ $row[0] }}</td>
                                            <td>{{ $row[1] }}</td>
                                            <td>{{ $row[2] }}</td>
                                            <td>{{ $row[3] }}</td>
                                            <td>{{ $row[4] }}</td>
                                            <td>{{ $row[5] }}</td>
                                            <td>{{ $row[6] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <form action="{{ route('process-import') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Process Import</button>
                                </form>
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
