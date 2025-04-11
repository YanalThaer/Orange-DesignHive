@extends('layouts.admin')
@section('title', 'DesignHive | Payment Details')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Payment Details</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Payment Information</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $payment->id }}</td>
                </tr>
                <tr>
                    <th>User ID</th>
                    <td>{{ $payment->user->name ?? 'Unknown' }} (ID: {{ $payment->user_id }})</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>${{ number_format($payment->amount, 2) }}</td>
                </tr>
                <tr>
                    <th>Payment Method</th>
                    <td>{{ $payment->payment_method }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($payment->status) }}</td>
                </tr>
                <tr>
                    <th>Transaction ID</th>
                    <td>{{ $payment->transaction_id }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $payment->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $payment->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection