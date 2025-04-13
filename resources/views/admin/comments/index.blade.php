@extends('layouts.admin')
@section('title', 'DesignHive | Admin Comments')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Comments</h1>

    {{-- Display success message --}}
    @if(session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="mb-3 d-flex">
        <a href="{{ route('comments.deleted') }}" class="btn btn-secondary">Deleted Comments</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Comments List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th> <!-- Changed column name to a counter -->
                            <th>Comment Author</th>
                            <th>Project ID</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Use $loop->iteration for the counter -->
                            <td>{{ $comment->user->name ?? 'Unknown' }} <br> (ID: {{ $comment->user_id }})</td>
                            <td>
                                @php
                                $projectTitle = $projects->firstWhere('id', $comment->project_id)?->title;
                                @endphp
                                {{ $projectTitle ?? 'No Project' }}
                            </td>
                            <td>{{ $comment->content }}</td>
                            <td class="d-flex justify-content-center"> <!-- Align buttons in one line -->
                                <a href="{{ route('comments.show', $comment->id) }}" class="btn btn-sm btn-info mx-1">
                                    <i class="fas fa-eye"></i> <!-- Eye icon -->
                                </a>
                                <form id="delete-form-{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" class="btn btn-sm btn-danger mx-1" onclick="confirmDelete({{ $comment->id }})">
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