@extends('welcome')

@section('page-title')
    <a href="/agents" class="btn btn-default" style="margin-bottom:2rem"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h1>{{$agent->name}}</h1>
@endsection

@section('content')

    <div class="jumbotron">
        <div class="container">
            <p class="lead">{{$agent->phone_number}}</p>
            <small>Email: {{$agent->email}}</small>
            <br>
            <br>
            <a href="/agent/{{$agent->id}}/edit" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modal-edit">Edit</a>
            {!!Form::open(['action' => ['App\Http\Controllers\AgentsController@destroy', $agent->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
            {!!Form::close()!!}
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
            {!! Form::open(['action'=>['App\Http\Controllers\AgentsController@update',$agent->id], 'method'=>'POST']) !!}
              {!! csrf_field() !!}
              <div class="modal-body">

                <input type="text" value="{{$agent['name']}}" class="form-control" name="name">
                <br>
                <input type="text" value="{{$agent['id_number']}}" class="form-control" name="id_number">
                <br>
                <input type="text" value="{{$agent['phone_number']}}" class="form-control" name="phone_number">
                <br>
                <input type="text" value="{{$agent['email']}}" class="form-control" name="email">
                <br>
                {{-- <textarea class="text" name="id_number">{{$agent['id_number']}}</textarea> --}}
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
