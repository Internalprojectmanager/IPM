<div class="row bigtable">
    <table class="table table-hover table-center results">
        <thead>
        <th></th>
        <th>@sortablelink('name', 'Feature - Requirement')</th>
        <th>@sortablelink('description', 'Description')</th>
        <th>@sortablelink('rstatus.name', 'Status')</th>
        <th>@sortablelink('features->releases.deadline', 'Deadline')</th>
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
                <td>@if(isset($f->features->releases->deadline)){{date('d F Y', strtotime($f->features->releases->deadline))}} <br>
                    <?php echo $f->features->releases->daysleft;?>
                    @else -  @endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="center">

    </div>
    <span style='display: none;' id="new-count"></span>
</div>