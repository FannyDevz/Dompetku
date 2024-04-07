@extends('layouts.user.app')
@section('title', 'Edit User')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="text-sm breadcrumb-item active" aria-current="page">Edit User</li>
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
                            <form class="form form-vertical" action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div class="position-relative">
                                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <div class="position-relative">
                                                    <input type="text" name="username" class="form-control" value="{{ $user->username }}" placeholder="Username" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="position-relative">
                                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <div class="position-relative">
                                                    <input type="password" name="password" class="form-control" placeholder="Password" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update User Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
