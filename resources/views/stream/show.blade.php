@extends('welcome')

@section('page-title')
    <a href="/streams" class="btn btn-default" style="margin-bottom:2rem"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h1>{{$stream->name}}</h1>
@endsection

@section('content')

<div class="card mx-auto" style="width:75%">

    <div class="card-header">
        <h5>{{$stream->name}}</h5>
        </div>
        <div class="card-body">

        <p class="card-text">
            Polling Station: {{$station->name}}
        </p>
        <p class="card-text">
            Votes: {{$stream->votes}}
        </p>
        <p class="card-text">
            Pending:
        </p>

        <a href="/stream/{{$stream->id}}/edit" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modal-edit">Edit</a>
        {!!Form::open(['action' => ['App\Http\Controllers\StreamsController@destroy', $stream->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
            {!!Form::close()!!}
        </div>
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Stream</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['action'=>['App\Http\Controllers\StreamsController@update',$stream->id], 'method'=>'POST']) !!}
              {!! csrf_field() !!}
              <div class="modal-body">

                <input type="text" value="{{$stream['name']}}" class="form-control" name="name">
                <br>
                <select name="station[]" class="form-control">
                    @foreach ($stations as $station)
                      <option value="{{$station->id}}">{{$station->name}}</option>
                    @endforeach
                </select>
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
