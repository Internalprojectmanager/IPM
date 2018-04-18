 <div class="row bigtable">
        <table class="table table-hover table-center results" id="release-overview">
            <thead>
            <tr>
                <th></th>
                <th>@sortablelink('name', 'Project + Client')</th>
                <th>@sortablelink('description', 'Description')</th>
                <th>@sortablelink('pstatus.name', 'Status')</th>
                <th>@sortablelink('deadline', 'Deadline')</th>
                <th>Users</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <td style="background-color: {{$project->pstatus->color}};"></td>
                    <td><span id="tabletitle"><a href="{{route('projectdetails', [$client->path, $project->path])}}">{{$project->name}}</a></span> <br> <span class="tablesubtitle">@if(isset($project->company)){{$project->company->name}}@endif</span></td>
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
 </div>