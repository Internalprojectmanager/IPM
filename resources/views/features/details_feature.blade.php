@extends('layout.app')

@section('title')
    Project details
@endsection


@section('content')

    <button type="button" id="project-edit" data-toggle="modal" data-target="#editFeatureModal" class="btn-edit pull-right">
        <span class="glyphicon edit-icon"></span> Edit
    </button>
    <div class="row">
        <div class="header-3" id="project-details">
            <div class="row" id="block-show">
                <div class="col-md-4 col-xs-6">
                    <span class="project-title block-title">Feature Name</span> <br>
                    <span class="project-detail block-value">{{$feature->name}}</span>
                </div>

                <div class="col-md-2 col-xs-6">
                    <span class="project-title block-title">Status</span> <br>
                    <span class="project-detail block-value">{{$feature->fstatus->name}}</span>
                </div>

                <div class="col-md-offset-1 col-md-5 col-xs-6">
                    <span class="project-title block-title">Project Name</span> <br>
                    <span class="project-detail block-value">{{$feature->releases->projects->name}}</span>
                </div>

            </div>
            <div class="row under-details" id="block-hidden">
                <div class="col-md-6 col-xs-12">
                    <span class="project-title block-title">Feature Description</span><br>
                    <span class="project-detail block-value">{{$feature->description}}</span>
                </div>

                <div class="col-md-offset-1 col-md-5 col-xs-12 pull-right">
                    <span class="project-title block-title">Project Description</span><br>
                    <span class="project-detail block-value">{{$feature->releases->projects->description}}</span>
                </div>


            </div>
            <div class="row pull-right">
                <div class="col-md-3 col-xs-3">
                    <button onclick="location.href='{{route('documentoverview', ['name' => $feature->releases->projects->name, 'company_id' => $feature->releases->projects->company_id])}}'"
                            class="blue-button" id="button-files">
                        <svg id="paperclip-icon" width="8px" height="19px" viewBox="0 0 8 19" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                            <title>Files/paperclip Icon</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="BUTTON/Files" transform="translate(-15.000000, -13.000000)" fill-rule="nonzero"
                                   fill="#FFFFFF">
                                    <path d="M23,27.7777778 C23,30.1105556 21.21,32 19,32 C16.79,32 15,30.1105556 15,27.7777778 L15,16.1666667 C15,14.4144444 16.34,13 18,13 C19.66,13 21,14.4144444 21,16.1666667 L21,25.6666667 C21,26.8277778 20.1,27.7777778 19,27.7777778 C17.9,27.7777778 17,26.8277778 17,25.6666667 L17,17.2222222 L18,17.2222222 L18,25.6666667 C18,26.2472222 18.45,26.7222222 19,26.7222222 C19.55,26.7222222 20,26.2472222 20,25.6666667 L20,16.1666667 C20,15.0055556 19.1,14.0555556 18,14.0555556 C16.9,14.0555556 16,15.0055556 16,16.1666667 L16,27.7777778 C16,29.53 17.34,30.9444444 19,30.9444444 C20.66,30.9444444 22,29.53 22,27.7777778 L22,17.2222222 L23,17.2222222 L23,27.7777778 Z"
                                          id="Files/paperclip-Icon"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="button-content" id="files-button">Files</span>
                    </button>
                </div>
            </div>

            <div class="row col-md-12 col-xs-12" id="button-top">
                <button onclick="projectDetailsDown()" class="black-button" id="black-button-down"></button>
            </div>

        </div>
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
@endsection