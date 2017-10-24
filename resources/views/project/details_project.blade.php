@extends('layout.app')

@section('title')
    Project details
@endsection

@section('breadcrumbs', Breadcrumbs::render('singleproject', $projects, $companys))

@section('content')

    <div class="row center">
            <span class="header-3">{{$companys->name}} - {{$projects->name}}</span>
            <p>
                {{$projects->description}}
            </p>
    </div>

    <div class="row center">
        <div class="col-md-4">
            <span class="header-3">Releases</span>
            <br>
            <div class="row">
                <a class="btn btn-primary" href="{{route('addrelease', ['name' => $projects->name, 'company_id' => $projects->company_id])}}">
                    <span class="glyphicon glyphicon-plus"></span> New release</a>
            </div>
            @foreach($releases as $release)
                <div class="row">
                    <a href="{{route('showrelease', ['name' => $projects->name, 'company_id' => $projects->company_id,
                     'release_name' => $release->name, 'version' => $release->version])}}">{{$release->version}} {{$release->name}} </a>
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <span class="header-3">Letters</span>
            <br>
            <div class="row">
                <a class="btn btn-primary" href="{{route('addletter', ['name' => $projects->name, 'company_id' => $projects->company_id])}}">
                    <span class="glyphicon glyphicon-plus"></span> New letter</a>
            </div>

            @foreach($letters as $letter)
                <div class="row">
                    <a href="{{route('showletter', ['name' => $projects->name, 'company_id' => $projects->company_id,
                    'letter_name' => $letter->title, 'letter_id' => $letter->id])}}">{{$letter->title}}</a>
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <span class="header-3">Documents</span>
            <br>
            <div class="row">
                <a class="btn btn-primary" href="{{route('adddocument', ['name' => $projects->name, 'company_id' => $projects->company_id])}}">
                    <span class="glyphicon glyphicon-plus"></span> Add document</a>

            </div>
            @foreach($documents as $document)
                <p>
                    <a href="{{route('showdocument', ['name' => $projects->name, 'company_id' => $projects->company_id,
                    'document_name' => $document->title, 'document_id' => $document->id])}}">{{$document->title}}</a>
                </p>
            @endforeach
        </div>
    </div>

@endsection