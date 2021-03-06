@extends('layout.app')

@section('title')
    {{$project->name}} -  {{$release->name}} {{number_format($release->version, 1)}} | {{env('APP_NAME')}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('showrelease', $project, $release))

@section('content')
    <a href="{{route('editrelease', [  $project->path, $release->path, $release->version])}}"
       class="btn btn-edit" id="project-edit">
        <span class="glyphicon edit-icon"></span> Edit
    </a>

    <div class="row" onload="">
        <div class="header-3 " id="project-details">
            <div class="row" id="block-show">
                <div class="col-md-6 col-xs-6" style="margin-bottom: 10px">
                    <span class="h2">
                        <i class="fas fa-circle"
                           style="font-size:18px; margin: 5px 0; color: @if($release->rstatus){{$release->rstatus->color}}; @endif ">
                        </i>

                        {{$release->name}}</span>

                    <br>
                    <span class="black h5">{{$client->name}} - {{$project->name}}</span>
                    <br>
                    <span class=" block-value grey">{{$release->rstatus->name}}</span>
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

                            <span class="project-title block-title">Release Description</span><br>
                            <span class="project-detail block-value">{!! nl2br($release->description) !!}</span>
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
                    /**                * <div class="col-md-5 col-xs-6"> ** <button onclick="location.href='{{route('documentoverview', [ $project->path])}}'"                                * class="blue-button" id="button-files">                            * <svg id="paperclip-icon" width="8px" height="19px" viewBox="0 0 8 19" version="1.1"                                 * xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">                                * <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->                                * <title>Files/paperclip Icon</title>                                * <desc>Created with Sketch.</desc>                                * <defs></defs>                                * <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">                                    * <g id="BUTTON/Files" transform="translate(-15.000000, -13.000000)"                                       * fill-rule="nonzero"                                       * fill="#FFFFFF">                                        * <path d="M23,27.7777778 C23,30.1105556 21.21,32 19,32 C16.79,32 15,30.1105556 15,27.7777778 L15,16.1666667 C15,14.4144444 16.34,13 18,13 C19.66,13 21,14.4144444 21,16.1666667 L21,25.6666667 C21,26.8277778 20.1,27.7777778 19,27.7777778 C17.9,27.7777778 17,26.8277778 17,25.6666667 L17,17.2222222 L18,17.2222222 L18,25.6666667 C18,26.2472222 18.45,26.7222222 19,26.7222222 C19.55,26.7222222 20,26.2472222 20,25.6666667 L20,16.1666667 C20,15.0055556 19.1,14.0555556 18,14.0555556 C16.9,14.0555556 16,15.0055556 16,16.1666667 L16,27.7777778 C16,29.53 17.34,30.9444444 19,30.9444444 C20.66,30.9444444 22,29.53 22,27.7777778 L22,17.2222222 L23,17.2222222 L23,27.7777778 Z"                                              * id="Files/paperclip-Icon"></path>                                    * </g>                                * </g>                            * </svg>                            * <span class="button-content" id="files-button">Files</span>                        * </button> ** </div>                **/
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
        <div class="pull-left spacing-button">
            <a class="black btn btn-primary" href="#" data-toggle="modal" data-target="#addFeatureModal">
                Add Feature <span class="glyphicon glyphicon-plus"></span>
            </a>
        </div>
        <div class="pull-left spacing-button">
            <a class="black btn btn-primary" href="#" data-toggle="modal" data-target="#addNFRModal">
                Add Non Functional Requirement <span class="glyphicon glyphicon-plus"></span>
            </a>
        </div>
        <div class="pull-left spacing-button">
            <a class="black btn btn-primary" href="#" data-toggle="modal" data-target="#addTSModal">
                Add Technical Specification <span class="glyphicon glyphicon-plus"></span>
            </a>
        </div>
        <div class="pull-left spacing-button">
            <a class="black btn btn-primary" href="#" data-toggle="modal" data-target="#addScopeModal">
                Add Out of Scope <span class="glyphicon glyphicon-plus"></span>
            </a>
        </div>
    </div>

    <div class="feature-results header-3">
        @php $total = 0; @endphp
        <div class="row under-details">
            <span class="h3 black">All Features</span>
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
                    <tr class="clickable-row" data-href="{{route('showfeature',
                             [ $release->projects->path, $release->path, $f->id])}}">
                        <td style="border-left: 1px solid #CECECE; background-color: {{$f->fstatus->color}};"></td>
                        <td class="col-md-4"><span class="tabletitle">{{$f->name}}</span>
                        </td>
                        <td class="col-md-2">{{$f->fstatus->name}}</td>
                        @php $counter = 0; @endphp
                        @foreach($f->requirements() as $r)
                            @if($r->rstatus->name == 'Completed')
                                @php $counter++;@endphp
                            @endif
                        @endforeach
                        <td class="col-md-2">
                            @if($f->requirements->count() > 0)
                                {{$counter}}/{{$f->requirements->count()}} Done
                            @else
                                No tasks
                            @endif
                        </td>
                        <td class="col-md-5">
                                <span class="assignee">
                                    @php $i = 0; $unique = array(); @endphp
                                    @foreach($f->requirements() as $fr)
                                        @foreach($fr->userAssingee as $as)
                                            @if($i < 5 && !in_array($as->first_name. " ".$as->last_name, $unique))
                                                <div class="table-users">
                                                        <img alt="{{$as->first_name}} {{$as->last_name}}"
                                                             class="img-circle img-thumbnail avatar-table"
                                                             src="{{$as->getAvatar()}}"/>
                                                        <span>{{$as->first_name}}</span>
                                                    </div>
                                                @php $unique[] = $as->first_name. " ".$as->last_name;@endphp
                                                @php $i++;@endphp
                                            @endif
                                            @if($i == 5 && $fr->assignee->count() > 4)
                                                <div class="table-users table-more">
                                                        <span class="avatar-more">+ {{$fr->assignee->count() - 4 }}</span>
                                                    </div>
                                                @php $i++;@endphp
                                            @endif

                                        @endforeach
                                    @endforeach
                                </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="nf-req"></div>
    @php $total = 0;@endphp
    <div class="nonfunctional-results header-3">
        <a href="#nf-req" class="not-active drop-link-release">
            <div onclick="showNF();" class="row under-details">
                <span class="h3 black">Non Functional Requirements</span>
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
                 <span id="nf-arrow" class="nf-arrow glyphicon arrow-right"></span>
            </span>
            </div>
        </a>
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
                    <tr class="clickable-row" data-href="{{route('showfeature',
                         [ $release->projects->path, $release->path, $n->id])}}">

                        <td style="border-left: 1px solid #CECECE; background-color: {{$n->fstatus->color}};"></td>
                        <td class="width20"><span class="tabletitle">{{$n->name}}</span>
                        </td>
                        <td class="width20">{{$n->fstatus->name}}</td>
                        <td class="width20">{{$n->fcategory->name}}</td>
                        <td class="width20">@php $counter = 0;@endphp
                            @foreach($f->requirements() as $r)
                                @if($r->rstatus->name == 'Completed')
                                    @php $counter++;@endphp
                                @endif
                            @endforeach
                            @if($n->requirements->count() > 0)
                                {{$counter}}/{{$n->requirements->count()}} Done
                            @else
                                No tasks
                            @endif
                        </td>
                        <td class="width20">
                                <span class="assignee">
                                    @php $i = 0; $unique = array(); @endphp
                                    @foreach($n->requirements() as $r)
                                        @foreach($r->userAssingee as $as)
                                            @if($i < 5 && !in_array($as->first_name. " ".$as->last_name, $unique))
                                                <div class="table-users">
                                                        <img alt="{{$as->first_name}} {{$as->last_name}}"
                                                             class="img-circle img-thumbnail avatar-table"
                                                             src="{{$as->getAvatar()}}"/>
                                                        <span>{{$as->first_name}}</span>
                                                    </div>
                                                @php $unique[] = $as->first_name. " ".$as->last_name;@endphp
                                                @php $i++;@endphp
                                            @endif
                                            @if($i == 5 && $fr->assignee->count() > 4)
                                                <div class="table-users table-more">
                                                        <span class="avatar-more">+ {{$fr->assignee->count() - 4 }}</span>
                                                    </div>
                                                @php $i++;@endphp
                                            @endif

                                        @endforeach
                                    @endforeach
                                </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="ts-specs"></div>
    @php $total = 0; @endphp
    <div class="ts-results header-3">
        <a href="#ts-specs" onclick="showTS();" class="not-active drop-link-release">
            <div class="row under-details">
                <span class="h3 black">All Technical Specifications</span>
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
                 <span id="ts-arrow" class="ts-arrow glyphicon arrow-right"></span>
            </span>
            </div>
        </a>
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
                    <tr class="clickable-row" data-href="{{route('showfeature',
                         [ $release->projects->path, $release->path, $t->id])}}">
                        <td style="border-left: 1px solid #CECECE; background-color: {{$t->fstatus->color}};"></td>
                        <td class="width20"><span class="tabletitle">{{$t->name}}</span></td>
                        <td class="width20">{{$t->fstatus->name}}</td>
                        <td class="width20">{{$t->fcategory->name}}</td>
                        <td class="width20">@php $counter = 0; @endphp
                            @foreach($t->requirements() as $tr)
                                @if($tr->rstatus->name == 'Completed')
                                    @php $counter++;@endphp
                                @endif
                            @endforeach
                            @if($t->requirements->count())
                                {{$counter}}/{{$t->requirements->count()}} Done
                            @else
                                No tasks
                            @endif
                        </td>
                        <td class="width20">
                            <span class="assignee">
                                @php $i = 0; $unique = array(); @endphp
                                @foreach($t->requirements() as $r)
                                    @foreach($r->userAssingee as $as)
                                        @if($i < 5 && !in_array($as->first_name. " ".$as->last_name, $unique))
                                            <div class="table-users">
                                                        <img alt="{{$as->first_name}} {{$as->last_name}}"
                                                             class="img-circle img-thumbnail avatar-table"
                                                             src="{{$as->getAvatar()}}"/>
                                                        <span>{{$as->first_name}}</span>
                                                    </div>
                                            @php $unique[] = $as->first_name. " ".$as->last_name;@endphp
                                            @php $i++;@endphp
                                        @endif
                                        @if($i == 5 && $fr->assignee->count() > 4)
                                            <div class="table-users table-more">
                                                        <span class="avatar-more">+ {{$fr->assignee->count() - 4 }}</span>
                                                    </div>
                                            @php $i++;@endphp
                                        @endif

                                    @endforeach
                                @endforeach
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div id="scope"></div>
    <div class="scope-results header-3">
        <a href="#scope" class="not-active drop-link-release" onclick="showScope();">
            <div class="row under-details">
                <span class="h3 black">Out of scope</span>
                <span class="block-white-subtitle">
                <span id="count_projects_bar">|</span>
                <span class="counter">{{$scope->count()}} Out of Scope</span>
                 <span id="scope-arrow" class="scope-arrow glyphicon arrow-right"></span>
            </span>
            </div>
        </a>
        <div id="scopetable" class="row scope-table">
            <table class="table table-hover table-center results">
                <thead>
                <th></th>
                <th>Name</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($scope as $s)
                    <tr class="clickable-row" data-href="{{route('showfeature',
                         [ $release->projects->path, $release->path, $s->id])}}">
                        <td style="border-left: 1px solid #CECECE; background-color: #CECECE;"></td>
                        <td class="width25"><span class="tabletitle">{{$s->name}}</span></td>
                        <td>{{$s->description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @include('features.add_feature')
    @include('features.add_nfr')
    @include('features.add_ts')
    @include('features.add_scope')
@endsection