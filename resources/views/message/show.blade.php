@extends('welcome')

@section('page-title')
    <a href="/messages" class="btn btn-default" style="margin-bottom:2rem"><i class="fas fa-arrow-left"></i> Messages</a>
@endsection

@section('content')

    <div class="card mx-auto" style="width:75%">
        <div class="card-header">
            <h5>{{ $message->title }}</h5>
        </div>
        <div class="card-body">

            <p class="card-text">
                {{ $message->message }}
            </p>

            <a href="/message/{{ $message->id }}/edit" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modal-edit">Edit</a>
            <a href="/message/{{ $message->id }}/delete" class="btn btn-danger float-right" role="button" data-toggle="modal" data-target="#modal-delete">Delete</a>
        </div>
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Message</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => ['App\Http\Controllers\MessagesController@update', $message->id], 'method' =>
                'POST']) !!}
                {!! csrf_field() !!}
                <div class="modal-body">

                    <input type="text" value="{{ $message['title'] }}" class="form-control" name="title">
                    <br>
                    <textarea class="form-control" rows="6" name="message">{{ $message['message'] }}</textarea>
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
                    <h4 class="modal-title">Delete Message</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => ['App\Http\Controllers\MessagesController@destroy', $message->id], 'method' =>
                'POST']) !!}
                <div class="modal-body">
                    <p>Are you sure you want to delete "{{ $message['title'] }}" from the messages' list?</p>
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
