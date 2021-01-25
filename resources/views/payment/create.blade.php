@extends('welcome')

@section('page-title')
@endsection

@section('content')


<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Make a payment</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    {!! Form::open(['action' => 'App\Http\Controllers\PaymentsController@store', 'method' => 'POST']) !!}
        <div class="card-body">

        {!!Form::label('amount', 'Amount');!!}
        {!! Form::text('amount',null, ['class' => 'form-control', 'placeholder'=>"Amount"]); !!}
        {!!Form::label('agents[]', 'Agent');!!}
        <select name="agents[]" class="form-control">
            @foreach ($agents as $agent)
              <option value="{{$agent->id}}">{{$agent->name}}</option>
            @endforeach
        </select>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
        {!! Form::submit('Save', ['class'=>'btn btn-info float-right']); !!}
        </div>
    {!! Form::close() !!}
</div>

{{-- {!! Form::open(['action' => 'App\Http\Controllers\PaymentsController@store', 'method' => 'POST']) !!}
    {!!Form::label('amount', 'Amount');!!}
    {!! Form::text('amount'); !!}
    <select name="agents[]" class="form-control">
        @foreach ($agents as $agent)
          <option value="{{$agent->id}}">{{$agent->name}}</option>
        @endforeach
    </select>
    {!! Form::submit('Save'); !!}
{!! Form::close() !!} --}}

@endsection
