@extends('welcome')

@section('page-title')
    <h1>Payments</h1>
@endsection

@section('content')

    <a href="/payments/create" class="btn btn-primary" style="margin-bottom:2rem">Create New</a>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="">All Payments</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th style="width: 40px"> </th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($payments) > 0)
                        @foreach ($payments as $payment)

                            <tr>
                                <td>
                                    @foreach ($agents as $agent)
                                        @if ($agent->id == $payment->agent_id)
                                            {{$agent->name}}
                                        @endif
                                    @endforeach

                                </td>
                                <td>{{ $payment->created_at }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>
                                    <a href="/payments/{{ $payment->id }}" class="btn btn-sm btn-info"
                                        role="button">More</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                No payments at the moment
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
