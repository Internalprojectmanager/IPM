@extends('layout.app')

@section('content')
        <form action="{{route('storeclient')}}" method="post">
            <div class="modal-body">
                <h1>New Client</h1>
                {{ csrf_field() }}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @include('client.form')
            </div>
            <div class="modal-footer row" style="border:none;">
                <div class="col-md-6" align="left">
                    <button type="button" class="btn-cancel" onclick="window.location.assign('{{route('overviewclient')}}')">Close</button>
                </div>
                <div class="col-md-6" align="right">
                    <button class="btn btn-primary" type="submit">
                        Add Client <span class="glyphicon glyphicon-plus">
                    </button>
                </div>
            </div>
        </form>

@endsection