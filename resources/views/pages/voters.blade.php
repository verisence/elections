@extends('welcome')

@section('page-title')
    <h1>Voters</h1>
@endsection

@section('content')

    @if (count($voters)>0)
        <div class="row">
            @foreach ($voters as $voter)
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{$voter->name}}
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                Phone: {{$voter->phone_number}}
                            </h6>
                            <p>
                                <a href="/voters/{{$voter->id}}" class="btn btn-sm btn-success">View More</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h3>No voters added at the moment click the button below to create a new one</h3>
    @endif

    <a href="/voters/create" class="btn btn-primary" style="margin-bottom:2rem">Create New</a>
@endsection
