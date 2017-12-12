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
            <form action="{{secure_url('/project/overview')}}" class="pull-right searchform">
        @else
            <form action="{{url('/project/overview')}}" class="pull-right searchform">
        @endif
            <div class="form-group pull-right">
                <input type="text" name="search" class="search searchfield" placeholder="Search">
            </div>

            <div class="form-group pull-right">
                <select name='client' type="text" class="search dropdown-search">
                    <option selected value="">Client</option>
                    @foreach($clients as $c)
                        <option value="{{$c->name}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group pull-right">
                <select name='status' type="text" class="search dropdown-search">
                    <option  selected value="">Status</option>
                    @foreach($status as $s)
                        <option value="{{$s->name}}">{{$s->name}}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <div class="row bigtable">
        <table class="table table-hover table-center results">
            <thead>
            <tr>
            <th></th>
            <th>@sortablelink('column', 'Project + Client')</th>
            <th>@sortablelink('column', 'Description')</th>
            <th>@sortablelink('column', 'Status')</th>
            <th>@sortablelink('column', 'Deadline')</th>
            <th>@sortablelink('column', 'Users')</th>
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