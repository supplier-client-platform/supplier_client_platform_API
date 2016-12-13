<!Doctype html>
<head>
    <title>Password reset : Supplier Client Platform</title>
</head>
<body>
<p>
    Hello {{$data->name}}, <br>
    You requested a password reset for your account with this email. Please use this as your new password to login to your account.
    Please consider changing this password to a one you can remember after logging in.<br>

    <b>New Password : {{$data2['newPassword']}}</b> <br>

    Thanks, <br>

    Supplier Client Platform Team
</p>
<sub>*p.s. Do not reply to this mail. We do not check this inbox.</sub>
</body>
</html>