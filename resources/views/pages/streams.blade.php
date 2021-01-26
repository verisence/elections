@extends('welcome')

@section('page-title')
    <h1>Streams</h1>
@endsection

@section('content')
    <a href="/streams/create" class="btn btn-primary" style="margin-bottom:2rem">Create New</a>

    @if (count($streams)>0)
        <div class="row">
            @foreach ($streams as $stream)
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{$stream->name}}</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">
                                Polling station:
                                @foreach ($stations as $station)
                                    @if ($station->id==$stream->station_id)
                                        {{$station->name}}
                                    @endif
                                @endforeach
                            </h6>
                            <span class="card-text">{{$stream->votes}} votes</span>
                        </div>
                        <div class="card-footer">
                            <a href="/streams/{{$stream->id}}" class="btn btn-sm btn-info">View More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h3>No streams added at the moment click the button above to create a new one</h3>
    @endif

@endsection
