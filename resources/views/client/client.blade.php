@extends('layout.app')

@section('title')
    Client
@endsection

@section('breadcrumbs', Breadcrumbs::render('client'))
@section('content')
    <div class="row">
        <a class="black" href="{{route('addclient')}}">
            <button class="btn-primary">
                Add Client <span class="icon-right glyphicon glyphicon-plus"></span>
            </button></a>

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
                <input type="text" name="search" id="searchfield" class="search searchfield" placeholder="Search">
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

    <!-- ADD COMPANY -->
    <div id="addCompany" class="modal">
        <span onclick="document.getElementById('addCompany').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form action="{{route('storeclient')}}" method="post" class="modal-content animate">
            {{ csrf_field() }}
            <h3>Company</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Company name"
                       required>
                <br><br>
                <textarea rows="4" cols="50" name="description" class="form-control" id="description"
                          placeholder="Company description"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-danger" onclick="document.getElementById('addCompany').style.display='none'">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>

    @include('client.client_table')

@endsection

<script>
    // Get the modal
    var modal = document.getElementById('addCompany');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>