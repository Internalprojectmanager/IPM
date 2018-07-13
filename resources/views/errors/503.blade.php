@extends('layout.app')

@section('title')
    Maintenance | {{env('APP_NAME')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 center">
                    <h1 class="supertitle">IPM</h1>
                    <h3 class="undertitle">Under maintenance - Please come back later</h3>

                    @if(isset($e))
                        <h2>{{ $e->getMessage() }}</h2>
                    @endif
                </div>
            </div>
            <div class="row center">
                <h4>Check our socials for status updates</h4>
                <p>
                    <a href="https://twitter.com/internalpm" target="_blank"><i class="fab fa-twitter fa-2x black"></i></a>
                    <a href="https://instagram.com/internalprojectmanager" target="_blank"><i class="fab fa-instagram fa-2x black"></i></a>
                    <a href="https://gitlab.com/internalprojectmanager/IPM" target="_blank"><i class="fab fa-gitlab fa-2x black"></i></a>
                </p>
            </div>
        </div>
    </div>
@endsection