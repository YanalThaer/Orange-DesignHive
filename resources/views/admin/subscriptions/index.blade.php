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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Subscriptions List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Plan</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->id }}</td>
                            <td>{{ $subscription->user->name ?? 'Unknown' }} <br> (ID: {{ $subscription->user_id }})</td>
                            <td>{{ $subscription->plan->name ?? 'Unknown' }} <br> (ID: {{ $subscription->plan_id }})</td>
                            <td>{{ ucfirst($subscription->status) }}</td>
                            <td>
                                <a href="{{ route('subscriptions.show', $subscription->id) }}" class="btn btn-sm btn-info">Show</a>
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