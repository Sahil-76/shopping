<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Recovery</title>
</head>
<body>

    {{-- @dd($data) <!-- Check what data is received in the view --> --}}

    @if ($data['user']) <!-- Directly check if the user object is set -->
        <h1>Hello, {{ $data['user']->name }}</h1>
    @else
        <h1>Hello, User</h1>
    @endif

    <p>You have requested to reset your password. Please click the link below to update your password:</p>

    <a href="{{ route('password-reset', $data['token']) }}?email={{ $data['user']->email }}" target="_blank">
        Reset Password
    </a>

    <p>If you did not request a password reset, please ignore this email.</p>

    <p>This link is valid for one use only. After clicking, it will expire immediately.</p>

    <br>
    <p>Thank you!</p>
    <p><img src="{{ asset('favicon.ico') }}" alt="" style="width: 50px; height: 50px; border-radius: 10%; object-fit: cover;"></p>
</body>
</html>
