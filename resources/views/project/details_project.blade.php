@extends('layout.app')

@section('title')
    Project details
@endsection

@section('breadcrumbs', Breadcrumbs::render('singleproject', $projects, $companys))

@section('content')

        <p>
            Project:
            {{$projects->name}}
            <br>
                Company:
                {{$companys->name}}
            <br>
            Description:
            {{$projects->description}}
            <br><br>
            Releases:
            @foreach($releases as $release)
                <p>
                    <a href="{{route('showrelease', ['name' => $projects->name, 'company_id' => $projects->company_id,
                     'release_name' => $release->name, 'version' => $release->version])}}">{{$release->version}} {{$release->name}} </a>
                </p>
            @endforeach
            <br><br>
            <a href="{{route('addrelease', ['name' => $projects->name, 'company_id' => $projects->company_id])}}">Add release</a>
            <br>
            <a href="{{route('adddocument', $projects->name)}}">Add document</a>
        </p>

@endsection