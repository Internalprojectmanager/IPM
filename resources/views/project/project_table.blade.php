<div class="row bigtable">
    <table class="table table-hover table-center results">
        <thead>
        <th></th>
        <th>@sortablelink('name', 'Project')</th>
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
                <td class="col-md-2"><span class="tabletitle">{{$project->name}}</span>
                    <br>
                    <span class="tablesubtitle">
                        @if(isset($project->company))
                            <a class="grey" href="{{route('clientdetails', $project->company->path)}}">
                                {{$project->company->name}}</a>
                        @endif

                    </a>
                    </span>
                </td>
                <td class="col-md-2">{{implode(' ', array_slice(str_word_count($project->description, 2), 0, 10))}}
                    @if(str_word_count($project->description) > 10)
                        ...
                    @endif
                </td>
                <td class="col-md-2">{{$project->pstatus->name}}
                    <br>
                    @if($project->pstatus->name == "Completed")
                        <span class="tablesubtitle grey">on {{\Carbon\Carbon::parse($project->updated_at)}}</span>
                    @elseif($project->pstatus->name == "Paused")
                        <span class="tablesubtitle grey">on {{\Carbon\Carbon::parse($project->updated_at)}}</span>
                    @elseif($project->pstatus->name == "Cancelled")
                        <span class="tablesubtitle grey">on {{\Carbon\Carbon::parse($project->updated_at)}}</span>
                    @endif

                </td>
                <td class="col-lg-2 col-md-2">
                    @if($project->pstatus->name != "Completed" &&$project->pstatus->name != "Paused" && $project->pstatus->name != "Cancelled")
                        @if(isset($project->deadline)){{date('d F Y', strtotime($project->deadline))}} <br>
                            @if($project->monthsleft && $project->monthsleft > 0)
                                <span class="tablesubtitle">{{abs($project->monthsleft)}} Month(s) left</span>
                            @elseif($project->monthsleft && $project->monthsleft < 0)
                                <span class="tablesubtitle red">{{abs($project->monthsleft)}} Month(s) overdue</span>
                            @elseif($project->daysleft >= 0)
                                <span class="tablesubtitle @if($project->daysleft < 5) red @endif ">{{abs($project->daysleft)}} day(s) left</span>
                            @elseif($project->daysleft < 0)
                                 <span class="tablesubtitle red">{{abs($project->daysleft)}} day(s) overdue</span>
                            @endif
                        @endif
                    @endif
                </td>
                <td class="col-md-6">
                    <?php $i = 0;?>
                    @foreach($project->assignee as $as)
                        <div class="col-md-12 col-lg-6">
                            <span class="assignee">{{$as->users->first_name}} {{$as->users->last_name}}</span>
                        </div>

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