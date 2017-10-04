@extends('layout.app')

@section('title')
    Homepage
@endsection

@section('content')
    <div>
        <img src="{{asset('img/iav_logo.jpg')}}" width="150" height="auto" />
    </div>
    <div class="title m-b-md">
        IPM ITSAVIRUS<hr>
    </div>
    <div class="m-b-md">
        IPM is alleen toegankelijk voor geautoriseerde gebruikers
    </div>

@endsection