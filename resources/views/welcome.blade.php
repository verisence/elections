@extends('adminlte::page')

@section('title', 'Election Dashboard')


@section('content_header')
    @yield('page-title')
@stop

@section('content')
    <!-- yield the content -->
    @yield('content')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" >
@stop

{{-- @section('js')
    <script> console.log('Hi!'); </script>
@stop --}}
