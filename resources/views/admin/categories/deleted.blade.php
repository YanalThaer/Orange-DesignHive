@extends('layouts.admin')
@section('title', 'DesignHive | Deleted Categories')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Deleted Categories</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Deleted Categories List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @if($category->image)
                                    <img src="{{ $category->image }}" alt="{{ $category->name }}" style="width: 100px; height: auto;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->deleted_at }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('categories.showdeleted', $category) }}" class="btn btn-sm btn-info mx-1">
                                    <i class="fas fa-eye"></i> Show
                                </a>
                                <form action="{{ route('categories.restore', $category) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success mx-1">
                                        <i class="fas fa-undo"></i> Restore
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection