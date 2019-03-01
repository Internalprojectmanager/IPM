@extends('layout.app')

@section('title')
    {{$project->company->name}} {{$project->name}} - Documents
@endsection

@section('breadcrumbs', Breadcrumbs::render('documents', $project))


@section('content')

    <div class="row">
        <a class="black" href="{{route('adddocument', [ $project->path])}}">
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
                        <td style="border-left: 1px solid #CECECE; background-color: @if(!empty($doc->status)){{$doc->dstatus->color}}@endif ;"></td>
                        <td>
                            @if(!empty($doc->release_id))
                                {{$doc->release->version}} - {{$doc->release->name}}
                            @else
                                -
                            @endif
                        </td>

                        <td><a href="{{route('showdocument', ['company_id' => $project->company_id, 'name' => $project->name, 'document_id' => $doc->id])}}">{{$doc->title}}</a></td>
                        <td style="width: 180px;">
                            @if(!empty($doc->category))
                                {{$doc->categories->name}}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if(!empty($doc->status))
                                {{$doc->dstatus->name}}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
            @endforeach
                </tbody>
            </table>
    </div>
@endsection