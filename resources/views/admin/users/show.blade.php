@extends('layouts.admin')
@section('title', 'DesignHive | User Details')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">User Details</h1>

    <!-- Basic Information Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Basic Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Email Verified</th>
                            <td>{{ $user->email_verified_at ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Provider</th>
                            <td>{{ $user->provider ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Account Created</th>
                            <td>{{ $user->created_at}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Information Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                </div>
                <div class="card-body">
                    @if($user->profile)
                        <div class="text-center mb-3">
                            @php
                            $profileimage = $user->profile->profile_picture;
                            $profileimage = $profileimage
                            ? (Str::startsWith($profileimage, ['http://', 'https://']) ? $profileimage : asset($profileimage))
                            : asset('assets/img/person/person-f-7.webp');
                            @endphp
                            @if($profileimage)
                                <img src="{{ $profileimage }}" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; margin: 0 auto;">
                                    <i class="fas fa-user text-white" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>Bio</th>
                                <td>{{ $user->profile->bio ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>{{ $user->profile->location ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Social Links</th>
                                <td>
                                    @if($user->profile->facebook)
                                        <a href="{{ $user->profile->facebook }}" target="_blank" class="btn btn-sm btn-primary mb-1"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if($user->profile->twitter)
                                        <a href="{{ $user->profile->twitter }}" target="_blank" class="btn btn-sm btn-info mb-1"><i class="fab fa-twitter"></i></a>
                                    @endif
                                    @if($user->profile->linkedin)
                                        <a href="{{ $user->profile->linkedin }}" target="_blank" class="btn btn-sm btn-primary mb-1"><i class="fab fa-linkedin-in"></i></a>
                                    @endif
                                    @if($user->profile->instagram)
                                        <a href="{{ $user->profile->instagram }}" target="_blank" class="btn btn-sm btn-danger mb-1"><i class="fab fa-instagram"></i></a>
                                    @endif
                                    @if(!$user->profile->facebook && !$user->profile->twitter && !$user->profile->linkedin && !$user->profile->instagram)
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @else
                        <div class="alert alert-info">No profile information available</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- User Projects Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">User Projects ({{ $user->projects->count() }})</h6>
                    <button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#projectsCollapse">
                        Toggle Projects
                    </button>
                </div>
                <div class="card-body collapse show" id="projectsCollapse">
                    @if($user->projects->count() > 0)
                        <div class="list-group">
                            @foreach($user->projects as $project)
                                <div class="list-group-item mb-3">
                                    <div class="d-flex justify-content-between">
                                        <h5>{{ $project->title }}</h5>
                                        <small>{{ $project->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if($project->image)
                                        <img src="{{ asset($project->image) }}" class="img-fluid mb-2" style="max-height: 150px;">
                                    @endif
                                    <p>{{ Str::limit($project->description, 150) }}</p>
                                    
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="badge badge-primary">
                                                <i class="fas fa-thumbs-up"></i> {{ $project->likes->count() }} Likes
                                            </span>
                                            <span class="badge badge-info ml-2">
                                                <i class="fas fa-comments"></i> {{ $project->comments->count() }} Comments
                                            </span>
                                        </div>
                                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-info">
                                            View Project
                                        </a>
                                    </div>

                                    <!-- Comments Section -->
                                    @if($project->comments->count() > 0)
                                        <div class="mt-3">
                                            <h6>Recent Comments:</h6>
                                            <div class="list-group">
                                                @foreach($project->comments->take(3) as $comment)
                                                    <div class="list-group-item small">
                                                        <div class="d-flex justify-content-between">
                                                            <strong>{{ $comment->user->name }}</strong>
                                                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                        </div>
                                                        <p class="mb-0">{{ $comment->content }}</p>
                                                    </div>
                                                @endforeach
                                                @if($project->comments->count() > 3)
                                                    <a href="{{ route('projects.show', $project->id) }}" class="list-group-item text-center small">
                                                        View all {{ $project->comments->count() }} comments
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">This user hasn't posted any projects yet.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
        </form>
        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $user->id }})">Delete User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection