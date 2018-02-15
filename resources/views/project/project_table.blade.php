<div class="row bigtable">
    <table class="table table-hover table-center results">
        <thead>
        <th></th>
        <th>@sortablelink('name', 'Project + Client')</th>
        <th>@sortablelink('description', 'Description')</th>
        <th>@sortablelink('pstatus.name', 'Status')</th>
        <th>@sortablelink('deadline', 'Deadline')</th>
        <th>Users</th>
        </thead>
        <tbody>
        @foreach($projects as $project)
            <tr class="clickable-row" data-href="{{route('projectdetails', ['name' => $project->path, 'client_name' => $project->company->path])}}">
                <td style="background-color: {{$project->pstatus->color}};"></td>
                <td><span class="tabletitle">{{$project->name}}</span>
                    <br> <span class="tablesubtitle">@if(isset($project->company))<a class="tablesubtitle" href="{{route('clientdetails', ['name' => $project->company->name])}}">{{$project->company->name}}</a>@endif</span></td>
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