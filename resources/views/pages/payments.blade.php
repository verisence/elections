@extends('welcome')

@section('page-title')
    <h1>Payments</h1>
@endsection

@section('content')

    @if (count($payments)>0)
        <div class="row">
            @foreach ($payments as $payment)
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{$payment->agent_id}}
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                Amount: {{$payment->amount}}
                            </h6>
                            <p>
                                <a href="/payments/{{$payment->id}}" class="btn btn-sm btn-success">View More</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h3>No payments made at the moment click the button below to create a new one</h3>
    @endif

    <a href="/payments/create" class="btn btn-primary" style="margin-bottom:2rem">Create New</a>
@endsection
