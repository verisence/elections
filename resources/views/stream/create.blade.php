@extends('welcome')

@section('page-title')
    <h1>Create a new Stream</h1>
@endsection

@section('content')

{!! Form::open(['action' => 'App\Http\Controllers\StreamsController@store', 'method' => 'POST']) !!}
    {!!Form::label('name', 'Name');!!}
    {!! Form::text('name'); !!}
    {!!Form::label('station', 'Polling Station');!!}
    <select name="station[]" class="form-control">
        @foreach ($stations as $station)
          <option value="{{$station->id}}">{{$station->name}}</option>
        @endforeach
    </select>
    {{-- {!!Form::select('station', ['1' => 'Parklands', '2' => 'Westlands', '4' => 'Kremlin'], null, ['placeholder' => 'Pick a station...']);!!} --}}
    {!! Form::submit('Save'); !!}
{!! Form::close() !!}

@endsection
