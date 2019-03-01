<div class="requirement-results">
    <div class="row under-details requirement-table">
        <span class="block-white-title h3 black">All requirements</span>
        <span class="block-white-subtitle">
                <span id="count_projects_bar">|</span>
                <span class="counter">{{$feature->requirements->count()}} Requirements</span>
                <span id="count_projects_bar">|</span>
                <span class="counter">{{$requirementcount}}/{{$feature->requirements->count()}} Done</span>
            </span>
    </div>
    <div class="requirements-results header-3">
    <div class="row requirement-table table-responsive">
        <form action="{{route('requirementsavestatus', ['name' => $feature->releases->projects->name,
            'release_name' => $feature->releases->name, 'feature_id' => $feature->id])}}" method="post" id="assignee_update">
            <table class="table table-hover table-center results">
                <thead>
                <th></th>
                <th>Requirement</th>
                <th>Description</th>
                <th>Status</th>
                <th>Assigned To</th>
                </thead>
                <tbody>
                <?php $i = 0;?>
                @foreach($feature->requirements as $requirement)
                    <tr>
                        <td style="border-left: 1px solid #CECECE; background-color: {{$requirement->rstatus->color}};"></td>
                        <td><span class="tabletitle">{{$requirement->name}}</span></td>
                        <td style="max-width: 300px">{!! nl2br(Linkify::process($requirement->description)) !!}</td>
                        <td>
                            @if($requirement->rstatus)
                                {{$requirement->rstatus->name}}
                            @endif

                        </td>
                        <td>
                            @foreach($requirement->assignees as $assignee)
                                <div class="row" style="line-height: 2.3;">
                                    <div class="requiremnt-assingee">
                                        <div class="col-md-7">
                                            <i class="fas fa-circle" style="margin-right: 10px; color: @if($assignee->astatus){{$assignee->astatus->color}}; @endif "></i>
                                            <span>
                                                <img alt="{{$assignee->users->first_name}} {{$assignee->users->last_name}}"
                                                     class="img-circle img-thumbnail avatar-table" src="{{$assignee->users->getAvatar()}}"/>
                                                <span style="margin-left: 10px;">{{$assignee->users->first_name}} {{$assignee->users->last_name}}</span>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="form-control transparent-selectbox assignee-check" width="100%" name="status[]" @if(Auth::id() !== $assignee->userid) disabled="" @endif>
                                                @foreach($status as $s)
                                                    @if($s->name == "Completed" || $s->name == "Draft" || $s->name == "Testing" || $s->name == "In Progress")
                                                        <option

                                                                @if($assignee->status == $s->id)
                                                                selected
                                                                @endif
                                                                value="{{json_encode(
                                                        array(
                                                            "assignee" => $assignee->userid,
                                                            "uuid" => $requirement->requirement_uuid,
                                                           'status' => $s->id))
                                                        }}">
                                                            <i class="fas fa-circle" style="color: {{$s->color}}; "></i>{{$s->name}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++;?>
                            @endforeach
                        </td>
                        <td><a href="{{route('editRequirement',
                             [ $project->path, $release->path, $feature->id, $requirement->id])}}"> <span class="glyphicon edit-icon"></span> </a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
    </div>
</div>