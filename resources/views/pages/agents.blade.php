@extends('welcome')

@section('page-title')
    <h1>Agents</h1>
@endsection

@section('content')

<a href="/agents/create" class="btn btn-primary" style="margin-bottom:2rem">Create New</a>

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="">All Agents</h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone number</th>
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
                            <td>
                                {{ $agent->email }}
                            </td>
                            <td>{{ $agent->votes }}</td>
                            <td>
                                <a href="/agents/{{ $agent->id }}" class="btn btn-sm btn-info"
                                    role="button">More</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            No agents at the moment
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
