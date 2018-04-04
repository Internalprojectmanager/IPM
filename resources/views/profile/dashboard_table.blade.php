<div class="row bigtable">
    <table class="table table-hover table-center results">
        <thead>
        <th></th>
        <th>Feature - Requirement</th>
        <th>Description</th>
        <th>Status</th>
        <th>Deadline</th>
        </thead>
        <tbody>
        @foreach($feature as $f)
            <tr class="clickable-row"
                data-href="{{route('showfeature',[$f->features->releases->projects->company->path,
                             $f->features->releases->projects->path,
                             $f->features->releases->path, $f->features->id])}}">
                <td style="background-color: {{$f->rstatus->color}};"></td>
                <td>
                    <span class="tabletitle">{{$f->features->name}} - {{$f->name}}</span>
                    <br><span class="tablesubtitle">
                        @if(isset($f->features))
                            <a class="tablesubtitle"
                               href="{{route('showrelease',[$f->features->releases->projects->company->path,
                             $f->features->releases->projects->path,
                             $f->features->releases->path, $f->features->releases->version])}}">
                                {{$f->features->releases->projects->name}} - {{$f->features->releases->name}}</a>
                        @endif
                    </span>
                </td>
                <td class="table-description">{{implode(' ', array_slice(str_word_count($f->description, 2), 0, 10))}}
                    ...
                </td>
                <td>{{$f->rstatus->name}}</td>
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
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="center">
        {{$feature->links()}}
    </div>
    <span style='display: none;' id="new-count">{{$featurecount}}</span>
</div>