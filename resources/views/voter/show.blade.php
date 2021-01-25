@extends('welcome')

@section('page-title')
    <a href="/voters" class="btn btn-default" style="margin-bottom:2rem"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h1>{{$voter->name}}</h1>
@endsection

@section('content')

    <div class="jumbotron">
        <div class="container">
            <p class="lead">{{$voter->phone_number}}</p>
            <small>Email: {{$voter->email}}</small>
            <br>
            <br>
            <a href="/voter/{{$voter->id}}/edit" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modal-edit">Edit</a>
            {!!Form::open(['action' => ['App\Http\Controllers\VotersController@destroy', $voter->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
            {!!Form::close()!!}
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
            {!! Form::open(['action'=>['App\Http\Controllers\VotersController@update',$voter->id], 'method'=>'POST']) !!}
              {!! csrf_field() !!}
              <div class="modal-body">

                <input type="text" value="{{$voter['name']}}" class="form-control" name="name">
                <br>
                <input type="text" value="{{$voter['id_number']}}" class="form-control" name="id_number">
                <br>
                <input type="text" value="{{$voter['phone_number']}}" class="form-control" name="phone_number">
                <br>
                <input type="text" value="{{$voter['email']}}" class="form-control" name="email">
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
