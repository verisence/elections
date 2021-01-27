@extends('welcome')

@section('page-title')
    <a href="/agents" class="btn btn-default" style="margin-bottom:2rem"><i class="fas fa-arrow-left"></i> Agents</a>
@endsection

@section('content')


    <div class="card mx-auto" style="width:75%">

        <div class="card-header">
            <h5>{{ $agent->name }} <span class="float-right">
                    <h6>Payments <span class="badge badge-info right">{{ count($payments) }}</span></h6>
                </span></h5>
        </div>
        <div class="card-body">

            <p class="card-text">
                Email address: {{ $agent->email }}
            </p>
            <p class="card-text">
                Phone number: {{ $agent->phone_number }}
            </p>
            <p class="card-text">
                ID number: {{ $agent->id_number }}
            </p>
            <p class="card-text">
                Polling Station: {{ $station->name }}
            </p>
            <p class="card-text">
                Stream: {{ $stream->name }}
            </p>
            <p class="card-text">
                Votes: {{ $agent->votes }}
            </p>

            {!! Form::open(['action' => ['App\Http\Controllers\AgentsController@vote', $agent->id], 'method' => 'POST']) !!}
            {!! Form::label('votes', 'Update votes') !!}
            {!! Form::text('votes', null, ['class' => 'form-control']) !!}
            <br>
            {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
            <br>

            <table class="table">
                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Paid on</th>
                        <th style="width: 40px"> </th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($payments) > 0)
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->amount }}</td>
                                {{-- <td>{{ $payment->created_at->format('M j, Y g:i a') }}</td> --}}
                                <td>{{ date('M j, Y g:i a', strtotime($payment->created_at.'+3 hour')) }}</td>
                                <td>
                                    <a href="/payments/{{ $payment->id }}" class="btn btn-sm btn-info"
                                        role="button">More</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>
                                <a href="" class="btn btn-sm btn-info" role="button" data-toggle="modal" data-target="#modal-create">Make Payment</a>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                        <tr>
                            <td>
                                This agent has received no payments
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="" class="btn btn-sm btn-info" role="button" data-toggle="modal" data-target="#modal-create">Make Payment</a>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif

                </tbody>
            </table>

            <div class="card-footer">
                <a href="/stream/{{ $stream->id }}/edit" class="btn btn-primary" role="button" data-toggle="modal"
                    data-target="#modal-edit">Edit</a>
                <a href="/stream/{{ $stream->id }}/delete" class="btn btn-danger float-right" role="button"
                    data-toggle="modal" data-target="#modal-delete">Delete</a>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Agent Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => ['App\Http\Controllers\AgentsController@update', $agent->id], 'method' =>
                'POST']) !!}
                {!! csrf_field() !!}
                <div class="modal-body">

                    <input type="text" value="{{ $agent['name'] }}" class="form-control" name="name">
                    <br>
                    <input type="text" value="{{ $agent['id_number'] }}" class="form-control" name="id_number">
                    <br>
                    <input type="text" value="{{ $agent['phone_number'] }}" class="form-control" name="phone_number">
                    <br>
                    <input type="text" value="{{ $agent['email'] }}" class="form-control" name="email">
                    <br>
                    <select name="stream[]" id="stream" class="form-control">
                        {{-- <option value="" disabled selected>Select a polling station stream...</option> --}}
                        @foreach ($streams as $stream)
                          <option value="{{$stream->id}}" {{$stream->id == $agent->stream_id ? 'selected' : ''}}>{{$stream->name}}</option>
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

    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Make a payment to {{$agent->name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {!! Form::open(['action' => ['App\Http\Controllers\AgentsController@makePayment', $agent->id], 'method' =>
                'POST']) !!}
                <div class="modal-body">
                    <input type="text" placeholder="Amount" class="form-control" name="amount">
                    <br>
                    <select disabled name="agent[]" id="agent" class="form-control">
                        <option value="{{$agent->id}}" disabled selected>{{$agent->name}}</option>
                    </select>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    {!! Form::submit('Save', ['class' => 'btn btn-info']) !!}
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
                    <h4 class="modal-title">Delete Agent</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => ['App\Http\Controllers\AgentsController@destroy', $agent->id], 'method' =>
                'POST']) !!}
                <div class="modal-body">
                    <p>Are you sure you want to delete "{{ $agent['name'] }}" from the agents' list?</p>
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
