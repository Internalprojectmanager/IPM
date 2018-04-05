@extends('layout.app')

@section('title')
    Dashboard | {{env('APP_NAME')}}
@endsection



@section('content')
    @if(Session::has('flash_message'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
    @endif

    <div class="row block-white">

        <div class="col-md-4 col-xs-12">
            <span class="block-white-title">To-do</span>
            <span class="block-white-subtitle">
                <span id="count_projects_bar">|</span>
                <span class="counter">{{$requirementscount}}</span>
                <span class="contenttype hidden"></span>
                <span>To-do</span>
            </span>
        </div>
        <div class="col-md-8 col-xs-12 pull-right">
        </div>

        <form action="{{url('/dashboard')}}" class=" searchform">
            <input type="hidden" value="{{csrf_token()}}"/>

            <div class="form-group pull-right">
                <input type="text" name="search" id="searchfield" class="form-control search searchfield" placeholder="Search">
            </div>

            <input type="hidden" id="sort" value="">
            <input type="hidden" id="page" value="">
            <input type="hidden" id="order" value="">
        </form>
    </div>

    @include('profile.dashboard_table')
@endsection