{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- @endsection --}}
@extends('layouts.auth')
        @section('content')

                <div id="loginbox">
                    <form id="loginform" method="POST" class="form-vertical" action="{{ route('login') }}">
                        @csrf
                        <div class="control-group normal_text"> <h3><img src="{{url('/admin/img/logo.png')}}" alt="Logo" /></h3></div>
                        <div class="control-group">
                            <div class="controls">
                                <div class="main_input_box">
                                    <span class="add-on bg_lg"><i class="icon-user"> </i></span><input id="email" type="email" placeholder="ایمیل" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

                                </div>
                                 @error('email')
                                          <span class="invalid-feedback" role="alert">
                                            <small style="color: red">{{$message}}</small>
                                           </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <div class="main_input_box">
                                    <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="رمز عبور" name="password"  @error('password') is-invalid @enderror required autocomplete="current-password"/>

                                </div>
                            @error('password')
                                     <span class="invalid-feedback" role="alert">
                                        <small style="color: red">{{$message}}</small>
                                    </span>
                              @enderror
                            </div>
                        </div>
                        <div class="form-actions">
                            <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">رمز عبور خود را فراموش کرده اید؟</a></span>
                            {{-- <span class="pull-right"><a type="submit" href="index.html" class="btn btn-success" />  {{ __('ورود') }}</a></span> --}}
                            <span class="pull-right">
                            <button type="submit" class="btn btn-success">
                                {{ __('ورود') }}
                            </button>
                            </span>

                        <span class="pull-right"><a href="{{route('register')}}" class="btn btn-success" id="to-recover">ثبت نام</a></span>

                        </div>
                    </form>
                    <form id="recoverform" action="#" class="form-vertical">
        				<p class="normal_text">ایمیل خود را در زیر وارد کنید و ما دستورالعمل نحوه بازیابی رمز عبور را برای شما ارسال خواهیم کرد.</p>

                            <div class="controls">
                                <div class="main_input_box">
                                    <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="آدرس ایمیل" />
                                </div>
                            </div>

                        <div class="form-actions">
                            <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; بازگشت به صفحه ورود</a></span>
                            <span class="pull-right"><a class="btn btn-info"/>بازیابی دوباره</a></span>
                        </div>
                    </form>
                </div>

               @endsection
