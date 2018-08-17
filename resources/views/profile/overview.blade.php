@extends('layout.app')

@section('title')
    {{Auth::user()->first_name}} {{Auth::user()->last_name}} - Profile  | {{env('APP_NAME')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 center">
                    <span class="supertitle">Settings</span>
                    <p class="undertitle">Personal Information</p>
                    @if(session('status'))
                        <div class="success center">{{session('status')}}</div>
                    @endif
                </div>
            </div>

            <form class="form-horizontal" role="form" method="POST"
                  action="{{ url('/profile') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label for="first_name" class="col-md-5 control-label">Name</label>
                    <div class="form-settings-field">
                        <input id="first_name" type="text"
                               class="form-control form-settings-field"
                               name="first_name" value="{{ $profile->first_name }}" placeholder="" autofocus>

                        @if ($errors->has('first_name'))
                            <i class="error-icon"></i>
                            <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                        @else
                            <i class="check-icon"></i>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label for="last_name" class="col-md-5 control-label">Surname</label>
                    <div class="form-settings-field">
                        <input id="last_name" type="text"
                               class="form-control form-settings-field"
                               name="last_name" value="{{ $profile->last_name }}" placeholder="">

                        @if ($errors->has('last_name'))
                            <i class="error-icon"></i>
                            <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                        @else
                            <i class="check-icon"></i>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-5 control-label">Email</label>
                    <div class="form-settings-field">
                        <input id="email" type="text"
                               {{ $profile->provider == "normal" ? "" : "readonly" }} class="form-control form-settings-field"
                               name="email" value="{{ $profile->email }}" placeholder="">
                        @if ($errors->has('email'))
                            <i class="error-icon"></i>
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @else
                            <i class="check-icon"></i>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
                    <label for="job_title" class="col-md-5 control-label">Job Title</label>
                    <div class="form-settings-field">
                        <select name="job_title" class="dropdown-settings">
                            <option @if($profile->job_title == '' && $profile->job_title == NULL)selected=""
                                    @endif disabled>Select a Job Title
                            </option>
                            @foreach($status as $s)
                                @if($s->id === $profile->job_title)
                                    <option selected="" value="{{$s->id}}">{{$s->name}}</option>
                                @else
                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('job_title') || $profile->job_title == '' && $profile->job_title == NULL)
                            <i class="error-icon"></i>
                            <span class="help-block">
                                <strong>{{ $errors->first('job_title') }}</strong>
                            </span>
                        @else
                            <i class="check-icon"></i>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-5 control-label">Password</label>
                    <div class="form-settings-field">
                        <input id="password" type="password"
                               {{ $profile->provider == "normal" ? "" : "readonly" }} class="form-control form-settings-field"
                               name="password" placeholder="">
                        @if ($errors->has('password'))
                            <i class="error-icon"></i>
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @else
                            <i class="check-icon"></i>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password_confirm') ? ' has-error' : '' }}">
                    <label for="password_confirm" class="col-md-5 control-label">Confirm Password</label>
                    <div class="form-settings-field">
                        <input id="password" type="password"
                               {{ $profile->provider == "normal" ? "" : "readonly" }} class="form-control form-settings-field"
                               name="password_confirm" placeholder="">
                        @if ($errors->has('password_confirm'))
                            <i class="error-icon"></i>
                            <span class="help-block">
                                    <strong>{{ $errors->first('password_confirm') }}</strong>
                                </span>
                        @else
                            <i class="check-icon"></i>
                        @endif
                        <a href="{{route('home')}}" class="pull-left btn btn-cancel">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-save pull-right">
                            Save
                        </button>
                    </div>
                </div>
                <div class="form-group margin-top-50">
                    <div class="col-md-12 center">
                    </div>
                </div>

            </form>

            <div class="row center">
                <h1 class="supertitle">Emails</h1>
                <div class="center">
                    <div class="row">
                        <div class="col-md-2 col-md-offset-3">
                            <label>Email</label>
                        </div>
                        <div class="col-md-2">
                            <label>Connected With</label>
                        </div>
                        <div class="col-md-1">
                            <label>Delete</label>
                        </div>
                        <div class="col-md-2">
                            <label>Make Primary Email</label>
                        </div>
                    </div>
                    @foreach($profile->getEmails() as $email => $providers)
                        <div class="row">
                            <div class="col-md-2 col-md-offset-3">
                                <label>{{$email}}</label> <span
                                        class="small">{{$profile->email == $email ? "(Primary)" : ""}}</span>
                            </div>
                            <div class="col-md-2">
                                @foreach($providers as $p)
                                    <i class="fab fa-{{$p}} fa-2x"></i>
                                @endforeach

                            </div>

                            @if($profile->email !== $email)
                                <div class="col-md-1">
                                    @include('partials.single-post-submit', [
                                    'name'  =>  '<i class="fas fa-times black fa-2x"></i>',
                                    'route' =>  'deleteEmail',
                                    'confirm'   =>  'Are you sure you want to remove this email?',
                                    'a_class' => '',
                                    'params' => array($email),
                                    ])

                                </div>

                                <div class="col-md-2">
                                    @include('partials.single-post-submit', [
                                    'name'  =>  '<i class="fas fa-check-circle black fa-2x"></i>',
                                    'route' =>  'changePrimary',
                                    'confirm'   =>  'Are you sure change your primary email?',
                                    'a_class' => '',
                                    'params' => array($email),
                                    ])
                                </div>
                            @endif


                        </div>
                    @endforeach
                    <div class="row auth-buttons margin-top-50">
                        <div class="col-md-4 col-md-offset-4 google-btn center">
                            <h4>Add more</h4>
                            <form action="{{route('addEmail')}}" method="post">
                                {{ csrf_field() }}
                                <input id="email" type="text"
                                       class="form-control form-settings-field"
                                       name="email" placeholder="New Email"/>
                                <select class="form-control input-text-modal selectpicker" name="provider[]" multiple>
                                    <option disabled="" value="">-- Select --</option>
                                    <option value="google">Google</option>
                                    <option value="github">Github</option>
                                </select>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-save pull-right">
                                        Save
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection