<div class="row bigtable requirement-results">
    <form action="{{route('requirementsaveAuthstatus')}}" method="post" id="assignee_update">
    <table class="table table-hover table-center results">
        <thead>
        <th></th>
        <th>Feature - Requirement</th>
        <th>Description</th>
        <th>Status</th>
        <th>Deadline</th>
        </thead>
        <tbody>
        @if($requirements->count() == 0)
            <tr>
                <td style="border-left: 1px solid #CECECE" class="center" colspan="5"><h4>@lang('You have no To-dos left, Good Job :D')</h4></td>
            </tr>

        @endif
        @foreach($requirements as $f)
            @foreach($f->assignees as $as)
                @if($as->userid == Auth::id())
            <tr class="">
                <td style="background-color: @if($as->astatus){{$as->astatus->color}} @else #000 @endif;"></td>
                <td>
                    <span class="tabletitle">
                        <a href="{{route('showfeature',[$f->features->releases->projects->company->path,
                             $f->features->releases->projects->path,
                             $f->features->releases->path, $f->features->id])}}">
                            {{$f->features->name}} - {{$f->name}}
                        </a>
                        </span>
                    <br><span class="tablesubtitle">
                        @if(isset($f->features))
                            <a class="tablesubtitle"
                               href="{{route('showrelease',[$f->features->releases->projects->company->path,
                             $f->features->releases->projects->path,
                             $f->features->releases->path, $f->features->releases->version])}}">
                                {{$f->features->releases->projects->name}}: {{number_format($f->features->releases->version, 1,'.', ' ')}} {{$f->features->releases->name}}</a>
                        @endif
                    </span>
                </td>
                <td class="table-description">{!! nl2br(\Illuminate\Support\Str::words($f->description, 10,'...')) !!}</td>
                <td>
                    <select class="form-control transparent-selectbox assignee-check" name="status[]">
                        @foreach($status as $s)
                                @if($s->name == "Completed" || $s->name == "Draft" || $s->name == "Testing" || $s->name == "In Progress")
                                    <option
                                            @if($as->status == $s->id)
                                            selected
                                            @endif
                                            value="{{json_encode(
                                                            array(
                                                                "assignee" => Auth::id(),
                                                                "uuid" => $f->requirement_uuid,
                                                                'status' => $s->id))
                                                            }}">
                                        {{$s->name}}
                                    </option>
                                @endif

                        @endforeach
                    </select></td>
                <td>
                    @if($f->features->releases->rstatus->name != "Completed" && $f->features->releases->rstatus->name != "Paused"
                    && $f->features->releases->rstatus->name != "Cancelled")
                        @if(isset($f->features->releases->deadline)){{date('d F Y', strtotime($f->features->releases->deadline))}} <br>
                        @if($f->features->releases->monthsleft && $f->features->releases->monthsleft > 0)
                            <span>{{abs($f->features->releases->monthsleft)}} Month(s) left</span>
                        @elseif($f->features->releases->monthsleft && $f->features->releases->monthsleft < 0)
                            <span>{{abs($f->features->releases->monthsleft)}} Month(s) overdue</span>
                        @elseif($f->features->releases->daysleft >= 0)
                            <span @if($f->features->releases->daysleft < 5) class="red" @endif>{{abs($f->features->releases->daysleft)}} day(s) left</span>
                        @elseif($f->features->releases->daysleft < 0)
                            <span class="red">{{abs($f->features->releases->daysleft)}} day(s) overdue</span>
                        @endif
                        @endif
                    @endif
                </td>
                <td>

                </td>
            </tr>
            @endif
            @endforeach
        @endforeach
        </tbody>
    </table>
    <div class="center">
        {{$requirements->links()}}
    </div>
    <span style='display: none;' id="new-count">{{$requirementscount}}</span>
</div>