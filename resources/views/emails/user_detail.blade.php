<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Naturolia!</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2 style="color: #4CAF50;">Welcome to Naturolia!</h2>
    <p>Dear {{ $name }},</p>
    <p>Your account has been created successfully. You can log in using the following credentials:</p>

    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>

    <p>We recommend changing your password after logging in.</p>

    <p>Thank you for shopping with us!</p>
    <p>Best regards,<br><strong>The Naturolia Team</strong></p>
</body>
</html>
