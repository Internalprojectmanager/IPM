@extends('layout.app')

@section('title')
    {{$project->company->name}} - {{$project->name}} | {{env('APP_NAME')}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('singleproject', $project, $client))

@section('content')

    <a href="{{route('editproject', [ $client->path, $project->path])}}" class="btn btn-edit" id="project-edit">
        <span class="glyphicon edit-icon"></span> Edit
    </a>

    <div class="row">
        <div class="header-3 " id="project-details">
            <div class="row" id="block-show">
                <div class="col-md-6 col-xs-6" style="margin-bottom: 10px">
                    <span class="h1">
                        <i class="fas fa-circle"
                           style="font-size:18px; margin: 5px 0; color: @if($project->pstatus){{$project->pstatus->color}}; @endif ">
                        </i>

                        {{$project->name}}</span>
                    <span class=" block-value grey">{{$project->pstatus->name}}</span>
                    <br>
                    <span class="grey">{{$client->name}}</span>
                </div>

                <div class="col-md-3">
                    <span class="project-title">Deadline:</span><br>

                    <span class="project-detail">
                        @if($project->pstatus->name != "Completed" && $project->pstatus->name != "Paused" && $project->pstatus->name != "Cancelled")
                            @if(isset($project->deadline)){{date('d F Y', strtotime($project->deadline))}}
                            @else
                                No Deadline
                            @endif
                        @endif
                    </span>
                </div>

                <div class="col-md-3">
                    <span class="project-title">Projectcode:</span><br>

                    <span class="project-detail">{{$project->projectcode}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <div class="block-description under-details" id="block-hidden">

                        <span class="project-title block-title">Project Description</span><br>
                        <span class="project-detail block-value">{!! nl2br($project->description) !!}</span>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <span class="project-title block-title">Contact Person</span><br>
                    <i class="user-icon block-icons"><span class="project-detail block-value"
                                                           id="contact-name">{{$client->contactname}}</span></i><br>
                    <i class="tel-icon block-icons"><span class="project-detail block-value" id="contact-phone"><a
                                    href="tel:{{$client->contactnumber}}">{{$client->contactnumber}}</a></span></i><br>
                    <i class="mail-icon block-icons"> <span class="project-detail block-value" id="contact-email"><a
                                    href="mailto:{{$client->contactemail}}">{{$client->contactemail}}</a></span></i>

                </div>

                <div class="col-md-3 col-xs-12 pull-right">
                    <span class="project-title block-title" id="link">Link</span><br>
                    <i class="word-icon block-value"><span class="project-detail block-value" id="link-world"><a
                                    href="{{$project->link_url}}">{{$project->link_url}}</a> </span></i><br>
                    <i class="text-icon block-value"><span class="project-detail block-value"
                                                           id="link-t"></span>{{$project->link_title}}</i>
                </div>

            </div>
            <div class="row pull-right">
                <div class="col-md-5 col-xs-3">
                    @php
                        /**
                        <button onclick="location.href='{{route('documentoverview', ['name' => $project->path, 'company_id' => $project->company->path])}}'"
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
                        **/
                    @endphp

                </div>

                <div class="col-md-6 col-xs-3">
                    <button type="button" class="blue-button" id="button-people" data-toggle="modal" data-target="#addProjectModal">
                        <svg id="people-icon" width="20px" height="13px" viewBox="0 0 20 13" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                            <title>Peoples icon</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="BUTTON/People" transform="translate(-15.000000, -16.000000)" fill-rule="nonzero"
                                   fill="#FFFFFF">
                                    <path d="M29.0909091,23.4285714 C27.9954545,23.4285714 26.2954545,23.7396429 25,24.3617857 C23.7045455,23.7396429 22.0045455,23.4285714 20.9090909,23.4285714 C18.9409091,23.4285714 15,24.4360714 15,26.4464286 L15,29 L35,29 L35,26.4464286 C35,24.4360714 31.0590909,23.4285714 29.0909091,23.4285714 Z M25.4545455,27.6071429 L16.3636364,27.6071429 L16.3636364,26.4464286 C16.3636364,25.9496429 18.6909091,24.8214286 20.9090909,24.8214286 C23.1272727,24.8214286 25.4545455,25.9496429 25.4545455,26.4464286 L25.4545455,27.6071429 Z M33.6363636,27.6071429 L26.8181818,27.6071429 L26.8181818,26.4464286 C26.8181818,26.0239286 26.6363636,25.6478571 26.3454545,25.3135714 C27.15,25.035 28.1318182,24.8214286 29.0909091,24.8214286 C31.3090909,24.8214286 33.6363636,25.9496429 33.6363636,26.4464286 L33.6363636,27.6071429 Z M20.9090909,22.5 C22.6681818,22.5 24.0909091,21.0421429 24.0909091,19.25 C24.0909091,17.4578571 22.6681818,16 20.9090909,16 C19.1545455,16 17.7272727,17.4578571 17.7272727,19.25 C17.7272727,21.0421429 19.1545455,22.5 20.9090909,22.5 Z M20.9090909,17.3928571 C21.9136364,17.3928571 22.7272727,18.2239286 22.7272727,19.25 C22.7272727,20.2760714 21.9136364,21.1071429 20.9090909,21.1071429 C19.9045455,21.1071429 19.0909091,20.2760714 19.0909091,19.25 C19.0909091,18.2239286 19.9045455,17.3928571 20.9090909,17.3928571 Z M29.0909091,22.5 C30.85,22.5 32.2727273,21.0421429 32.2727273,19.25 C32.2727273,17.4578571 30.85,16 29.0909091,16 C27.3363636,16 25.9090909,17.4578571 25.9090909,19.25 C25.9090909,21.0421429 27.3363636,22.5 29.0909091,22.5 Z M29.0909091,17.3928571 C30.0954545,17.3928571 30.9090909,18.2239286 30.9090909,19.25 C30.9090909,20.2760714 30.0954545,21.1071429 29.0909091,21.1071429 C28.0863636,21.1071429 27.2727273,20.2760714 27.2727273,19.25 C27.2727273,18.2239286 28.0863636,17.3928571 29.0909091,17.3928571 Z"
                                          id="Peoples-icon"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="button-content" id="people-button">People</span>
                    </button>
                </div>
            </div>

            <div class="row col-md-12 col-xs-12" id="button-top">
                <button onclick="projectDetailsDown()" class="black-button" id="black-button-down"></button>
            </div>
        </div>
    </div>

    <div class="row under-details">
        <a class="black btn btn-primary" href="#" data-toggle="modal" data-target="#addReleaseModal">
            Add Release <span class="glyphicon glyphicon-plus"></span>
        </a>
    </div>
    <div class="row">
        <table class="table table-hover table-center results" id="release-overview">
            <thead>
            <th></th>
            <th>Version+Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Deadline</th>
            </thead>
            <tbody>
            @foreach($releases as $release)
                <tr class="clickable-row" data-href="{{route('showrelease', [$project->company->path, $project->path,
                        $release->path, $release->version])}}">
                    <td style="background-color: {{$release->rstatus->color}};"></td>
                    <td class="col-md-2"><span class="tabletitle">{{number_format($release->version, 1)}} - {{$release->name}}</span>
                    </td>
                    <td class=" col-md-5">{{implode(' ', array_slice(str_word_count($release->description, 2), 0, 20))}}
                        @if(str_word_count($release->description) > 20)
                            ...
                        @endif
                    </td>
                    <td class="col-md-2">{{$release->rstatus->name}}
                        <br>
                        @if($release->rstatus->name == "Completed")
                            <span class="tablesubtitle">on {{\Carbon\Carbon::parse($release->updated_at)}}</span>
                        @elseif($release->rstatus->name == "Paused")
                            <span class="tablesubtitle">on {{\Carbon\Carbon::parse($release->updated_at)}}</span>
                        @elseif($release->rstatus->name == "Cancelled")
                            <span class="tablesubtitle">on {{\Carbon\Carbon::parse($release->updated_at)}}</span>
                        @endif
                    </td>
                    <td class="col-md-4">@if($release->rstatus->name != "Completed" && $release->rstatus->name != "Paused" && $release->rstatus->name != "Cancelled")
                            @if(isset($release->deadline)){{date('d F Y', strtotime($release->deadline))}} <br>
                            @if($release->monthsleft && $release->monthsleft > 0)
                                <span>{{abs($release->monthsleft)}} Months left</span>
                            @elseif($release->monthsleft && $release->monthsleft < 0)
                                <span class="red">{{abs($release->monthsleft)}} Months overdue</span>
                            @elseif($release->daysleft >= 0)
                                <span @if($release->daysleft < 5) class="red" @endif>{{abs($release->daysleft)}} days left</span>
                            @elseif($release->daysleft < 0)
                                <span class="red">{{abs($release->daysleft)}} Days overdue</span>
                            @endif
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('project.assignee')
    @include('release.add_release')
@endsection