@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 center">
                    <span class="supertitle">Reset Password</span>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @else
                        <p class="undertitle">Enter your email address. You will receive an email with a link to reset your password.</p>
                    @endif
                </div>
            </div>



            @if(config('app.secure') == TRUE)
                <form class="form-horizontal" role="form" method="POST" action="{{ secure_url('/password/email') }}">
            @else
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
            @endif

             {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-5 control-label">E-Mail Address*</label>
                    <div class="form-forgot-field">
                        <input id="email" type="email" class="form-control form-control-login form-control-forgot" name="email" value="{{ old('email') }}" required>
                        <button type="submit" class="btn btn-danger pull-right">
                            Reset Password
                        </button>
                    </div>
                </div>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
