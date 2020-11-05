@extends('auth.layouts.app')
 {{-- @section('stylesheet')
<style type="text/css">

</style>
@endsection  --}}
@section('content')



    <!-- start: login section -->
    <section class="login-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="login-form-box">

                        <div class="logo text-center">
                            <a href="{{ url('') }}">
                                <img src="{{ url('assets/img/logo-2x.png') }}" alt="visffor-logo">
                            </a>
                        </div>


                        <h2 class="login-form-title">{{ __('auth.Already_have_an_account') }}</h2>
                         
                        <form action="{{ url('auth-login/login') }}" method="post" class="login-form">
                          {{ csrf_field() }}
                            <div class="form-group">
                                <input type="email" name="email" required class="log-fname form-control" placeholder="{{ __('auth.Enter_Your_Email_ID') }}">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="log-pass form-control" placeholder="{{ __('auth.Enter_Your_Password') }}">
                            </div>

                            <button type="submit" class="reg-signup-btn reg-login-btn">{{ __('auth.Log_In') }}</button>
                        </form>
                        <div class="fogot-pass-btn-box text-center">
                            <a href="{{ url('forgot-password') }}" class="forgot-pass-link">{{ __('auth.Forget_Password?') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: login section -->



@endsection
 {{-- @section('script')

         @endsection  --}}
