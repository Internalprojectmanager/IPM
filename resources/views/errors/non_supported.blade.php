@extends('layout.loggedout') 
@section('title') Non Supported device | {{env('APP_NAME')}}
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 center">
                <h1>Device not supported</h1>
                <h4>Mobile and Tablet devices are not supported with IPM</h4>
                <p>Please use a different device such as a laptop or desktop </p>
            </div>
        </div>
    </div>
</div>
@endsection