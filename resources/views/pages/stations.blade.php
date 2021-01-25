@extends('welcome')

@section('page-title')
    <h1>Polling Stations</h1>
@endsection

@section('content')
    <p>Here is all the relevant station data.</p>

    @if (count($stations)>0)
        <div class="row">
            @foreach ($stations as $station)
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{$station->name}}</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">
                                Location: {{$station->location}}
                            </h6>
                            <p>
                                <a href="/stations/{{$station->id}}" class="btn btn-sm btn-success">View More</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h3>No polling stations added at the moment click the button below to create a new one</h3>
    @endif

    <a href="/stations/create" class="btn btn-primary" style="margin-bottom:2rem">Add New</a>
@endsection
