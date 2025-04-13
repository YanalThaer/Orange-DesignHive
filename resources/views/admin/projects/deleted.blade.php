@extends('layouts.admin')
@section('title', 'DesignHive | Deleted Projects')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Deleted Projects</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Deleted Projects List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ Str::limit($project->description, 50) }}</td>
                            <td>{{ $project->user->name ?? 'Unknown' }}</td>
                            <td>{{ $project->deleted_at }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('projects.showdeleted', $project) }}" class="btn btn-sm btn-info mx-1">
                                    <i class="fas fa-eye"></i> Show
                                </a>
                                <form action="{{ route('projects.restore', $project) }}" method="POST">
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
    <div class="mt-3">
        <a href="{{ route('projects.index') }}"  class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection