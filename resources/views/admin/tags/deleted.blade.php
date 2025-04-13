@extends('layouts.admin')
@section('title', 'DesignHive | Deleted Tags')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Deleted Tags</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Deleted Tags List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->deleted_at }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('tags.showdeleted', $tag) }}" class="btn btn-sm btn-info mx-1">
                                    <i class="fas fa-eye"></i> Show
                                </a>
                                <form action="{{ route('tags.restore', $tag) }}" method="POST">
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
        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection