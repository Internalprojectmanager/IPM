<div class="requirement-results">
    <div class="row under-details requirement-table">
        <span class="block-white-title">All requirements</span>
        <span class="block-white-subtitle">
                <span id="count_projects_bar">|</span>
                <span class="counter">{{$feature->requirements->count()}} Requirements</span>
                <span id="count_projects_bar">|</span>
                <span class="counter">{{$requirementcount}}/{{$feature->requirements->count()}} Done</span>
            </span>
    </div>
    <div class="row requirement-table">
        <form action="{{route('requirementsavestatus', ['company_id' => $feature->releases->projects->company_id, 'name' => $feature->releases->projects->name,
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
                        <td class="width20"><span class="tabletitle">{{$requirement->name}}</span></td>
                        <td class="">{!! nl2br($requirement->description) !!}</td>
                        <td class="">
                            @if($requirement->rstatus)
                                {{$requirement->rstatus->name}}
                            @endif

                        </td>
                        <td class="width25">
                            @foreach($requirement->assignees as $assignee)
                                <div class="row" style="line-height: 2.3;">
                                    <div class="col-md-12 requiremnt-assingee">
                                        <div class="col-md-7" style="padding: 6px 12px;">
                                            <span >{{$assignee->users->first_name}} {{$assignee->users->last_name}}</span>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="form-control input-text-modal assignee-check" name="status[]" @if(Auth::id() !== $assignee->userid) disabled="" @endif>
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
                                                            {{$s->name}}
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
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>