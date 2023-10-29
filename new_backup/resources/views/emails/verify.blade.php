<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Email Verification</title>
</head>
<body>
    <h2>Email Verification</h2>
    <p>Hello, {{$student->name}},</p>
    <p>Thank you for registering. Please click the link below to verify your email address:</p>
    <a href="{{ $verificationUrl }}">Verify Email Address</a>
    <p>If you did not create an account, no further action is required.</p>
    <br>
    <p>Best regards,</p>
    <p>Your Application Team</p>
</body>
</html>
