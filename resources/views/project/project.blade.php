@extends('layout.app')

@section('title')
    Project Overview | {{env('APP_NAME')}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('projects'))

@section('content')
    @if(Session::has('flash_message'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
    @endif
    <div class="row">
        <a class="black btn btn-primary" href="#" data-toggle="modal" data-target="#addProjectModal">
            Add Project <span class="glyphicon glyphicon-plus"></span>
        </a>
    </div>

    <div class="row block-white">

        <div class="col-md-4 col-xs-12">
            <span class="block-white-title">All projects</span>
            <span class="block-white-subtitle">
            <span id="count_projects_bar">|</span>
            <span class="counter">{{$projectcount}}</span>
            <span class="contenttype">Projects</span>
        </span>
        </div>
        <div class="col-md-offset-1 col-md-7 col-xs-12 ">
            <form method="get" action="{{url('/project/overview')}}" class="searchform">
                <div class="form-group col-md-4 col-xs-12">
                    <select name='status' id="status" type="text" class="search dropdown-search">
                                        <option selected value="">-- All Statuses --</option>
                                        @foreach($status as $s)
                                            <option value="{{$s->id}}">{{$s->name}}</option>
                                        @endforeach
                                    </select>
                </div>

                <div class="form-group col-md-4 col-xs-12">
                    <select name='client' type="text" id="client" class="search dropdown-search">
                        <option selected value="">-- All Clients --</option>
                        @foreach($client as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
                </div>
                

                <div class="form-group col-md-4 col-xs-12">
                    <input type="text" name="search" id="searchfield" class="form-control search searchfield" placeholder="Search">
                </div>

                <input type="hidden" id="sort" value="">
                <input type="hidden" id="page" value="">
                <input type="hidden" id="order" value="">
            </form>
        </div>


    </div>

    @include('project.project_table')
    @include('project.add_project')
@endsection