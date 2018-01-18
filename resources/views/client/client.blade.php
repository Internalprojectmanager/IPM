@extends('layout.app')

@section('title')
    Client
@endsection

@section('breadcrumbs', Breadcrumbs::render('client'))
@section('content')
    <div class="row">

        <button type="button" class="btn btn-primary black" data-toggle="modal" data-target="#addClientModal">
            Add Client <span class="icon-right glyphicon glyphicon-plus"></span>
        </button>

    </div>

    <div class="row block-white">
        <span class="block-white-title">All clients</span>
        <span class="block-white-subtitle">
            <span id="count_projects_bar">|</span>
            <span class="counter">{{$clientcount}}</span>
            <span class="contenttype">Clients</span>
        </span>

        @if(config('app.secure') == TRUE)
            <form action="{{secure_url('/client/overview')}}" class="pull-right searchform">
                @else
                    <form action="{{url('/client/overview')}}" class="pull-right searchform">
                        @endif
                        {{ csrf_field() }}
                        <div class="form-group pull-right">
                            <input type="text" name="search" id="searchfield" class="search searchfield"
                                   placeholder="Search">
                        </div>

                        <div class="form-group pull-right">
                            <select name="status" id="status" class="search dropdown-search">
                                <option value="" selected>Status</option>
                                @foreach($status as $s)
                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="sort" value="">
                        <input type="hidden" id="page" value="">
                        <input type="hidden" id="order" value="">
                    </form>
    </div>


    @include('client.client_table')
    @include('client.add_client')

@endsection