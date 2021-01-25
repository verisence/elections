@extends('welcome')

@section('page-title')
    <a href="/payments" class="btn btn-default" style="margin-bottom:2rem"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h1>{{$payment->agent_id}}</h1>
@endsection

@section('content')

    <div class="jumbotron">
        <div class="container">
            <p class="lead">{{$payment->phone_number}}</p>
            <small>Amount: {{$payment->amount}}</small>
            <br>
            <br>
            <a href="/payment/{{$payment->id}}/edit" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modal-edit">Edit</a>
            {!!Form::open(['action' => ['App\Http\Controllers\PaymentsController@destroy', $payment->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
            {!!Form::close()!!}
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
            {!! Form::open(['action'=>['App\Http\Controllers\PaymentsController@update',$payment->id], 'method'=>'POST']) !!}
              {!! csrf_field() !!}
              <div class="modal-body">

                <input type="text" value="{{$payment['amount']}}" class="form-control" name="amount">
                <br>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::hidden('_method', 'PUT') !!}
                {!! Form::submit('Submit', ['class'=>'btn btn-info']) !!}
              </div>
            {!! Form::close() !!}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
