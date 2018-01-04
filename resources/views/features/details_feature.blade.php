@extends('layout.app')

@section('title')
    Project details
@endsection


@section('content')

    <!-- Edit FEATURE
    <button onclick="location.href=''"
            class="btn-edit" id="project-edit">
        <span class="glyphicon edit-icon"></span> Edit
    </button>
    -->

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

                <div class="col-md-6 col-xs-6">
                    <span class="project-title block-title">Project Name</span> <br>
                    <span class="project-detail block-value">{{$feature->releases->projects->name}}</span>
                </div>

            </div>
            <div class="row under-details" id="block-hidden">
                <div class="col-md-6 col-xs-12">
                    <span class="project-title block-title">Feature Description</span><br>
                    <span class="project-detail block-value">{{$feature->description}}</span>
                </div>

                <div class="col-md-6 col-xs-12 pull-right">
                    <span class="project-title block-title">Project Description</span><br>
                    <span class="project-detail block-value">{{$feature->releases->projects->description}}</span>
                </div>




            </div>
            <div class="row" id="no-buttons">

            </div>

            <div class="row col-md-12 col-xs-12" id="button-top">
                <button onclick="projectDetailsDown()" class="black-button" id="black-button-down"></button>
            </div>

        </div>
        <!-- ADD REQUIREMENT
        <a class="btn-primary" id="addrelease"
           href="addrequirement">
            <span class="yellow-button" id="release-button">Add Release</span>
            <span class="glyphicon glyphicon-plus" id="release-plus"></span>
        </a>
        -->
    </div>
    <div class="row">
        <table class="table table-hover table-center results" id="release-overview">
            <thead>
            <th>Requirement</th>
            <th>Description</th>
            <th>Assigned To</th>
            </thead>
            <tbody>
            @foreach($feature->requirements as $requirement)
                <tr>
                    <td style="background-color: {{$release->rstatus->color}};"></td>
                    <td><span class="tabletitle">{{$requirement->name}}</span>
                    </td>
                    <td class="table-description">{{$requirement->description}}
                    </td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection