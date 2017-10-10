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

        <a class="btn btn-primary btn-lg btn-block" href="{{route('addcompany', $company->name, $company->description)}}">
            <span class="glyphicon glyphicon-plus"></span>
        </a>

</div>

@endsection