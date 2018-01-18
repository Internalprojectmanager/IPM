@extends('layout.app')

@section('title')
    Client details
@endsection

@section('breadcrumbs', Breadcrumbs::render('singleclient', $clients))

@section('content')

    <button type="button" class="btn-edit" id="project-edit" data-toggle="modal" data-target="#editClientModal">
        <span class="glyphicon edit-icon"></span> Edit
    </button>

    <div class="row">
        <div class="header-3" id="project-details">
            <div class="row" id="block-show">
                <div class="col-md-4 col-xs-6">
                    <span class="project-title block-title">Client Name</span> <br>
                    <span class="project-detail block-value">{{$clients->name}}</span>
                </div>

                <div class="col-md-4 col-xs-6">
                    <span class="project-title block-title">Status</span> <br>
                    <span class="project-detail block-value">{{$clients->cstatus->name}}</span>
                </div>

                <div class="col-md-4 col-xs-6">
                    <span class="project-title block-title">Contact Person</span><br>
                    <i class="user-icon block-icons"><span class="project-detail block-value" id="contact-name">{{$clients->contactname}}</span></i><br>
                    <i class="tel-icon block-icons"><span class="project-detail block-value" id="contact-phone"><a href="tel:{{$clients->contactnumber}}">{{$clients->contactnumber}}</a></span></i><br>
                    <i class="mail-icon block-icons"> <span class="project-detail block-value" id="contact-email"><a href="mailto:{{$clients->contactemail}}">{{$clients->contactemail}}</a></span></i>

                </div>

            </div>
            <div class="row under-details block-description" id="block-hidden">
                <div class="col-md-8 col-xs-12">
                    <span class="project-title block-title">Client Description</span><br>
                    <span class="project-detail block-value">{{$clients->description}}</span>
                </div>

                <div class="col-md-4 col-xs-12 pull-right">
                    <span class="project-title block-title" id="link">Link</span><br>
                    <i class="word-icon block-value"><span class="project-detail block-value" id="link-world"><a href="{{$clients->link_url}}">{{$clients->link_url}}</a> </span></i><br>
                    <i class="text-icon block-value"><span class="project-detail block-value" id="link-t"></span>{{$clients->link_title}}</i>
                </div>


            </div>
            <div class="row" id="no-buttons">

            </div>

            <div class="row col-md-12 col-xs-12" id="button-top">
                <button onclick="projectDetailsDown()" class="black-button" id="black-button-down"></button>
            </div>

        </div>
    <div class="row under-details">
        <a class="black" href="{{route('addproject')}}">
            <button class="btn-primary">
                Add project <span class="icon-right glyphicon glyphicon-plus"></span>
            </button></a>
        <form method="GET" action="{{route('clientsorting', ['name' =>  $clients->name])}}" class="pull-right searchform">

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
    @include('client.edit_client')

@endsection