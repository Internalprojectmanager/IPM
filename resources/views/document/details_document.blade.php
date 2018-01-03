@extends('layout.app')

@section('title')
    {{$document->title}} - {{$document->projects->name}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('detailsdocument', $document))

@section('content')
    <button onclick="location.href='{{route('editdocument', ['name' => $document->projects->name, 'company_id' => $document->projects->company_id, 'document_id' => $document->id])}}'"
            class="btn-edit" id="project-edit">
        <span class="glyphicon edit-icon"></span> Edit
    </button>

    <div class="row">
        <div class="header-3" id="document-details">
            <div class="row">
                <div class="col-md-6">
                    <span class="project-title block-title">Release Name</span> <br>
                    <span class="project-detail block-value">{{$document->release->name}}</span>
                </div>

                <div class="col-md-3">
                    <span class="project-title block-title">Category</span> <br>
                    <span class="project-detail block-value">{{$document->categories->name}}</span>
                </div>
                <div class="col-md-3">
                    <span class="project-title block-title">Status</span> <br>
                    <span class="project-detail block-value">{{$document->dstatus->name}}</span>
                </div>
            </div>

            <div class="row under-details">
                <div class="col-md-6">
                    <span class="project-title block-title">File Name</span> <br>
                    <span class="project-detail block-value">{{$document->title}}</span>
                </div>
                <div class="col-md-6">
                    <span class="project-title block-title">File</span> <br>
                    @if(!empty($document->filename))
                        <div class="download">
                            <span class="project-detail block-value">{{$document->filename}}</span>
                            <a href="{{route('downloadfile',['name' => $project->name, 'company_id' => $project->company_id, 'document_id' => $document->id])}}"><span class="project-detail pull-right block-value black"><i class=""></i>Download</span></a>
                            <span class="project-detail pull-right block-value">{{round(Storage::size($document->link) / 1000000, 2)}} MB</span>
                        </div>
                    @else
                        <div class="download">
                            <span class="project-detail block-value">No file uploaded</span>
                        </div>
                    @endif

                </div>
            </div>
            <div class="row block-description">
                <div class="col-md-6">
                    <span class="project-title block-title">File Description</span> <br>
                    <span class="project-detail block-value">{{$document->description}}</span>
                </div>
            </div>
        </div>
    </div>
@endsection