@extends('layouts.admin')
@section('title', 'DesignHive | Show Deleted Tag')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Deleted Tag Details</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tag Information</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $tag->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $tag->name }}</td>
                </tr>
                <tr>
                    <th>Created By</th>
                    <td>{{ $tag->admin->name ?? 'Unknown' }}</td>
                </tr>
                <tr>
                    <th>Deleted At</th>
                    <td>{{ $tag->deleted_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <form action="{{ route('tags.restore', $tag) }}" method="POST" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-success">Restore tag</button>
        </form>
        <a href="{{ route('tags.deleted') }}" class="btn btn-secondary">Back to Deleted Tags</a>
        <a href="{{ route('tags.index') }}" class="btn btn-primary">Back to Active Tags</a>
    </div>
</div>

@endsection