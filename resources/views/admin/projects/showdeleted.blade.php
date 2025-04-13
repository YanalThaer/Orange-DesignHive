@extends('layouts.admin')
@section('title', 'DesignHive | Show Deleted Project')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Deleted Project Details</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Project Information</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $project->id }}</td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>{{ $project->title }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $project->description }}</td>
                </tr>
                <tr>
                    <th>Author</th>
                    <td>{{ $project->user->name ?? 'Unknown' }}</td>
                </tr>
                <tr>
                    <th>Deleted At</th>
                    <td>{{ $project->deleted_at }}</td>
                </tr>
            </table>
            
            @if($project->image)
            <div class="mt-3">
                <h6>Project Image:</h6>
                <img src="{{ $project->image }}" alt="{{ $project->title }}" style="max-width: 300px;">
            </div>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <form action="{{ route('projects.restore', $project) }}" method="POST" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-success">Restore Project</button>
        </form>
        <a href="{{ route('projects.deleted') }}" class="btn btn-secondary">Back to Deleted Projects</a>
        <a href="{{ route('projects.index') }}" class="btn btn-primary">Back to Active Projects</a>
    </div>
</div>

@endsection