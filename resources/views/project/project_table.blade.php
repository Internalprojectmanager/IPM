<div class="row bigtable">
    <table class="table table-hover table-center results">
        <thead>
        <th></th>
        <th>@sortablelink('name', 'Project + Client')</th>
        <th>@sortablelink('team.name', 'Workspace')</th>
        <th>@sortablelink('description', 'Description')</th>
        <th>@sortablelink('pstatus.name', 'Status')</th>
        <th>@sortablelink('deadline', 'Deadline')</th>
        <th>Users</th>
        </thead>
        <tbody>
        @foreach($projects as $project)
            <tr class="clickable-row" data-href="
                   {{route('projectdetails',[$project->company->path, $project->path])}}">
                <td style="background-color: {{$project->pstatus->color}};"></td>
                <td><span class="tabletitle">{{$project->name}}</span>
                    <br>
                    <span class="tablesubtitle">

                        @if(isset($project->company))
                            <a class="tablesubtitle" href="{{route('clientdetails', $project->company->path)}}">
                                {{$project->company->name}}</a>
                        @endif
                    </span>
                </td>
                <td>
                    <a class="black" href="{{route('team.show', $project->team()->name)}}">
                        {{$project->team()->name}}
                    </a>
                </td>
                <td class="table-description">{{implode(' ', array_slice(str_word_count($project->description, 2), 0, 10))}}
                    ...
                </td>
                <td>{{$project->pstatus->name}}
                    <br>
                    @if($project->pstatus->name == "Completed")
                        <span class="tablesubtitle">on {{\Carbon\Carbon::parse($project->updated_at)}}</span>
                    @elseif($project->pstatus->name == "Paused")
                        <span class="tablesubtitle">on {{\Carbon\Carbon::parse($project->updated_at)}}</span>
                    @elseif($project->pstatus->name == "Cancelled")
                        <span class="tablesubtitle">on {{\Carbon\Carbon::parse($project->updated_at)}}</span>
                    @endif

                </td>
                <td>
                    @if($project->pstatus->name != "Completed" &&$project->pstatus->name != "Paused" && $project->pstatus->name != "Cancelled")
                        @if(isset($project->deadline)){{date('d F Y', strtotime($project->deadline))}} <br>
                            @if($project->monthsleft && $project->monthsleft > 0)
                                <span>{{abs($project->monthsleft)}} Month(s) left</span>
                            @elseif($project->monthsleft && $project->monthsleft < 0)
                                <span>{{abs($project->monthsleft)}} Month(s) overdue</span>
                            @elseif($project->daysleft >= 0)
                                <span @if($project->daysleft < 5) class="red" @endif>{{abs($project->daysleft)}} day(s) left</span>
                            @elseif($project->daysleft < 0)
                                 <span class="red">{{abs($project->daysleft)}} day(s) overdue</span>
                            @endif
                        @endif
                    @endif
                </td>
                <td style="max-width: 250px;">
                    <?php $i = 0;?>
                    @foreach($project->assignee as $as)
                        @if($i <= 2)
                            <span class="assignee">{{$as->users->first_name}} {{$as->users->last_name}}</span>
                        @else
                            <span class="more">and More...</span>
                            @php break; @endphp
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
    <span style='display: none;' id="new-count">{{$projectcount}}</span>
</div>