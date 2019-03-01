@extends('layout.app')

@section('title')
    {{$release->name}} {{number_format($release->version, 1)}} - {{$feature->name}} | {{env('APP_NAME')}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('detailsfeature', $feature))

@section('content')

    <a href="#" id="project-edit" data-toggle="modal" data-target="#editFeatureModal" class="btn btn-edit pull-right">
        <span class="glyphicon edit-icon"></span> Edit
    </a>
    <div class="row">
        <div class="header-3 " id="project-details">
            <div class="row" id="block-show">
                <div class="col-md-6 col-xs-6" style="margin-bottom: 10px">
                    <span class="h2">
                        <i class="fas fa-circle"
                           style="font-size:18px; margin: 5px 0; color: @if($feature->fstatus){{$feature->fstatus->color}}; @endif ">
                        </i>

                        {{$feature->name}}</span>
                    <span class=" block-value grey">{{$feature->fstatus->name}}</span>
                    <br>
                    <span class="grey">{{$client->name}} - {{$project->name}}: {{$release->name}}</span>
                </div>

                <div class="col-md-3">
                    <span class="project-title">Deadline:</span><br>

                    <span class="project-detail">
                        @if($release->rstatus->name != "Completed" && $release->rstatus->name != "Paused" && $release->rstatus->name != "Cancelled")
                            @if(isset($release->deadline)){{date('d F Y', strtotime($release->deadline))}}@endif
                        @endif
                    </span>
                </div>
            </div>
            <div class="row">
                <div id="block-hidden" class=" under-details">
                    <div class="col-md-6 col-xs-6">
                        <div class="block-description ">

                            <span class="project-title block-title">Feature Description</span><br>
                            <span class="project-detail block-value">{!! nl2br($feature->description) !!}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="block-description">
                            <span class="project-title block-title">Project Description</span><br>
                            <span class="project-detail block-value">{!! nl2br($project->description) !!}</span>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row pull-right">
                    @php
                    /**
                <div class="col-md-5 col-xs-6">
                    
                    <button onclick="location.href='{{route('documentoverview', [ $project->path])}}'"
                            class="blue-button" id="button-files">
                        <svg id="paperclip-icon" width="8px" height="19px" viewBox="0 0 8 19" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                            <title>Files/paperclip Icon</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="BUTTON/Files" transform="translate(-15.000000, -13.000000)"
                                   fill-rule="nonzero"
                                   fill="#FFFFFF">
                                    <path d="M23,27.7777778 C23,30.1105556 21.21,32 19,32 C16.79,32 15,30.1105556 15,27.7777778 L15,16.1666667 C15,14.4144444 16.34,13 18,13 C19.66,13 21,14.4144444 21,16.1666667 L21,25.6666667 C21,26.8277778 20.1,27.7777778 19,27.7777778 C17.9,27.7777778 17,26.8277778 17,25.6666667 L17,17.2222222 L18,17.2222222 L18,25.6666667 C18,26.2472222 18.45,26.7222222 19,26.7222222 C19.55,26.7222222 20,26.2472222 20,25.6666667 L20,16.1666667 C20,15.0055556 19.1,14.0555556 18,14.0555556 C16.9,14.0555556 16,15.0055556 16,16.1666667 L16,27.7777778 C16,29.53 17.34,30.9444444 19,30.9444444 C20.66,30.9444444 22,29.53 22,27.7777778 L22,17.2222222 L23,17.2222222 L23,27.7777778 Z"
                                          id="Files/paperclip-Icon"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="button-content" id="files-button">Files</span>
                    </button>
                    
                </div>
                **/
                @endphp
                <div class="col-md-7 col-xs-6">
                    <button onclick="location.href='{{route('createpdf', [ $project->path, $release->path, $release->version])}}'"
                            class="blue-button" id="button-pdf">
                        <svg id="pdf-icon" width="19px" height="19px" viewBox="0 0 19 19" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                            <title>Pdf icon</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="BUTTON/Create-PDF" transform="translate(-15.000000, -13.000000)"
                                   fill-rule="nonzero"
                                   fill="#FFFFFF">
                                    <path d="M32.1,13 L20.7,13 C19.655,13 18.8,13.855 18.8,14.9 L18.8,26.3 C18.8,27.345 19.655,28.2 20.7,28.2 L32.1,28.2 C33.145,28.2 34,27.345 34,26.3 L34,14.9 C34,13.855 33.145,13 32.1,13 Z M24.025,20.125 C24.025,20.9135 23.3885,21.55 22.6,21.55 L21.65,21.55 L21.65,23.45 L20.225,23.45 L20.225,17.75 L22.6,17.75 C23.3885,17.75 24.025,18.3865 24.025,19.175 L24.025,20.125 Z M28.775,22.025 C28.775,22.8135 28.1385,23.45 27.35,23.45 L24.975,23.45 L24.975,17.75 L27.35,17.75 C28.1385,17.75 28.775,18.3865 28.775,19.175 L28.775,22.025 Z M32.575,19.175 L31.15,19.175 L31.15,20.125 L32.575,20.125 L32.575,21.55 L31.15,21.55 L31.15,23.45 L29.725,23.45 L29.725,17.75 L32.575,17.75 L32.575,19.175 Z M21.65,20.125 L22.6,20.125 L22.6,19.175 L21.65,19.175 L21.65,20.125 Z M16.9,16.8 L15,16.8 L15,30.1 C15,31.145 15.855,32 16.9,32 L30.2,32 L30.2,30.1 L16.9,30.1 L16.9,16.8 Z M26.4,22.025 L27.35,22.025 L27.35,19.175 L26.4,19.175 L26.4,22.025 Z"
                                          id="Pdf-icon"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="button-content" id="pdf-button">Create PDF</span>
                    </button>
                </div>
            </div>

            <div class="row col-md-12 col-xs-12" id="button-top">
                <button onclick="projectDetailsDown()" class="black-button" id="black-button-down"></button>
            </div>
        </div>
    </div>

    <div class="row under-details">
        <a class="black btn btn-primary" href="#" data-toggle="modal" data-target="#addRequirement">
            Add Requirement <span class="glyphicon glyphicon-plus"></span>
        </a>
    </div>

    @if($feature->type !== "Scope")
        @include('requirement.requirement_table')
    @endif
    @if($feature->type == "Feature")
        @include('features.edit_feature')
    @elseif($feature->type == "NFR")
        @include('features.edit_nfr')
    @elseif($feature->type == "Scope")
        @include('features.edit_scope')
    @else
        @include('features.edit_ts')
    @endif

    @include('requirement.add_requirement')
@endsection