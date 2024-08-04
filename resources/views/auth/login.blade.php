@extends('layouts.login-template')

@section('content')
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('assets/media/bg/bg-3.jpg');">
                <div class="login-form text-center p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <img src="{{asset('images/logo/Walkin_Logo.png')}}" class="max-h-120px" alt="" />
                        </a>
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                    {{--<div class="mb-20">
                            <h3>เข้าสู่ระบบ</h3>
                            <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
                        </div> --}}
                        {{-- <form class="form" id="kt_login_signin_form"> --}}
                        <form method="POST" id="kt_login_signin_form" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-5">
                                <input id="email" class="form-control h-auto form-control-solid py-4 px-8 @error('username') is-invalid @enderror" type="text" placeholder="ชื่อเข้าใช้ระบบ" name="username" autocomplete="off" />
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                @if( $message == 'These credentials do not match our records.')
                                                    ไม่สามารถเข้าสู่ระบบได้ กรุณาลองใหม่ อีกครั้ง !!!
                                                @else
                                                    กรุณากรอก ชื่อเข้าสู่ระบบ
                                                @endif
                                            </strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8 @error('password') is-invalid @enderror" type="password" placeholder="รหัสผ่าน" name="password" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>กรุณากรอก รหัสผ่าน</strong>
                                        </span>
                                    @enderror
                            </div>
                            {{-- <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                                <div class="checkbox-inline">
                                    <label class="checkbox m-0 text-muted">
                                    <input type="checkbox" name="remember" />
                                    <span></span>Remember me</label>
                                </div>
                                <a href="javascript:;" id="kt_login_forgot" class="text-muted text-hover-primary">Forget Password ?</a>
                            </div> --}}
                            <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">เข้าสู่ระบบ</button>
                        </form>
                        {{-- <div class="mt-10">
                            <span class="opacity-70 mr-4">Don't have an account yet?</span>
                            <a href="javascript:;" id="kt_login_signup" class="text-muted text-hover-primary font-weight-bold">Sign Up!</a>
                        </div> --}}
                    </div>
                    <!--end::Login Sign in form-->
                    <!--begin::Login Sign up form-->

                    <!--begin::Login forgot password form-->
                    <div class="login-forgot">
                        <div class="mb-20">
                            <h3>Forgotten Password ?</h3>
                            <div class="text-muted font-weight-bold">Enter your email to reset your password</div>
                        </div>
                    </div>
                    <!--end::Login forgot password form-->
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
@endsection
