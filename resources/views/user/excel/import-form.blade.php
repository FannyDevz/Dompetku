@extends('layouts.user.app')
@section('title', 'Dashboard')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="text-sm breadcrumb-item active">Import</li>
        {{--        <li class="text-sm breadcrumb-item active" aria-current="page">Dashboard</li>--}}
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
            <div class="col-12">
                <form action="{{ route('import-excel') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">Import Excel</h5>
                                </div>
                                <div class="col-6 d-flex align-items-end justify-content-end">
                                    <a href="{{ route('export-excel') }}" class="btn btn-primary float-right">Download Template</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <input type="file" class="basic-filepond" name="file">
                                <button class="btn btn-primary btn-block" type="submit">Import</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@section('custom-scripts')
    <script src="{{ asset('vendor/mazer/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
    <script src="{{ asset('vendor/mazer/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('vendor/mazer/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}"></script>
    <script src="{{ asset('vendor/mazer/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script src="{{ asset('vendor/mazer/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js') }}"></script>
    <script src="{{ asset('vendor/mazer/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('vendor/mazer/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}"></script>
    <script src="{{ asset('vendor/mazer/extensions/filepond/filepond.js') }}"></script>
    <script src="{{ asset('vendor/mazer/extensions/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('vendor/mazer/static/js/pages/filepond.js') }}"></script>
@endsection
