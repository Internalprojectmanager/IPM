@extends('layout.loggedout')

@section('title')
    503 Service Unavailable | {{env('APP_NAME')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 center">
                    <h1 class="supertitle">IPM</h1>
                    <h3 class="undertitle">Service Unavailable - Please come back later</h3>

                    <h2>{{ $e->getMessage() }}</h2>
                </div>
            </div>
        </div>
    </div>
@endsection