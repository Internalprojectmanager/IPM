@extends(Auth::user() ? 'layout.app' : 'layout.loggedout')

@section('title')
    Help | {{env('APP_NAME')}}
@endsection



@section('content')
    <div class="row block-white">
        <div class="col-md-12 col-xs-12">
            <span class="block-white-title">{{env('APP_NAME')}} - <?php  echo file_get_contents(public_path('../VERSION'), 'r'); ?></span>
            <span id="count_projects_bar">|</span>
            <span class="block-white-subtitle black">
                <span style="margin-left: 10px; vertical-align: middle">
                        <span class="status-{{$version[0]['color']}} white" style="padding: 10px">{{$version[0]['response']}}</span>
                    @if($version[0]['major'] !== "" && $version[0]['major'] !== null)
                        <span class="status-{{$version[0]['major_color']}} white" style="padding: 10px">{{$version[0]['major']}}</span>
                    @endif
                </span>

            </span>
        </div>
        <div class="col-md-8 col-xs-12 pull-right">
        </div>
    </div>

    <div class="block-white row">
        <div class="col-md-12">
            <h3>Quick links</h3>
            <ul class="black">
                <li>
                    <a class="black" href="{{route('terms')}}">
                        <i class="fas fa-file-alt"></i>
                        <span  style="margin-left: 5px;">Terms of use</span>
                    </a>
                </li>
                <li>
                    <a class="black" href="https://gitlab.com/internalprojectmanager/IPM">
                        <i class="fab fa-gitlab"></i>
                        Gitlab</a>
                </li>
                <li>
                    <a class="black" href="https://twitter.com/internalpm">
                        <i class="fab fa-twitter"></i>
                        Twitter</a>
                </li>
            </ul>
        </div>
    </div>
@endsection