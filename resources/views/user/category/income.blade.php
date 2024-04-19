@extends('layouts.user.app')
@section('title', 'Income Category')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="text-sm breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="text-sm breadcrumb-item active" aria-current="page">Income</li>
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
                <div class="card">
                    <div class="accordion" id="cardAccordion">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                        Add New Category
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form action="{{ route('income.category.store') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="basicInput">Name</label>
                                                        <input type="text" class="form-control" name="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="basicInput">Description</label>
                                                        <textarea class="form-control" name="description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <button type="submit" class="float-end btn btn-primary">Add Category</button>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="card-title">Data Category Income</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4">
                        <div class="table-responsive-sm">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($results as $key => $result)
                                    <tr>

                                        <td>{{ $result->id }}</td>
                                        <td>{{ $result->name }}</td>
                                        <td>{{ $result->description }}</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $result->id }}"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $result->id }}"><i class="bi bi-trash"></i></button>

                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editModal{{ $result->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $result->id }}" aria-hidden="true">
                                        <div class=" modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title white" id="editModalLabel{{ $result->id }}">Edit</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('income.category.update', $result->id) }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="basicInput">Name</label>
                                                                    <input type="text" class="form-control" name="name"  value="{{ $result->name }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="basicInput">Description</label>
                                                                    <textarea name="description" class="form-control" rows="5">{{ $result->description }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="float-end btn btn-primary">Edit Proxy</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="deleteModal{{ $result->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $result->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title white" id="deleteModalLabel{{ $result->id }}">Konfirmasi Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('income.category.destroy', $result->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="float-end py-2">
                            @include('user.category.layout.pagination')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('custom-scripts')
@endsection
