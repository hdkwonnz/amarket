@extends('layouts.app')
@section('title')
Register
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="margin-top: 50px; margin-bottom: 50px;">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">
                    <b style="font-size: 19px;">Register</b>
                </div>

                <div class="panel-body">
                    <form name="form" id="form" class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" onsubmit="return(validate());">
                        {{ csrf_field() }}

                        <!--Email Verification을 위해 추가. 사용 중지.12/04/2019-->
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus />

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required />

                                @if ($errors->has('lastname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required />

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>                       

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required />

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required />

                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{$errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <!--google API reCaptcha-->
                        <!--RegisterController.php를 반드시 참고 할 것. 07/03/2019-->
                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-4">
                                <!--www.google.com/recaptcha/admin에서 amarket.test를 등록 한후 새로운 site key, secret key를 얻어-->
                                <!--.env file에 등록 한 후 사용. controller 참조 할 것-->
                                <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>

                                @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                                @endif
                                @if ($errors->has('captcha'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('captcha') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" id="submit" name="submit" class="btn btn-default btn-primary" value="Register" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="/myJs/registerValidationByJavaScript.js"></script><!--admin/register는 다른 js를 쓴다.12/04/2019-->
@endsection
