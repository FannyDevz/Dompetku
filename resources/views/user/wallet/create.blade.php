@extends('layouts.user.app')
@section('title', 'Create Wallet')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="text-sm breadcrumb-item"><a href="{{ route('wallet.index') }}">Wallet</a></li>
                <li class="text-sm breadcrumb-item active" aria-current="page">Create Wallet</li>
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
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{ route('wallet.store') }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div class="position-relative">
                                                    <input type="text" name="name" class="form-control" placeholder="Wallet Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <div class="position-relative">
                                                    <textarea name="description" class="form-control" placeholder="Wallet Description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Icon</label>
                                                <div class="position-relative">
                                                    <select class="choices form-select" name="icon">
                                                        @foreach($icons as $icon)
                                                            <option value="{{ $icon }}">{{ $icon }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Color</label>
                                                <div class="position-relative">
                                                    <select class="choices form-select" name="color">
                                                        @foreach($colors as $color)
                                                            <option value="{{ $color }}">{{ $color }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <a href="{{ route('wallet.index') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="accordion" id="cardAccordion">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="false"
                                            aria-controls="collapseOne">
                                       Lihat Icon
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse "
                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            @foreach($icons as $icon)
                                                <div class="col-md-2 col-5 m-2 text-center align-items-center justify-content-center">
                                                    <i class="iconly-bold{{ $icon }}"></i>
                                                    <br>
                                                    <span>{{ $icon }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
@section('custom-scripts')
    <script src="{{asset('vendor/mazer/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
    <script src="{{asset('vendor/mazer/static/js/pages/form-element-select.js')}}"></script>
@endsection
