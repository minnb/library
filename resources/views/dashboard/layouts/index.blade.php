@extends('dashboard.app')
@section('title', 'Dashboard')
@section('content')
    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>

        <i class="ace-icon fa fa-check green"></i>

        Welcome to
        <strong class="green">
            {{ config('app.name', 'Laravel') }}
            <small>{{ config('app.version', 'v1.0') }}</small>
        </strong>
    </div>
@endsection


