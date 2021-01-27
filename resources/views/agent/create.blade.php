@extends('welcome')

@section('page-title')
    <h1>Create a new Agent</h1>
@endsection

@section('content')


<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Create a polling station</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    {!! Form::open(['action' => 'App\Http\Controllers\AgentsController@store', 'method' => 'POST']) !!}
        <div class="card-body">

        {!!Form::label('name', 'Name');!!}
        {!! Form::text('name',null, ['class' => 'form-control', 'placeholder'=>"Name"]); !!}
        {!!Form::label('id_number', 'ID Number');!!}
        {!! Form::text('id_number',null, ['class' => 'form-control', 'placeholder'=>"ID Number"]); !!}
        {!!Form::label('phone', 'Phone');!!}
        {!! Form::text('phone',null, ['class' => 'form-control', 'placeholder'=>"Phone"]); !!}
        {!!Form::label('email', 'Email');!!}
        {!! Form::text('email',null, ['class' => 'form-control', 'placeholder'=>"Email"]); !!}
        {!!Form::label('stream', 'Stream');!!}
        <select name="stream[]" id="stream" class="form-control">
            <option value="" disabled selected>Select a polling station stream...</option>
            @foreach ($streams as $stream)
              <option value="{{$stream->id}}">{{$stream->name}}</option>
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
