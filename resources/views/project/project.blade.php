@extends('layout.app')

@section('title')
    Project
@endsection

@section('breadcrumbs', Breadcrumbs::render('projects'))

@section('content')
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
        <div class="col-md-8 col-xs-12 pull-right">
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


    </div>

    @include('project.project_table')
    @include('project.add_project')
@endsection