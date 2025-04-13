@extends('layouts.admin')
@section('title', 'DesignHive | Deleted Comments')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Deleted Comments</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Deleted Comments List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Comment Author</th>
                            <th>Project</th>
                            <th>Content</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $comment->user->name ?? 'Unknown' }} (ID: {{ $comment->user_id }})</td>
                            <td>{{ $comment->projects->title ?? 'Deleted Project' }} (ID: {{ $comment->project_id }})</td>                            <td>{{ Str::limit($comment->content, 50) }}</td>
                            <td>{{ $comment->deleted_at }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('comments.showdeleted', $comment) }}" class="btn btn-sm btn-info mx-1">
                                    <i class="fas fa-eye"></i> Show
                                </a>
                                <form action="{{ route('comments.restore', $comment) }}" method="POST">
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
        <a href="{{ route('comments.index') }}"  class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection