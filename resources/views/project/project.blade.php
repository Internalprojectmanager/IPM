@extends('layout.app')

@section('title')
    Project
@endsection

@section('breadcrumbs', Breadcrumbs::render('projects'))

@section('content')
    <div class="row">
        <a class="black" href="{{route('addproject')}}">
        <button class="btn-primary">
             Add project <span class="icon-right glyphicon glyphicon-plus"></span>
        </button></a>

    </div>

    <div class="row block-white">
        <span class="block-white-title">All projects</span>
        <span class="block-white-subtitle">
            <span id="count_projects_bar">|</span>
            <span class="counter">{{$projectcount}}</span>
            <span class="contenttype">Projects</span>
        </span>
        @if(config('app.secure') == TRUE)
            <form method="get" action="{{secure_url('/project/overview')}}" class="pull-right searchform">
        @else
            <form method="get" action="{{url('/project/overview')}}" class="pull-right searchform">
        @endif
            <div class="form-group pull-right">
                <input type="text" name="search" id="searchfield" class="search searchfield" placeholder="Search">
            </div>

            <div class="form-group pull-right">
                <select name='client' type="text" id="client" class="search dropdown-search">
                    <option selected value="">Client</option>
                    @foreach($clients as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group pull-right">
                <select name='status' id="status" type="text" class="search dropdown-search">
                    <option  selected value="">Status</option>
                    @foreach($status as $s)
                        <option value="{{$s->id}}">{{$s->name}}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" id="sort" value="">
            <input type="hidden" id="page" value="">
            <input type="hidden" id="order" value="">
        </form>
    </div>

    @include('project.project_table')
@endsection