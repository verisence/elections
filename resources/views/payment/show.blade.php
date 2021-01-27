@extends('welcome')

@section('page-title')
    <a href="/payments" class="btn btn-default" style="margin-bottom:2rem"><i class="fas fa-arrow-left"></i> Payments</a>
@endsection

@section('content')

    <div class="card mx-auto" style="width:75%">
        <div class="card-header">
            <h5>Paid to: {{ $agent->name }} <span class="float-right">Amount: Ksh. {{$payment->amount}}</span></h5>
        </div>
        <div class="card-body">

            <p class="card-text">
                Agent ID Number: {{ $agent->id_number }}
            </p>
            <p class="card-text">
                Agent Phone Number: {{ $agent->phone_number }}
            </p>

            <p class="card-text">
                Agent Email: {{ $agent->email }}
            </p>

            <p class="card-text">
                Paid on: {{ $payment->created_at }}
            </p>
        </div>
        <div class="card-footer">

            <a href="/payment/{{ $payment->id }}/edit" class="btn btn-primary" role="button" data-toggle="modal"
                data-target="#modal-edit">Edit</a>
            <a href="/payment/{{ $payment->id }}/delete" class="btn btn-danger float-right" role="button" data-toggle="modal"
                data-target="#modal-delete">Delete</a>

        </div>
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Payment Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => ['App\Http\Controllers\PaymentsController@update', $payment->id], 'method' =>
                'POST']) !!}
                {!! csrf_field() !!}
                <div class="modal-body">
                    <input type="text" value="{{ $payment['amount'] }}" class="form-control" name="amount">
                    <br>
                    <select name="agent[]" id="agent" class="form-control">
                        @foreach ($agents as $agent)
                          <option value="{{$agent->id}}" {{$agent->id==$payment->agent_id ? 'selected' : ''}}>{{$agent->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::hidden('_method', 'PUT') !!}
                    {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content bg-default">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => ['App\Http\Controllers\PaymentsController@destroy', $payment->id], 'method' =>
                'POST']) !!}
                <div class="modal-body">
                    <p>Are you sure you want to delete the payment made to {{ $agent['name'] }}?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
