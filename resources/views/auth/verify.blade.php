@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 200px; margin-bottom: 200px;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 40px;">{{ __('Verify Your Email Address') }}</div>
                <br />
                <br />
                <div class="card-body" style="font-size: 30px;">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}"><span style="color: blue;">{{ __('click here to request another') }}</span></a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
