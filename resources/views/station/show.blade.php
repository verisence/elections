@extends('welcome')

@section('page-title')
    <a href="/stations" class="btn btn-default" style="margin-bottom:2rem"><i class="fas fa-arrow-left"></i> Go Back</a>
@endsection

@section('content')

    <div class="card mx-auto" style="width:75%">
      <div class="card-header">
        <h5>{{$station->name}}</h5>
      </div>
      <div class="card-body">

        <p class="card-text">
          Location: {{$station->location}}
        </p>
        <p class="card-text">
          Votes: {{$station->votes}}
        </p>
        <p class="card-text">
            @if ($station->pending==1)
                Pending: Yes
            @else
                Pending: No
            @endif
        </p>

        <a href="/station/{{$station->id}}/edit" class="btn btn-primary" role="button" data-toggle="modal" data-target="#modal-edit">Edit</a>
        {!!Form::open(['action' => ['App\Http\Controllers\StationsController@destroy', $station->id], 'method' => 'POST', 'class' => 'float-right'])!!}
              {{Form::hidden('_method','DELETE')}}
              {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
          {!!Form::close()!!}
      </div>
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Polling Station</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['action'=>['App\Http\Controllers\StationsController@update',$station->id], 'method'=>'POST']) !!}
              {!! csrf_field() !!}
              <div class="modal-body">

                <input type="text" value="{{$station['name']}}" class="form-control" name="name">
                <br>
                <input type="text" value="{{$station['location']}}" class="form-control" name="location">
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
