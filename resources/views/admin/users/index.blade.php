@extends('layout.app')

@section('title')
    Users - Admin - {{env('APP_NAME')}}
@endsection


@section('content')

    <div class="row block-white">

        <div class="col-md-12 col-xs-12">
            <span class="block-white-title">
                Admin - Users </span>
            <span class="block-white-subtitle">
                    <span id="count_projects_bar">|</span>
                    <span class="counter">{{$users->count()}}</span>
                    <span class="contenttype">User(s)</span>
            </span>

        </div>
    </div>

    <div class="row">
        <table class="table table-hover table-center results" id="release-overview">
            <thead>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Login Provider</th>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="col-md-1" style="background-color: @if($user->active)#7ED321 @else #CECECE @endif ;"></td>
                    <td colspan="" class="col-md-3">
                        <span class="tabletitle">{{$user->first_name}} {{$user->last_name}} </span>
                        @if($user->id == Auth::id()) <span class="its its-you"> Its You!</span> @endif
                        @if($user->active == false) <span class="its its-blocked"> Blocked</span> @endif
                    </td>
                    <td class="col-md-3">
                        {{$user->email}}
                    </td>
                    <td class="col-md-3">{{ mb_strtoupper($user->provider)}}</td>
                    <td></td>
                    <td class="col-md-2 right">
                        @if($user->id  !== Auth::id())
                            @if($user->active == true)
                                <a class="no-underline" onclick="return confirm('Are you sure you want to block this User?');"
                                   href="">
                                    <span class="btn btn-danger"><i class="fas fa-ban"></i>  Block</span>
                                </a>
                            @else
                                <a class="no-underline" onclick="return confirm('Are you sure you want to block this User?');"
                                   href="">
                                    <span class="btn btn-success"><i class="far fa-check-circle"></i>  Unblock</span>
                                </a>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection