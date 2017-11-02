@extends('layout.app')

@section('title')
    Company
@endsection

@section('breadcrumbs', Breadcrumbs::render('company'))

@section('content')

    <button class="btn btn-primary" onclick="document.getElementById('addCompany').style.display='block'">
        <span class="glyphicon glyphicon-plus"></span> Add company
    </button>
    <br><br>

    <!-- ADD COMPANY -->
    <div id="addCompany" class="modal">
        <span onclick="document.getElementById('addCompany').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form action="{{route('storecompany')}}" method="post" class="modal-content animate">
            {{ csrf_field() }}
            <h3>Company</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company name" required>
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

    <table class="table table-striped table-hover">
        @foreach($companys as $company)
            <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-md-6">
                            {{$company->name}}
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-success" href="{{route('companydetails', $company->name)}}"><span class="glyphicon glyphicon-search"></span></a>
                            <a class="btn btn-warning" href="{{route('editcompany', ['name' => $company->name, 'company_id' => $company->company_id])}}"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" href="{{route('deletecompany', $company->name)}}"><span class="glyphicon glyphicon-trash"></span></a>
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
    var modal = document.getElementById('addCompany');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>