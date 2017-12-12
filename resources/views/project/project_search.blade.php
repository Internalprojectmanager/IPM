<div class="row bigtable">
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
                <td>
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
    <span style='display: none;' id="new-count">{{$projectcount}}</span>
</div>