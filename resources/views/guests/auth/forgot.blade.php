@extends('guests.layouts.master')
@push('title')
    <title>Forgot Password</title>
@endpush
@section('content')
<div class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="{{ route('/') }}"><span><img src="{{ asset('favicon.ico') }}" alt="Logo"
            style="mix-blend-mode: darken;width: 5rem;"></span></a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

          <form action="{{ route('forgot-password') }}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" name="email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Request new password</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="mt-3 mb-1">
            <a href="{{ route('login') }}">Login</a>
          </p>
          <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
@endsection
