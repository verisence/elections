@extends('welcome')

@section('page-title')
    <h1>Agents</h1>
@endsection

@section('content')

    @if (count($agents)>0)
        <div class="row">
            @foreach ($agents as $agent)
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{$agent->name}}</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                {{$agent->name}}
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                Stream: {{$agent->stream_id}}
                            </h6>
                            <p>
                                <a href="/agents/{{$agent->id}}" class="btn btn-sm btn-success">View More</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h3>No agents added at the moment click the button below to create a new one</h3>
    @endif

    <a href="/agents/create" class="btn btn-primary" style="margin-bottom:2rem">Create New</a>
@endsection
