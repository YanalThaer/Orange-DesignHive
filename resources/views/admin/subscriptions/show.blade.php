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
                    <th>ID</th>
                    <td>{{ $subscription->id }}</td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>{{ $subscription->user->name ?? 'Unknown' }} (ID: {{ $subscription->user_id }})</td>
                </tr>
                <tr>
                    <th>Plan</th>
                    <td>{{ $subscription->plan->name ?? 'Unknown' }} (ID: {{ $subscription->plan_id }})</td>
                </tr>
                <tr>
                    <th>Start Date</th>
                    <td>{{ $subscription->start_date }}</td>
                </tr>
                <tr>
                    <th>End Date</th>
                    <td>{{ $subscription->end_date }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($subscription->status) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection