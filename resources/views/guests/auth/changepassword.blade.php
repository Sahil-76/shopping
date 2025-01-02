@extends('guests.layouts.master')
@push('title')
    <title>Change Password</title>
@endpush
@section('content')
    <div class="hold-transition login-page">
        <div class="card-header text-center">
            <img src="{{ asset('favicon.ico') }}" alt="" style="mix-blend-mode: darken;width: 5rem;">
        </div>
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <p class="login-box-msg">You are only one step a way from your new password, recover your password now.
                    </p>
                    <form action="{{ route('change-password') }}" method="post">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password_confirmation')
                               <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Change password</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mt-3 mb-1">
                        <a href="{{ route('login') }}">Login</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    @endsection
