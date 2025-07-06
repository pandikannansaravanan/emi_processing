@extends('common.template')

@section('title', 'Loan Details Page')

@section('content')
<div class="container mt-3">
    <h1 class="text-center mb-4">Loan Details</h1>
    <p>Welcome, <b>{{ Auth::user()->name }}!</b> Here are the details of the loans:</p>
    <table class="table table-striped table-hover table-responsive table-sm">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Client ID</th>
                <th>Num of Payment</th>
                <th>First Payment Date</th>
                <th>Last Payment Date</th>
                <th>Loan Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $key=>$loan)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $loan->clientid }}</td>
                    <td>{{ $loan->num_of_payment }}</td>
                    <td>{{ $loan->first_payment_date }}</td>
                    <td>{{ $loan->last_payment_date }}</td>
                    <td>{{ $loan->loan_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
    <script>
        console.log('This script only runs on the home page!');
    </script>
@endpush
