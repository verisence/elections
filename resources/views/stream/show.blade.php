@extends('welcome')

@section('page-title')
    <a href="/streams" class="btn btn-default" style="margin-bottom:2rem"><i class="fas fa-arrow-left"></i> Streams</a>
@endsection

@section('content')

    <div class="card mx-auto" style="width:75%">

        <div class="card-header">
            <h5>{{ $stream->name }} <span class="float-right">
                    <h6>Agents <span class="badge badge-info right">{{ count($agents) }}</span></h6>
                </span></h5>
        </div>
        <div class="card-body">

            <p class="card-text">
                Polling Station: {{ $station->name }}
            </p>
            <p class="card-text">
                Votes: {{ $stream->votes }}
            </p>
            <p class="card-text">
                @if ($station->pending == 1)
                    Pending: Yes
                @else
                    Pending: No
                @endif
            </p>

            <table class="table">
                <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Votes</th>
                        <th style="width: 40px"> </th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($agents) > 0)
                        @foreach ($agents as $agent)
                            <tr>
                                <td>{{ $agent->name }}</td>
                                <td>{{ $agent->phone_number }}</td>
                                <td>{{ $agent->email }}</td>
                                <td>
                                    {{ $agent->votes }}
                                </td>
                                <td>
                                    <a href="/agents/{{ $agent->id }}" class="btn btn-sm btn-info" role="button">More</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                This stream has no agents
                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>

            <div class="card-footer">
                <a href="/stream/{{ $stream->id }}/edit" class="btn btn-primary" role="button" data-toggle="modal"
                    data-target="#modal-edit">Edit</a>
                <a href="/stream/{{ $stream->id }}/delete" class="btn btn-danger float-right" role="button"
                    data-toggle="modal" data-target="#modal-delete">Delete</a>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Stream</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => ['App\Http\Controllers\StreamsController@update', $stream->id], 'method' =>
                'POST']) !!}
                {!! csrf_field() !!}
                <div class="modal-body">

                    <input type="text" value="{{ $stream['name'] }}" class="form-control" name="name">
                    <br>
                    <select name="station[]" id="station" class="form-control">
                        {{-- <option value="" disabled selected>Select a polling station...</option> --}}
                        @foreach ($stations as $station)
                          <option value="{{$station->id}}" {{$station->id == $stream->station_id ? 'selected' : ''}}>{{$station->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::hidden('_method', 'PUT') !!}
                    {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content bg-default">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Stream</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => ['App\Http\Controllers\StreamsController@destroy', $stream->id], 'method' =>
                'POST']) !!}
                <div class="modal-body">
                    <p>Are you sure you want to delete "{{ $stream['name'] }}" from the streams' list?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
