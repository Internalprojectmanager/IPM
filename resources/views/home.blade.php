@extends('layout.app')

@section('title')
    Homepage
@endsection

@section('content')
    <div class="title m-b-md">
        Welcome {{ Auth::user()->first_name }}
    </div>

@endsection
