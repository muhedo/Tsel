@extends('layouts.login_temp')

@section('title',"Login")
@section('page_title',"")

@section('content')
<div class="panel-body">
    <form id="loginForm" method="POST" action="{{ route('login') }}">
      @csrf

      <div class="form-group">
          <label for="email" class="control-label">{{ __('Email') }}</label>

          <div class="form-group">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>

      <div class="form-group">
          <label for="password" class="control-label">{{ __('Password') }}</label>

          <div class="form-group">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>

      <div class="form-group">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                  </label>
          </div>
      </div>

      <div style="text-align: right">
              <button type="submit" class="btn btn-primary">
                  {{ __('Login') }}
              </button>
              
              {{-- <a class="btn btn-default btn-primary" href="{{ asset ('register') }}">Register</a> --}}
      </div>
  </form>
  </div>
@endsection
