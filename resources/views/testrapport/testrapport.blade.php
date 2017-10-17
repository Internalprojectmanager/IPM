@extends('layout.app')

@section('title')
    Company
@endsection

@section('breadcrumbs', Breadcrumbs::render('testrapport'))

@section('content')

    <button class="btn btn-primary" onclick="document.getElementById('addTestrapport').style.display='block'">
        <span class="glyphicon glyphicon-plus"></span> Add testrapport
    </button>
    <br><br>

    <!-- ADD COMPANY -->
    <div id="addCompany" class="modal">
        <span onclick="document.getElementById('addTestrapport').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form action="{{route('storetestrapport')}}" method="post" class="modal-content animate">
            {{ csrf_field() }}
            <h3>Company</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="testrapport_title" id="testrapport_title" placeholder="Testrapport title" required>
                <br><br>
                <textarea rows="4" cols="50" name="description" class="form-control" id="description" placeholder="Description"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-danger" onclick="document.getElementById('addTestrapport').style.display='none'">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-striped table-hover">
        @foreach($testrapports as $testrapport)
            <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-md-6">
                            {{$testrapport->name}}
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-success" href="{{route('$testrapportdetails', $testrapport->name)}}"><span class="glyphicon glyphicon-search"></span></a>
                            <a class="btn btn-warning" onclick="document.getElementById('editTestrapport').style.display='block'"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" href="{{route('deletetestrapport', $testrapport->name)}}"><span class="glyphicon glyphicon-trash"></span></a>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>

@endsection

<script>
    // Get the modal
    var modal = document.getElementById('addTestrapport');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>