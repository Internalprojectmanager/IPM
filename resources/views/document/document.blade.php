@extends('layout.app')

@section('title')
@endsection

@section('content')

    <div class="row">
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
                        <td>{{$doc->title}}</td>
                        <td style="width: 180px;"></td>
                        <td>{{$doc->dstatus->name}}</td>
                    </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection