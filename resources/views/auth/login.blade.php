@extends('layouts.app')

@section('title')
Login
@endsection

@section('content')
<div>
    <!--<a href="/home/index">Home</a>
    &nbsp;&nbsp;> &nbsp;&nbsp;-->
    <a href="/">Home</a>
    &nbsp;&nbsp;> &nbsp;&nbsp;
    <a href="#">
        <b>로그인</b>
    </a>
</div>

<div class="row" style="margin-top: 100px; margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div style="border-top: 2px solid rgba(0, 0, 255, 0.75); min-height: 40px;
                    width: 100%; background-color: rgba(128, 128, 128, 0.14);
                    font-size: 20px; line-height: 40px; vertical-align: central;
                    text-align: center;">
            <span>
                고객님은 현재
                <span style="color: #31ff00;">
                    <b>바로접속 ON</b>
                </span>이십니다.
            </span>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12">
        <i class="glyphicon glyphicon-off" style="font-size: 25px; color: rgba(128, 128, 128, 0.76);
                                                  margin-top: 30px; margin-left: 30px;"></i>
        <span style="font-size: 25px;">
            <b>로그인</b>
        </span>
        <hr style="margin-top: 0px;" />
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6">
        <div style="margin-left: 50px;">
            <form action="{{ url('/login') }}" method="post" class="form-horizontal">
                {{ csrf_field() }}                                
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-md-2 col-lg-2 control-label">Email</label>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <input type="email" id="email" name="email" class="form-control" maxlength="30" value="{{ old('email') }}" required autofocus />
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-md-2 col-lg-2 control-label">Password</label>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <input type="password" id="password" name="password" class="form-control" maxlength="30" required />
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{$errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2 col-md-2 col-lg-2"></div>
                    <div class="col-md-6 ">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" />Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 50px;">
                    <div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-sm-8 col-md-8 col-lg-8">
                        <input type="submit" class="btn btn-lg btn-primary" value="Login" />
                    </div>                  
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-sm-8 col-md-8 col-lg-8">
                        <a class="btn btn-link" href="{{ url('/password/reset') }}" style="padding-left: 0px;">
                            Forgot Your Password?
                        </a>
                    </div>                    
                </div>
            </form>
            
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 100px;">
        <a href="#">
            <!--<img src="/imageOwner/loginAdtmt.JPG" class="img-responsive" />-->
            <img src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/loginAdtmt.JPG" class="img-responsive" />

        </a>
    </div>
</div>

@endsection
