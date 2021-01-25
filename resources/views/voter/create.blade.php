@extends('welcome')

@section('page-title')
    <h1>Create a new voter</h1>
@endsection

@section('content')

{!! Form::open(['action' => 'App\Http\Controllers\VotersController@store', 'method' => 'POST']) !!}
    {!!Form::label('name', 'Name');!!}
    {!! Form::text('name'); !!}
    {!!Form::label('id_number', 'ID Number');!!}
    {!! Form::text('id_number'); !!}
    {!!Form::label('phone', 'Phone Number');!!}
    {!! Form::text('phone'); !!}
    {!!Form::label('email', 'Email');!!}
    {!! Form::text('email'); !!}
    {!! Form::submit('Save'); !!}
{!! Form::close() !!}

@endsection
