@extends('layout.app')

@section('title')
    Client
@endsection

@section('breadcrumbs', Breadcrumbs::render('client'))

@section('content')

    <button class="btn btn-primary" onclick="document.getElementById('addCompany').style.display='block'">
        <span class="glyphicon glyphicon-plus"></span> Add client
    </button>
    <h2>All Clients ({{$clientcount}})</h2>

    <!-- ADD COMPANY -->
    <div id="addCompany" class="modal">
        <span onclick="document.getElementById('addCompany').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form action="{{route('storeclient')}}" method="post" class="modal-content animate">
            {{ csrf_field() }}
            <h3>Company</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Company name" required>
                <br><br>
                <textarea rows="4" cols="50" name="description" class="form-control" id="description" placeholder="Company description"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-danger" onclick="document.getElementById('addCompany').style.display='none'">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-striped table-hover table-center">
        <thead>
            <th>Client Name</th>
            <th>Contact</th>
            <th>Resent Case</th>
            <th>Users</th>
            <th></th>
        </thead>
        @foreach($clients as $client)
            <tbody>
            <tr>
                <td>{{$client->name}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a class="btn btn-warning" href="{{route('editclient', ['name' => $client->name, 'client_id' => $client->client_id])}}"><span class="glyphicon glyphicon-edit"></span></a>
                    <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" href="{{route('deleteclient', $client->name)}}"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>

@endsection

<script>
    // Get the modal
    var modal = document.getElementById('addCompany');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>