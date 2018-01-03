@extends('layout.app')

@section('title')
    {{$project->company->name}} {{$project->name}} - Documents
@endsection

@section('breadcrumbs', Breadcrumbs::render('documents', $project))


@section('content')

    <div class="row">
        <a class="black" href="{{route('adddocument', ['name' => $project->name, 'company_id' => $project->company_id])}}">
            <button class="btn-primary">
                Add Document <span class="icon-right glyphicon glyphicon-plus"></span>
            </button></a>

    </div>

    <div class="row bigtable">
            <table class="table client-table table-center results">
                <thead>
                <th></th>
                <th>Release Name</th>
                <th>Document Name</th>
                <th>Document Type</th>
                <th>Document Status</th>
                </thead>
                <tbody>
                @foreach($document as $doc)
                    <tr>
                        <td style="border-left: 1px solid #CECECE; background-color: {{$doc->dstatus->color}};"></td>
                        <td>{{$doc->release->version}} - {{$doc->release->name}}</td>
                        <td><a href="{{route('showdocument', ['company_id' => $project->company_id, 'name' => $project->name, 'document_id' => $doc->id])}}">{{$doc->title}}</a></td>
                        <td style="width: 180px;">{{$doc->categories->name}}</td>
                        <td>{{$doc->dstatus->name}}</td>
                    </tr>
            @endforeach
                </tbody>
            </table>
    </div>
@endsection