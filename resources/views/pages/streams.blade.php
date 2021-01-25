@extends('welcome')

@section('page-title')
    <h1>Streams</h1>
@endsection

@section('content')

    @if (count($streams)>0)
        <div class="row">
            @foreach ($streams as $stream)
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{$stream->name}}
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                Polling Station: {{$stream->station_id}}
                            </h6>
                            <p>
                                <a href="/streams/{{$stream->id}}" class="btn btn-sm btn-success">View More</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h3>No streams added at the moment click the button below to create a new one</h3>
    @endif

    <a href="/streams/create" class="btn btn-primary" style="margin-bottom:2rem">Create New</a>
@endsection
