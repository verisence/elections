@extends('welcome')

@section('page-title')
    <h1>Create New Message</h1>
@endsection

@section('content')

    {!! Form::open(['action' => 'App\Http\Controllers\MessagesController@store', 'method' => 'POST']) !!}
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    <br>
    {!! Form::label('message', 'Message') !!}
    {!! Form::textArea('message', null, ['class' => 'form-control', 'rows' => '2']) !!}
    <br>
    {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
    <br>
    {{-- <h3>All Messages</h3> --}}


    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="">All Messages</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th style="width: 40px"> </th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($messages) > 0)
                        @foreach ($messages as $message)
                            <tr>
                                <td>{{ $message->title }}</td>
                                <td>
                                    {{ date('M j, Y g:i a', strtotime($message->created_at.'+3 hour')) }}
                                </td>
                                <td>
                                    <a href="/messages/{{ $message->id }}" class="btn btn-sm btn-success"
                                        role="button">More</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                No messages
                            </td>
                            <td>
                                Create one above
                            </td>
                            <td>

                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

@endsection
