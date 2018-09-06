@extends('layout.app')

@section('content')
    <div class="header-3 center" id="edit-project">
        @if(Auth::user()->active == false)
            <h1>Welcome to IPM</h1>
            <h3>Please activate your email address</h3>
        @else
            <h1>Please activate your email address</h1>
        @endif
        @include('partials.single-post-submit', [
             'name'  =>  'Send Activation Mail',
             'route' =>  'sendActivationMail',
             'a_class' => 'btn btn-save ',
        ])
    </div>
@endsection