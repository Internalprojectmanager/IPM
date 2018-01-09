@extends('layout.app')

@section('title')
    {{$project->name}} - {{$release->version}} {{$release->name}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('showrelease', $project, $company, $release))

@section('content')
    <div class="row" onload="">
        <div class="header-3" id="project-details">
            <div class="row" id="block-show">
                <div class="col-md-4 col-xs-6">
                    <span class="project-title block-title">Release Version</span> <br>
                    <span class="project-detail block-value">{{number_format($release->version, 1)}}</span>
                </div>

                <div class="col-md-2 col-xs-6">
                    <span class="project-title block-title">Status</span> <br>
                    <span class="project-detail block-value">{{$release->rstatus->name}}</span>
                </div>

                <div class="col-md-offset-1 col-md-5 col-xs-6">
                    <span class="project-title block-title">Project Name</span> <br>
                    <span class="project-detail block-value">{{$release->projects->name}}</span>
                </div>

            </div>
            <div class="row" id="block-hidden">
                <div class="under-details">
                    <div class="col-md-6 col-xs-12">
                        <span class="project-title block-title">Release Name</span><br>
                        <span class="project-detail block-value">{{$release->name}}</span>
                    </div>

                    <div class="col-md-offset-1 col-md-5 col-xs-12 pull-right">
                        <span class="project-title block-title">Project Description</span><br>
                        <span class="project-detail block-value">{{$release->projects->description}}</span>
                    </div>
                </div>
                <div class="under-details">
                    <div class="col-md-12 col-xs-12">
                        <span class="project-title block-title">Release Description</span><br>
                        <span class="project-detail block-value">{{$release->description}}</span>
                    </div>
                </div>
                <div class="under-details">
                    <div class="col-md-3 col-xs-12">
                        <span class="project-title block-title">Specification Type</span><br>
                        <span class="project-detail block-value">{{$release->specificationtype}}</span>
                    </div>
                </div>
                <div class="under-details">
                    <div class="col-md-3 col-xs-12">
                        <span class="project-title block-title">Document status</span><br>
                        <span class="project-detail block-value">{{$release->document_status}}</span>
                    </div>
                </div>
                <div class="under-details">
                    <div class="col-md-12 col-xs-12">
                        <span class="project-title block-title">Extra Content</span><br>
                        <span class="project-detail block-value"></span>
                    </div>
                </div>

            </div>

            <div class="row pull-right">
                <div class="col-md-3 col-xs-3">
                    <button onclick="location.href='{{route('documentoverview', ['name' => $release->projects->name, 'company_id' => $release->projects->company_id])}}'"
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
        <!-- ADD REQUIREMENT
        <a class="btn-primary" id="addrelease"
           href="addrequirement">
            <span class="yellow-button" id="release-button">Add Release</span>
            <span class="glyphicon glyphicon-plus" id="release-plus"></span>
        </a>
        -->
    </div>


    <div class="feature-results">
        @php $total = 0; @endphp
        <div class="row under-details">
            <span class="block-white-title">All Features</span>
            <span class="block-white-subtitle">
                <span id="count_projects_bar">|</span>
                <span class="counter">{{$features->count()}} Features</span>
                <span id="count_projects_bar">|</span>
                @foreach($features as $f)
                    @if($f->fstatus->name == "Completed")
                        @php $total++;@endphp
                    @endif
                @endforeach
                <span id="featurecount" class="counter">{{$total}}/{{$features->count()}} Done</span>
            </span>
        </div>
        <div class="row feature-table">
                <table class="table table-hover table-center results">
                    <thead>
                    <th></th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Task</th>
                    <th>Assigned To</th>
                    </thead>
                    <tbody>
                    @foreach($features as $f)
                        <tr>
                            <td style="border-left: 1px solid #CECECE; background-color: {{$f->fstatus->color}};"></td>
                            <td><span class="tabletitle"><a href="{{route('showfeature',
                             ['name' => $release->projects->name, 'company_id' => $release->projects->company_id, 'release_name' => $release->name, $f->id])}}">{{$f->name}}</a></span>
                            </td>
                            <td>{{$f->fstatus->name}}</td>
                            @php $counter = 0; @endphp
                            @foreach($f->requirements as $r)
                                @if($r->rstatus->name == 'Completed')
                                    @php $counter++;@endphp
                                @endif
                            @endforeach
                            <td>{{$counter}}/{{$f->requirements->count()}} Done</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>

    <div id="nf-req"></div>
    @php $total = 0;@endphp
    <div class="nonfunctional-results">
        <div class="row under-details">
            <span class="block-white-title">Non Functional Requirements</span>
            <span class="block-white-subtitle">
                <span id="count_projects_bar">|</span>
                <span class="counter">{{$nfr->count()}} NFR</span>
                <span id="count_projects_bar">|</span>
                @foreach($nfr as $n)
                    @if($n->fstatus->name == "Completed")
                        @php $total++;@endphp
                    @endif
                @endforeach
                <span class="counter">{{$total}}/{{$nfr->count()}} Done</span>
                <a href="#nf-req" class="not-active"> <span  onclick="showNF();" id="nf-arrow" class="nf-arrow glyphicon arrow-right"></span></a>
            </span>
        </div>
        <div id="nftable" class="row nfr-table">
            <table class="table table-hover table-center results">
                <thead>
                <th></th>
                <th>Name</th>
                <th>Status</th>
                <th>Category</th>
                <th>Task</th>
                <th>Assigned To</th>
                </thead>
                <tbody>
                @foreach($nfr as $n)
                    <tr>

                        <td style="border-left: 1px solid #CECECE; background-color: {{$n->fstatus->color}};"></td>
                        <td><span class="tabletitle"><a href="{{route('showfeature',
                         ['name' => $release->projects->name, 'company_id' => $release->projects->company_id, 'release_name' => $release->name, $n->id])}}">{{$n->name}}</a></span>
                        </td>
                        <td>{{$n->fstatus->name}}</td>
                        <td>{{$n->category}}</td>
                        <td>@php $counter = 0;@endphp
                            @foreach($f->requirements as $r)
                                @if($r->rstatus->name == 'Completed')
                                    @php $counter++;@endphp
                                @endif
                            @endforeach

                            {{$counter}}/{{$n->requirements->count()}} Done</td>
                            <td></td></a>
                    </tr></a>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="ts-specs"></div>
    @php $total = 0; @endphp
    <div class="ts-results">
        <div class="row under-details">
            <span class="block-white-title">All Technical Specifications</span>
            <span class="block-white-subtitle">
                <span id="count_projects_bar">|</span>
                <span class="counter">{{$techspecs->count()}} Technical Specifications</span>
                <span id="count_projects_bar">|</span>
                @foreach($techspecs as $ts)
                    @if($ts->fstatus->name == "Completed")
                        @php $total++;@endphp
                    @endif
                @endforeach
                <span class="counter">{{$total}}/{{$techspecs->count()}} Done</span>
                <a href="#ts-specs" class="not-active"> <span  onclick="showTS();" id="ts-arrow" class="ts-arrow glyphicon arrow-right"></span></a>
            </span>
        </div>
        <div id="tstable" class="row ts-table">
            <table class="table table-hover table-center results">
                <thead>
                <th></th>
                <th>Name</th>
                <th>Status</th>
                <th>Category</th>
                <th>Task</th>
                <th>Assigned To</th>
                </thead>
                <tbody>
                @foreach($techspecs as $t)
                    <tr>
                        <td style="border-left: 1px solid #CECECE; background-color: {{$t->fstatus->color}};"></td>
                        <td><span class="tabletitle">{{$t->name}}</span>
                        </td>
                        <td>{{$t->fstatus->name}}</td>
                        <td>{{$t->category}}</td>
                        <td>@php $counter = 0; @endphp
                            @foreach($t->requirements as $tr)
                                @if($tr->rstatus->name == 'Completed')
                                    @php $counter++;@endphp
                                @endif
                            @endforeach
                            {{$counter}}/{{$t->requirements->count()}} Done</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div id="scope"></div>
    <div class="scope-results">
        <div class="row under-details">
            <span class="block-white-title">Out of scope</span>
            <span class="block-white-subtitle">
                <span id="count_projects_bar">|</span>
                <span class="counter">{{$scope->count()}} Out of Scope</span>
                <a href="#scope" class="not-active"> <span  onclick="showScope();" id="scope-arrow" class="scope-arrow glyphicon arrow-right"></span></a>
            </span>
        </div>
        <div id="scopetable" class="row scope-table">
            <table class="table table-hover table-center results">
                <thead>
                <th></th>
                <th>Name</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($scope as $s)
                    <tr>
                        <td style="border-left: 1px solid #CECECE; background-color: #CECECE;"></td>
                        <td><span class="tabletitle">{{$s->name}}</span></td>
                        <td>{{$s->description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection