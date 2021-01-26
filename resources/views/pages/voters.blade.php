@extends('welcome')

@section('page-title')
    <h1>Voters</h1>
@endsection

@section('content')

<a href="/voters/create" class="btn btn-primary" style="margin-bottom:2rem">Create New</a>

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="">All Voters</h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>ID number</th>
                    <th>Phone number</th>
                    <th>Email</th>
                    <th style="width: 40px"> </th>
                </tr>
            </thead>
            <tbody>

                @if (count($voters) > 0)
                    @foreach ($voters as $voter)
                        <tr>
                            <td>{{ $voter->name }}</td>
                            <td>{{ $voter->id_number }}</td>
                            <td>{{ $voter->phone_number }}</td>
                            <td>
                                {{ $voter->email }}
                            </td>
                            <td>
                                <a href="/voters/{{ $voter->id }}" class="btn btn-sm btn-info"
                                    role="button">More</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            No voters at the moment
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
