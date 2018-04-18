@extends('layout.app')

@section('title')
    Requirement
@endsection

@section('breadcrumbs', Breadcrumbs::render('requirement'))

@section('content')

    <button class="btn btn-primary" onclick="document.getElementById('addRequirement').style.display='block'">
        <span class="glyphicon glyphicon-plus"></span> Add Requirement
    </button>
    <br><br>

    <!-- ADD REQUIREMENT -->
    <div id="addRequirement" class="modal">
        <span onclick="document.getElementById('addRequirement').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form action="{{route('storeRequirement')}}" method="post" class="modal-content animate">
            {{ csrf_field() }}
            <h3>Requirement</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="requirement_name" id="requirement_name" placeholder="Requirement name" required>
                <br><br>
                <textarea rows="4" cols="50" name="description" class="form-control" id="description" placeholder="Requirement description"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-danger" onclick="document.getElementById('addRequirement').style.display='none'">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-striped table-hover">
        @foreach($requirements as $requirement)
            <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-md-6">
                            {{$requirement->name}}
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-success" href="{{route('requirementdetails', $requirement->name)}}"><span class="glyphicon glyphicon-search"></span></a>
                            <a class="btn btn-warning" onclick="document.getElementById('editRequirement').style.display='block'"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" href="{{route('deleteRequirement', $requirement->name)}}"><span class="glyphicon glyphicon-trash"></span></a>
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
    var modal = document.getElementById('addRequirement');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>