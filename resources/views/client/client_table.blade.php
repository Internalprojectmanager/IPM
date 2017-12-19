<div class="row bigtable">
    <table class="table client-table table-center results">
        <thead>
        <th></th>
        <th>@sortablelink('name', 'Client Name')</th>
        <th>@sortablelink('contactname', 'Contact')</th>
        <th>@sortablelink('cstatus.name', 'Status')</th>
        <th>@sortablelink('projects_count')</th>
        <th>Last Two Projects</th>
        </thead>
        <tbody>
        @foreach($clients as $client)
            <tr>
                <td style="border-left: 1px solid #CECECE; background-color: {{$client->cstatus->color}};"></td>
                <td><a href="{{route('clientdetails', ['name' => $client->name])}}">{{$client->name}}</a></td>
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
                            <div class="col-md-6 recent-projects"><a href="/{{$client->id}}/project/{{$p->name}}/details">{{$p->name}}</a></div>
                        @endif
                        <?php $i++;?>
                    @endforeach</td>
            <!--<td>
                        <a class="btn btn-warning"
                           href="{{route('editclient', ['name' => $client->name, 'client_id' => $client->client_id])}}"><span
                                    class="glyphicon glyphicon-edit"></span></a>
                        <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')"
                           href="{{route('deleteclient', $client->name)}}"><span
                                    class="glyphicon glyphicon-trash"></span></a>
                    </td>-->
            </tr>
        @endforeach
        </tbody>

    </table>

    {{ $clients->links() }}
    <span style='display: none;' id="new-count">{{$clientcount}}</span>
</div>