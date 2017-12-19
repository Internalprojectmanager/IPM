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
            <span class="counter">{{$projectcount}}</span>
            <span class="contenttype">Projects</span>
        </span>
        @if(config('app.secure') == TRUE)
            <form method="get" action="{{secure_url('/project/overview')}}" class="pull-right searchform">
        @else
            <form method="get" action="{{url('/project/overview')}}" class="pull-right searchform">
        @endif
            <div class="form-group pull-right">
                <input type="text" name="search" id="searchfield" class="search searchfield" placeholder="Search">
            </div>

            <div class="form-group pull-right">
                <select name='client' type="text" id="client" class="search dropdown-search">
                    <option selected value="">Client</option>
                    @foreach($clients as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group pull-right">
                <select name='status' id="status" type="text" class="search dropdown-search">
                    <option  selected value="">Status</option>
                    @foreach($status as $s)
                        <option value="{{$s->id}}">{{$s->name}}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" id="sort" value="">
            <input type="hidden" id="page" value="">
            <input type="hidden" id="order" value="">
        </form>
    </div>

    <div class="row bigtable">
        <table class="table table-hover table-center results">
            <thead>
            <tr>
            <th></th>
            <th>@sortablelink('name', 'Project + Client')</th>
            <th>@sortablelink('description', 'Description')</th>
            <th>@sortablelink('pstatus.name', 'Status')</th>
            <th>@sortablelink('deadline', 'Deadline')</th>
            <th>@sortablelink('users', 'Users')</th>
            </thead>
            </tr>
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
                    <td style="max-width: 250px;">
                        <?php $i = 0;?>
                        @foreach($project->assignee as $as)
                                @if($i <= 2)
                                    <span class="assignee">{{$as->users->first_name}} {{$as->users->last_name}}</span>
                                @else
                                    <span class="more">and More...</span>
                                @endif
                                <?php $i++;?>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="center">
            {{ $projects->links() }}
        </div>

    </div>
@endsection