@extends('layout.app')

@section('title')
    Client
@endsection

@section('breadcrumbs', Breadcrumbs::render('client'))
@section('content')
    <div class="row">
        <button class="btn-primary black" id="myBtn">
            Add Client <span class="icon-right glyphicon glyphicon-plus"></span>
        </button>
    </div>

    <div class="row block-white">
        <span class="block-white-title">All clients</span>
        <span class="block-white-subtitle">
            <span id="count_projects_bar">|</span>
            <span class="counter">{{$clientcount}}</span>
            <span class="contenttype">Clients</span>
        </span>

        @if(config('app.secure') == TRUE)
            <form action="{{secure_url('/client/overview')}}" class="pull-right searchform">
        @else
            <form action="{{url('/client/overview')}}" class="pull-right searchform">
        @endif
            {{ csrf_field() }}
            <div class="form-group pull-right">
                <input type="text" name="search" class="search searchfield" placeholder="Search">
            </div>

            <div class="form-group pull-right">
                <select name="status" class="search dropdown-search">
                    <option value="" selected>Status</option>
                    @foreach($status as $s)
                        <option value="{{$s->name}}">{{$s->name}}</option>
                    @endforeach
                </select>
            </div>
        </form>

    </div>

    <!-- ADD CLIENT MODAL -->
    <div id="addClientModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <span>Add Client</span>
            </div>
            <div class="modal-body">
                <form action="{{route('storeclient')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="form-label-modal">Client Name<span class="required">*</span></label>
                        <input type="text" class="form-control input-text-modal" name="client_name" id="client_name">
                        <br><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label-modal">Client Description</label>
                        <textarea rows="4" cols="50" name="description" class="form-control" id="description"></textarea>
                        <br><br>
                    </div>
                        <!--
                        <label for="description">Description:</label>
                        <textarea rows="4" cols="50" name="description" class="form-control" id="description"></textarea>
                        <br><br>

                        <label for="contact_name">Contact Name:</label>
                        <input type="text" class="form-control" name="contact_name" id="contact_name">
                        <br><br>

                        <label for="contact_number">Contact Phonenumber:</label>
                        <input type="text" class="form-control" name="contact_number" id="contact_number">
                        <br><br>

                        <label for="contact_number">Contact Email:</label>
                        <input type="text" class="form-control" name="contact_mail" id="contact_number">
                        <br><br>


                        <label for="client_status">Client Status:</label>
                        <br>
                        <select name="status">
                            @foreach($status as $s)
                                <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                        <br><br>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>-->
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('addClientModal');

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <div class="row bigtable">
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
                                    <div class="col-md-6 recent-projects"><a href="{{route('projectdetails', ['client_id' => $client->id, 'name' => $p->name])}}">{{$p->name}}</a></div>
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