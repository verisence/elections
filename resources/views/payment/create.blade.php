@extends('welcome')

@section('page-title')
    <h1>Make a payment</h1>
@endsection

@section('content')

{!! Form::open(['action' => 'App\Http\Controllers\PaymentsController@store', 'method' => 'POST']) !!}
    {!!Form::label('amount', 'Amount');!!}
    {!! Form::text('amount'); !!}
    <select name="agents[]" class="form-control">
        @foreach ($agents as $agent)
          <option value="{{$agent->id}}">{{$agent->name}}</option>
        @endforeach
    </select>
    {!! Form::submit('Save'); !!}
{!! Form::close() !!}

@endsection
