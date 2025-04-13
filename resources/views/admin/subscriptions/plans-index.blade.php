@extends('layouts.admin')
@section('title', 'DesignHive | Subscription Plans')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Subscription Plans</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Available Plans</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Type</th>
                            <th>Contact Designer</th>
                            <th>Featured Post</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plans as $plan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $plan->name }}</td>
                            <td>${{ number_format($plan->price, 2) }}</td>
                            <td>{{ ucfirst($plan->duration) }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $plan->type)) }}</td>
                            <td>
                                @if($plan->can_contact_designer)
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                @if($plan->featured_post)
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-secondary">No</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Subscriptions
    </a>
</div>

@endsection
