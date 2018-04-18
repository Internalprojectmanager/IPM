@extends('layout.app')

@section('title')
    {{$client->name}} Details | {{env('APP_NAME')}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('singleclient', $client))

@section('content')

    <a href="#"  class="btn-edit" id="project-edit" data-toggle="modal" data-target="#editClientModal">
        <span class="glyphicon edit-icon"></span> Edit
    </a>

    <div class="row">
        <div class="header-3" id="project-details">
            <div class="row" id="block-show">
                <div class="col-md-4 col-xs-6">
                    <span class="project-title block-title">Client Name</span> <br>
                    <span class="project-detail block-value">{{$client->name}}</span>
                </div>

                <div class="col-md-4 col-xs-6">
                    <span class="project-title block-title">Status</span> <br>
                    <span class="project-detail block-value">{{$client->cstatus->name}}</span>
                </div>

                <div class="col-md-4 col-xs-6">
                    <span class="project-title block-title">Contact Person</span><br>
                    <i class="user-icon block-icons"><span class="project-detail block-value" id="contact-name">{{$client->contactname}}</span></i><br>
                    <i class="tel-icon block-icons"><span class="project-detail block-value" id="contact-phone"><a href="tel:{{$client->contactnumber}}">{{$client->contactnumber}}</a></span></i><br>
                    <i class="mail-icon block-icons"> <span class="project-detail block-value" id="contact-email"><a href="mailto:{{$client->contactemail}}">{{$client->contactemail}}</a></span></i>

                </div>

            </div>
            <div class="row under-details block-description" id="block-hidden">
                <div class="col-md-8 col-xs-12">
                    <span class="project-title block-title">Client Description</span><br>
                    <span class="project-detail block-value">{{$client->description}}</span>
                </div>

                <div class="col-md-4 col-xs-12 pull-right">
                    <span class="project-title block-title" id="link">Link</span><br>
                    <i class="word-icon block-value"><span class="project-detail block-value" id="link-world"><a href="{{$client->link_url}}">{{$client->link_url}}</a> </span></i><br>
                    <i class="text-icon block-value"><span class="project-detail block-value" id="link-t"></span>{{$client->link_title}}</i>
                </div>


            </div>
            <div class="row" id="no-buttons">

            </div>

            <div class="row col-md-12 col-xs-12" id="button-top">
                <button onclick="projectDetailsDown()" class="black-button" id="black-button-down"></button>
            </div>

        </div>
    <div class="row under-details">
        <a class="black btn btn-primary" href="#" data-toggle="modal" data-target="#addProjectModal">
            Add Project <span class="glyphicon glyphicon-plus"></span>
        </a>
        <form method="GET" action="{{route('clientsorting', ['name' =>  $client->path])}}" class="pull-right searchform">

            <input type="hidden" id="sort" value="">
            <input type="hidden" id="page" value="">
            <input type="hidden" id="order" value="">
        </form>
    </div>

    <div class="row under-details">
        <span class="block-white-title">All projects</span>
        <span class="block-white-subtitle">
            <span id="count_projects_bar">|</span>
            <span class="counter">{{$projectcount}}</span>
        </span>
    </div>
    @include('project.project_table')
    @include('client.add_project')
    @include('client.edit_client')


@endsection