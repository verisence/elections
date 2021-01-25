@extends('welcome')

@section('page-title')
    <h1>Create a new Stream</h1>
@endsection

@section('content')

<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Create a polling station</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    {!! Form::open(['action' => 'App\Http\Controllers\StreamsController@store', 'method' => 'POST']) !!}
        <div class="card-body">

        {!!Form::label('name', 'Name');!!}
        {!! Form::text('name',null, ['class' => 'form-control', 'placeholder'=>"Name"]); !!}
        {!!Form::label('location', 'Location');!!}
        <select name="station[]" class="form-control">
            @foreach ($stations as $station)
              <option value="{{$station->id}}">{{$station->name}}</option>
            @endforeach
        </select>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
        {!! Form::submit('Save', ['class'=>'btn btn-info float-right']); !!}
        </div>
    {!! Form::close() !!}
</div>

@endsection
