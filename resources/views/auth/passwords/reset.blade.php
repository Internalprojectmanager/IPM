@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 center">
                    <span class="supertitle">Reset Password</span>
                    <p class="undertitle">Enter your email address and new password to change your account password</p>
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if(config('app.secure') == TRUE)
                <form class="form-horizontal" role="form" method="POST" action="{{ secure_url('/password/request') }}">
                    @else
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/request') }}">
                            @endif
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-5 control-label">E-Mail Address</label>

                                <div class="form-forgot-field">
                                    <input id="email" type="email" class="form-control form-control-login form-forgot-field" name="email"
                                           value="{{ $email or old('email') }}"
                                           required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-5 control-label">Password</label>

                                <div class="form-forgot-field">
                                    <input id="password" type="password" class="form-control form-control-login form-forgot-field" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} ">
                                <label for="password-confirm" class="col-md-5 control-label">Confirm Password</label>
                                <div class="form-forgot-field">
                                        <input id="password-confirm" type="password" class="form-control form-control-login form-forgot-field"
                                               name="password_confirmation"
                                               required>

                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>


                                        @endif
                                        <button type="submit" class="btn btn-primary pull-right">
                                            Reset Password
                                        </button>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-6 pull-right">

                                </div>
                            </div>
                        </form>
        </div>
    </div>
@endsection
