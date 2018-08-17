@extends('layout.app')

@section('content')
    <div class="row">
        <h1>Please activate your email</h1>
        @include('partials.single-post-submit', [
             'name'  =>  '<i class="fas fa-check-circle black fa-2x"></i> Send Activation Mail',
             'route' =>  'sendActivationMail',
             'a_class' => 'btn btn-primary',
        ])
    </div>
@endsection