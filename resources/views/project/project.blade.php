@extends('layout.app')

@section('title')
    Project
@endsection

@section('breadcrumbs', Breadcrumbs::render('projects'))

@section('content')
    <div class="row">
        <a class="black" href="{{route('addproject')}}">
        <button class="btn-primary">
             Add project <span class="icon-right glyphicon glyphicon-plus"></span>
        </button></a>

    </div>

    <div class="row block-white">
        <span class="block-white-title">All projects</span>
        <span class="block-white-subtitle">
            <span id="count_projects_bar">|</span>
            <span class="counter">{{$projectcount}} Projects</span>
        </span>
        <div class="form-group pull-right">
            <input type="text" class="search" placeholder="Search">
        </div>
    </div>

    <div class="row">
        <table class="table table-hover table-center results">
            <thead>
            <th></th>
            <th>Project + Client</th>
            <th>Description</th>
            <th>Status</th>
            <th>Deadline</th>
            <th>Users</th>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <td style="background-color: {{$project->pstatus->color}};"></td>
                    <td><span class="tabletitle"><a href="{{route('projectdetails', ['name' => $project->name, 'company_id' => $project->company_id])}}">{{$project->name}}</a></span> <br> <span class="tablesubtitle">@if(isset($project->company)){{$project->company->name}}@endif</span></td>
                    <td class="table-description">{{implode(' ', array_slice(str_word_count($project->description, 2), 0, 10))}}...</td>
                    <td>{{$project->pstatus->name}}</td>
                    <td>@if(isset($project->deadline)){{date('d F Y', strtotime($project->deadline))}} <br>
                            <?php echo $project->daysleft;?>
                        @else -  @endif</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="center">
            {{ $projects->links() }}
        </div>

    </div>
@endsection