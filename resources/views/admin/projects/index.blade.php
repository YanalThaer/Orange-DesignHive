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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Projects List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Author (User ID)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ Str::limit($project->description, 50) }}</td>
                            <td>
                                @if($project->image)
                                    <img src="{{ $project->image }}" alt="{{ $project->title }}" style="width: 100px; height: auto;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $project->user->name ?? 'Unknown' }} <br> (ID: {{ $project->user_id }})</td>
                            <td>
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-info m-1 fixed-width-btn">Show</a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger m-1 fixed-width-btn" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                </form>
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