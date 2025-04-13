@extends('layouts.admin')
@section('title', 'DesignHive | Subscriptions')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Subscriptions</h1>

    {{-- Display success message --}}
    @if(session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="mb-3">
            <a href="{{ route('subscription-plans.index') }}" class="btn btn-primary">
                <i class="fas fa-list"></i> View All Plans
            </a>
        </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Subscriptions List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Plan</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscriptions as $subscription)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subscription->user->name ?? 'Unknown' }} <br> <small>(ID: {{ $subscription->user_id }})</small></td>
                            <td>{{ $subscription->plan->name ?? 'Unknown' }} <br> <small>(ID: {{ $subscription->plan_id }})</small></td>
                            <td>{{ $subscription->start_date }}</td>
                            <td>{{ $subscription->end_date }}</td>
                            <td>
                                <span class="badge badge-{{ $subscription->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($subscription->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('subscriptions.show', $subscription->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
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