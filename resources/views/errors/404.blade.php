@extends('layout.app')

@section('title')
    404 Page not found | {{env('APP_NAME')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 center">
                    <h1 class="supertitle">404</h1>
                    <h3 class="undertitle">Page cannot be found</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
