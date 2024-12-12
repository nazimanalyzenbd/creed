<!DOCTYPE html>
<html>
<head>
    <title>Password Reset OTP</title>
</head>
<body>
    <p>Hello,</p>
    <p>Here is your OTP for password reset: <strong>{{ $otp }}</strong></p>
    <p>The OTP is valid for 10 minutes.</p>
    <p>If you did not request this, please ignore this email.</p>
    <br>
    <p>Regards, <br>{{ config('app.name') }}</p>
</body>
</html>
