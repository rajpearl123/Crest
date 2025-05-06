<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password</title>
</head>
<body>
    <p>Hello,</p>
    <p>You requested a password reset. Click the link below to reset your password:</p>
    <p>
        <a href="{{ $resetLink }}" style="background-color: #007bff; color: white; padding: 10px 15px; text-decoration: none; display: inline-block; border-radius: 5px;">
            Reset Password
        </a>
    </p>
    <p>This link will expire in 5 minutes.</p>
    <p>If you did not request this, please ignore this email.</p>
</body>
</html>
