@extends('layouts.admin')
@section('title', 'DesignHive | Subscription Details')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Subscription Details</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Subscription Information</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Subscription ID</th>
                    <td>{{ $subscription->id }}</td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>
                        {{ $subscription->user->name ?? 'Unknown' }}<br>
                        <small class="text-muted">(ID: {{ $subscription->user_id }})</small>
                    </td>
                </tr>
                <tr>
                    <th>Plan</th>
                    <td>
                        {{ $subscription->plan->name ?? 'Unknown' }}<br>
                        <small class="text-muted">(ID: {{ $subscription->plan_id }})</small>
                    </td>
                </tr>
                <tr>
                    <th>Start Date</th>
                    <td>{{ \Carbon\Carbon::parse($subscription->start_date)->format('F j, Y') }}</td>
                </tr>
                <tr>
                    <th>End Date</th>
                    <td>{{ \Carbon\Carbon::parse($subscription->end_date)->format('F j, Y') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge badge-{{ $subscription->status === 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($subscription->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $subscription->created_at->format('F j, Y - g:i A') }}</td>
                </tr>
                <tr>
                    <th>Last Updated</th>
                    <td>{{ $subscription->updated_at->format('F j, Y - g:i A') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
</div>

@endsection
