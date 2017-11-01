@extends('layout.app')

@section('title')
    Test Report Details
@endsection

@section('content')
        <p>
            Title:
            {{$testreport->title}}
            <br>
            Description:
            {{$testreport->description}}
            <br>
            Version:
            {{$testreport->version}}
            <br>
            Author:
            {{$testreport->author}}
            <br>
            Status:
            {{$testreport->status}}
        </p>

@endsection