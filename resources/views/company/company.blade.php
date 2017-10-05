@extends('layout.app')

@section('title')
    Company
@endsection

@section('content')

    @foreach($companys as $company)
        <p>
            {{$company->name}}
            <a class="btn btn-success" href="{{route('companydetails', $company->name, $company->description)}}"><span class="glyphicon glyphicon-edit"></span></a>
            <a class="btn btn-warning" href="{{route('editcompany', $company->name, $company->description)}}"><span class="glyphicon glyphicon-edit"></span></a>

            <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('deletecompany', $company->name)}}"><span class="glyphicon glyphicon-trash"></span></a>

        </p>
    @endforeach

    <div class="dropdown">
        <button class="btn btn-primary btn-lg btn-block dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <form action="{{route('storecompany')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company name" required>
                </div>
                <div class="form-group">
                    <textarea rows="4" cols="50" name="description" class="form-control" id="description" placeholder="Company description" required></textarea>
                </div>
                <button id="show_form" class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>

</div>

@endsection

<script>
    function showCompany() {
        return alert("Company: {{$company->name}}\n\nDescription: {{$company->description}}");
    }
</script>