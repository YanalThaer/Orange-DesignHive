@extends('layouts.admin')
@section('title', 'DesignHive | Projects')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Projects</h1>

    {{-- Display success message --}}
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3 d-flex">
        <a href="{{ route('projects.deleted') }}" class="btn btn-secondary">Deleted Projects</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Projects List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th> <!-- Changed column name to a counter -->
                            <th>Title</th>
                            <th>Description</th>
                            <th>Author (User ID)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Use $loop->iteration for the counter -->
                            <td>{{ $project->title }}</td>
                            <td>{{ Str::limit($project->description, 50) }}</td>
                            <td>{{ $project->user->name ?? 'Unknown' }} <br> (ID: {{ $project->user_id }})</td>
                            <td class="d-flex justify-content-center"> <!-- Align buttons in one line -->
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-info mx-1">
                                    <i class="fas fa-eye"></i> <!-- Eye icon -->
                                </a>
                                <form id="delete-form-{{ $project->id }}" action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" class="btn btn-sm btn-danger mx-1" onclick="confirmDelete({{ $project->id }})">
                                    <i class="fas fa-trash"></i> <!-- Trash can icon -->
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection