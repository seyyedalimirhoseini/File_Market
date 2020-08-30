{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.auth')
@section( 'content')

<div id="loginbox">
    <form id="loginform" method="POST" class="form-vertical" action="{{ route('register') }}">
        @csrf
        <div class="control-group normal_text"> <h3><img src="{{url('/admin/img/logo.png')}}" alt="Logo" /></h3></div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                   </i></span><input id="name" type="text" placeholder="نام" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />

                </div>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <small style="color: red">{{$message}}</small>
            </span>
             @enderror

            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                  </i></span><input id="email" type="email" placeholder="ایمیل" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />


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
                  </i></span><input id="phone" type="tel" placeholder="تلفن همراه" @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" />


                </div>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                <small style="color: red">{{$message}}</small>
                </span>
             @enderror
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                  <input id="password" type="password" placeholder="رمز عبور"  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"/>

                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <small style="color: red">{{$message}}</small>
                </span>
            @enderror
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                  <input id="password-confirm" type="password" placeholder="تکرار رمز عبور"   name="password_confirmation" required autocomplete="new-password"/>

                </div>
            </div>
        </div>
        <div class="form-actions">
            {{-- <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">رمز عبور خود را فراموش کرده اید؟</a></span> --}}
            {{-- <span class="pull-right"><a type="submit" href="index.html" class="btn btn-success" />  {{ __('ورود') }}</a></span> --}}
            <span class="pull-right">
                <button type="submit" class="btn btn-success">
                    {{ __('ثبت نام') }}
                </button>
            </span>
        </div>
    </form>

</div>
@endsection
