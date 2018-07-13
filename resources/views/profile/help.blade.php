@extends(Auth::user() ? 'layout.app' : 'layout.loggedout')

@section('title')
    Help | {{env('APP_NAME')}}
@endsection



@section('content')
    <div class="row block-white">
        <div class="col-md-12 col-xs-12">
            <span class="block-white-title">{{env('APP_NAME')}}</span>
            <span id="count_projects_bar">|</span>
            <span class="block-white-subtitle black"><?php  echo file_get_contents(public_path('../VERSION'), 'r'); ?> </span>
            <span id="count_projects_bar">|</span>
            <span>Build: <a href="https://gitlab.com/internalprojectmanager/IPM/commit/@version('build')">#@version('build')</a></span>
        </div>
        <div class="col-md-8 col-xs-12 pull-right">
        </div>
    </div>
@endsection