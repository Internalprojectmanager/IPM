@extends('layout.app')

@section('title')
    {{$projects->company->name}} {{$projects->name}} details | IPM
@endsection

@section('breadcrumbs', Breadcrumbs::render('singleproject', $projects, $companys))

@section('content')

    <a href="{{route('editproject', ['name' => $projects->name, 'company_id' => $projects->company_id])}}" class="btn-edit" id="project-edit">
        <span class="glyphicon edit-icon"></span> Edit
    </a>

    <div class="row">
        <div class="header-3" id="project-details">
            <div class="row" id="block-show">
                <div class="col-md-4 col-xs-6">
                    <span class="project-title block-title">Projects Name</span> <br>
                    <span class="project-detail block-value">{{$projects->name}}</span>
                </div>

                <div class="col-md-2 col-xs-6">
                    <span class="project-title block-title">Project Code</span> <br>
                    <span class="project-detail block-value">{{$projects->projectcode}}</span>
                </div>

                <div class="col-md-3 col-xs-6">
                    <span class="project-title block-title">Client</span> <br>
                    <span class="project-detail block-value">{{$projects->company->name}}</span>
                </div>

                <div class="col-md-3 col-xs-6">
                    <span class="project-title block-title" id="link">Link</span><br>
                    <i class="word-icon block-value"><span class="project-detail block-value" id="link-world">-</span></i><br>
                    <i class="text-icon block-value"><span class="project-detail block-value" id="link-t">-</span></i>
                </div>

            </div>
            <div class="row under-details block-description" id="block-hidden">
                <div class="col-md-6 col-xs-12">
                    <span class="project-title block-title">Project Description</span><br>
                    <span class="project-detail block-value">{{$projects->description}}</span>
                </div>

                <div class="col-md-6 col-xs-12 pull-right">
                    <span class="project-title block-title">Contact Person</span><br>
                    <i class="user-icon block-icons"><span class="project-detail block-value" id="contact-name">{{$projects->company->contactname}}</span></i><br>
                    <i class="tel-icon block-icons"><span class="project-detail block-value" id="contact-phone"><a href="tel:{{$projects->company->contactnumber}}">{{$projects->company->contactnumber}}</a></span></i><br>
                    <i class="mail-icon block-icons"> <span class="project-detail block-value" id="contact-email"><a href="mailto:{{$projects->company->contactemail}}">{{$projects->company->contactemail}}</a></span></i>
                </div>


            </div>
            <div class="row pull-right">
                <div class="col-md-5 col-xs-3">
                    <button onclick="location.href='{{route('documentoverview', ['name' => $projects->name, 'company_id' => $projects->company_id])}}'"
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
                <tr>
                    <td style="background-color: {{$release->rstatus->color}};"></td>
                    <td><span class="tabletitle"><a href="{{route('showrelease', ['name' => $projects->name, 'company_id' => $projects->company_id,
                        'release_name' => $release->name, 'version' => $release->version])}}">{{$release->version}}
                                - {{$release->name}} </a></span>
                    </td>
                    <td class="table-description">{{implode(' ', array_slice(str_word_count($release->description, 2), 0, 10))}}
                        ...
                    </td>
                    <td>{{$release->rstatus->name}}</td>
                    <td>@if(isset($release->deadline)){{date('d F Y', strtotime($release->deadline))}} <br>
                        <?php echo $release->daysleft;?>
                        @else -  @endif</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('project.assignee')
    @include('release.add_release')
@endsection