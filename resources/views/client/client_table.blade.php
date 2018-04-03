<div class="row bigtable">
    <table class="table client-table table-center results">
        <thead>
        <th></th>
        <th>@sortablelink('name', 'Client Name')</th>
        <th>@sortablelink('contactname', 'Contact')</th>
        <th>@sortablelink('cstatus.name', 'Status')</th>
        <th>@sortablelink('Projects')</th>
        <th>Last Two Projects</th>
        </thead>
        <tbody>
        @foreach($clients as $client)
            <tr class="clickable-row" data-href="{{route('clientdetails', [$client->path])}}">
                <td style="border-left: 1px solid #CECECE; background-color: {{$client->cstatus->color}};"></td>
                <td>{{$client->name}}</td>
                <td>
                    <span class="tabletitle">{{$client->contactname}}</span> <br>
                    <span class="tablesubtitle"> {{$client->contactnumber}}<br>
                        {{$client->contactemail}}</span>
                </td>
                <td style="width: 180px;">{{$client->cstatus->name}}</td>
                <td>{{$client->projects->count()}} Projects</td>
                <td>
                    <?php $i = 0 ;?>
                    @foreach ($client->projects as $p)
                        @if($i < 2)
                            <div class="col-md-6 recent-projects"><a href="/{{$client->path}}/{{$p->path}}/details">{{$p->name}}</a></div>
                        @endif
                        <?php $i++;?>
                    @endforeach</td>
            </tr>
        @endforeach
        </tbody>

    </table>

    {{ $clients->links() }}
    <span style='display: none;' id="new-count">{{$clientcount}}</span>
</div>