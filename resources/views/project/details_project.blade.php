@extends('layout.app')

@section('title')
    Project details
@endsection

@section('breadcrumbs', Breadcrumbs::render('singleproject', $projects, $companys))

@section('content')

    <div class="row">
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
        </p>
    </div>

    <div class="row">
        <div class="col-md-4">
            Releases:
            <br>
            <a href="{{route('addrelease', ['name' => $projects->name, 'company_id' => $projects->company_id])}}">Add release</a>
            @foreach($releases as $release)
                <p>
                    <a href="{{route('showrelease', ['name' => $projects->name, 'company_id' => $projects->company_id,
                     'release_name' => $release->name, 'version' => $release->version])}}">{{$release->version}} {{$release->name}} </a>
                </p>
            @endforeach
        </div>
        <div class="col-md-4">
            Letters:
            <br>
            <a href="{{route('addletter', ['name' => $projects->name, 'company_id' => $projects->company_id])}}">Add letter</a>
            @foreach($letters as $letter)
                <p>
                    <a href="#">{{$letter->title}}</a>
                </p>
            @endforeach
        </div>
        <div class="col-md-4">
            Documents:
            <br>
            <a href="{{route('adddocument', ['name' => $projects->name, 'company_id' => $projects->company_id])}}">Add document</a>
            @foreach($documents as $document)
                <p>
                    <a href="{{route('showdocument', ['name' => $projects->name, 'company_id' => $projects->company_id,
                    'document_name' => $document->title, 'document_id' => $document->id])}}">{{$document->title}}</a>
                </p>
            @endforeach
        </div>
    </div>

@endsection