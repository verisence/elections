@extends('welcome')

@section('page-title')
    <a href="/voters" class="btn btn-default" style="margin-bottom:2rem"><i class="fas fa-arrow-left"></i> Voters</a>
@endsection

@section('content')

    <div class="card mx-auto" style="width:75%">
        <div class="card-header">
            <h5>{{ $voter->name }}</h5>
        </div>
        <div class="card-body">

            <p class="card-text">
                ID Number: {{ $voter->id_number }}
            </p>
            <p class="card-text">
                Phone Number: {{ $voter->phone_number }}
            </p>

            <p class="card-text">
                Email: {{ $voter->email }}
            </p>
        </div>
        <div class="card-footer">

            <a href="/voter/{{ $voter->id }}/edit" class="btn btn-primary" role="button" data-toggle="modal"
                data-target="#modal-edit">Edit</a>
            <a href="/voter/{{ $voter->id }}/delete" class="btn btn-danger float-right" role="button" data-toggle="modal"
                data-target="#modal-delete">Delete</a>

        </div>
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Voter Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => ['App\Http\Controllers\VotersController@update', $voter->id], 'method' =>
                'POST']) !!}
                {!! csrf_field() !!}
                <div class="modal-body">

                    <input type="text" value="{{ $voter['name'] }}" class="form-control" name="name">
                    <br>
                    <input type="text" value="{{ $voter['id_number'] }}" class="form-control" name="id_number">
                    <br>
                    <input type="text" value="{{ $voter['phone_number'] }}" class="form-control" name="phone_number">
                    <br>
                    <input type="text" value="{{ $voter['email'] }}" class="form-control" name="email">
                    <br>
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
                    <h4 class="modal-title">Delete Voter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => ['App\Http\Controllers\VotersController@destroy', $voter->id], 'method' =>
                'POST']) !!}
                <div class="modal-body">
                    <p>Are you sure you want to delete {{ $voter['name'] }} from the voters list?</p>
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
