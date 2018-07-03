@extends(Auth::user() ? 'layout.app' : 'layout.loggedout')

@section('title')
    Help | {{env('APP_NAME')}}
@endsection



@section('content')
    <div class="row block-white">
        <div class="col-md-12 col-xs-12">
            <span class="block-white-title">{{env('APP_NAME')}}</span>
            <span id="count_projects_bar">|</span>
            <span>Version @version('version')</span>
        </div>
        <div class="col-md-8 col-xs-12 pull-right">
        </div>
    </div>
@endsection