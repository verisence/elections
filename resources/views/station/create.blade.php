@extends('welcome')

@section('page-title')
    <h1>Create a new Station</h1>
@endsection

@section('content')

{!! Form::open(['action' => 'App\Http\Controllers\StationsController@store', 'method' => 'POST']) !!}
    {!!Form::label('name', 'Name');!!}
    {!! Form::text('name'); !!}
    {!!Form::label('location', 'Location');!!}
    {!! Form::text('location'); !!}
    {!! Form::submit('Save'); !!}
{!! Form::close() !!}

@endsection
