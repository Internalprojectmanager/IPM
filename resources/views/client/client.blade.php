@extends('layout.app')

@section('title')
    Client
@endsection

@section('breadcrumbs', Breadcrumbs::render('client'))
@section('content')
    <div class="row">
        <a class="black" href="{{route('addclient')}}">
            <button class="btn-primary">
                Add Client <span class="icon-right glyphicon glyphicon-plus"></span>
            </button></a>

    </div>

    <div class="row block-white">
        <span class="block-white-title">All clients</span> <span class="block-white-subtitle"> | {{$clientcount}} Clients</span>
    </div>

    <!-- ADD COMPANY -->
    <div id="addCompany" class="modal">
        <span onclick="document.getElementById('addCompany').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form action="{{route('storeclient')}}" method="post" class="modal-content animate">
            {{ csrf_field() }}
            <h3>Company</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Company name"
                       required>
                <br><br>
                <textarea rows="4" cols="50" name="description" class="form-control" id="description"
                          placeholder="Company description"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-danger" onclick="document.getElementById('addCompany').style.display='none'">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <table class="table client-table table-center">
            <thead>
            <th></th>
            <th>Client Name</th>
            <th>Contact</th>
            <th>Status</th>
            <th>Project Count</th>
            <th>Last Two Projects</th>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td style="border-left: 1px solid #CECECE;" class="status-@if(!isset($client->status))Client @elseif($client->status == "No Partners Anymore")no-partner @else{{$client->status}} @endif"></td>
                    <td>{{$client->name}}</td>
                    <td>
                        <span class="tabletitle">{{$client->contactname}}</span> <br>
                        <span class="tablesubtitle"> {{$client->contactnumber}}<br>
                        {{$client->contactemail}}</span>
                    </td>
                    <td style="width: 180px;">{{$client->status}}</td>
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
    </div>


@endsection

<script>
    // Get the modal
    var modal = document.getElementById('addCompany');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>