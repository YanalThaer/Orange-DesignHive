@extends('layouts.admin')
@section('title', 'DesignHive | Payments')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Payments</h1>

    {{-- Display success message --}}
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Payments List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->user->name ?? 'Unknown' }} <br> (ID: {{ $payment->user_id }})</td>
                            <td>${{ number_format($payment->amount, 2) }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td>{{ ucfirst($payment->status) }}</td>
                            <td>
                                <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-sm btn-info">Show</a>
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